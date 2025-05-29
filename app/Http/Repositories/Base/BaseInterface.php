<?php

namespace App\Http\Repositories\Base;

interface BaseInterface
{
  // get by id
    public function findByIdWith($request);
    public function setSortParams($request);
    public function findById($id);
    public function delete($id);
    public function findBySlug($slug);
    public function UpdateImages($request, $model);
    public function uploadMedia($model, $imageId);
    public function DbFind($id);
    public function updateImage($model, $imageId);
    public function imageMedia($model, $file);
    public function imageMediaUpdate($model, $file);
    public function generatefrom($name);
}
