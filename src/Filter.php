<?php


namespace Filter;


use Filter\Utilities\FilterCollection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

abstract class Filter
{
    /**
     * @var Builder
     */
    protected $query;

    protected function __construct($query, FilterCollection $data)
    {
        $this->query = $query;
        $this->filter($data);
    }


    /**
     * @param array $data
     * @param Builder $query
     * @return Builder $query
     */
    public static function create(Builder $query, array $data)
    {
        $data = \filterCollection($data);
        return ( new static($query, $data) )->query;
    }

    /**
     * @param FilterCollection $collection
     */
    protected function filter(FilterCollection $collection)
    {
        $reflector = new \ReflectionClass(static::class);
        foreach ( $reflector->getMethods() as $method ) {
            $matches = [];
            if(preg_match('/^filter([\S]+)$/i', $method->getName(), $matches)){
                $property = $collection->{Str::snake($matches[ 1 ])};
                if(isset($property)){
                    $this->{$method->getName()}($property);
                }
            }
        }
    }

}
