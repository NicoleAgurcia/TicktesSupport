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

/*Route::get('/', function () {
    return view('welcome');
});
*/
Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/', 'TicketsController@AllTickets');

Route::get('new_ticket', 'TicketsController@create');
Route::post('new_ticket', 'TicketsController@store');

Route::get('tickets/{ticket_id}', 'TicketsController@show');

Route::get('my_tickets', 'TicketsController@userTickets');

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function() {
	Route::get('create', 'AdminController@create_user');
	Route::post('create', 'AdminController@store');
  
  Route::get('category', 'AdminController@create_category');
  Route::post('category', 'AdminController@store_category');

  Route::get('tickets', 'TicketsController@index');
  Route::post('close_ticket/{ticket_id}', 'TicketsController@close');
	
	Route::post('update/{ticket_id}', 'TicketsController@update');
});

Route::get('agent/tickets', 'AgentController@tickets');
Route::post('agent/close_ticket/{ticket_id}', 'AgentController@close');
	
Route::post('comment', 'CommentsController@postComment');


Route::get('storage/{archivo}', function ($archivo) {
   $public_path = public_path();
   $url = $public_path.'/storage/'.$archivo;
   if (Storage::exists($archivo)){
     return response()->download($url);
   }
  return redirect()->back()->with("success", "can't find the archive");
});