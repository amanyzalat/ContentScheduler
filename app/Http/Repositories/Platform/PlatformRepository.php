<?php

namespace App\Http\Repositories\Platform;

use App\Http\Repositories\Base\BaseRepository;
use App\Models\Platform;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

final class PlatformRepository extends BaseRepository implements PlatformInterface
{
    public function __construct(Platform $model)
    {
        $this->model = $model;
    }
    public function models($request)
    {

        $query = $this->model::all();

        return ['status' => true, 'data' => $query];
    }

  

    
}