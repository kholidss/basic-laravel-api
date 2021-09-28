<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Symfony\Component\HttpFoundation\Response;

class UserCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    private $pagination;

    public function __construct($resource)
    {
        $this->pagination = [
            'total_data' => $resource->total(),
            'per_page' => (int)$resource->perPage(),
            'current_page' => $resource->currentPage(),
            'total_pages' => $resource->lastPage()
        ];

        $resource = $resource->getCollection();

        parent::__construct($resource);
    }

    public function toArray($request)
    {
        return [
            'messsage' => 'Success get all users',
            'status' => Response::HTTP_OK,
            'data' => UserResource::collection($this->collection),
            'meta' => $this->pagination
        ];
    }
}
