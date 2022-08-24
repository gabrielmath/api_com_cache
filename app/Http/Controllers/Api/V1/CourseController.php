<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;
use App\Http\Resources\CourseResource;
use App\Services\CourseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CourseController extends Controller
{

    public function __construct(
        protected CourseService $courseService
    ) {
    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        $courses = $this->courseService->getCourses();

        return CourseResource::collection($courses);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CourseRequest $request
     * @return CourseResource
     */
    public function store(CourseRequest $request)
    {
        $course = $this->courseService->createCourse($request->validated());

        return new CourseResource($course);
    }

    /**
     * Display the specified resource.
     *
     * @param string $identify
     * @return CourseResource
     */
    public function show(string $identify)
    {
        $course = $this->courseService->getCourse($identify);

        return new CourseResource($course);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CourseRequest $request
     * @param string $identify
     * @return JsonResponse
     */
    public function update(CourseRequest $request, $identify)
    {
        $this->courseService->updateCourse($identify, $request->validated());

        return response()->json(['message' => 'updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $identify
     * @return JsonResponse
     */
    public function destroy($identify)
    {
        $this->courseService->deleteCourse($identify);

        return response()->json([], 204);
    }
}
