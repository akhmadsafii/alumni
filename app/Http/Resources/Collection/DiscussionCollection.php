<?php

namespace App\Http\Resources\Collection;

use App\Http\Resources\DiscussionResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class DiscussionCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'meta' => [
                'current_page' => $this->currentPage(),
                'last_page' => $this->lastPage(),
                'per_page' => $this->perPage(),
                'total' => $this->total(),
                'pages' => ceil($this->total() / $this->perPage())
            ],
            'data' => DiscussionResource::collection($this->items())->resolve()
        ];
    }
}
