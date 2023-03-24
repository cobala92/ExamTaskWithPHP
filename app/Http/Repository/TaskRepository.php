<?php

namespace App\Http\Repository;

class TaskRepository extends EloquentRepository
{

    public function getModel()
    {
        return \App\Models\Task::class;
    }
}
