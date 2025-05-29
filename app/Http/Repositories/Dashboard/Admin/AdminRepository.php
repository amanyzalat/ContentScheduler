<?php

namespace App\Http\Repositories\Dashboard\Admin;

use App\Http\Repositories\Base\BaseRepository;
use App\Http\Repositories\Dashboard\Admin\AdminInterface;
use App\Models\Role;
use App\Models\User;
use App\Services\ResponseService;

use Illuminate\Support\Facades\Hash;

class AdminRepository extends BaseRepository implements AdminInterface
{
    public $user_type_id;

    public function __construct(User $model, public ResponseService $ResponseService)
    {
        $this->model = $model;
    }

    public function models($request)
    {
        $models = $this->model->orderBy('updated_at', 'desc')->where(function ($query) use ($request) {
            $query->where(function ($query) use ($request) {
                $query->where('name', 'like', "%{$request->name}%");
            });

            if ($request->exists('email') && $request->email !== null) {
                $query->where('email', $request->email);
            }
        });
        [$sort, $order] = $this->setSortParams($request);
        $models->orderBy($sort, $order);
        $models = $request->per_page ? $models->paginate($request->per_page) : $models->get();
        return ['status' => true, 'data' => $models];
    }



    public function create($request)
    {
        $model = $this->model::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),

        ]);
        if (!$model) {
            return ['status' => false, 'errors' => ['error' => [trans('crud.create')]]];
        }

        return ['status' => true, 'data' => $model];
    }

    public function edit($request, $id)
    {
        $model = $this->model->find($id);
        if (!$model) {
            return ['status' => false, 'errors' => ['error' => [trans('crud.notfound', ['model' => 'User'])]]];
        }
        if ($request->exists('name') && $request->name !== null) {
            $model->name = $request->name;
        }

        if ($request->exists('email') && $request->email !== null) {
            $model->email = $request->email;
        }
        if ($request->exists('password') && $request->password !== null) {
            $model->password = Hash::make($request->password);
        }

        $model->save();

        return ['status' => true, 'data' => $model];
    }
}
