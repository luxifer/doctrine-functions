<?php

namespace Luxifer\Tests;

class NumericTest extends DQLFunctionTest
{
    /**
     * Test RAND function
     */
    public function testRand()
    {
        $query = $this->em->createQuery(
            sprintf("SELECT RAND() FROM %s as s0_", self::FAKE_ENTITY)
        );

        $this->assertEquals(
            "SELECT RAND() AS sclr_0 FROM some_fake s0_",
            $query->getSQL()
        );
    }
}
