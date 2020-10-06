<?php 

namespace Pietrantonio\Floware\Interfaces;

/**
 * Interface of a single condition.
 */
interface ConditionInterface
{
    public function __invoke($entity);

    public function check($entity);
}
