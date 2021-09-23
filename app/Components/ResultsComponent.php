<?php
namespace App\Components;

use App\Helpers\RandomHelper;
use App\Models\Club;

class ResultsComponent
{
    private Club $firstClub;
    private Club $secondClub;

    private int $firstClubGoals;
    private int $secondClubGoals;

    public function __construct(Club $firstClub, Club $secondClub)
    {
        $this->firstClub = $firstClub;
        $this->secondClub = $secondClub;

        $this->firstClubGoals = RandomHelper::getGoals();
        $this->secondClubGoals = RandomHelper::getGoals();
    }

    public function set()
    {
        $this->setClubGoals();
        $this->setClubPoints();
        $this->setWhoWonWhoLost();
        $this->setPlayed();
    }

    private function setClubGoals(): void
    {
        //show week results
        $this->firstClub->currentGoalsFor += $this->firstClubGoals;
        $this->secondClub->currentGoalsFor += $this->secondClubGoals;

        $this->firstClub->goals_for += $this->firstClubGoals;
        $this->firstClub->goals_against += $this->secondClubGoals;

        $this->secondClub->goals_for += $this->secondClubGoals;
        $this->secondClub->goals_against += $this->firstClubGoals;
    }

    private function setClubPoints(): void
    {
        switch ($this->firstClubGoals <=> $this->secondClubGoals) {
            case 1 :
                $this->firstClub->points += 3;
                break;
            case -1 :
                $this->secondClub->points += 3;
                break;
            case 0 :
                $this->firstClub->points  += 1;
                $this->secondClub->points += 1;
                break;
        }
    }

    private function setWhoWonWhoLost(): void
    {
        switch ($this->firstClubGoals <=> $this->secondClubGoals) {
            case 1 :
                $this->firstClub->won += 1;
                $this->secondClub->lost += 1;
                break;
            case -1 :
                $this->firstClub->lost += 1;
                $this->secondClub->won += 1;
                break;
            case 0 :
                $this->firstClub->drawn  += 1;
                $this->secondClub->drawn += 1;
                break;
        }
    }

    private function setPlayed(): void
    {
        $this->firstClub->played += 1;
        $this->secondClub->played += 1;
    }
}
