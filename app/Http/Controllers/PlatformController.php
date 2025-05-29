<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Platform\PlatformInterface;
use App\Http\Requests\toggleUserPlatformRequest;
use App\Http\Resources\PlatformListResource;
use App\Http\Resources\PlatformResource;
use App\Services\ResponseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlatformController extends Controller
{
    public function __construct(private PlatformInterface $PlatformI, private ResponseService $responseService) {}
    // get all 
    public function get(Request $request)
    {
        $models = $this->PlatformI->models($request);
        if (!$models) {
            return $this->responseService->json('Fail!', [], 400);
        }
        if (!$models['status']) {
            return $this->responseService->json('Fail!', [], 400, $models['errors']);
        }
        $data = PlatformListResource::collection($models['data']);
        return $this->responseService->json('Success!', $data, 200);
    }
    public function toggleUserPlatform(toggleUserPlatformRequest $request)
    {


        $user = Auth::user();

        if ($user->activePlatforms()->where('platform_id', $request->platform_id)->exists()) {
            $user->activePlatforms()->detach($request->platform_id);
            return $this->responseService->json('Success!', 'Platform deactivated', 200);
            
        } else {
            $user->activePlatforms()->attach($request->platform_id);
             return $this->responseService->json('Success!', 'Platform activated', 200);
            
        }
    }
}
