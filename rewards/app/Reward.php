<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    protected $fillable = [
        'name', 'description'
    ];

    public function appliedUsers()
    {
        return $this->belongsToMany(User::class, 'user_rewards', 'reward_id', 'user_id')->using(UserReward::class)->as('info')->withTimestamps();
    }

}
