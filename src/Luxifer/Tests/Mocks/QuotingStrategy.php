<?php

namespace Luxifer\Tests\Mocks;

use Doctrine\ORM\Mapping\DefaultQuoteStrategy;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\ORM\Mapping\ClassMetadata;

class QuotingStrategy extends DefaultQuoteStrategy
{
    public function getColumnAlias($columnName, $counter, AbstractPlatform $platform, ClassMetadata $class = null)
    {
        // 1 ) Concatenate column name and counter
        // 2 ) Trim the column alias to the maximum identifier length of the platform.
        //     If the alias is to long, characters are cut off from the beginning.
        // 3 ) Strip non alphanumeric characters
        // 4 ) Prefix with "_" if the result its numeric
        $columnName = $columnName . '_' . $counter;
        $columnName = substr($columnName, -$platform->getMaxIdentifierLength());
        $columnName = preg_replace('/[^A-Za-z0-9_]/', '', $columnName);
        $columnName = is_numeric($columnName) ? '_' . $columnName : $columnName;

        return $platform->getSQLResultCasing($columnName);
    }
}
