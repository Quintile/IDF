<?php

namespace Excessive\IDF\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Excessive\IDF\Models\Portion;

class CreateMeal extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'meal:create';

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
		$selected = new \stdClass;

		$protein = Portion::whereHas('type', function($q){
			$q->where('name', 'Protein')->where('include_random', true);
		})->get();

		$random = rand(0, count($protein)-1);
		
		$selected->protein = $protein[$random];

		$starch = Portion::whereHas('type', function($q){
			$q->where('name', 'Starch')->where('include_random', true);
		})->get();

		$random = rand(0, count($starch)-1);

		$selected->starch = $starch[$random];

		$veg = Portion::whereHas('type', function($q){
			$q->where('name', 'Vegetable')->where('include_random', true);
		})->get();

		$random = rand(0, count($veg)-1);

		$selected->veg = $veg[$random];

		try {
			$this->line('Protein: '.$selected->protein->name);
			$this->line('Starch: '.$selected->starch->name);
			$this->line('Vegatable: '.$selected->veg->name);
		}
		catch(\Exception $ex)
		{
			$this->error($ex->getMessage());
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
			
		);
	}

}
