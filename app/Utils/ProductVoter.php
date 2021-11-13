<?php declare(strict_types=1);

namespace App\Utils;

use App\Models\AppUser;
use App\Models\Product;

class ProductVoter implements Voters{

    const READ = 'read';

    public function canVote(string $permission, $subject = null): bool
    {
        return $permission === self::READ && $subject instanceof Product;
    }

    public function vote(AppUser $user, string $permission, $subject = null): bool
    {
        if(!$subject instanceof Product){
            throw new \RuntimeException('Le sujet doit être de type ' . Product::class);
        }

        return $user->getId() == $subject->getApp_user_id();
    }
}