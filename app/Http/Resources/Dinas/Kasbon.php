<?php

namespace App\Http\Resources\Dinas;

use Illuminate\Http\Resources\Json\Resource;


class Kasbon extends Resource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($this);
        Resource::withoutWrapping();
        // setlocale (LC_MONETARY, 'id_ID');

        // return array();
        return [
            'hotel' => $this->convertToRupiah($this->hotel),
            'uang_makan' => $this->convertToRupiah($this->uang_makan),
            'transport' => $this->convertToRupiah($this->transport),
            'airport_tax' => $this->convertToRupiah($this->airport_tax),
            'taxi' => $this->convertToRupiah($this->taxi),
            'bbm' => $this->convertToRupiah($this->bbm),
            'laundry' => $this->convertToRupiah($this->laundry),
        ];
    }

    private function convertToRupiah($string)
    {
        if($string == null){
          $string = "0";
        }
        return $string = "".number_format($string,0,',','.');
    }

    private function checkTest(){
        if(config('database.default') == "pma_testing"){
          return true;
        }
        return false;
	  }
}
