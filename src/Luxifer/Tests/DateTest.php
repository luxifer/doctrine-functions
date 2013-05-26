<?php

namespace Luxifer\Tests;

class DateTest extends DQLFunctionTest
{
    public function testDate()
    {
        $em = $this->_getEntityManager();
        $query = $em->createQuery("SELECT DATE('2003-12-31 01:02:03')");

        $this->assertEquals($query->getSQL(), "SELECT DATE('2003-12-31 01:02:03')");
    }
}