<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PagingCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $data = parent::toArray($request);
        $paginator = $this->resource->toArray();
        $formattedData = [
            'data' => $this->collection,
            'pagination' => [
                'total' => $paginator['total'],
                'per_page' => $paginator['per_page'],
                'current_page' => $paginator['current_page'],
            ],
        ];
        return $formattedData;
    }
}
