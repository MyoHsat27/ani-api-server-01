<?php
namespace App\Repositories\Filters;

class FilterFactory
{
    public static function create(string $filterName): FilterInterface
    {
        $className = 'App\Repositories\Filters\\' . ucfirst($filterName) . 'Filter';

        if (class_exists($className)) {
            return new $className;
        }

        throw new \InvalidArgumentException("Filter '$filterName' not supported.");
    }
}