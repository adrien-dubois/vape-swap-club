<?php declare(strict_types=1);

namespace App\Utils;

use App\Models\AppUser;

interface Voters
{
    public function canVote (string $permission, $subject = null): bool;

    public function vote (AppUser $user, string $permission, $subject = null): bool;
}