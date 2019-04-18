<?php

namespace App\Listeners;

use App\Events\NewlyRegistered;
use App\Reward;

class ApplyRegisteredReward
{

    public $rewardName = 'registration';


    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NewlyRegistered $event
     * @return void
     */
    public function handle(NewlyRegistered $event)
    {
        $user = $event->user;
        $reward = $event->reward;

        if ($reward == null) {
            $reward = $this->getRandomRewardByName($this->rewardName);
        } elseif (gettype($reward) == "string") {
            $reward = $this->getRandomRewardByName($reward);
        }

        $user->receivedRewards()->attach($reward->id);
    }

    private function getRandomRewardByName($name)
    {
        return Reward::whereName($name)->get()->random(1)[0];
    }
}
