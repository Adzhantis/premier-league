<?php
namespace App\Helpers;

class RandomHelper
{
    private const GOAL_CHANCES = [
        0 => 30,
        1 => 30,
        2 => 20,
        3 => 15,
        4 => 5
    ];

    /**
     * @return int
     */
    public static function getGoals(): int
    {
        $selectArray = [];

        foreach (self::GOAL_CHANCES as $item => $chance) {
            $selectArray = array_merge($selectArray, array_fill(0, $chance, $item));
        }
        shuffle($selectArray);

        return $selectArray[rand(0, sizeof($selectArray) - 1)];
    }

    /**
     * https://stackoverflow.com/questions/4133859/round-up-to-nearest-multiple-of-five-in-php
     *
     * @param $n
     * @param int $x
     * @return int
     */
    public static function roundUpToAny($n, $x = 5): int
    {
        return ceil( $n / $x ) * $x;
    }
}
