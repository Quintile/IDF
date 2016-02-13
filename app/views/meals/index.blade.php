@extends('layouts.master')
@section('content')

<h1>Create Meal</h1>

<form method="post">
	<div class="row">
		<div class="col-sm-6">
			<label>Meal Name</label>
			<div class="input">
				<label class="icon"><i class="fa fa-file"></i></label>
				<input type="text" name="meal-name" />
			</div>
		</div>
		<div class="col-sm-6">
			<label>Meal Type</label>
			<div class="input">
				<label class="icon"><i class="fa fa-file"></i></label>
				<select name="meal-type">
					<option>Select Type</option>
					@foreach($types as $t)
					<option value="{{$t->id}}" @if($t->id == 2) selected @endif>{{$t->name}}</option>
					@endforeach
				</select>
			</div>
		</div>
	</div>

	<button class="primary">Create Meal</button>
</form>
<hr />

<h4>Existing Meals</h4>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Meal</th>
			<th>Type</th>
		</tr>
	</thead>
	<tbody>
		@foreach($meals as $meal)
		<tr>
			<td>
				<a href="{{\URL::route('meals.manage', $meal->id)}}">
				{{$meal->name}}
				</a>
			</td>
			<td>{{$meal->type->name}}</td>
		</tr>
		@endforeach
	</tbody>
</table>

@stop
@section('js-includes')
<script>
$(function(){
	$('input[name=meal-name]').focus();
});
</script>
@stop