<?php


namespace App\Http\Repositories;

use App\Http\Models\Exhibition;
use App\Http\Repositories\BaseRepository\BaseRepository;
use App\Http\Repositories\RepositoryInterface\BaseRepositoryInterface;

class ExhibitionRepository extends BaseRepository implements BaseRepositoryInterface
{

    public function __construct(Exhibition $model)
    {
        $this->model = $model;
    }

    // Add your repository methods here

}
