<?php

namespace App\Http\Resources\Api1\Pemukiman;

use Illuminate\Http\Resources\Json\JsonResource;

class PemukimanResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            
            'created_at' => dateTimeFormat($this->created_at),
            'updated_at' => dateTimeFormat($this->updated_at),
        ];
    }
}
