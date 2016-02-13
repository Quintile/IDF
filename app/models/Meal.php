<?php

namespace Excessive\IDF\Models;

class Meal extends \Eloquent
{
	protected $table = 'meals';

	public function type()
	{
		return $this->belongsTo('Excessive\IDF\Models\MealType', 'meal_type_id');
	}

	public function portions()
	{
		return $this->belongsToMany('Excessive\IDF\Models\Portion', 'meal_portions');
	}

	public function randomPortions()
	{
		$results = array();
		$randoms = Joins\MealPortion::where('meal_id', $this->id)->whereNull('portion_id')->get();
		foreach($randoms as $random)
		{
			$results[] = $random->getRandom();
		}

		return $results;
	}

	public function getPortions()
	{
		$portions = array();
		foreach($this->portions as $p)
			$portions[] = $p;
		foreach($this->randomPortions() as $p)
			$portions[] = $p;

		return $portions;
	}
}