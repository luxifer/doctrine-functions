<?php

namespace Luxifer\Tests;

abstract class DQLFunctionTest extends \PHPUnit_Framework_TestCase
{
    protected $config;

    protected function _getEntityManager()
    {
        $this->config = new \Doctrine\ORM\Configuration();

        $conn = array(
            'driverClass'  => 'Doctrine\Tests\Mocks\DriverMock',
            'wrapperClass' => 'Doctrine\Tests\Mocks\ConnectionMock',
            'user'         => 'john',
            'password'     => 'wayne'
        );

        $conn = \Doctrine\DBAL\DriverManager::getConnection($conn, $this->config);

        $this->config->setProxyDir(__DIR__ . '/Proxies');
        $this->config->setProxyNamespace('Luxifer\Tests\Proxies');
        $this->config->addCustomDatetimeFunction('date', 'Luxifer\DQL\Datetime\Date');
        $this->config->addCustomDatetimeFunction('datediff', 'Luxifer\DQL\Datetime\DateDiff');
        $this->config->addCustomDatetimeFunction('dayofmonth', 'Luxifer\DQL\Datetime\DayOfMonth');
        $this->config->addCustomDatetimeFunction('dayofweek', 'Luxifer\DQL\Datetime\DayOfWeek');
        $this->config->addCustomDatetimeFunction('dayofyear', 'Luxifer\DQL\Datetime\DayOfYear');
        $this->config->addCustomDatetimeFunction('hour', 'Luxifer\DQL\Datetime\Hour');
        $this->config->addCustomDatetimeFunction('minute', 'Luxifer\DQL\Datetime\Minute');
        $this->config->addCustomDatetimeFunction('month', 'Luxifer\DQL\Datetime\Month');
        $this->config->addCustomDatetimeFunction('second', 'Luxifer\DQL\Datetime\Second');
        $this->config->addCustomDatetimeFunction('time', 'Luxifer\DQL\Datetime\Time');
        $this->config->addCustomDatetimeFunction('year', 'Luxifer\DQL\Datetime\Year');

        return \Doctrine\Tests\Mocks\EntityManagerMock::create($conn, $this->config);
    }
}