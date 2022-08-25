<?php

namespace App\Services;

use App\Repositories\CourseRepository;
use App\Repositories\ModuleRepository;

class ModuleService
{
    public function __construct(
        protected ModuleRepository $repository,
        protected CourseRepository $courseRepository,
    ) {
    }

    public function getModulesByCourse(string $course)
    {
        $courseData = $this->courseRepository->getCourseByUuid($course);
        return $this->repository->getAllModulesByCourse($courseData->id);
    }

    public function createModule(array $data)
    {
        $course = $this->courseRepository->getCourseByUuid($data['course']);
        return $this->repository->createNewModule($course->id, $data);
    }

    public function getModuleByCourse($course, string $identify)
    {
        $courseData = $this->courseRepository->getCourseByUuid($course);
        return $this->repository->getModuleByCourseAndUuid($courseData->id, $identify);
    }

    public function deleteModule(string $identify)
    {
        return $this->repository->deleteModuleByUuid($identify);
    }

    public function updateModule(string $identify, array $data)
    {
        $course = $this->courseRepository->getCourseByUuid($data['course']);
        return $this->repository->updateModuleByUuid($course->id, $identify, $data);
    }
}
