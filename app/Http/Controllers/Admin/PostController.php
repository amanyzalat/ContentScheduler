<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use App\Models\Platform;
use App\Models\Statistic;
use Illuminate\Http\Request;
use App\Http\Repositories\Post\PostInterface;

class PostController extends Controller
{
    public $objectName;
    public $folderView;
    public function __construct(Post $model,private PostInterface $PostI)
    {
        $this->objectName = $model;
        $this->folderView = 'post';
    }
    public function index()
    {
        $data['items'] = $this->objectName::get();
        return view('admin.' . $this->folderView . '.lists', $data);
    }
    public function create()
    {
        $data['platforms'] =  Platform::all();
        return view('admin.' . $this->folderView . '.create', $data);
    }
    public function store(Request $request)
    {
        $this->PostI->createForm($request);

        return redirect()->route('posts.index')->with('success', 'Post created successfully!');
    }


    public function statistics()
    {
        $data['statistics'] = Statistic::with('user')
            ->orderBy('task_count', 'desc')
            ->take(10)
            ->get();
        return view('admin.' . $this->folderView . '.statistics', $data);
    }
}
