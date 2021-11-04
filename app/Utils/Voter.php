<?php declare(strict_types=1);

namespace App\Utils;

interface Voter
{
    public function canVote (string $permission, $subject = null): bool;

    public function vote (User $user, string $permission, $subject = null): bool;
}