<?php 

namespace Modules\User\src\Http\Controllers;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Modules\User\src\Http\Requests\UserRequest;
use Modules\User\src\Repositories\UserRepository;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller {

    protected $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function data() {
        $users = $this->userRepository->getAllUsers();
        return DataTables::of($users)
            ->addColumn('edit', function($user) {
                return '<a href="'.route('admin.users.edit', $user).'" class="btn btn-warning">Sửa</a>';
            })
            ->addColumn('delete', function($user) {
                return '<a href="'.route('admin.users.delete', $user).'" class="btn btn-danger delete-action">Xoá</a>';
            })
            ->editColumn('created_at', function ($user) {
                return Carbon::parse($user->created_at)->format('d/m/Y H:i:s');
            })
        ->rawColumns(['edit', 'delete'])
        ->toJson();
    }
    public function index() {
        $pageTitle = 'Quản lý người dùng';
        $users = $this->userRepository->getUsers(5);
        return view('user::lists', compact('pageTitle'));
    }

    public function create() {
        $pageTitle = 'Thêm mới người dùng';
        return view('user::add', compact('pageTitle'));
    }

    public function store(UserRequest $request) {
        $this->userRepository->create([
            'name' => $request->name,
            'email' => $request->email,
            'group_id' => $request->group_id,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route(route: 'admin.users.index')->with('msg',__('user::messages.create.success'));
    }

    public function edit($id) {
        $user = $this->userRepository->find($id);
        $pageTitle = 'Cập nhập người dùng';

        if(!$user) {
            abort(404);
        }
        return view('user::edit', compact('user', 'pageTitle'));
    }

    public function update(UserRequest $userRequest, $id) {

        $data = $userRequest->except('_token', 'password');

        if($userRequest->password) {
            $data['password'] = bcrypt($userRequest->password);
        }
        $this->userRepository->update($id, $data);

        return back()->with('msg',__('user::messages.update.success'));
    }

    public function delete($id) {
        $this->userRepository->delete($id);
        return back()->with('msg',__('user::messages.delete.success'));
    }
}