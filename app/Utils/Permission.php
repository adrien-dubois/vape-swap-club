<?php declare(strict_types=1);

namespace App\Utils;

final class Permission
{
    /**
     * @var Voter[]
     */
    private array $voters = [];

    public function can(User $user, string $permission, $subject = null) : bool
    {
        return false;
    }

    public function addVoter (Voter $voter) {
        $this -> voters[] = $voter;
    }
}