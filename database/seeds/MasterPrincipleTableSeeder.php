<?php

use Illuminate\Database\Seeder;
use App\master\principles;

class MasterPrincipleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
 
		DB::table('principles')->truncate();
 
		principles::create(array(
			'kd_principle'=>'P001',
			'nm_principle_in'=>'PT. Pinus Merah Abadi',
			'foto_principle_in'=>'-',
			'nm_principle_eng'=>'PT. Pinus Merah Abadi',
			'foto_principle_eng'=>'-',
			'create_user'=>'-',
			'update_user'=>'-',
		));
 
	}
}
