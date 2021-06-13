<?php


namespace Filter\Utilities;


use Illuminate\Support\Collection;

class FilterCollection extends Collection
{
    public function __construct($items = [])
    {
        parent::__construct($items);
    }

    public function __get($key)
    {
        return $this->get($key);
    }

    public function only($keys): array
    {
        return (parent::only($keys))->toArray();
    }


}
