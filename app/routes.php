<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/**
 * Главная страница
 */
Route::get('/', function () {
    return View::make('Login.login');
});
Route::post('/login', 'UserController@login');
Route::get('/logout', 'UserController@logout');

/** Пользователи **/
Route::get('/user', 'UserController@index');
Route::get('/user/add', function () {
    return View::make('User.create', array());
});
Route::post('/user/add', 'UserController@create');
//Route::post('/user/update', 'UserController@update');
Route::get('/user/id/{id}', 'UserController@user');
Route::post('/user/id/{id}', 'UserController@edit');
Route::get('/user/del/{id}', 'UserController@del');

/** Текста */
Route::get('/text', 'TextController@index');
Route::get('/text/add', function () {
    return View::make('Text.create', array());
});
Route::post('/text/add', 'TextController@create');
Route::post('/text/update', 'TextController@update');
Route::get('/text/id/{id}', 'TextController@text');
Route::post('/text/id/{id}', 'TextController@edit');
Route::get('/text/del/{id}', 'TextController@del');

/** Price */
Route::get('/price', 'PriceController@index');
Route::post('/price', 'PriceController@edit');


/** Logger */
Route::get('/logger', 'LoggerController@index');
Route::get('/logger/{id}', 'LoggerController@poster');

/** Reg Acc */
Route::get('/reg', 'RegController@index');
Route::post('/reg/step_two', 'RegController@step_two');
Route::post('/reg/finish', 'RegController@finish');

/** Address */
Route::get('/address', 'AddressController@index');
Route::get('/address/add', 'AddressController@add');
Route::post('/address/add', 'AddressController@create');
Route::get('/address/id/{id}', 'AddressController@address');
Route::post('/address/id/{id}', 'AddressController@edit');
Route::get('/address/del/{id}', 'AddressController@del');


/** Accounts */
Route::get('/account', 'AccountController@index');

// Генерация аккаунта и данных для постинга
Route::get('/false_reg', 'AccountController@pseudo'); // Вводим номер и тип объекта
Route::post('/false_reg/step2', 'AccountController@genacc'); //
Route::post('/false_reg/finish', 'AccountController@finish'); //

/** Advert */
Route::get('/advert', 'AdvertController@index');
Route::get('/advert/deleted', 'AdvertController@deleted');
Route::get('/advert/del/{id}', 'AdvertController@del');
Route::get('/advert/redbal/', 'AdvertController@redbal');
Route::get('/advert/check', function(){
    $id = AdvertSettings::findOrFail(1);
    $id->value = 1;
    $id->save();

    return Redirect::to('/advert')->with('status', 'Проверка началась');
});

/** Api */
Route::group(['prefix' => 'api/v1'], function () {

    Route::get('/getnumber/', 'ApiController@getnumber'); // получаем номер для регистрации

    Route::get('/getcode/{tel}', 'ApiController@getcode'); // получаем код

    Route::post('/accinfo', 'ApiController@accinfo'); // заносим данные аккаунта

    Route::get('/get_text/{tmp_object}', 'ApiController@text');
    Route::get('/get_addres', 'ApiController@address');

    Route::get('/getparam/{tel}', 'ApiController@param');

    Route::post('/addlog', 'ApiController@addlog');

    Route::post('/advert', 'ApiController@advert');

    Route::get('/get_stat/get_ids', 'ApiController@getID');
    Route::post('/get_stat/stat', 'ApiController@stat');

    Route::get('/get_stat/start', function(){
        $id = AdvertSettings::findOrFail(1);
        $id->value = 2;
        $id->save();
    });

    Route::get('/get_stat/stop', function(){
        $id = AdvertSettings::findOrFail(1);
        $id->value = 0;
        $id->save();
    });

});