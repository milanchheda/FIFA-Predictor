@extends('layouts.app')
@section('content')
	<div class="flex items-center">
	    <div class="md:w-1/2 md:mx-auto">
			<table class="text-left m-4" style="border-collapse:collapse">
				<thead>
					<tr>
						<th class="py-2 px-6 text-sm font-semibold font-sans font-medium uppercase bg-grey-lighter border-b border-grey-light">Name</th>
						<th class="py-2 px-6 text-sm font-semibold font-sans font-medium uppercase bg-grey-lighter border-b border-grey-light">If you win</th>
						<th class="py-2 px-6 text-sm font-semibold font-sans font-medium uppercase bg-grey-lighter border-b border-grey-light">If you lose</th>
					</tr>
				</thead>
				<tbody>
			@foreach($all as $prediction)
				<tr>
					<td class="text-sm py-2 px-6 border-b border-grey-light">{{ $prediction->name }}</td>
					<td class="text-sm py-2 px-6 border-b border-grey-light">+{{ $prediction->plus }}</td>
					<td class="text-sm py-2 px-6 border-b border-grey-light">-{{ $prediction->minus }}</td>
				</tr>
			@endforeach
				</tbody>
			</table>
		</div>
	</div>
@endsection
