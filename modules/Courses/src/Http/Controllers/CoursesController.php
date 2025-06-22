<?php

namespace Modules\Courses\src\Http\Controllers;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Modules\User\src\Http\Requests\CoursesRequest;
use Modules\Courses\src\Repositories\CoursesRepository;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
   protected $coursesRepository;

    public function __construct(CoursesRepository $coursesRepository) {
        $this->coursesRepository = $coursesRepository;
    }

    public function data() {
        $users = $this->coursesRepository->getAllCourses();
        return DataTables::of($users)
            ->addColumn('edit', function($user) {
                return '<a href="'.route('admin.courses.edit', $user).'" class="btn btn-warning">Sửa</a>';
            })
            ->addColumn('delete', function($user) {
                return '<a href="'.route('admin.courses.delete', $user).'" class="btn btn-danger delete-action">Xoá</a>';
            })
            ->editColumn('created_at', function ($user) {
                return Carbon::parse($user->created_at)->format('d/m/Y H:i:s');
            })
        ->rawColumns(['edit', 'delete'])
        ->toJson();
    }
    public function index() {
        $pageTitle = 'Quản lý người dùng';
        $users = $this->coursesRepository->getAllCourses();
        return view('courses::lists', compact('pageTitle'));
    }

    public function create() {
        $pageTitle = 'Thêm mới người dùng';
        return view('courses::add', compact('pageTitle'));
    }

    public function store(CoursesRequest $request) {
        $this->coursesRepository->create([
            'name' => $request->name,
            'email' => $request->email,
            'group_id' => $request->group_id,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route(route: 'admin.courses.index')->with('msg',__('user::messages.create.success'));
    }

    public function edit($id) {
        $user = $this->coursesRepository->find($id);
        $pageTitle = 'Cập nhập người dùng';

        if(!$user) {
            abort(404);
        }
        return view('courses::edit', compact('user', 'pageTitle'));
    }

    public function update(CoursesRequest $userRequest, $id) {

        $data = $userRequest->except('_token', 'password');

        if($userRequest->password) {
            $data['password'] = bcrypt($userRequest->password);
        }
        $this->coursesRepository->update($id, $data);

        return back()->with('msg',__('courses::messages.update.success'));
    }

    public function delete($id) {
        $this->coursesRepository->delete($id);
        return back()->with('msg',__('courses::messages.delete.success'));
    }
}
