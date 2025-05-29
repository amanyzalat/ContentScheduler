<?php

namespace App\Http\Repositories\Dashboard\Admin;
use App\Http\Repositories\Base\BaseInterface;

interface AdminInterface{
    public function models($request);
    public function create($request);
    public function edit($request, $id);
   
    
    
}

