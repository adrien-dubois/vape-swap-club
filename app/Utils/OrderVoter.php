<?php declare(strict_types=1);

namespace App\Utils;

use App\Models\AppUser;
use App\Models\Order;

class OrderVoter implements Voters{

    const READ = 'read';

    public function canVote(string $permission, $subject = null): bool
    {
        return $permission === self::READ && $subject instanceof Order;
    }

    public function vote(AppUser $user, string $permission, $subject = null): bool
    {
        if(!$subject instanceof Order){
            throw new \RuntimeException('Le sujet doit être une instance de ' . Order::class);
        }

        /**@var Order $subject */
        return $user->getId() == $subject->getApp_user_id();
    }
}