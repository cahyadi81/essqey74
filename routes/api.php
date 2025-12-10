<?php

use Illuminate\Http\Request;
use App\Http\Middleware\ignoreNull;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::get('/db/{database?}', function ($database) {
// $database = 'ss'; 

Route::post('login/server/connect', 'API\\LoginController@connectToServer');
Route::get('login/server/list', 'API\\LoginController@listServer');

Route::post('save_data_demo', 'API\\LoginController@request_demo');

//mode release
Route::group(array('prefix' => '{database?}'), function () {
	
	Route::group(array('prefix' => '{customer?}'), function () {
		Route::post('login', 'API\\LoginController@login');
		Route::get('login', 'API\\LoginController@login');
		Route::post('auth/reset', 'API\\LoginController@reset');
		Route::get('auth/reset', 'API\\LoginController@reset');
		
		//connect on login in for check maintance
		Route::post('login/server/connect', 'API\\LoginController@connectToServer');

		Route::get('login/data/user', 'API\\LoginController@data_login');
		Route::post('login/data/user/logout', 'API\\LoginController@logout_force_user');
		Route::get('login/data/user/logout', 'API\\LoginController@logout_force_user');

		Route::post('login/server/list', 'API\\LoginController@connectToServer');

		Route::post('notif/send', 'API\\NotifController@sendNotif');
		

		Route::group(array('prefix' => 'pesan_ho'), function () {
			Route::post('send', 'API\\PesanHOController@store');
		});

		Route::group(array('prefix' => 'karyawan'), function () {
			Route::get('goverment', 'API\\KaryawanController@goverment');
			Route::post('delete_force', 'API\\KaryawanController@delete_force');
		});

		Route::middleware(['token_auth'])->group(function () {

			Route::get('notif', 'API\\NotifController@index');

			Route::get('logout', 'API\\LoginController@logout');
			Route::post('logout', 'API\\LoginController@logout');
			Route::post('auth/update', 'API\\LoginController@update');


			Route::group(array('prefix' => 'dinas'), function () {
				Route::get('', 'API\\DinasController@index');
				Route::post('', 'API\\DinasController@store');

				Route::post('show', 'API\\DinasController@show');

				Route::group(array('prefix' => 'approval'), function () {
					Route::get('', 'API\\DinasController@index');
					Route::post('', 'API\\DinasController@update');
					Route::post('show', 'API\\DinasController@approvalShow');
				});
			});

			//slip
			Route::group(array('prefix' => 'slip'), function () {
				Route::get('', 'API\\SlipController@index');
				Route::get('link', 'API\\SlipController@slip_link');
				Route::get('list_periode', 'API\\SlipController@periode_list');
			});

			//cuti izin
			Route::group(array('prefix' => 'izin_cuti'), function () {
				Route::get('', 'API\\CutiController@jumlahIzinCuti');
				Route::get('list', 'API\\CutiController@listIzinCuti');
				Route::get('sisa_cuti', 'API\\CutiController@sisaIzinCuti');
				Route::get('summary', 'API\\CutiController@sisaIzinCuti');
				Route::group(array('prefix' => 'terpakai'), function () {
					Route::get('list_izin', 'API\\CutiController@listIzin');
					Route::get('list_cuti', 'API\\CutiController@listCuti');
					Route::get('detail', 'API\\CutiController@detailIzinCuti');
				});
				Route::get('sisa', 'API\\CutiController@sisaCuti');
				Route::get('detail', 'API\\CutiController@detailIzinCuti');
				//save
				Route::post('request', 'API\\CutiController@requestIzinCuti');
				//approval
				Route::group(array('prefix' => '/approval'), function () {
					Route::get('', 'API\\CutiController@index');
					Route::get('list', 'API\\CutiController@listIzinCutiApproval');
					Route::get('detail', 'API\\CutiController@detailIzinCuti');
					//approval
					Route::post('approved', 'API\\CutiController@approvedIzinCuti');
				});
			});

			//absensi
			Route::group(array('prefix' => 'absensi'), function () {
				Route::get('', 'API\\AbsensiController@index');
				Route::get('detail', 'API\\AbsensiController@detail_absensi');
				Route::post('update', 'API\\AbsensiController@update');
				Route::get('rekap', 'API\\AbsensiController@rekap_absensi');
				Route::get('list_periode', 'API\\AbsensiController@periode_list');
			});

			//karyawan
			Route::group(array('prefix' => 'karyawan'), function () {
				Route::get('', 'API\\KaryawanController@index');
				Route::get('hr', 'API\\KaryawanController@hr');
				Route::get('pendidikan', 'API\\KaryawanController@pendidikan');
				Route::get('skill', 'API\\KaryawanController@skill');
				Route::get('keluarga', 'API\\KaryawanController@keluarga');
				Route::get('organisasi', 'API\\KaryawanController@organisasi');
				Route::get('pengalaman_kerja', 'API\\KaryawanController@pengalaman_kerja');
				// Route::get('goverment', 'API\\KaryawanController@goverment');

				Route::get('employee_journey', 'API\\KaryawanController@employee_journey');

				Route::post('upload_image', 'API\\KaryawanController@upload_image');

				Route::post('update', 'API\\KaryawanController@update')->middleware(ignoreNull::class);

				

				Route::group(array('prefix' => 'status'), function () {
					Route::get('', 'API\\KaryawanController@status');
					Route::get('detail', 'API\\KaryawanController@detail_status');
				});
			});

			//pesan ho
			Route::group(array('prefix' => 'pesan_ho'), function () {
				Route::get('', 'API\\PesanHOController@index');
				Route::get('list', 'API\\PesanHOController@list');
				Route::get('detail', 'API\\PesanHOController@detail');
			});

			//pesan ho
			Route::group(array('prefix' => 'perjalanan_dinas'), function () {
				Route::get('', 'API\\PerjalananDinasController@index');
				Route::get('list', 'API\\PerjalananDinasController@list');
				Route::get('detail', 'API\\PerjalananDinasController@detail');
				//save
				Route::post('request', 'API\\PerjalananDinasController@request');
				//approval
				Route::group(array('prefix' => '/approval'), function () {
					Route::get('', 'API\\PerjalananDinasController@index');
					Route::get('list', 'API\\PerjalananDinasController@list_appr');
					Route::get('detail', 'API\\PerjalananDinasController@detail');
					//approval
					Route::post('approved', 'API\\PerjalananDinasController@approved');
				});
			});
		});
	});
});

//mode demo
Route::group(array('prefix' => '{database?}'), function () {
	
	Route::group(array('prefix' => ''), function () {
		Route::post('login', 'API\\LoginController@login');
		Route::post('auth/reset', 'API\\LoginController@reset');
		Route::get('auth/reset', 'API\\LoginController@reset');
		
		//connect on login in for check maintance
		Route::post('login/server/connect', 'API\\LoginController@connectToServer');

		Route::get('login/data/user', 'API\\LoginController@data_login');
		Route::post('login/data/user/logout', 'API\\LoginController@logout_force_user');
		Route::get('login/data/user/logout', 'API\\LoginController@logout_force_user');

		Route::post('login/server/list', 'API\\LoginController@connectToServer');

		Route::post('notif/send', 'API\\NotifController@sendNotif');
		

		Route::group(array('prefix' => 'pesan_ho'), function () {
			Route::post('send', 'API\\PesanHOController@store');
		});

		Route::group(array('prefix' => 'karyawan'), function () {
			Route::get('goverment', 'API\\KaryawanController@goverment');
			Route::post('delete_force', 'API\\KaryawanController@delete_force');
		});

		Route::middleware(['token_auth'])->group(function () {

			Route::get('notif', 'API\\NotifController@index');

			Route::get('logout', 'API\\LoginController@logout');
			Route::post('auth/update', 'API\\LoginController@update');


			Route::group(array('prefix' => 'dinas'), function () {
				Route::get('', 'API\\DinasController@index');
				Route::post('', 'API\\DinasController@store');

				Route::post('show', 'API\\DinasController@show');

				Route::group(array('prefix' => 'approval'), function () {
					Route::get('', 'API\\DinasController@index');
					Route::post('', 'API\\DinasController@update');
					Route::post('show', 'API\\DinasController@approvalShow');
				});
			});

			//slip
			Route::group(array('prefix' => 'slip'), function () {
				Route::get('', 'API\\SlipController@index');
				Route::get('link', 'API\\SlipController@slip_link');
				Route::get('list_periode', 'API\\SlipController@periode_list');
			});

			//cuti izin
			Route::group(array('prefix' => 'izin_cuti'), function () {
				Route::get('', 'API\\CutiController@jumlahIzinCuti');
				Route::get('list', 'API\\CutiController@listIzinCuti');
				Route::get('sisa_cuti', 'API\\CutiController@sisaIzinCuti');
				Route::get('summary', 'API\\CutiController@sisaIzinCuti');
				Route::group(array('prefix' => 'terpakai'), function () {
					Route::get('list_izin', 'API\\CutiController@listIzin');
					Route::get('list_cuti', 'API\\CutiController@listCuti');
					Route::get('detail', 'API\\CutiController@detailIzinCuti');
				});
				Route::get('sisa', 'API\\CutiController@sisaCuti');
				Route::get('detail', 'API\\CutiController@detailIzinCuti');
				//save
				Route::post('request', 'API\\CutiController@requestIzinCuti');
				//approval
				Route::group(array('prefix' => '/approval'), function () {
					Route::get('', 'API\\CutiController@index');
					Route::get('list', 'API\\CutiController@listIzinCutiApproval');
					Route::get('detail', 'API\\CutiController@detailIzinCuti');
					//approval
					Route::post('approved', 'API\\CutiController@approvedIzinCuti');
				});
			});

			//absensi
			Route::group(array('prefix' => 'absensi'), function () {
				Route::get('', 'API\\AbsensiController@index');
				Route::get('detail', 'API\\AbsensiController@detail_absensi');
				Route::post('update', 'API\\AbsensiController@update');
				Route::get('rekap', 'API\\AbsensiController@rekap_absensi');
				Route::get('list_periode', 'API\\AbsensiController@periode_list');
			});

			//karyawan
			Route::group(array('prefix' => 'karyawan'), function () {
				Route::get('', 'API\\KaryawanController@index');
				Route::get('hr', 'API\\KaryawanController@hr');
				Route::get('pendidikan', 'API\\KaryawanController@pendidikan');
				Route::get('skill', 'API\\KaryawanController@skill');
				Route::get('keluarga', 'API\\KaryawanController@keluarga');
				Route::get('organisasi', 'API\\KaryawanController@organisasi');
				Route::get('pengalaman_kerja', 'API\\KaryawanController@pengalaman_kerja');
				// Route::get('goverment', 'API\\KaryawanController@goverment');

				Route::get('employee_journey', 'API\\KaryawanController@employee_journey');

				Route::post('upload_image', 'API\\KaryawanController@upload_image');

				Route::post('update', 'API\\KaryawanController@update')->middleware(ignoreNull::class);

				

				Route::group(array('prefix' => 'status'), function () {
					Route::get('', 'API\\KaryawanController@status');
					Route::get('detail', 'API\\KaryawanController@detail_status');
				});
			});

			//pesan ho
			Route::group(array('prefix' => 'pesan_ho'), function () {
				Route::get('', 'API\\PesanHOController@index');
				Route::get('list', 'API\\PesanHOController@list');
				Route::get('detail', 'API\\PesanHOController@detail');
			});

			//pesan ho
			Route::group(array('prefix' => 'perjalanan_dinas'), function () {
				Route::get('', 'API\\PerjalananDinasController@index');
				Route::get('list', 'API\\PerjalananDinasController@list');
				Route::get('detail', 'API\\PerjalananDinasController@detail');
				//save
				Route::post('request', 'API\\PerjalananDinasController@request');
				//approval
				Route::group(array('prefix' => '/approval'), function () {
					Route::get('', 'API\\PerjalananDinasController@index');
					Route::get('list', 'API\\PerjalananDinasController@list_appr');
					Route::get('detail', 'API\\PerjalananDinasController@detail');
					//approval
					Route::post('approved', 'API\\PerjalananDinasController@approved');
				});
			});
		});
	});
});