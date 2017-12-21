<?php

namespace Luxifer\Tests;

class StringTest extends DQLFunctionTest
{
    /**
     * Test CONCAT_WS function
     *
     * @dataProvider concatProvider
     */
    public function testConcatWs($dql, $sql)
    {
        $query = $this->em->createQuery(
            sprintf("SELECT CONCAT_WS(%s) FROM %s as e", $dql, self::FAKE_ENTITY)
        );

        $this->assertEquals(
            sprintf("SELECT CONCAT_WS(%s) AS sclr_0 FROM some_fake s0_", $sql),
            $query->getSQL()
        );
    }

    /**
     * Data provider
     * @codeCoverageIgnore
     */
    public function concatProvider()
    {
        return array(
            array("'', '1', '2'", "'', '1', '2'"),
            array("' ', '1', '2', '3'", "' ', '1', '2', '3'"),
            array("', ', '1', '2', '3', '4'", "', ', '1', '2', '3', '4'"),
            array("' ', e.id, '2'", "' ', s0_.id, '2'"),
        );
    }

    /**
     * Expect at least 3 arguments
     *
     * @expectedException \Doctrine\ORM\Query\QueryException
     */
    public function testConcatWsFail()
    {
        $query = $this->em->createQuery(
            sprintf("SELECT CONCAT_WS(' ', '1') FROM %s as e", self::FAKE_ENTITY)
        );

        $query->getSQL();

        $this->fail('Should have failed');
    }

    /**
     * Test MD5 function
     */
    public function testMd5()
    {
        $query = $this->em->createQuery(
            sprintf("SELECT MD5(s0_.somedate) FROM %s as s0_", self::FAKE_ENTITY)
        );

        $this->assertEquals(
            "SELECT MD5(s0_.somedate) AS sclr_0 FROM some_fake s0_",
            $query->getSQL()
        );
    }

    /**
     * Test IF function
     *
     * @dataProvider ifProvider
     */
    public function testIfElse($dql, $sql)
    {
        $query = $this->em->createQuery(
            sprintf("SELECT IF(%s) FROM %s as e", $dql, self::FAKE_ENTITY)
        );

        $this->assertEquals(
            sprintf("SELECT IF(%s) AS sclr_0 FROM some_fake s0_", $sql),
            $query->getSQL()
        );
    }

    /**
     * @codeCoverageIgnore
     */
    public function ifProvider()
    {
        return array(
            array('1 > 2, e.id, e.somedate', '1 > 2, s0_.id, s0_.somedate'),
        );
    }
}
