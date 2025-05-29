<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Platform;
use Illuminate\Support\Facades\Auth;

class AnalyticsController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Scheduled vs Published
        $statusCounts = Post::where('user_id', $userId)
            ->selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');

        // Posts per platform
        $platformCounts = Platform::withCount(['posts as post_count' => function ($q) use ($userId) {
            $q->where('user_id', $userId);
        }])->get();

        // Publishing success rate (you could use a pivot field like 'platform_status')
        $successRate = [];
        foreach ($platformCounts as $platform) {
            $success = $platform->posts()
                ->where('user_id', $userId)
                ->wherePivot('platform_status', 'success')
                ->count();
            $total = $platform->posts()->where('user_id', $userId)->count();

            $successRate[$platform->name] = $total > 0 ? round(($success / $total) * 100, 2) : 0;
        }

        return view('admin.analytics.index', compact('statusCounts', 'platformCounts', 'successRate'));
    }
}
