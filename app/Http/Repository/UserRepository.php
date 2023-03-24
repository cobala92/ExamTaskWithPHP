<?php

namespace App\Http\Repository;

class UserRepository extends EloquentRepository
{

    public function getModel()
    {
        return \App\Models\User::class;
    }
}
