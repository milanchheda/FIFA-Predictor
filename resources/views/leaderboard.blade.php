@extends('layouts.app')
@section('content')
	<div class="flex items-center">
	    <div class="md:w-2/3 md:mx-auto">
	    	<table  class="text-left" style="border-collapse:collapse">
	    		<tr>
	    			<th class="py-2 px-4 text-sm font-semibold font-sans font-medium uppercase bg-grey-lighter border-b border-grey-light">#</th>
	    			<th class="py-2 px-4 text-sm font-semibold font-sans font-medium uppercase bg-grey-lighter border-b border-grey-light">Name</th>
	    			<th class="py-2 px-4 text-sm font-semibold font-sans font-medium uppercase bg-grey-lighter border-b border-grey-light">Points</th>
	    		</tr>
	    	@foreach($leaderboard as $key => $value)
	    		<tr>
	    			<td class="text-sm py-2 px-2 border-b border-grey-light">{{ $loop->iteration }}</td>
	    			<td class="text-sm py-2 px-2 border-b border-grey-light">{{ $users[$key] }}</td>
	    			<td class="text-sm py-2 px-2 border-b border-grey-light">{{ $value }}</td>
	    		</tr>
	    	@endforeach
	    	</ol>
	    </div>
	</div>
@endsection
