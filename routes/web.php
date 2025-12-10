<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */
// Auth::routes();

Route::get('home', function(){
  return "<div style='width:50%;margin:auto;'>
            <h1 style='font-size:50px;'>ESS HOME</h1>
            <p style='font-size:30px;'>Download aplikasi Android ESS QEY di google playstore,</p>
            <p><a href='https://play.google.com/store/apps/details?id=id.addroo.ess'> 
            <img src='https://www.gstatic.com/android/market_images/web/play_prism_hlock_2x.png' />
            </a></p>
          </div>";
});




    Auth::routes();
    Route::get('dashboard', 'HomeController@index')->name('dashboard');
    DB::disconnect(config('database.default'));
    //Config::set('database.default', '');
    //config(['database.connections.demo' => $jalusi ]);
    config(['database.default' => 'mysql' ]);
    Route::group(array('prefix' => 'admin'), function () {

      Route::group(array('prefix' => 'user'), function () {
        Route::get('monitoring', 'User\UserController@monitoring');
        // Route::get('logout', 'User\UserController@forcelogout');
      });

      Route::group(array('prefix' => 'pesan_ho'), function () {
        Route::get('send', 'PesanHO\PesanHOController@form_send');
      });
    
    });
  
  
  

