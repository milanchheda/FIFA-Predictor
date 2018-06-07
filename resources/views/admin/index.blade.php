@extends('layouts.app')
@section('content')

<div class="flex items-center">
    <div class="md:w-4/5 md:mx-auto">
    	<h2 class="mb-4 text-red-dark uppercase font-semibold font-sans font-medium">FIFA World Cup 2018 Fixtures</h2>
		<table class="text-left" style="border-collapse:collapse">
			<thead>
				<tr>
					<th class="py-2 px-2 text-sm font-semibold font-sans font-medium uppercase bg-grey-lighter border-b border-grey-light">#</th>
					<th class="py-2 px-4 text-sm font-semibold font-sans font-medium uppercase bg-grey-lighter border-b border-grey-light">Team 1</th>
					<th class="py-2 px-4 text-sm font-semibold font-sans font-medium uppercase bg-grey-lighter border-b border-grey-light">Team 2</th>
					<!-- <th class="py-2 px-4 text-sm font-semibold font-sans font-medium uppercase bg-grey-lighter border-b border-grey-light">Match date</th> -->
					<!-- <th class="py-2 px-4 text-sm font-semibold font-sans font-medium uppercase bg-grey-lighter border-b border-grey-light">Lock time</th> -->
					<th class="py-2 px-4 text-sm font-semibold font-sans font-medium uppercase bg-grey-lighter border-b border-grey-light">Time remaining</th>
					<th class="py-2 px-4 text-sm font-semibold font-sans font-medium uppercase bg-grey-lighter border-b border-grey-light">You Selected</th>
					<th class="py-2 px-4 text-sm font-semibold font-sans font-medium uppercase bg-grey-lighter border-b border-grey-light">Action / Winning team</th>
					@can('isAdmin')
						<th class="py-2 px-4 text-sm font-semibold font-sans font-medium uppercase bg-grey-lighter border-b border-grey-light">Winning Team/Player (Admin)</th>
						<th class="py-2 px-4 text-sm font-semibold font-sans font-medium uppercase bg-grey-lighter border-b border-grey-light">Action (Admin)</th>
						<th class="py-2 px-4 text-sm font-semibold font-sans font-medium uppercase bg-grey-lighter border-b border-grey-light">Lock time</th>
						<th class="py-2 px-4 text-sm font-semibold font-sans font-medium uppercase bg-grey-lighter border-b border-grey-light">Action</th>
					@endcan
				</tr>
			</thead>
			<tbody>
		@foreach($matches as $match)
			<tr>
				<td class="text-sm py-2 px-2 border-b border-grey-light">{{ $match->id }}</td>
				<td class="text-sm py-2 px-4 border-b border-grey-light">
				@if($match->home_team)
                        {{ $teams[$match->home_team] }}
                @else
                    tbd
                @endif
				</td>
				<td class="text-sm py-2 px-4 border-b border-grey-light">
				@if($match->away_team)
                        {{ $teams[$match->away_team] }}
                @else
                    tbd
                @endif
				</td>
				<!-- <td class="text-sm py-2 px-4 border-b border-grey-light">{{ $match->date }}</td> -->
				<!-- <td class="text-sm py-2 px-4 border-b border-grey-light">{{ $match->lock_time }}</td> -->
				<td class="text-sm py-2 px-4 border-b border-grey-light">
				<?php
					$length = '';
				?>

				@if(isset($match->lock_time))
					<?php
						$now = Carbon\Carbon::now();
						echo $length = Carbon\Carbon::parse($match->lock_time)->diffForHumans($now);
					?>
				@else
					<?php echo $length = '-'; ?>
				@endif
				</td>
				<td class="text-sm py-2 px-4 border-b border-grey-light">
					@if(!$match->finished)
						@if($length != '-')
							<select class="p-2 bg-white border-grey border UserSelectedWinningTeamId">
								<option>Please select</option>
								@if($match->home_team)
									@if(isset($user_predictions[$match->id]) && $user_predictions[$match->id] == $match->home_team)
				            			<option value="{{ $match->home_team }}" selected="selected">{{ $teams[$match->home_team] }}</option>
				            		@else
				            			<option value="{{ $match->home_team }}">{{ $teams[$match->home_team] }}</option>
				            		@endif
				                @else
				                    <option value="0">tbd</option>
				                @endif

								@if($match->away_team)
									@if(isset($user_predictions[$match->id]) && $user_predictions[$match->id] == $match->away_team)
										<option value="{{ $match->away_team }}" selected="selected">{{ $teams[$match->away_team] }}</option>
									@else
		                				<option value="{{ $match->away_team }}">{{ $teams[$match->away_team] }}</option>
		                			@endif
				                @else
				                    <option value="0">tbd</option>
				                @endif
							</select>
						@else
							Wait until time remaining appears.
						@endif
					@else
						@if(isset($user_predictions[$match->id]) && $user_predictions[$match->id] == $match->home_team)
							{{ $teams[$match->home_team] }}
						@else
							{{ $teams[$match->away_team] }}
						@endif
					@endif
				</td>
				<td class="text-sm py-2 px-4 border-b border-grey-light">
					@if(!$match->finished)
						<button data-match-id="{{ $match->id }}" class="p-2 bg-green-light rounded font-semibold saveUserSelectedWinningTeam">Save</button>
					@else
						{{ $teams[$match->winning_team_id] }}
					@endif
				</td>
				@can('isAdmin')
					<td class="text-sm py-2 px-4 border-b border-grey-light">
						<select class="bg-white p-2 border-grey-light border matchWinnerId">
							@foreach($teams as $key => $value)
								<option value="{{ $key }}">{{ $value }}</option>
							@endforeach
						</select>
					</td>
					<td class="text-sm py-2 px-4 border-b border-grey-light">
						<button data-match-id="{{ $match->id }}" class="p-2 bg-green-light rounded font-semibold saveMatchWinnerId">Save</button>
					</td>
					<td class="text-sm py-2 px-4 border-b border-grey-light">
						@if(!$match->finished)
							<select class="p-2 bg-white border-grey border selectedLockTime">
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
					<td class="text-sm py-2 px-4 border-b border-grey-light">
						@if(!$match->finished)
							<button data-match-id="{{ $match->id }}" class="p-2 bg-green-light rounded font-semibold saveLockTimes">Save</button>
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
