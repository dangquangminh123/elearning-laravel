<?php

namespace Modules\Teacher\src\Repositories;

use App\Repositories\RepositoryInterface;

interface TeacherRepositoryInterface extends RepositoryInterface
{
    // public function getUsers($limit);

   public function getAllTeacher();
   public function getTeachers();
}