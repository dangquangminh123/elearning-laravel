<?php

namespace Modules\Home\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Modules\Teacher\src\Repositories\TeacherRepositoryInterface;
use Modules\Courses\src\Repositories\CoursesRepositoryInterface;

class KnowledgeController extends Controller
{

     protected $coursesRepository;
    protected $teacherRepository;

    public function __construct(CoursesRepositoryInterface $coursesRepository, TeacherRepositoryInterface $teacherRepository) 
    {
        $this->coursesRepository = $coursesRepository;
        $this->teacherRepository = $teacherRepository;
    }
    public function index() {
        $pageTitle = 'Kiến thức lập trình';

        return view('home::knowledge', compact('pageTitle'));
    }
}