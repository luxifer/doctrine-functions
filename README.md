Doctrine Functions
==================

This package contains doctrine functions, you can contribute by forking it and propose pull request with your own functions.
By defaults it add these:

* `DATE()`
* `DAYOFWEEK()`
* `HOUR()`

Edit this file in your pull request to add your function to the list.

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

### Using Symfony 2

With symfony 2 you can register yout functions directly in the `config.yml` file.

```yaml
doctrine:
    orm:
        entity_managers:
            default:
                dql:
                    datetime_functions:
                        date: Luxifer\DQL\Datetime\Date
```