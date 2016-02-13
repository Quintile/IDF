@extends('layouts.master')
@section('content')
<h1>Assign Portions To {{$meal->name}}</h1>
<p>This meal is made up of the following portions:</p>

<form method="post">
	<label>Add Portion</label>
	<div class="input">
		<label class="icon"><i class="fa fa-file"></i></label>
		<select name="meal-portion">
			<option selected disabled></option>
			@foreach($portions as $portion)
			<option value="{{$portion->id}}">{{$portion->name}}</option>
			@endforeach
			@foreach($portionTypes as $type)
			<option value="random-{{$type->id}}">Random {{$type->name}}</option>
			@endforeach
		</select>
	</div>

	<button class="btn btn-info">Add Portion</button>
	<a class="btn btn-default" href="{{\URL::route('portions.add')}}">Create Portion</a>
</form>
<hr />

<div class="row">
	<div class="col-md-9">
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Portion Name</th>
					<th>Portion Type</th>
				</tr>
			</thead>
			<tbody>
				@foreach($meal->portions as $portion)
				<tr>
					<td>{{$portion->name}}</td>
					<td>{{$portion->type()}}</td>
				</tr>
				@endforeach
				@foreach($meal->randomPortions() as $portion)
				<tr>
					<td>Random</td>
					<td>{{dd($portion->portion_type_id);$portion->type()->name}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<div class="col-md-3">
		<h5>Ingredients</h5>
		<ul>
			@foreach($meal->portions as $portion)
			@foreach($portion->ingredients as $ingredient)
			<li>{{$ingredient->name}}</li>
			@endforeach
			@endforeach
		</ul>
	</div>	
</div>

@stop