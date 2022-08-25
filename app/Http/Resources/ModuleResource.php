<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ModuleResource extends JsonResource
{
    public static $wrap = 'module';

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'identify'  => $this->uuid,
            'name'      => $this->name,
            'course_id' => $this->course_id,
            'lessons'   => LessonResource::collection($this->whenLoaded('lessons'))
        ];
    }
}
