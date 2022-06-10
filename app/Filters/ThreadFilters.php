<?php

namespace App\Filters;

use App\Models\User;
use Illuminate\Http\Request;

class ThreadFilters extends Filters
{
    protected $filters = ['by', 'popular'];
    
    protected function by($username)
    {
        $user = User::where('name', $username)->firstOrFail();
        
        return $this->bulider->where('user_id', $user->id);
    }

    protected function popular()
    {
        $this->bulider->getQuery()->orders = [];

        return $this->bulider->orderBy('replies_count', 'desc');
    }
}
