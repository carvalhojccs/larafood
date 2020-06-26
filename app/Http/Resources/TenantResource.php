<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TenantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'name'          => $this->name,
            'image'         => $this->logo ? url("storage/{$this->logo}") : '',
            'uuid'          => $this->uuid,
            'flag'          => $this->url,
            'contact'       => $this->email,
            'date_created'  => $this->created_at->format('d/m/Y'),
        ];
    }
}
