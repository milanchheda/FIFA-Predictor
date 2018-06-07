@extends('layouts.app')
@section('content')
	<div class="flex items-center">
	    <div class="md:w-2/3 md:mx-auto">
		    	@foreach($matches as $match)
		    		<div class="p-2 mb-4 mx-2">
		    		<div class="py-4 flex">
		    			<span class="mx-8 font-semibold font-sans text-lg w-1/3 flex-1 text-center">
			    			@if($match->home_team)
		                        <img class="align-middle m-4 rounded-full" src="/images/flags/png100px/{{ $teams_short[$match->home_team] }}.png" height="64px" width="64px" /> {{ $teams[$match->home_team] }}
			                @else
			                    tbd
			                @endif
		                </span>
		                <span class="w-1/3 flex-1 text-center pt-2 text-4xl">vs</span>
		                <span class="mx-8 font-semibold font-sans text-lg w-1/3 flex-1 text-center">
			    			@if($match->away_team)

		                        <img class="align-middle m-4 rounded-full" src="/images/flags/png100px/{{ $teams_short[$match->away_team] }}.png" height="64px" width="64px" />
		                        {{ $teams[$match->away_team] }}
			                @else
			                    tbd
			                @endif
		                </span>
		    		</div>
		    		</div>
		    	@endforeach
	    </div>
    </div>
@endsection
