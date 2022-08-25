<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LessonRequest;
use App\Http\Resources\LessonResource;
use App\Services\LessonService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class LessonController extends Controller
{

    public function __construct(
        protected LessonService $lessonService
    ) {
    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index($module)
    {
        $lessons = $this->lessonService->getLessonsByModule($module);

        return LessonResource::collection($lessons);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param LessonRequest $request
     * @param $module
     * @return LessonResource
     */
    public function store(LessonRequest $request, $module)
    {
        $lesson = $this->lessonService->createNewLesson($request->validated());

        return new LessonResource($lesson);
    }

    /**
     * Display the specified resource.
     *
     * @param $module
     * @param string $identify
     * @return LessonResource
     */
    public function show($module, $identify)
    {
        $lesson = $this->lessonService->getLessonByModule($module, $identify);

        return new LessonResource($lesson);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param LessonRequest $request
     * @param $module
     * @param string $identify
     * @return JsonResponse
     */
    public function update(LessonRequest $request, $module, $identify)
    {
        $this->lessonService->updateLesson($identify, $request->validated());

        return response()->json(['message' => 'updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $module
     * @param string $identify
     * @return JsonResponse
     */
    public function destroy($module, $identify)
    {
        $this->lessonService->deleteLesson($identify);

        return response()->json([], 204);
    }
}
