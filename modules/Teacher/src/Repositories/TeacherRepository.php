<?php

namespace Modules\Teacher\src\Repositories;

use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;
use Modules\Teacher\src\Models\Teacher;
use Modules\Teacher\src\Repositories\TeacherRepositoryInterface;

class TeacherRepository extends BaseRepository implements TeacherRepositoryInterface
{
    public function getModel()
    {
        return Teacher::class;
    }

    public function getAllTeacher() {
        return $this->model->select(['id', 'name', 'exp', 'phone_zalo', 'image', 'created_at'])->latest();
    }

   
}