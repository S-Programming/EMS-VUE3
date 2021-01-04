<?php


namespace App\Http\Repositories;

use App\Http\Models\Visitor;
use App\Http\Models\ExhibitionVisitor;
use App\Http\Repositories\BaseRepository\BaseRepository;
use App\Http\Repositories\RepositoryInterface\BaseRepositoryInterface;

class VisitorRepository extends BaseRepository implements BaseRepositoryInterface
{

    public function __construct(Visitor $model)
    {
        $this->model = $model;
    }

    // Add your repository methods here

}
