<?php


namespace Filter\Traits;


use Illuminate\Database\Eloquent\Builder;
/**
* @method static Builder filter(array $data)
 * */
trait HasFilter
{
    protected static $filterNameSpace = 'App\\Filters\\';

    public function scopeFilter($q, $data)
    {
        return $this->getFilterClassName()::create($q,$data);
    }

    protected function getFilterClassName()
    {
        return  self::$filterNameSpace . $this->getModelClassName();
    }

    protected function getModelClassName()
    {
        $path = explode('\\', static::class);
        return   array_pop($path) . 'Filter';
    }

}
