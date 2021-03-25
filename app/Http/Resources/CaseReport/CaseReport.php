<?php

namespace App\Http\Resources\CaseReport;

use Illuminate\Http\Resources\Json\JsonResource;

class CaseReport extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $img = collect($this->media)->firstWhere('collection_name', 'report-image');
        $video = collect($this->media)->firstWhere('collection_name', 'report-video');

        return [
            'id' => $this->id,
            'crime' => $this->crime,
            'focus_crime_type' => $this->focus_crime_type,
            'crime_date' => $this->crime_date,
            'name' => $this->name,
            'reported_by' => $this->reported_by,
            'event_detail' => $this->event_detail,
            'action_taken' => $this->action_taken,
            'summary' => $this->summary,
            'address' => $this->address,
            'long' => $this->long,
            'lat' => $this->lat,
            'status' => $this->caseStatus,
            'prepared' => $this->prepared,
            'complainant' => $this->complainant,
            'image_url' => optional($img)->getUrl(),
            'video_url' => optional($video)->getUrl(),
            'video_type' => optional($img)->mime_type,
        ];
    }
}
