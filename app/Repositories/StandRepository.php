<?php


namespace App\Http\Repositories;

use App\Http\Models\Stand;
use App\Http\Repositories\BaseRepository\BaseRepository;
use App\Http\Repositories\RepositoryInterface\BaseRepositoryInterface;

class StandRepository extends BaseRepository implements BaseRepositoryInterface
{

    public function __construct(Stand $model)
    {
        $this->model = $model;
    }

    // Add your repository methods here

}
