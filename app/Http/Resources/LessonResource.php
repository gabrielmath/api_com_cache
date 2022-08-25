<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class LessonResource extends JsonResource
{
    public static $wrap = 'lesson';

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
            'title'       => $this->name,
            'video'       => $this->video,
            'description' => $this->description,
            'created_at'  => Carbon::make($this->created_at)->format('d/m/Y'),
        ];
    }
}
