<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Platform;
use Illuminate\Support\Facades\Auth;

class UserPlatformController extends Controller
{
     public $objectName;
    public $folderView;
    public function __construct(Platform $model)
    {
        $this->objectName = $model;
        $this->folderView = 'platforms';
    }
    public function index()
    {
        $platforms = $this->objectName::all();
        $activePlatformIds = Auth::user()->activePlatforms()->pluck('platform_id')->toArray();

        return view('admin.' . $this->folderView . '.lists', compact('platforms', 'activePlatformIds'));
    }
    public function toggle(Request $request)
    {
        $request->validate([
            'platform_id' => 'required|exists:platforms,id'
        ]);

        $user = Auth::user();
        $platformId = $request->platform_id;

        if ($user->activePlatforms()->where('platform_id', $platformId)->exists()) {
            $user->activePlatforms()->detach($platformId);
        } else {
            $user->activePlatforms()->attach($platformId);
        }

        return redirect()->back()->with('success', 'Platform setting updated.');
    }
}
