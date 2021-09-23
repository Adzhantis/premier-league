<?php

namespace Database\Seeders;

use App\Helpers\ClubsDataHelper;
use App\Models\Club;
use App\Models\Game;
use App\Models\Week;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->addClubs();
        $this->setGames();

        $weeks = $this->setWeeksCount();
        $this->setWeekNumberForEachGame($weeks);
    }

    private function addClubs()
    {
        $clubsCount = env('CLUBS_COUNT');

        for ($clubIndex = 0; $clubIndex < $clubsCount; $clubIndex++) {
            $club = new Club;
            $club->name = ClubsDataHelper::DATA[$clubIndex]['name'];
            $club->img = ClubsDataHelper::DATA[$clubIndex]['img'];
            $club->save();
        }
    }

    private function setGames(): void
    {
        $clubs      = Club::all();
        $clubsCount = $clubs->count();

        for ($i = 0; $i < $clubsCount; $i++) {
            for ($k = $clubsCount - 1; $k >= 0; $k--) {
                if ($k == $i) {
                    continue;
                }

                $game = new Game;
                $game->week_number = 0;
                $game->first_club_id = $clubs->get($i)->id;
                $game->second_club_id = $clubs->get($k)->id;
                $game->save();
            }
        }
    }

    /**
     * @param int $weeks
     */
    private function setWeekNumberForEachGame(int $weeks): void
    {
        $clubs = Club::all();

        for ($week = 1; $week <= $weeks; $week++) {
            $clubIds = $clubs->pluck('id')->toArray();

            $firstGame = $this->updateFirstGameOfWeek($week, current($clubIds));
            next($clubIds);

            //rm already updated game
            $clubIds = array_diff($clubIds, [$firstGame->first_club_id, $firstGame->second_club_id]);

            do {
                $clubIdsWeekNotSet = $clubIds;
                $game = Game::query()
                    ->whereIn('first_club_id', $clubIdsWeekNotSet)
                    ->whereIn('second_club_id', $clubIdsWeekNotSet)
                    ->where('week_number' , 0)
                    ->orderBy('id', 'DESC')
                    ->first();

                $game->week_number = $week;
                $game->save();

                //rm already updated game
                $clubIds = array_diff($clubIds, [$game->first_club_id, $game->second_club_id]);

            } while ($clubIds);
        }
    }

    /**
     * @param int $week
     * @param int $clubId
     * @return Model
     */
    private function updateFirstGameOfWeek(int $week, int $clubId): Model
    {
        $atHomeOrNot = $week % 2 === 0 ? 'first_club_id' : 'second_club_id';

        $game = Game::query()
            ->where('week_number', 0)
            ->where($atHomeOrNot, '=', $clubId)
            ->first();

        $game->week_number = $week;
        $game->save();

        return $game;
    }

    /**
     * @return int
     */
    private function setWeeksCount(): int
    {
        $clubs = Club::all();
        $clubsCount = $clubs->count();
        $weeks = ($clubsCount - 1) * 2;

        $week = new Week;
        $week->countWeeks = $weeks;
        $week->save();

        return $weeks;
    }
}
