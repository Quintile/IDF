@extends('layouts.master')
@section('content')

<a href="{{\URL::route('meals.plan.date', $previous->format('Y-m-d'))}}" class="btn btn-info">Previous</a>
<a href="{{\URL::route('meals.plan.date', $next->format('Y-m-d'))}}" class="btn btn-info">Next</a>
<h2>{{$time->format('l F d, Y')}}</h2>

<table class="table table-striped table-bordered meal-table">
	<thead>
		<tr>
			<th>Day</th>
			<th style="width: 20%">Breakfast</th>
			<th style="width: 40%">Lunch</th>
			<th style="width: 40%">Dinner</th>
		</tr>
	</thead>
	<tbody>
		@for($i = 0; $i < 8; $i++)
		<tr>
			<th>
				<span>{{with(clone($time))->modify('+'.$i.' Days')->format('l')}}</span>
				<small>{{with(clone($time))->modify('+'.$i.' Days')->format('F d')}}</small>
			</th>
			<td></td>
			<td></td>
			<td>
				<form action="{{\URL::route('meals.plan')}}" method="post">
					<div class="row">
						<div class="col-sm-10">
							<input type="hidden" name="day" value="{{with(clone($time))->modify('+'.$i.' Days')->format('Y-m-d')}}" />
							<input type="hidden" name="meal_type_id" value="2" />
							<div class="input">
								<label class="icon"><i class="fa fa-spoon"></i></label>
								<select name="meal-id">
									<option value=""></option>
									@foreach($dinner->meals as $meal)
									<option value="{{$meal->id}}">{{$meal->name}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-sm-2">
							<button class="btn btn-info">Set</button>
						</div>
					</div>
				</form>
			</td>
		</tr>	
		@endfor
	</tbody>
</table>

@stop