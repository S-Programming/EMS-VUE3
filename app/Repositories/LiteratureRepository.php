<?php


namespace App\Http\Repositories;

use App\Http\Models\Literature;
use App\Http\Repositories\BaseRepository\BaseRepository;
use App\Http\Repositories\RepositoryInterface\BaseRepositoryInterface;

class LiteratureRepository extends BaseRepository implements BaseRepositoryInterface
{

    public function __construct(Literature $model)
    {
        $this->model = $model;
    }

    // Add your repository methods here

}
