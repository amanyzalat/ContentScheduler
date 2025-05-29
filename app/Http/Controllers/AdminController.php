<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ResponseService;
use App\Http\Controllers\Controller;
use App\Http\Requests\EditAdminRequest;
use App\Http\Requests\CreateAdminRequest;
use App\Http\Resources\AdminListResource;
use App\Http\Resources\AdminProfileResource;
use App\Http\Repositories\Dashboard\Admin\AdminInterface;

class AdminController extends Controller
{
    public function __construct(private AdminInterface $AdminI, private ResponseService $responseService)
    {
    }
    // create admin
    public function create(CreateAdminRequest $request)
    {

        $admin = $this->AdminI->create($request);
        if (!$admin) {
            return $this->responseService->json('Fail!', [], 400, ['error' => [trans('messages.error')]]);
        }

        if (!$admin['status']) {
            return $this->responseService->json('Fail!', [], 400, $admin['errors']);
        }
        return $this->responseService->json('Success!', [], 200);
    }
    // get by id
    public function find(Request $request)
    {
       
        $admin = $this->AdminI->findByIdWith($request);
        if (!$admin) {
            return $this->responseService->json('Fail!', [], 400, ['errors' => [trans('crud.notfound')]]);
        }
        $data = new AdminProfileResource($admin);
        return $this->responseService->json('Success!', $data, 200);
    }
    // get all 
    public function get(Request $request)
    {
        if (!$request->exists('order') || $request->order == null) {
            $request->merge(['order' => 'desc']);
        }

        if (!$request->exists('sort') || $request->sort == null) {
            $request->merge(['sort' => 'updated_at']);
        }

        $admins = $this->AdminI->models($request);

        if (!$admins) {
            return $this->responseService->json('Fail!', [], 400);
        }

        if (!$admins['status']) {
            return $this->responseService->json('Fail!', [], 400, $admins['errors']);
        }

        $admins = $admins['data'];
        $data = AdminListResource::collection($admins);
        return $this->responseService->json('Success!', $data, 200);
    }
    // edit admin
    public function edit(EditAdminRequest $request, $id)
    {
        $admin = $this->AdminI->edit($request, $id);
        if (!$admin) {
            return $this->responseService->json('Fail!', [], 400, ['error' => [trans('messages.error')]]);
        }

        if (!$admin['status']) {
            return $this->responseService->json('Fail!', [], 400, $admin['errors']);
        }

        return $this->responseService->json('Success!', [], 200);
    }
    // delete admin
    public function delete(Request $request, $id)
    {

        $admin = $this->AdminI->findByIdWith($request);
        if (!$admin) {
            return $this->responseService->json('Fail!', [], 400, ['errors' => [trans('crud.notfound')]]);
        }
        $admin->delete();
        return $this->responseService->json('Success!', [trans('messages.delete')], 200);
    }
 

  
}
