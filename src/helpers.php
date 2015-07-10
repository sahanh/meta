<?php

if (!function_exists('getMeta')) {
    /**
     * getMeta('Properties', 'fields.bedrooms')
     * @param  [type] $namespace [description]
     * @param  [type] $field     [description]
     * @return [type]            [description]
     */
    function getMeta($namespace, $field)
    {
        return array_assoc_to_keyval(App::make('SahanH\Meta\MetaManager')->getMeta($namespace, $field), 0, 1);
    }
}

if (!function_exists('transformMeta')) {
    /**
     * transformMeta('Properties', 'fields.bedrooms', 1)
     * @param  [type] $namespace [description]
     * @param  [type] $field     [description]
     * @param  [type] $value     [description]
     * @return [type]            [description]
     */
    function transformMeta($namespace, $field, $value)
    {
        return App::make('SahanH\Meta\MetaManager')->transform($namespace, $field, $value);
    }
}