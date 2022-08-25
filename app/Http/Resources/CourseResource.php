<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    public static $wrap = 'course';

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'identify'    => $this->uuid,
            'name'        => $this->name,
            'description' => $this->description,
            'created_at'  => Carbon::make($this->created_at)->format('d/m/Y'),
            'modules'     => ModuleResource::collection($this->whenLoaded('modules'))
        ];
    }
}
