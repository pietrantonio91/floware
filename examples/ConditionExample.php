<?php

use Pietrantonio\Floware\Condition;

// It must extends Condition class
class CountGreaterThen1 extends Condition
{
    // It must have the check method
    public function check($entity)
    {
        // it must return a boolean
        return true;
    }
}