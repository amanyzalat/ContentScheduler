<?php

namespace App\Http\Repositories\Post;

use App\Http\Repositories\Base\BaseRepository;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Helpers\ActivityLogger;

final class PostRepository extends BaseRepository implements PostInterface
{
    public function __construct(Post $model)
    {
        $this->model = $model;
    }
    public function models($request)
    {

        $query = $this->model::with(['user', 'platforms']);

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        if ($request->has('date')) {
            $query->whereDate('scheduled_time', $request->date);
        }

        return ['status' => true, 'data' => $query->latest()->get()];
    }

    public function modelLimit($limit)
    {
        $models = $this->model->latest()->take($limit)->get();

        return ['status' => true, 'data' => $models];
    }

    public function create($request)
    {

        $model = Auth::user()->posts()->create($request->only([
            'title',
            'content',
            'image_url',
            'scheduled_time',
            'status'
        ]));

        foreach ($request->platforms as $platform) {
            $model->platforms()->attach($platform['id'], [
                'platform_status' => $platform['platform_status']
            ]);
        }
        if (!$model) {
            return ['status' => false, 'errors' => ['error' => [trans('crud.create')]]];
        }

        ActivityLogger::log('Created Post', "Post ID: {$model->id}");
        return ['status' => true, 'data' => $model];
    }

    public function createForm($request)
    {

        $model = Auth::user()->posts()->create($request->only([
            'title',
            'content',
            'image_url',
            'scheduled_time',
            'status'
        ]));
        $imageUrl = null;
        if ($request->hasFile('image')) {
            $imageUrl = $request->file('image')->store('post-images', 'public');
        }
        if ($request->filled('platforms')) {
            $platformData = [];

            foreach ($request->platforms as $platformId) {
                $platformData[$platformId] = ['platform_status' => 'pending'];
            }

            $model->platforms()->attach($platformData);
        }

        ActivityLogger::log('Created Post', "Post ID: {$model->id}");

        return true;
    }




    public function edit($request, $id)
    {
        $model = $this->findById($id);
        if (!$model) {
            return [
                'status' => false,
                'errors' => [
                    'error' => [trans('crud.notfound', ['model' => 'Post'])]
                ]
            ];
        }
        $model->update($request->only([
            'title',
            'content',
            'image_url',
            'scheduled_time',
            'status'
        ]));
        if ($request->has('platforms')) {
            $model->platforms()->sync([]);
            foreach ($request->platforms as $platform) {
                $model->platforms()->attach($platform['id'], [
                    'platform_status' => $platform['platform_status']
                ]);
            }
        }

        return ['status' => true, 'data' => $model];
    }
}
