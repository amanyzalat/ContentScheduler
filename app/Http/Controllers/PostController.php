<?php

namespace App\Http\Controllers;

use App\Helpers\ActivityLogger;
use App\Http\Controllers\Controller;
use App\Http\Repositories\Post\PostInterface;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\updatePostRequest;
use App\Http\Resources\PostListResource;
use App\Http\Resources\PostResource;
use App\Services\ResponseService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct(private PostInterface $PostI, private ResponseService $responseService)
    {
    }
   // create post
    public function create(CreatePostRequest $request)
    {

        $admin = $this->PostI->create($request);
        if (!$admin) {
            return $this->responseService->json('Fail!', [], 400, ['error' => [trans('messages.error')]]);
        }

        if (!$admin['status']) {
            return $this->responseService->json('Fail!', [], 400, $admin['errors']);
        }
        return $this->responseService->json('Success!', [], 200);
    }
     // edit post
    public function edit(updatePostRequest $request, $id)
    {
        $admin = $this->PostI->edit($request, $id);
        if (!$admin) {
            return $this->responseService->json('Fail!', [], 400, ['error' => [trans('messages.error')]]);
        }

        if (!$admin['status']) {
            return $this->responseService->json('Fail!', [], 400, $admin['errors']);
        }

        return $this->responseService->json('Success!', [], 200);
    }

     // get all 
    public function get(Request $request)
    {
        $models = $this->PostI->models($request);
        if (!$models) {
            return $this->responseService->json('Fail!', [], 400);
        }
        if (!$models['status']) {
            return $this->responseService->json('Fail!', [], 400, $models['errors']);
        }
        $data = PostListResource::collection($models['data']);
        return $this->responseService->json('Success!', $data, 200);
    }
     // delete post

      public function delete(Request $request, $id)
    {

        $post = $this->PostI->findByIdWith($request);
        if (!$post) {
            return $this->responseService->json('Fail!', [], 400, ['errors' => [trans('crud.notfound')]]);
        }
        $post->delete();
        ActivityLogger::log('Deleted Post', "Post ID: {$post->id}");
        return $this->responseService->json('Success!', [trans('messages.delete')], 200);
    }
   
}
