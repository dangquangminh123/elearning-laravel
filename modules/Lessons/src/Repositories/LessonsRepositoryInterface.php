<?php

namespace Modules\Lessons\src\Repositories;

use App\Repositories\RepositoryInterface;

interface LessonsRepositoryInterface extends RepositoryInterface
{
     public function getPosition($courseId);
      // public function getAllLessons();
      public function getAllLessions($courseId);
      public function getLessons($courseId);

      public function getModuleByPosition($course);
      public function getLessonsByPosition($course, $moduleId = null, $isDocument = false);
      public function getLessonCount($course);
      public function getLesssonActive($slug);
      public function findLessonWithVideo($lessonId);
      public function getLessonsGroup($courseId);
}