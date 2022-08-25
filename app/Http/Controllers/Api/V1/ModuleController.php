<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ModuleRequest;
use App\Http\Resources\ModuleResource;
use App\Services\ModuleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ModuleController extends Controller
{
    public function __construct(
        protected ModuleService $moduleService
    ) {
    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index($course)
    {
        $modules = $this->moduleService->getModulesByCourse($course);

        return ModuleResource::collection($modules);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ModuleRequest $request
     * @return ModuleResource
     */
    public function store(ModuleRequest $request, $course)
    {
        $module = $this->moduleService->createModule($request->validated());

        return new ModuleResource($module);
    }

    /**
     * Display the specified resource.
     *
     * @param $identify
     * @return ModuleResource
     */
    public function show($course, $identify)
    {
        $module = $this->moduleService->getModuleByCourse($course, $identify);

        return new ModuleResource($module);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ModuleRequest $request
     * @param string $identify
     * @return JsonResponse
     */
    public function update(ModuleRequest $request, $course, $identify)
    {
        $this->moduleService->updateModule($identify, $request->validated());

        return response()->json(['message' => 'updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $identify
     * @return JsonResponse
     */
    public function destroy($course, $identify)
    {
        $this->moduleService->deleteModule($identify);

        return response()->json([], 204);
    }
}
