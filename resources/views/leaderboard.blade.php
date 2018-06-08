@extends('layouts.app')
@section('content')
	<div class="flex">
	    <div class="w-full md:mx-8 bg-white px-8 py-6 rounded shadow mb-16">
    		<h2 class="pb-4 text-red-dark uppercase font-semibold font-sans font-medium border-b-2 border-grey-light">Leader board</h2>
	    	<table  class="text-left w-full" style="border-collapse:collapse">
	    		<tr>
	    			<th class="py-2 px-4 text-sm font-semibold font-sans font-medium uppercase bg-grey-lighter border-b border-grey-light">#</th>
	    			<th class="py-2 px-4 text-sm font-semibold font-sans font-medium uppercase bg-grey-lighter border-b border-grey-light">Name</th>
	    			<th class="py-2 px-4 text-sm font-semibold font-sans font-medium uppercase bg-grey-lighter border-b border-grey-light">Points</th>
	    		</tr>
	    	@foreach($leaderboard as $key => $value)
	    		<tr>
	    			<td class="text-sm py-2 px-2 border-b border-grey-light text-base">{{ $loop->iteration }}</td>
	    			<td class="text-sm py-2 px-2 border-b border-grey-light text-base">{{ ucfirst($users[$key]) }}</td>
	    			<td class="text-sm py-2 px-2 border-b border-grey-light text-base">{{ $value }}</td>
	    		</tr>
	    	@endforeach
	    	</ol>
	    </div>
	</div>
@endsection
