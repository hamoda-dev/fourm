<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function singIn($user = "")
    {
        ($user) ? $this->be($user) : $this->be(create(User::class));
        
        return $this;
    }
}
