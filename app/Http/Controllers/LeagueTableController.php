<?php

namespace App\Http\Controllers;

use App\Components\GameComponent;
use App\Models\Club;
use App\Models\Week;
use App\Models\Game;
use Illuminate\Database\Eloquent\Collection;

class LeagueTableController extends Controller
{
    private GameComponent $component;

    public function __construct(GameComponent $component)
    {
        $this->component = $component;
    }

    public function index()
    {
      return view('index');
    }

    public function clubs()
    {
        $clubs = Club::query()->orderBy('points', 'DESC')->get();

        return view('club-rows', ['clubs' => $clubs]);
    }

    public function predictions()
    {
        $clubs = Club::query()->orderBy('points', 'DESC')->get();
        $week  = Week::query()->first();

        $this->component->setClubPredictions($week, $clubs);

        return view('prediction-rows', [
            'clubs' => $clubs,
            'currentWeekNumber' => $week->current,
        ]);
    }

    public function play()
    {
        $week = Week::query()->first();

        if ($week->isPremierLeagueEnd()) {
            return response()->json([
                'error' => 'Premier League is over',
                'showResetBtn' => true
            ], 404);
        }

        $this->component->updateToNextWeek($week);

        $games = Game::query()->where('week_number', $week->current)->get();

        $this->component->play($games);

        return view('match-results', ['games' => $games, 'currentWeekNumber' => $week->current]);
    }
}
