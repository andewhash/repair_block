<?php

namespace App\Policies;

use App\Models\CustomerRequest;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CustomerRequestPolicy
{
    public function create(User $user)
    {
        return $user->role === 'user';
    }
    
    public function update(User $user, CustomerRequest $customerRequest)
    {
        return $user->id === $customerRequest->user_id;
    }
    
    public function delete(User $user, CustomerRequest $customerRequest)
    {
        return $user->id === $customerRequest->user_id;
    }
}
