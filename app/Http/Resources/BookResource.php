<?php

namespace App\Http\Resources;

use App\Author;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $author = Author::find($this->author_id);

        return [
            'id' => $this->id,
            'title' => $this->title,
            'author' => $author->name
        ];
    }
}
