<?php
/*
 * This file bootstraps the test environment.
 */
namespace Luxifer\Tests;

error_reporting(E_ALL | E_STRICT);

require_once __DIR__ . "/../../../vendor/autoload.php";

$classLoader = new \Doctrine\Common\ClassLoader('Doctrine\Tests\Mocks', __DIR__ . '/../../../vendor/doctrine/orm/tests/');
$classLoader->register();
