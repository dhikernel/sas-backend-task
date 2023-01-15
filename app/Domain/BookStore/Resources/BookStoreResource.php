<?php

namespace App\Domain\BookStore\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookStoreResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'ID Book' => $this->book_id,
            'Name Book' => $this->name,
            'ISBN' => $this->isbn,
            'Price' => $this->value,
        ];
    }
}
