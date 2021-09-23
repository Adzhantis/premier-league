<?php
namespace App\Helpers;

class ClubsDataHelper
{
    private const CLUB_IMG_PREFIX = 'https://resources.premierleague.com/premierleague/badges/25/';

    public const DATA = [
        [
            'name' => 'Manchester United',
            'img' => self::CLUB_IMG_PREFIX . 't1.png',
        ],
        [
            'name' => 'Leeds United',
            'img' => self::CLUB_IMG_PREFIX . 't2.png',
        ],
        [
            'name' => 'Arsenal',
            'img' => self::CLUB_IMG_PREFIX . 't3.png',
        ],
        [
            'name' => 'Newcastle United',
            'img' => self::CLUB_IMG_PREFIX . 't4.png',
        ],
        [
            'name' => 'Tottenham Hotspur',
            'img' => self::CLUB_IMG_PREFIX . 't6.png',
        ],
        [
            'name' => 'Aston Villa',
            'img' => self::CLUB_IMG_PREFIX . 't7.png',
        ],
        [
            'name' => 'Chelsea',
            'img' => self::CLUB_IMG_PREFIX . 't8.png',
        ],
        [
            'name' => 'Everton',
            'img' => self::CLUB_IMG_PREFIX . 't11.png',
        ],
        [
            'name' => 'Leicester City',
            'img' => self::CLUB_IMG_PREFIX . 't13.png',
        ],
        [
            'name' => 'Liverpool',
            'img' => self::CLUB_IMG_PREFIX . 't14.png',
        ]
    ];
}
