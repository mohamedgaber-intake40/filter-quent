<?php
if (!function_exists('filterCollection'))
{
    function filterCollection(array $items=[]): \Filter\Utilities\FilterCollection
    {
        return new \Filter\Utilities\FilterCollection($items);
    }
}
