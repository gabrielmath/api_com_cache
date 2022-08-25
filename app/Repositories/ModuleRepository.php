<?php

namespace App\Repositories;

use App\Models\Module;
use Illuminate\Support\Facades\Cache;

class ModuleRepository
{
    public function __construct(
        protected Module $entity
    ) {
    }

    public function getAllModulesByCourse(int $courseId)
    {
        return $this->entity::whereCourseId($courseId)->get();
    }

    public function getModuleByUuid(string $identify)
    {
        return $this->entity::whereUuid($identify)->firstOrFail();
    }

    public function createNewModule(int $courseId, array $data)
    {
        $data['course_id'] = $courseId;

        Cache::forget('courses');
        return $this->entity->create($data);
    }

    public function getModuleByCourseAndUuid(int $courseId, string $identify)
    {
        return $this->entity::whereCourseId($courseId)->whereUuid($identify)->firstOrFail();
    }

    public function deleteModuleByUuid(string $identify)
    {
        $module = $this->getModuleByUuid($identify);

        Cache::forget('courses');
        return $module->delete();
    }

    public function updateModuleByUuid(int $courseId, string $identify, array $data)
    {
        $module = $this->getModuleByUuid($identify);

        $data['course_id'] = $courseId;

        Cache::forget('courses');
        return $module->update($data);
    }
}
