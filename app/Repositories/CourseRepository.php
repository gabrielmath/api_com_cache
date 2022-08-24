<?php

namespace App\Repositories;

use App\Models\Course;

class CourseRepository
{
    public function __construct(
        protected Course $entity
    ) {
    }

    public function getAllCourses()
    {
        return $this->entity->get();
    }

    public function createNewCourse(array $data)
    {
        return $this->entity->create($data);
    }

    public function getCourseByUuid(string $identify)
    {
        return $this->entity::whereUuid($identify)->firstOrFail();
    }

    public function deleteCourseByUuid(string $identify)
    {
        $course = $this->getCourseByUuid($identify);

        return $course->delete();
    }

    public function updateCourseByUuid(string $identify, array $data)
    {
        $course = $this->getCourseByUuid($identify);

        return $course->update($data);
    }
}
