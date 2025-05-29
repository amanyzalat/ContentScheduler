<?php

namespace App\Http\Repositories\Platform;

interface PlatformInterface
{
    public function models($request);
   
    public function delete($id);

}
