<?php
namespace App\Components;

use App\Models\Club;
use App\Models\Week;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class GameComponent
{
    /**
     * @param Week $week
     */
    public function updateToNextWeek(Model $week): void
    {
        $week->current += 1;
        $week->save();
    }

    /**
     * @param Collection $games
     */
    public function play(Collection $games): void
    {
        foreach ($games as $game) {
            $firstClub  = $game->firstClub;
            $secondClub = $game->secondClub;

            $this->saveGameResults($firstClub, $secondClub);
        }
    }

    /**
     * @param Club $firstClub
     * @param Club $secondClub
     */
    private function saveGameResults(Club $firstClub, Club $secondClub): void
    {
        (new ResultsComponent($firstClub, $secondClub))->set();

        $firstClub->save();
        $secondClub->save();
    }


    public function setWhoLoseChampionship(Collection $clubs, int $pointsLeft, int $maxPointsTopClub)
    {
        foreach ($clubs as $position => $club) {
            //first club has $maxPointsTopClub
            if ($position === 0) {
                continue;
            }
            $club->loseChampionShip = ($club->points + $pointsLeft) <= $maxPointsTopClub;
        }
    }

    /**
     * @param Model $week
     * @param Collection|array $clubs
     */
    public function setClubPredictions(Model $week, Collection $clubs): void
    {
        $gamesLeft = $week->countWeeks - $clubs->first()->played;
        $topClubPoints = $clubs->first()->points;

        $this->setWhoLoseChampionship($clubs, $gamesLeft * 3, $topClubPoints);

        $maxPointsAll = 0;
        foreach ($clubs as $club) {
            if ($club->loseChampionShip) {
                continue;
            }
            $maxPointsAll += $club->points;
        }

        if (!$maxPointsAll) {
            return;
        }

        foreach ($clubs as $club) {
            if ($club->loseChampionShip) {
                continue;
            }
            $club->chanceToWin = round(100 * $club->points / $maxPointsAll);
        }
    }

}
