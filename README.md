Doctrine Functions
==================

[[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/luxifer/doctrine-functions/badges/quality-score.png?s=32406f6c6df4378a2f352bd062707d3c7a0216ea)](https://scrutinizer-ci.com/g/luxifer/doctrine-functions/) [![Code Coverage](https://scrutinizer-ci.com/g/luxifer/doctrine-functions/badges/coverage.png?s=6701d974c062e2c98ec2a556ba8ba4db76667e68)](https://scrutinizer-ci.com/g/luxifer/doctrine-functions/) [![Latest Stable Version](https://poser.pugx.org/luxifer/doctrine-functions/v/stable.png)](https://packagist.org/packages/luxifer/doctrine-functions) [![Total Downloads](https://poser.pugx.org/luxifer/doctrine-functions/downloads.png)](https://packagist.org/packages/luxifer/doctrine-functions)

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
* `CONVERT_TZ(expr, 'from_tz', 'to_tz')` (MySQL)
* `DATE_FORMAT(expr, 'format')` (MySQL)
* `CONCAT_WS(separator, str1, str2, ...)` (MySQL)
* `RAND()` (MySQL)
* `MD5(expr)` (MySQL, Postgres)
* `FROM_UNIXTIME(expr1, expr2)` (MySQL)

Edit this file in your pull request to add your functions to the list.

Requirements
------------

This library is expected to work with PHP >= 5.3, but you should consider to upgrade to PHP >= 7.0. To contribute to this library you must have PHP >= 7.0 to run the test suite.

Installation
------------

Just add the package to your `composer.json`

```json
{
    "require": {
        "luxifer/doctrine-functions": "^1.5"
    }
}
```

Integration
-----------

### 1) Doctrine Only

According to the [Doctrine documentation](http://doctrine-orm.readthedocs.org/en/latest/cookbook/dql-user-defined-functions.html "Doctrine documentation") you can register the functions in this package this way.

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
