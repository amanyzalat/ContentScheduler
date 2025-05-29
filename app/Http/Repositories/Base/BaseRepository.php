<?php

namespace App\Http\Repositories\Base;

use Illuminate\Database\Eloquent\Model;
use App\Http\Repositories\Base\BaseInterface;
use Spatie\MediaLibrary\MediaCollections\Models\Media;




class BaseRepository implements BaseInterface
{
    public $locales = ['en', 'ar'];

    public function __construct(public Model $model )
    {
    }
    // get by id
    public function findByIdWith($request)
    {
        $model = $this->model->where('id', $request->id)->with($request->with ?? [])->withCount($request->withCount ?? [])->first();
        return $model ?? false;
    }


    public function generatefrom($name)
    {
        $slug = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $name));
        $baseSlug = $slug;
        $count = 1;
        while ($this->model->where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $count;
            $count++;
        }
        return $slug;
    }

    // sort
    public function setSortParams($request)
    {
        switch ($request->sort) {
            default:
                $sort = $request->sort ?: 'created_at';
                break;
        }

        switch ($request->order) {
            default:
                $order = $request->order ?: 'desc';
                break;
        }

        return [$sort, $order];
    }

    // 
    public function findById($id)
    {
        $model = $this->model->find($id);
        return $model ?? false;
    }

    public function delete($id)
    {
        $model = $this->findById($id);

        if (!$model) {
            return ['status' => false, 'errors' => ['error' => trans('crud.notfound')]];
        }
        if (isset($this->model::$hasMany)) {
            foreach ($this->model::$hasMany as $hasMany) {
                if ($model->$hasMany && $count = $model->$hasMany->count()) {
                    return ['status' => false, 'errors' => ['error' => [trans('auth.cascade_delete', ['model' => class_basename($model), 'count' => $count, 'cascade' => trans('models.' . $hasMany)])]]];
                }
            }
        }

        $model->delete();
        return ['status' => true, 'data' => []];
    }

    public function findBySlug($slug)
    {
        $model = $this->model->where('slug', $slug)->first();
        return $model ?? false;
    }

    public function UpdateImages($request, $model)
    {
        $imageIds = $request->images;
        $existingImageIds = $model->getMedia('images')->pluck('id')->toArray();
        $deletedImageIds = array_diff($existingImageIds, $imageIds);
        foreach ($deletedImageIds as $deletedImageId) {
            $model->getMedia('images')->where('id', $deletedImageId)->first()->delete();
        }
        $model->media()->whereNotIn('id', $imageIds)->delete();
        $newImageIds = array_diff($imageIds, $existingImageIds);
        return $newImageIds;
    }

    public function uploadMedia($model, $imageId)
    {
        $this->media->where('id', $imageId)
            ->update([
                'model_id' => $model->id,
                'model_type' => get_class($this->model),
                'collection_name' => 'images'
            ]);
    }

    public function DbFind($id)
    {
        $model = $this->model->where('id', $id)->first();
        if (!$model) {
            return ['status' => false, 'errors' => ['error' => [trans('crud.notfound', ['model' => class_basename($this->model)])]]];
        }
        return ['status' => true, "data" => $model] ?? false;
    }
    public function updateImage($model, $imageId)
    {
        if ($imageId && $model->getMedia('images')->first()?->id != $imageId) {
            $model->clearMediaCollection('images');
            $this->media->where('id', $imageId)
                ->update([
                    'model_id' => $model->id,
                    'model_type' => get_class($this->model),
                    'collection_name' => 'images'
                ]);
        }
    }

    public function imageMedia($model, $file)
    {
        $model->addMedia($file)->toMediaCollection('images');
    }
    public function imageMediaUpdate($model, $file)
    { 
        $model->clearMediaCollection('images');
        $model->addMedia($file)->toMediaCollection('images');
        
    }

}
