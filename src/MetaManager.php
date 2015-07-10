<?php
namespace SahanH\Meta;

class MetaManager
{
    protected $instances;

    public function registerNamespace($namespace, $directory)
    {
        $this->instances[$namespace] = new Meta($namespace, $directory);
        return $this;
    }

    public function getInstance($namespace)
    {
        $ins = array_get($this->instances, $namespace);
        
        if (!$ins)
            throw new Exception\InvalidMetaGroupException("No meta group registered under {$namespace}");

        return $ins;
    }

    public function getMeta($namespace, $field)
    {
        return $this->getInstance($namespace)->get($field);
    }

    public function getMetaValues($namespace, $field)
    {
        return $this->getInstance($namespace)->values($field);
    }

    public function getMetaIndexes($namespace, $field)
    {
        return $this->getInstance($namespace)->indexes($field);
    }

    public function transform($namespace, $field, $value)
    {
        return $this->getInstance($namespace)->transform($field, $value);
    }
}