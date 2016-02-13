<?php

namespace Excessive\IDF\Controllers;

use Excessive\IDF\Models\Meal;
use Excessive\IDF\Models\MealType;
use Excessive\IDF\Models\Portion;
use Excessive\IDF\Models\Joins\MealPortion;
use Excessive\IDF\Models\PortionType;

class MealController extends \BaseController
{
	public function index()
	{
		$meals = Meal::orderBy('name')->get();
		$types = MealType::all();
		return \View::make('meals.index')->with(['meals' => $meals, 'types' => $types])->render();
	}

	public function manage($id)
	{
		$meal = Meal::find($id);
		$portions = Portion::all();
		$portionTypes = PortionType::all();
		return \View::make('meals.add')->with(['portionTypes' => $portionTypes, 'meal' => $meal, 'portions' => $portions])->render();
	}

	public function createPost()
	{
		$exists = Meal::where('name', \Input::get('meal-name'))->first();
		if($exists)
			return \Redirect::back()->with('error', 'That name has already been used');
		
		$meal = new Meal;
		$meal->name = \Input::get('meal-name');
		$meal->meal_type_id = \Input::get('meal-type');
		$meal->save();

		return \Redirect::back()->with('success', 'You have successfuly created a meal');
	}

	public function managePost($id)
	{
		if(!\Input::has('meal-portion'))
			return \Redirect::back()->with('error', 'You must select a portion to add');

		$portionID = \Input::get('meal-portion');
		$portionType = null;
		if(substr(\Input::get('meal-portion'), 0, strlen('random')) == 'random')
		{
			$portionType = substr(\Input::get('meal-portion'), strlen('random-'));
			$portionID = null;
		}

		$exists = MealPortion::where('meal_id', $id)
					->where('portion_id', $portionID)
					->where('portion_type_id', $portionType)
					->first();
		if($exists)
			return \Redirect::back()->with('error', 'That association already exists');

		$mealPortion = new MealPortion;
		$mealPortion->meal_id = $id;
		$mealPortion->portion_id = $portionID;
		$mealPortion->portion_type_id = $portionType;
		$mealPortion->save();

		return \Redirect::back()->with('success', 'You have successfully added a portion');
	}

	public function plan($date = null)
	{
		$time = new \DateTime($date);
		if($time->format('l') != 'Friday')
			$time = $time->modify('Previous Friday');

		$next = with(clone($time))->modify('+1 Week');
		$previous = with(clone($time))->modify('-1 Week');

		$dinner = MealType::where('name', 'Dinner')->first();

		return \View::make('meals.plan')->with(['dinner' => $dinner, 'time' => $time, 'previous' => $previous, 'next' => $next])->render();
	}

	public function planPost()
	{
		
		$date = new \DateTime(\Input::get('day'));
		
		$meal = Meal::find(\Input::get('meal-id'));
		$portions = $meal->getPortions();

		foreach($portions as $portion)
		{
			$day = new \Excessive\IDF\Models\DayPortion;
			$day->date = $date;
			$day->meal_type_id = $meal->type->id;
			$day->portion_id = $portion->id;
			$day->save();
		}

		return \Redirect::back()->with('success', 'You have assigned a meal to that day');
	}
}