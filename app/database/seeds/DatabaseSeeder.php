<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('MealTypeSeeder');
		$this->call('PortionTypeSeeder');
	}

}


class MealTypeSeeder extends Seeder {
	public function run()
	{
		$lunch = \Excessive\IDF\Models\MealType::where('name', 'Lunch')->first();
		if(!$lunch)
		{
			$mealType = new \Excessive\IDF\Models\MealType;
			$mealType->name = 'Lunch';
			$mealType->save();
		}

		$dinner = \Excessive\IDF\Models\MealType::where('name', 'Dinner')->first();
		if(!$dinner)
		{
			$mealType = new \Excessive\IDF\Models\MealType;
			$mealType->name = 'Dinner';
			$mealType->save();
		}
	}
}

class PortionTypeSeeder extends Seeder {
	public function run()
	{
		foreach(['Protein', 'Starch', 'Vegetable', 'Other'] as $type)
		{
			$model = \Excessive\IDF\Models\PortionType::where('name', $type)->first();
			if($model)
				continue;

			$model = new \Excessive\IDF\Models\PortionType;
			$model->name = $type;
			$model->save();

		}
	}
}