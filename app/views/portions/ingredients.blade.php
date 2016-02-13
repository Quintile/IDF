@extends('layouts.master')
@section('content')

<h1>{{$portion->name}}</h1>
<h2>Set Ingredients</h2>

<form method="post">
	<label>Ingredient</label>
	<div class="input">
		<label class="icon"><i class="fa fa-pencil"></i></label>
		<input type="text" name="ingredient-name" />
	</div>

	<button class="btn btn-primary">Add Ingredient</button>
</form>

<h2>Add Portion Type</h2>
<form action="{{\URL::route('portions.types.add', $portion->id)}}" method="post">
	<label>Portion Type</label>
	<div class="input">
		<label class="icon"><i class="fa fa-pencil"></i></label>
		<select name="portion-type">
			<option selected disabled>Select Type</option>
			@foreach($types as $type)
			<option value="{{$type->id}}">{{$type->name}}</option>
			@endforeach
		</select>
	</div>
	<button class="btn btn-primary">Add Portion Type</button>
</form>

<div class="row">
	<div class="col-sm-6">
		<h2>Ingredient List</h2>
		<ul>
		@foreach($portion->ingredients as $ingredient)
			<li>{{$ingredient->name}}</li>
		@endforeach
		</ul>
	</div>
	<div class="col-sm-6">
		<h2>Portion Types</h2>
		<ul>
		@foreach($portion->types as $type)
			<li>{{$type->name}}</li>
		@endforeach
		</ul>
	</div>
</div>

@stop

@section('js-includes')
<script type="text/javascript">

$(document).ready(function(){
	$('input').focus();
});

</script>
@stop