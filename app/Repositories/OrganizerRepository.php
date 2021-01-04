<?php


namespace App\Http\Repositories;

use App\Http\Models\Organizer;
use App\Http\Repositories\BaseRepository\BaseRepository;
use App\Http\Repositories\RepositoryInterface\BaseRepositoryInterface;

class OrganizerRepository extends BaseRepository implements BaseRepositoryInterface
{

    public function __construct(Organizer $model)
    {
        $this->model = $model;
    }

    // Add your repository methods here

}
