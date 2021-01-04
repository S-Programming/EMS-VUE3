<?php


namespace App\Http\Repositories;

use App\Http\Models\ShowGuide; 
use App\Http\Repositories\BaseRepository\BaseRepository;
use App\Http\Repositories\RepositoryInterface\BaseRepositoryInterface;

class ShowGuideRepository extends BaseRepository implements BaseRepositoryInterface
{

    public function __construct(ShowGuide $model)
    {
        $this->model = $model;
    }

    // Add your repository methods here

}
