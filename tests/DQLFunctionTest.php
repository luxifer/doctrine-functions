<?php

namespace Luxifer\Tests;

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\ORMSetup;
use Luxifer\Tests\Mocks\EntityManagerMock;
use Luxifer\Tests\Mocks\QuotingStrategy;
use PHPUnit\Framework\TestCase;

abstract class DQLFunctionTest extends TestCase
{
    const FAKE_ENTITY = 'Luxifer\Tests\Fixtures\Entity\Fake';

    protected $config;

    /** @var EntityManagerMock */
    protected $em;

    public function setUp(): void
    {
        $this->em = $this->getEntityManagerInstanceMock();
    }

    public function tearDown(): void
    {
        unset($this->em);
    }

    /**
     * Just for internal use, could be overridden in child classes
     * User $em property in case if you need EntityManager
     *
     * @return EntityManagerMock
     */
    protected function getEntityManagerInstanceMock()
    {
        $this->config = ORMSetup::createAttributeMetadataConfiguration(array('./Fixtures'), true);
        $this->config->setQuoteStrategy(new QuotingStrategy());

        $conn = array(
            'driverClass'  => 'Luxifer\Tests\Mocks\DriverMock',
            'wrapperClass' => 'Luxifer\Tests\Mocks\ConnectionMock',
            'user'         => 'john',
            'password'     => 'wayne'
        );

        $conn = DriverManager::getConnection($conn, $this->config);

        $this->config->setProxyDir(__DIR__ . '/Proxies');
        $this->config->setProxyNamespace('Luxifer\Tests\Proxies');
        $this->config->addCustomDatetimeFunction('date', 'Luxifer\DQL\Datetime\Date');
        $this->config->addCustomDatetimeFunction('datediff', 'Luxifer\DQL\Datetime\DateDiff');
        $this->config->addCustomDatetimeFunction('day', 'Luxifer\DQL\Datetime\Day');
        $this->config->addCustomDatetimeFunction('dayofmonth', 'Luxifer\DQL\Datetime\DayOfMonth');
        $this->config->addCustomDatetimeFunction('week', 'Luxifer\DQL\Datetime\Week');
        $this->config->addCustomDatetimeFunction('dayofweek', 'Luxifer\DQL\Datetime\DayOfWeek');
        $this->config->addCustomDatetimeFunction('dayofyear', 'Luxifer\DQL\Datetime\DayOfYear');
        $this->config->addCustomDatetimeFunction('hour', 'Luxifer\DQL\Datetime\Hour');
        $this->config->addCustomDatetimeFunction('minute', 'Luxifer\DQL\Datetime\Minute');
        $this->config->addCustomDatetimeFunction('month', 'Luxifer\DQL\Datetime\Month');
        $this->config->addCustomDatetimeFunction('quarter', 'Luxifer\DQL\Datetime\Quarter');
        $this->config->addCustomDatetimeFunction('second', 'Luxifer\DQL\Datetime\Second');
        $this->config->addCustomDatetimeFunction('time', 'Luxifer\DQL\Datetime\Time');
        $this->config->addCustomDatetimeFunction('year', 'Luxifer\DQL\Datetime\Year');
        $this->config->addCustomDatetimeFunction('convert_tz', 'Luxifer\DQL\Datetime\ConvertTZ');
        $this->config->addCustomDatetimeFunction('date_format', 'Luxifer\DQL\Datetime\DateFormat');
        $this->config->addCustomStringFunction('concat_ws', 'Luxifer\DQL\String\ConcatWs');
        $this->config->addCustomStringFunction('md5', 'Luxifer\DQL\String\Md5');
        $this->config->addCustomStringFunction('if', 'Luxifer\DQL\String\IfElse');
        $this->config->addCustomNumericFunction('rand', 'Luxifer\DQL\Numeric\Rand');

        return EntityManagerMock::create($conn, $this->config);
    }
}
