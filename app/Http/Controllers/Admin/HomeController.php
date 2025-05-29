<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        // dd($request->path());

        if (view()->exists($request->path())) {
            $query = Post::where('user_id', Auth::id());

            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }

            if ($request->filled('from') && $request->filled('to')) {
                $query->whereBetween('scheduled_time', [$request->from, $request->to]);
            }

            $posts = $query->orderBy('scheduled_time', 'asc')->get();


            return view($request->path(), compact('posts'));
        }
        return view('admin.errors.404');
    }
}
