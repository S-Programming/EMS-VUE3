<?php


namespace App\Http\Repositories;

use App\Http\Models\Product;
use App\Http\Repositories\BaseRepository\BaseRepository;
use App\Http\Repositories\RepositoryInterface\BaseRepositoryInterface;

class ProductRepository extends BaseRepository implements BaseRepositoryInterface
{

    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    // Add your repository methods here

}
