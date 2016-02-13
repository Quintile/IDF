<?php

namespace Excessive\IDF\Models;

class Portion extends \Eloquent
{
	protected $table = 'portions';

	public function types()
	{
		return $this->belongsToMany('Excessive\IDF\Models\PortionType', 'portion_type_joins', 'portion_id', 'portion_type_id');
	}

	public function ingredients()
	{
		return $this->belongsToMany('Excessive\IDF\Models\Ingredient', 'portion_ingredients');
	}

	public function type()
	{
		if($this->random)
		{
			$type = PortionType::where('id', $this->portion_type_id)->first();
			return $type;
		}
		
		if(!count($this->types))
			return null;

		$string = '';
		foreach($this->types as $t)
			$string .= $t->name.', ';

		return substr($string, 0, strlen($string)-2);
	}


}