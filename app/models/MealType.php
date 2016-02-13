<?php

namespace Excessive\IDF\Models;

class MealType extends \Eloquent
{
	protected $table = 'meal_types';

	public function meals()
	{
		return $this->hasMany('\Excessive\IDF\Models\Meal');
	}
}