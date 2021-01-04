<?php


namespace App\Http\Repositories;

use App\Http\Models\Exhibitor;
use App\Http\Repositories\BaseRepository\BaseRepository;
use App\Http\Repositories\RepositoryInterface\BaseRepositoryInterface;

class ExhibitorRepository extends BaseRepository implements BaseRepositoryInterface
{

    public function __construct(Exhibitor $model)
    {
        $this->model = $model;
    }

    // Add your repository methods here

}
