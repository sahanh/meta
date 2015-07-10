<?php
/**
 * Meta is a key valu handler for services
 */
namespace SahanH\Meta;

class Meta
{
    /**
     * Service namespace
     */
    protected $namespace;
    
    /**
     * Meta fields dir
     */
    protected $path;

    /**
     * Cache fields
     * @var [type]
     */
    protected $cache;

    public function __construct($namespace, $path)
    {
        $this->namespace = $namespace;
        $this->path      = $path;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function get($key)
    {
        //TODO: optimization point
        if (str_contains($key, '.')) {
            list($file_name, $key) = explode('.', $key, 2);
            $meta = $this->load($file_name);
            return array_get($meta, $key);
        } else {
            return $this->load($key);
        }

    }

    public function values($field)
    {
        $metas  = $this->get($field);
        $values = [];
        
        foreach ($metas as $meta)
            $values[] = $meta[1];

        return $values;
    }

    public function indexes($field)
    {
        $metas   = $this->get($field);
        $indexes = [];
        
        foreach ($metas as $meta)
            $indexes[] = $meta[0];

        return $indexes;
    }

    /**
     * Convert a value to it's meta
     * ::transform('fields.type', 1);
     */
    public function transform($field, $index)
    {
        $metas = $this->get($field);
        
        foreach ($metas as $meta) {
            if ($meta[0] == $index)
                return $meta[1];
        }

        return false;
    }

    protected function load($file)
    {
        if (!array_get($this->cache, $file)) {
            $path               = realpath("{$this->path}/{$file}.php");
            $this->cache[$file] = require($path);
        }

        return $this->cache[$file];
    }
}