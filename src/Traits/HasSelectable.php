<?php


namespace Filter\Traits;



trait HasSelectable
{
	public function scopeSelectable($q)
	{
	    $this->checkSelectableExists();

		return $q->when(request()->select, function ($q) {
			$selects = $this->getValidatedSelects();
			return $q->select($selects);
		});
	}

	private function checkSelectableExists()
    {
        if(!isset($this->selectable))
        {
            throw new \Exception('You need to add selectable array to the model');
        }
    }

	private function getValidatedSelects()
	{

		$availableSelects = [];
		foreach ( explode(',', request()->select) as $select ) {
			if ( in_array($select, $this->selectable) ) {
				$availableSelects [] = $select;
			}
		}
		return $availableSelects;
	}
}
