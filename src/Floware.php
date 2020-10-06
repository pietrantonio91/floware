<?php 

namespace Pietrantonio\Floware;

use Pietrantonio\Floware\Traits\Config;

class Floware
{
    /**
     * Config trait
     */
    use Config;

    /**
     * The variable used by all steps in this stepper.
     *
     * @var mixed
     */
    protected $entity;

    /**
     * Create new Floware instance.
     *
     * @param mixed $entity
     */
    public function __construct($entity = null)
    {   
        if($entity)
            $this->entity = $entity;
    }

    /**
     * Set entity to Floware instance. (Synonym of constructor)
     *
     * @param mixed $entity
     * @return $this
     */
    public function use($entity)
    {
        $this->entity = $entity;
        return $this;
    }

    /**
     * Set entity to Floware instance by reference.
     *
     * @param mixed $entity
     * @return $this
     */
    public function useByReference(&$entity)
    {
        $this->entity = &$entity;
        return $this;
    }

    /**
     * Set one single step.
     *
     * @param callable $step
     * @return $this
     */
    public function then(callable $step)
    {
        $new_entity = $step($this->entity);

        // Check if new entity is null. Probably because dev forgot a return
        if($this->config['entity_nullable'] && $new_entity === null)
            throw new \Exception('Entity is null. Maybe you forgot a return?');

        $this->entity = $new_entity;

        return $this;
    }

    /**
     * Set one single step if a condition is verified.
     *
     * @param callable $step
     * @param bool|callable $condition
     * @return $this
     */
    public function thenIf(callable $step, $condition)
    {
        if(is_callable($condition))
            $condition = $condition($this->entity);

        if($condition)
            return $this->then($step);
        else
            return $this;
    }

    /**
     * Return entity. Use at the end of stepper.
     *
     * @return mixed
     */
    public function thenReturn()
    {
        return $this->entity;
    }
}
