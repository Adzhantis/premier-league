<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'first_club_id',
        'second_club_id',
        'week_number',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['firstClub', 'secondClub'];

    /**
     * Get the phone associated with the user.
     */
    public function firstClub()
    {
        return $this->hasOne(Club::class, 'id', 'first_club_id');
    }

    /**
     * Get the phone associated with the user.
     */
    public function secondClub()
    {
        return $this->hasOne(Club::class, 'id', 'second_club_id');
    }
}
