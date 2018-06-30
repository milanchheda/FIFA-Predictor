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
	    			<th class="py-2 px-4 text-sm font-semibold font-sans font-medium uppercase bg-grey-lighter border-b border-grey-light">Earnings</th>
	    		</tr>
	    	@foreach($leaderboard as $key => $value)
	    		<tr>
	    			<?php
						$shapeClass = 'shape4';
						if($loop->index == 0)
							$shapeClass = 'shape1';
						elseif($loop->index == 1)
							$shapeClass = 'shape2';
						elseif($loop->index == 2)
							$shapeClass = 'shape3';
						?>
	    			<td class="text-sm py-2 px-2 border-b border-grey-light text-base"><span class=<?php echo $shapeClass; ?>></span></td>
	    			<td class="text-sm py-2 px-2 border-b border-grey-light text-base">{{ ucfirst($users[$key]) }}</td>
	    			<td class="text-sm py-2 px-2 border-b border-grey-light text-base">{{ $value }}</td>
	    			<td class="text-sm py-2 px-2 border-b border-grey-light text-base">
	    				<?php
	    				switch ($loop->index) {
	    					case 0:
	    						echo '₹ 5,000';
	    						break;
	    					case 1:
	    						echo '₹ 3,000';
	    						break;
	    					case 2:
	    						echo '₹ 2,000';
	    						break;
	    					case 3:
	    						echo '₹ 1,000';
	    						break;
	    					default:
	    						echo 0;
	    						break;
	    				}
						?>
	    			</td>
	    		</tr>
	    	@endforeach
	    	</table>
	    </div>
	</div>
@endsection
