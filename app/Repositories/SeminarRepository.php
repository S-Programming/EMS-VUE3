<?php


namespace App\Http\Repositories;

use App\Http\Models\Seminar;
use App\Http\Repositories\BaseRepository\BaseRepository;
use App\Http\Repositories\RepositoryInterface\BaseRepositoryInterface;

class SeminarRepository extends BaseRepository implements BaseRepositoryInterface
{

    public function __construct(Seminar $model)
    {
        $this->model = $model;
    }

    // Add your repository methods here

}
