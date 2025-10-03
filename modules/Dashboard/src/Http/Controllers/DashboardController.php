<?php 

namespace Modules\Dashboard\src\Http\Controllers;
use App\Http\Controllers\Controller;


class DashboardController extends Controller {
    public function index() {
         $pageTitle = __('home::messages.dashboard_page');
       return view('dashboard::dashboard', compact('pageTitle'));
    }

    // public function create() {
    //     $pageTitle = 'Thêm mới người dùng';
    //     return view('user::add', compact('pageTitle'));
    // }
}