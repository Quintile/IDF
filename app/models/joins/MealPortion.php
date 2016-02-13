<?php

namespace Excessive\IDF\Models\Joins;

class MealPortion extends \Eloquent
{
	protected $table = 'meal_portions';

	public function portionType()
	{
		return $this->belongsTo('\Excessive\IDF\Models\PortionType');
	}

	public function meal()
	{
		return $this->belongsTo('\Excessive\IDF\Models\Meal');
	}

	public function getRandom()
	{
		$type = $this->portionType->name;
		$pick = \Excessive\IDF\Models\Portion::whereHas('types', function($q) use($type){
			$q->where('name', $type);
		})->where('random', true)->get();

		$rand = rand(0, $pick->count()-1);

		return $pick[$rand];
	}
}