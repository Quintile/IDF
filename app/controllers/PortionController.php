<?php

namespace Excessive\IDF\Controllers;

use Excessive\IDF\Models\PortionType;
use Excessive\IDF\Models\Portion;
use Excessive\IDF\Models\Ingredient;
use Excessive\IDF\Models\Joins\PortionIngredient;

class PortionController extends \BaseController
{
	public function add($id = null)
	{
		$portions = Portion::all();

		$portion = null;
		if(!is_null($id))
			$portion = Portion::find($id);

		return \View::make('portions.add')
				->with([	'portions' 	=> $portions,
							'portion' 	=> $portion
				])->render();
	}

	public function addPost($id = null)
	{
		$portion = new Portion;
		if(!is_null($id))
			$portion = Portion::find($id);

		$portion->name = \Input::get('portion-name');
		$portion->difficulty = \Input::get('portion-difficulty');
		$portion->save();

		return \Redirect::route('portions.ingredients', $portion->id)->with('success', 'You have successfully created a new portion');
	}

	public function ingredients($id)
	{
		$portion = Portion::find($id);
		$types = PortionType::all();
		return \View::make('portions.ingredients')->with(['types' => $types, 'portion' => $portion])->render();
	}

	public function ingredientsPost($id)
	{
		$portion = Portion::find($id);

		$name = \Input::get('ingredient-name');

		$ingredient = Ingredient::where('name', $name)->first();
		if(!$ingredient)
		{
			$ingredient = new Ingredient;
			$ingredient->name = $name;
			$ingredient->save();
		}

		$exists = PortionIngredient::where('portion_id', $portion->id)->where('ingredient_id', $ingredient->id)->first();
		if($exists)
			return \Redirect::back()->with('error', 'The specified ingredient has already been added');

		$portionIngredient = new PortionIngredient;
		$portionIngredient->portion_id = $portion->id;
		$portionIngredient->ingredient_id = $ingredient->id;
		$portionIngredient->save();

		return \Redirect::back()->with('success', 'You have successfully added an ingredient');
	}

	public function addType($id)
	{
		if(\Excessive\IDF\Models\Joins\PortionTypeJoin::where('portion_id', $id)->where('portion_type_id', \Input::get('portion-type'))->count())
			return \Redirect::back()->with('error', 'Type is already assigned');

		$join = new \Excessive\IDF\Models\Joins\PortionTypeJoin;
		$join->portion_id = $id;
		$join->portion_type_id = \Input::get('portion-type');
		$join->save();

		return \Redirect::back()->with('success', 'Successfully assigned type');
	}
}