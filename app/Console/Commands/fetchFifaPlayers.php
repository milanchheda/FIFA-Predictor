<?php

namespace App\Console\Commands;

use App\Players;
use Illuminate\Console\Command;

class fetchFifaPlayers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fifa:players';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $json = json_decode(file_get_contents('https://fantasy.fifa.com/services/api/feed/players?gamedayId=1&optType=1&language=en&buster=default'), true);
        Players::truncate();
        foreach ($json['Data']['Value']['playerList'] as $player) {
            Players::create(['name' => ucwords(strtolower($player['PlayerFullName']))]);
        }
    }
}
