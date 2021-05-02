<?php 

namespace Pietrantonio\Floware;

use Pietrantonio\Floware\Exceptions\EntityNullException;
use Pietrantonio\Floware\Exceptions\NotCallableException;

class Floware
{
    /**
     * Array of default configs.
     *
     * @var array
     */
    protected $config = [
        'entity_nullable' => true
    ];

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
     * @param callable|string $step
     * @return $this
     */
    public function then($step)
    {
        $step = $this->initStep($step);

        $new_entity = $step($this->entity);

        // Check if new entity is null. Probably because dev forgot a return
        if($this->config['entity_nullable'] && $new_entity === null)
            throw new EntityNullException('Entity is null. Maybe you forgot a return?');

        $this->entity = $new_entity;

        return $this;
    }

    /**
     * Set one single step if a condition is verified.
     * If condition is verified use method "then".
     *
     * @param callable|string $step
     * @param callable|bool $condition
     * @return $this
     */
    public function thenIf($step, $condition)
    {
        $condition = $this->resolveCondition($condition);

        if($condition)
            return $this->then($step);
        else
            return $this;
    }

    /**
     * Return entity. To be used at the end of stepper (It ends the stepper).
     *
     * @return mixed
     */
    public function thenReturn()
    {
        return $this->entity;
    }

    /**
     * Set single config by name.
     *
     * @param string $name
     * @param mixed $value
     * @return void
     */
    public function setConfig(string $name, $value)
    {
        $this->config[$name] = $value;
        return $this;
    }

    /**
     * Set multiple configs
     *
     * @param array $configs
     * @return void
     */
    public function setConfigs(array $configs)
    {
        $this->config = array_merge($configs, $this->configs);
        return $this;
    }

    /**
     * Check if step is string or callable and solve.
     * Throw Exception if is neither a string or a callable.
     *
     * @param callable|string $step
     * @return void
     */
    private function initStep($step)
    {
        if (is_string($step)) {
            $step = new $step;
        } elseif (!is_callable($step)) {
            throw new NotCallableException('Step passed is not a callable');
        }

        return $step;
    }

    /**
     * Resolve condition if callable
     *
     * @param callable|bool $condition
     * @return void
     */
    private function resolveCondition($condition)
    {
        if(is_callable($condition))
            $condition = $condition($this->entity);

        return $condition;
    }
}
