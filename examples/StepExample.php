<?php

use Pietrantonio\Floware\Step;

// It must extends Step class
class StepExample extends Step
{
    // It must have the execute method
    public function execute($entity)
    {
        // do something with entity
        
        // it must return the entity
        return $entity;
    }
}