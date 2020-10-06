<?php 

namespace Pietrantonio\Floware;

use Pietrantonio\Floware\Interfaces\StepInterface;

class Step implements StepInterface
{
    /**
     * Called when a step is used as closure.
     * Call execute method passing entity variable.
     *
     * @param mixed $entity
     * @return mixed
     */
    public function __invoke($entity)
    {
        return $this->execute($entity);
    }

    /**
     * Method to implement by custom step.
     *
     * @param mixed $entity
     * @return mixed
     */
    public function execute($entity)
    {
        return $entity;
    }
}
