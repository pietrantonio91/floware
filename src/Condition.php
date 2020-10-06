<?php 

namespace Pietrantonio\Floware;

use Pietrantonio\Floware\Interfaces\ConditionInterface;

class Condition implements ConditionInterface
{
    /**
     * Called when a condition class is used as closure.
     * Call check method.
     *
     * @param mixed $entity
     * @return mixed
     */
    public function __invoke($entity)
    {
        return $this->check($entity);
    }

    /**
     * Method to implement by custom condition.
     *
     * @param mixed $entity
     * @return mixed
     */
    public function check($entity)
    {
        return true;
    }
}
