<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class LoanPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function destroy($user, $loan)
    {
        if($user->id == $loan->user_id){
            return true;
        }

        return false;
    }
}
