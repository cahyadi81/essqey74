<?php

namespace App\API\Dinas;

use Illuminate\Database\Eloquent\Model;

use App\Http\Resources\Dinas\DinasCollection as DinasCollection;

class hotel extends Model
{
    //
    protected $table = 'dinas_hotel';
    protected $primaryKey = 'id';

    public function header()
    {
        return $this->belongsTo(header::class,'id');
        // $items = hotel::with('header')->get();
    }
    
}
