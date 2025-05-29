<?php


namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use App\Models\Statistic;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public $objectName;
    public $folderView;
    public function __construct(Task $model)
        {
            $this->objectName=$model;
            $this->folderView='task';
        }
    public function index()
       {
            $data['items'] = $this->objectName::get();
            return view('admin.'.$this->folderView.'.lists', $data);
        }
    public function create()
        {
            $data['admins'] = User::where('is_admin', true)->get();
            $data['users'] = User::where('is_admin', false)->get();
            
            return view('admin.'.$this->folderView.'.create', $data);
        }
    public function store(Request $request)
        {
            $task = Task::create([
                'title' => $request->title,
                'description' => $request->description,
                'assigned_by_id' => $request->assigned_by_id,
                'assigned_to_id' => $request->assigned_to_id,
            ]);
        
            return redirect()->route('tasks.index');
        }
       
        
    public function statistics()
        {
            $data['statistics'] = Statistic::with('user')
                ->orderBy('task_count', 'desc')
                ->take(10)
                ->get();
            return view('admin.'.$this->folderView.'.statistics', $data);
            
        }

}
