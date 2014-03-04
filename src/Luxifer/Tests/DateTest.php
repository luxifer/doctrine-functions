<?php

namespace Luxifer\Tests;

class DateTest extends DQLFunctionTest
{
    const FAKE_ENTITY = 'Luxifer\Tests\Fixtures\Entity\Fake';

    public function testDate()
    {
        $query = $this->em->createQuery(sprintf("SELECT DATE('2003-12-31 01:02:03') FROM %s", self::FAKE_ENTITY));

        $this->assertEquals(
            $query->getSQL(),
            "SELECT DATE('2003-12-31 01:02:03') AS sclr0 FROM some_fake s0_"
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
            $query->getSQL(),
            sprintf("SELECT %s(s0_.somedate) AS sclr0 FROM some_fake s0_", strtoupper($part))
        );
    }

    /**
     * Data provider
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
        ];
    }

    public function testConvertTZ()
    {
        $query = $this->em->createQuery(sprintf("SELECT CONVERT_TZ(s0_.somedate, 'UTC', 'Europe/Kiev') FROM %s s0_", self::FAKE_ENTITY));

        $this->assertEquals(
            $query->getSQL(),
            "SELECT CONVERT_TZ(s0_.somedate, 'UTC', 'Europe/Kiev') AS sclr0 FROM some_fake s0_"
        );
    }
}
