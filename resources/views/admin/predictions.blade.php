@extends('layouts.app')
@section('content')
	<div class="flex">
	    <div class="w-full md:mx-8 bg-white px-8 py-6 rounded shadow mb-16">
    		<h2 class="pb-4 text-red-dark uppercase font-semibold font-sans font-medium border-b-2 border-grey-light">Predictions</h2>
			<table class="text-left" style="border-collapse:collapse">
				<thead>
					<tr>
						<th class="py-2 px-6 text-sm font-semibold font-sans font-medium uppercase bg-grey-lighter border-b border-grey-light">Name</th>
						<th class="py-2 px-6 text-sm font-semibold font-sans font-medium uppercase bg-grey-lighter border-b border-grey-light">If you win</th>
						<th class="py-2 px-6 text-sm font-semibold font-sans font-medium uppercase bg-grey-lighter border-b border-grey-light">If you lose</th>
						<th class="py-2 px-4 text-sm font-semibold font-sans font-medium uppercase bg-grey-lighter border-b border-grey-light">Time remaining</th>
						<th class="py-2 px-6 text-sm font-semibold font-sans font-medium uppercase bg-grey-lighter border-b border-grey-light">Your Selection</th>
						<th class="py-2 px-6 text-sm font-semibold font-sans font-medium uppercase bg-grey-lighter border-b border-grey-light">Action</th>
						@can('isAdmin')
							<th class="py-2 px-6 text-sm font-semibold font-sans font-medium uppercase bg-grey-lighter border-b border-grey-light">Winning Team/Player (Admin)</th>
							<th class="py-2 px-6 text-sm font-semibold font-sans font-medium uppercase bg-grey-lighter border-b border-grey-light">Action (Admin)</th>
							<th class="py-2 px-6 text-sm font-semibold font-sans font-medium uppercase bg-grey-lighter border-b border-grey-light">Lock Time (Admin)</th>
							<th class="py-2 px-6 text-sm font-semibold font-sans font-medium uppercase bg-grey-lighter border-b border-grey-light">Action (Admin)</th>
						@endcan
					</tr>
				</thead>
				<tbody>
			@foreach($predictions as $prediction)
				<tr>
					<td class="text-sm py-2 px-6 border-b border-grey-light text-base">{{ $prediction->name }}</td>
					<td class="text-sm py-2 px-6 border-b border-grey-light text-base">+{{ $prediction->plus }}</td>
					<td class="text-sm py-2 px-6 border-b border-grey-light text-base">-{{ $prediction->minus }}</td>
					<td class="text-sm py-2 px-4 border-b border-grey-light text-base">
					@if(isset($prediction->lock_time))
						<?php
							$now = Carbon\Carbon::now();
							echo $length = Carbon\Carbon::parse($prediction->lock_time)->diffForHumans($now);
						?>
					@else
						<?php echo $length = '-'; ?>
					@endif
					</td>
					<td class="text-sm py-2 px-6 border-b border-grey-light text-base">
						@if(!$prediction->winning_id)
							@if($length != '-')
								<select class="bg-white p-2 border-grey-light border userPredictedTeamId">
									@foreach($teams as $key => $value)
										@if(isset($user_predictions[$prediction->id]) && $key === $user_predictions[$prediction->id])
											<option value="{{ $key }}" selected="selected">{{ $value }}</option>
										@else
											<option value="{{ $key }}">{{ $value }}</option>
										@endif
									@endforeach
								</select>
								@else
									Wait until time remaining appears.
								@endif
						@else
							{{ isset($teams[$prediction->winning_id]) ? $teams[$prediction->winning_id] : '' }}
						@endif
					</td>
					<td class="text-sm py-2 px-6 border-b border-grey-light text-base">
					@if(!$prediction->winning_id)
						@if($length != '-')
							<button data-prediction-id="{{ $prediction->id }}" class="p-2 bg-green-light rounded font-semibold saveUserPrediction">Save</button>
						@else
							Wait until time remaining appears.
						@endif
					@endif
					</td>
					@can('isAdmin')
						<td class="text-sm py-2 px-6 border-b border-grey-light text-base">
							@if(!$prediction->winning_id)
								<select class="bg-white p-2 border-grey-light border predictionWinnerId">
									@foreach($teams as $key => $value)
										<option value="{{ $key }}">{{ $value }}</option>
									@endforeach
								</select>
							@else
								<span class="text-green font-semibold">{{ isset($teams[$prediction->winning_id]) ? $teams[$prediction->winning_id] : '' }}</span>
							@endif
						</td>
						<td class="text-sm py-2 px-6 border-b border-grey-light text-base">
						@if(!$prediction->winning_id)
							<button data-prediction-id="{{ $prediction->id }}" class="p-2 bg-green-light rounded font-semibold savePredictionWinner">Save</button>
						@else
							<span class="text-green font-semibold">Finished!</span>
						@endif
						</td>
						<td class="text-sm py-2 px-4 border-b border-grey-light text-base">
							@if(!$prediction->winning_id)
								<select class="p-2 bg-white border-grey border selectedPredictionLockTime">
									<option value="10">10 minutes</option>
									<option value="20">20 minutes</option>
									<option value="30">30 minutes</option>
									<option value="45">45 minutes</option>
									<option value="60">60 minutes</option>
								</select>
							@else
								Finished
							@endif
						</td>
						<td class="text-sm py-2 px-4 border-b border-grey-light text-base">
							@if(!$prediction->winning_id)
								<button data-prediction-id="{{ $prediction->id }}" class="p-2 bg-green-light rounded font-semibold savePredictionLockTimes">Save</button>
							@else
								Finished
							@endif
						</td>
					@endcan
				</tr>
			@endforeach
				</tbody>
			</table>
		</div>
	</div>
@endsection
