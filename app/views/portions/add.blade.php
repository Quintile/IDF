@extends('layouts.master')
@section('content')

<h1>Add Portion</h1>
<form method="post">
	<div class="row">
		<div class="col-sm-6">
			<label>Portion Name</label>
			<div class="input">
				<label class="icon"><i class="fa fa-pencil"></i></label>
				<input type="text" name="portion-name" @if($portion) value="{{$portion->name}}" @endif  />
			</div>
		</div>
		<div class="col-sm-3">

			
			
		</div>
		<div class="col-sm-3">
			<label>Prep Difficulty</label>
			<div class="input">
				<label class="icon"><i class="fa fa-exclamation-circle"></i></label>
				<input type="text" name="portion-difficulty" @if($portion) value="{{$portion->difficulty}}" @endif />
			</div>
		</div>
	</div>

	<button class="primary">Save Portion</button>

</form>

<hr />

<h2>Portions</h2>
<ul>
	@foreach($portions as $p)
	<li>
		<a href="{{\URL::route('portions.ingredients', $p->id)}}">
			{{$p->name}}
		</a>
		<a href="{{\URL::route('portions.edit', $p->id)}}">
			<i class="fa fa-refresh"></i>
		</a>
	</li>
	@endforeach	
</ul>
@stop