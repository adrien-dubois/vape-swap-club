<?php declare(strict_types=1);

namespace App\Utils;

use App\Models\AppUser;

final class Permissions
{
    /**
     * @var Voters[]
     */
    private array $voters = [];


    public function can(AppUser $user, string $permission, $subject = null) : bool
    {
        foreach($this->voters as $voter){
            if($voter->canVote($permission, $subject)){
                $vote = $voter->vote($user, $permission, $subject);

                if($vote === true){
                    return true;
                }
            }
        }
        return false;
    }

    public function addVoter (Voters $voter) {
        $this -> voters[] = $voter;
    }
}