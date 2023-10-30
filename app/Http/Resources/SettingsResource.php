<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SettingsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'secret' => $this->id,
            'about us' => $this->about_us, // coulmn name
            'why us' => $this->why_us,
            'goals' => $this->goal,
            'about footer' => $this->about_footer,
            'activities text' => $this->activities_text
        ];
    }
}
