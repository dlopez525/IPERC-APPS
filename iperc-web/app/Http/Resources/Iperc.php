<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Iperc extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'risk' => $this->risk->name,
            'engineering_controls' => $this->engineering_controls,
            'administrative_controls' => $this->administrative_controls,
            'epps' => $this->epps,
            'danger' => $this->danger->name,
            'danger_description' => $this->dangerDescription->name,
            'consequence' => $this->consequence->name,
            'event' => $this->dangerDescription->event,
            'task' => $this->task->name,
            'risk_color' => $this->risk->color,
            'risk_color_rgba' => $this->risk->color_rgba,
            'risk_name' => $this->risk->slug,
            'last_update' => date('d-m-Y', strtotime($this->file->last_update)),
        ];
    }
}
