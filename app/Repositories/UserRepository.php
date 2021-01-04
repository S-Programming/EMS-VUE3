<?php

namespace App\Http\Repositories;

use App\Http\Models\User;
use App\Http\Repositories\BaseRepository\BaseRepository;
use App\Http\Repositories\RepositoryInterface\BaseRepositoryInterface;

class UserRepository extends BaseRepository implements BaseRepositoryInterface
{

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    // Add your repository methods here

}
