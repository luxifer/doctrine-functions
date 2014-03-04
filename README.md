Doctrine Functions
==================

This package contains doctrine functions, you can contribute by forking it and propose pull request with your own functions.
List of available functions:

* `DATE(expr)`
* `DATEDIFF(expr1, expr2)`
* `DAYOFWEEK(expr)`
* `WEEK(expr)`
* `DAY(expr)`
* `DAYOFMONTH(expr)`
* `DAYOFYEAR(expr)`
* `HOUR(expr)`
* `MINUTE(expr)`
* `MONTH(expr)`
* `QUARTER(expr)`
* `SECOND(expr)`
* `TIME(expr)`
* `YEAR(expr)`
* `CONVERT_TZ(expr, 'from_tz', 'to_tz')` (MySQL implementation ONLY)

Edit this file in your pull request to add your functions to the list.

Installation
------------

Just add the package to your `composer.json`

```json
{
    "require": {
        "luxifer/doctrine-functions": "dev-master"
    }
}
```

Integration
-----------

### 1) Doctrine Only

According to the [Doctrine documentation](http://docs.doctrine-project.org/en/2.0.x/cookbook/dql-user-defined-functions.html "Doctrine documentation") you can register the functions in this package this way.

```php
<?php
$config = new \Doctrine\ORM\Configuration();
$config->addCustomDatetimeFunction('date', 'Luxifer\DQL\Datetime\Date');

$em = EntityManager::create($dbParams, $config);
```

### 2) Using Symfony 2

With Symfony 2 you can register your functions directly in the `config.yml` file.

```yaml
doctrine:
    orm:
        entity_managers:
            default:
                dql:
                    datetime_functions:
                        date:     Luxifer\DQL\Datetime\Date
                        datediff: Luxifer\DQL\Datetime\DateDiff
                        # etc
```

TODO
----

* Add test case using phpspec
