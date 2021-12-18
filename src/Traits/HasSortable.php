<?php


namespace Filter\Traits;


trait HasSortable
{
	public function scopeSortable($q)
	{
        $this->checkSortableExists();

        $validatedSorts = $this->getValidatedSorts();
		foreach ( $validatedSorts as $sort ) {
			$q->orderBy($sort[ 'column' ], $sort[ 'direction' ]);
		}
	}

    private function checkSortableExists()
    {
        if(!isset($this->sortable))
        {
            throw new \Exception('You need to add sortable array to the model');
        }
    }

	private function getValidatedSorts()
	{
		$availableSorts = [];
		foreach ( request()->sort ?? [] as $sort ) {
			$column    = explode(',', $sort)[ 0 ];
			$direction = explode(',', $sort)[ 1 ];
			if ( in_array($column, $this->sortable) && in_array($direction, [ 'asc', 'desc' ]) ) {
				$availableSorts [] = [
					'column'    => $column,
					'direction' => $direction
				];
			}
		}
		return $availableSorts;
	}

}
