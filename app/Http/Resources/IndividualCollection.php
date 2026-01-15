<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class IndividualCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => IndividualResource::collection($this->collection),
            'meta' => [
                'total' => number_format($this->collection->count(), 0, ',', '.'),
                'status' => 200
            ],
        ];
    }
}
