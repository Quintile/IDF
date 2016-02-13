<?php

namespace Excessive\IDF\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Excessive\IDF\Models\Meal;

class GenerateWeek extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'generate';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Command description.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$days = ['Fri', 'Sat', 'Sun', 'Mon', 'Tue', 'Wed', 'Thu'];
		$strict = $this->option('strict');

		if($strict && Meal::where('meal_type_id', 2)->count() < count($days))
		{
			$this->error('There must be at least '.count($days).' meals to choose from');
			return false;
		}

		$picks = array();
		$meals = Meal::where('meal_type_id', 2)->get();
		$max = count($meals);
		while(count($picks) < count($days))
		{
			do
			{
				$random = rand(0, $max);
				$this->info(count($picks));
				$this->info(count($meals));
			
			} while(!isset($meals[$random]));

			$pick = $meals[$random];
			unset($meals[$random]);

			$picks[] = $pick;
			
		}


		foreach($picks as $index => $pick)
		{
			$this->info($days[$index].': '.$pick->name);
		}
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			array('strict', null, InputOption::VALUE_NONE, 'An example option.', null),
		);
	}

}
