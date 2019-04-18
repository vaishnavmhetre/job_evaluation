<?php

namespace App\Events;

use App\Reward;
use App\User;
use Illuminate\Queue\SerializesModels;

class NewlyRegistered extends Event
{
    use SerializesModels;

    public $user;
    public $reward;

    /**
     * Create a new event instance.
     *
     * @param $user User
     * @param $reward Reward|null|string
     */
    public function __construct($user, $reward = null)
    {
        $this->user = $user;
        $this->reward = $reward;
    }
}
