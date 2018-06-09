<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PredictionSeederTable extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('predictions')->insert([
			[
				'name' => 'Group A Winner',
				'plus' => 250,
				'minus' => 50,
				'type' => 'overall',
				'date' => \Carbon\Carbon::parse(date_format(\Carbon\Carbon::parse('2018-06-19T18:00:00+03:00'), 'Y-m-d H:i:s T'))->setTimeZone('Asia/Kolkata')->format('Y-m-d H:i:s')
			],
			[
				'name' => 'Group B Winner',
				'plus' => 250,
				'minus' => 50,
				'type' => 'overall',
				'date' => \Carbon\Carbon::parse(date_format(\Carbon\Carbon::parse('2018-06-19T18:00:00+03:00'), 'Y-m-d H:i:s T'))->setTimeZone('Asia/Kolkata')->format('Y-m-d H:i:s')
			],
			[
				'name' => 'Group C Winner',
				'plus' => 250,
				'minus' => 50,
				'type' => 'overall',
				'date' => \Carbon\Carbon::parse(date_format(\Carbon\Carbon::parse('2018-06-19T18:00:00+03:00'), 'Y-m-d H:i:s T'))->setTimeZone('Asia/Kolkata')->format('Y-m-d H:i:s')
			],
			[
				'name' => 'Group D Winner',
				'plus' => 250,
				'minus' => 50,
				'type' => 'overall',
				'date' => \Carbon\Carbon::parse(date_format(\Carbon\Carbon::parse('2018-06-19T18:00:00+03:00'), 'Y-m-d H:i:s T'))->setTimeZone('Asia/Kolkata')->format('Y-m-d H:i:s'),
			],
			[
				'name' => 'Group E Winner',
				'plus' => 250,
				'minus' => 50,
				'type' => 'overall',
				'date' => \Carbon\Carbon::parse(date_format(\Carbon\Carbon::parse('2018-06-19T18:00:00+03:00'), 'Y-m-d H:i:s T'))->setTimeZone('Asia/Kolkata')->format('Y-m-d H:i:s'),
			],
			[
				'name' => 'Group F Winner',
				'plus' => 250,
				'minus' => 50,
				'type' => 'overall',
				'date' => \Carbon\Carbon::parse(date_format(\Carbon\Carbon::parse('2018-06-19T18:00:00+03:00'), 'Y-m-d H:i:s T'))->setTimeZone('Asia/Kolkata')->format('Y-m-d H:i:s'),
			],
			[
				'name' => 'Group G Winner',
				'plus' => 250,
				'minus' => 50,
				'type' => 'overall',
				'date' => \Carbon\Carbon::parse(date_format(\Carbon\Carbon::parse('2018-06-19T18:00:00+03:00'), 'Y-m-d H:i:s T'))->setTimeZone('Asia/Kolkata')->format('Y-m-d H:i:s'),
			],
			[
				'name' => 'Group H Winner',
				'plus' => 250,
				'minus' => 50,
				'type' => 'overall',
				'date' => \Carbon\Carbon::parse(date_format(\Carbon\Carbon::parse('2018-06-19T18:00:00+03:00'), 'Y-m-d H:i:s T'))->setTimeZone('Asia/Kolkata')->format('Y-m-d H:i:s'),
			],
			[
				'name' => '3rd Place',
				'plus' => 300,
				'minus' => 50,
				'type' => 'overall',
				'date' => \Carbon\Carbon::parse(date_format(\Carbon\Carbon::parse('2018-07-06T18:00:00+03:00'), 'Y-m-d H:i:s T'))->setTimeZone('Asia/Kolkata')->format('Y-m-d H:i:s')
			],
			[
				'name' => '4th Place',
				'plus' => 200,
				'minus' => 25,
				'type' => 'overall',
				'date' => \Carbon\Carbon::parse(date_format(\Carbon\Carbon::parse('2018-07-06T18:00:00+03:00'), 'Y-m-d H:i:s T'))->setTimeZone('Asia/Kolkata')->format('Y-m-d H:i:s')
			],
			[
				'name' => 'Runner Up',
				'plus' => 400,
				'minus' => 75,
				'type' => 'overall',
				'date' => \Carbon\Carbon::parse(date_format(\Carbon\Carbon::parse('2018-07-06T18:00:00+03:00'), 'Y-m-d H:i:s T'))->setTimeZone('Asia/Kolkata')->format('Y-m-d H:i:s')
			],
			[
				'name' => '2018 World Cup Winner',
				'plus' => 500,
				'minus' => 100,
				'type' => 'overall',
				'date' => \Carbon\Carbon::parse(date_format(\Carbon\Carbon::parse('2018-07-06T18:00:00+03:00'), 'Y-m-d H:i:s T'))->setTimeZone('Asia/Kolkata')->format('Y-m-d H:i:s')
			],
			[
				'name' => 'Golden Boot',
				'plus' => 500,
				'minus' => 100,
				'type' => 'players',
				'date' => \Carbon\Carbon::parse(date_format(\Carbon\Carbon::parse('2018-06-19T18:00:00+03:00'), 'Y-m-d H:i:s T'))->setTimeZone('Asia/Kolkata')->format('Y-m-d H:i:s'),
			],
			[
				'name' => 'Golden Ball',
				'plus' => 500,
				'minus' => 100,
				'type' => 'players',
				'date' => \Carbon\Carbon::parse(date_format(\Carbon\Carbon::parse('2018-06-19T18:00:00+03:00'), 'Y-m-d H:i:s T'))->setTimeZone('Asia/Kolkata')->format('Y-m-d H:i:s'),
			],
			[
				'name' => 'Golden Glove',
				'plus' => 500,
				'minus' => 100,
				'type' => 'players',
				'date' => \Carbon\Carbon::parse(date_format(\Carbon\Carbon::parse('2018-06-19T18:00:00+03:00'), 'Y-m-d H:i:s T'))->setTimeZone('Asia/Kolkata')->format('Y-m-d H:i:s'),
			],
			[
				'name' => 'Best Young Player',
				'plus' => 500,
				'minus' => 100,
				'type' => 'players',
				'date' => \Carbon\Carbon::parse(date_format(\Carbon\Carbon::parse('2018-07-06T18:00:00+03:00'), 'Y-m-d H:i:s T'))->setTimeZone('Asia/Kolkata')->format('Y-m-d H:i:s'),
			],
			[
				'name' => 'Team Selection',
				'plus' => 100,
				'minus' => 25,
				'type' => 'regular',
				'date' => \Carbon\Carbon::parse(date_format(\Carbon\Carbon::parse('2018-07-30T18:00:00+03:00'), 'Y-m-d H:i:s T'))->setTimeZone('Asia/Kolkata')->format('Y-m-d H:i:s'),
			]
		]);
	}
}
