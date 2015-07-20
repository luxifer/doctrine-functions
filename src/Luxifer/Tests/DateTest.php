<?php

namespace Luxifer\Tests;

class DateTest extends DQLFunctionTest
{
    const FAKE_ENTITY = 'Luxifer\Tests\Fixtures\Entity\Fake';

    public function testDate()
    {
        $query = $this->em->createQuery(
            sprintf("SELECT DATE('2003-12-31 01:02:03') FROM %s", self::FAKE_ENTITY)
        );

        $this->assertEquals(
            "SELECT DATE('2003-12-31 01:02:03') AS sclr_0 FROM some_fake s0_",
            $query->getSQL()
        );
    }

    /**
     * Test that Doctrine able to parse DQL without exceptions
     *
     * @dataProvider partsProvider
     */
    public function testDateParts($part)
    {
        $query = $this->em->createQuery(
            sprintf("SELECT %s(s0_.somedate) FROM %s as s0_", strtoupper($part), self::FAKE_ENTITY)
        );

        $this->assertEquals(
            sprintf("SELECT %s(s0_.somedate) AS sclr_0 FROM some_fake s0_", strtoupper($part)),
            $query->getSQL()
        );
    }

    /**
     * Data provider
     * @codeCoverageIgnore
     */
    public function partsProvider()
    {
        return [
            ['date'],
            ['month'],
            ['dayofmonth'],
            ['dayofweek'],
            ['dayofyear'],
            ['quarter'],
            ['week'],
            ['day'],
            ['time'],
            ['year'],
            ['minute'],
            ['hour'],
            ['second']
        ];
    }

    public function testConvertTZ()
    {
        $query = $this->em->createQuery(
            sprintf("SELECT CONVERT_TZ(s0_.somedate, 'UTC', 'Europe/Kiev') FROM %s s0_", self::FAKE_ENTITY)
        );

        $this->assertEquals(
            "SELECT CONVERT_TZ(s0_.somedate, 'UTC', 'Europe/Kiev') AS sclr_0 FROM some_fake s0_",
            $query->getSQL()
        );
    }

    public function testDateDiff()
    {
        $query = $this->em->createQuery(
            sprintf("SELECT DATEDIFF(s0_.somedate, CURRENT_DATE()) FROM %s s0_", self::FAKE_ENTITY)
        );

        $this->assertEquals(
            "SELECT DATEDIFF(s0_.somedate, CURRENT_DATE) AS sclr_0 FROM some_fake s0_",
            $query->getSQL()
        );
    }

    public function testDateFormat()
    {
        $query = $this->em->createQuery(
            sprintf("SELECT DATE_FORMAT(s0_.somedate, '%%Y %%M') FROM %s s0_", self::FAKE_ENTITY)
        );

        $this->assertEquals(
            "SELECT DATE_FORMAT(s0_.somedate, '%Y %M') AS sclr_0 FROM some_fake s0_",
            $query->getSQL()
        );
    }
}
