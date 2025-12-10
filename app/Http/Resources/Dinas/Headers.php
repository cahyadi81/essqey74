<?php

namespace App\Http\Resources\Dinas;

use Illuminate\Http\Resources\Json\ResourceCollection;

use App\Http\Resources\Karyawan\Header as Karyawan;

class Headers extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
