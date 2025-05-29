<?php

namespace App\Http\Repositories\Post;

interface PostInterface
{
    public function models($request);
    public function create($request);
    public function edit($request, $id);
    public function delete($id);

}
