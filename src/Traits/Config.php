<?php 

namespace Pietrantonio\Floware\Traits;

trait Config
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
     * Set single config by name.
     *
     * @param string $name
     * @param mixed $value
     * @return void
     */
    public function config(string $name, $value)
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
    public function configs(array $configs)
    {
        $this->config = array_merge($configs, $this->configs);
        return $this;
    }
}
