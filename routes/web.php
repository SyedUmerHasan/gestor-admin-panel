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

Route::get('/', function () {
    return redirect()->route("home");
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/user/{id}', 'HomeController@user')->name('user');
Route::get('/user/edit/{id}', 'HomeController@useredit')->name('user.edit');
Route::get('/contacts/{id}', 'HomeController@contacts')->name('contacts');
Route::get('/income/{id}', 'HomeController@income')->name('income');
Route::get('/expense/{id}', 'HomeController@expense')->name('expense');

Route::get('/user/{userid}/expense/view/{expenseid}', 'HomeController@expenseview')->name('expense.view');
Route::get('/user/{userid}/expense/edit/{expenseid}', 'HomeController@expenseedit')->name('expense.edit');

Route::get('/user/{userid}/contact/view/{contactid}', 'HomeController@contactview')->name('contact.view');
Route::get('/user/{userid}/contact/edit/{contactid}', 'HomeController@contactedit')->name('contact.edit');

Route::get('/user/{userid}/income/view/{incomeid}', 'HomeController@incomeview')->name('income.view');
Route::get('/user/{userid}/income/edit/{incomeid}', 'HomeController@incomeedit')->name('income.edit');

// APIS
Route::group(['prefix' => 'api'], function() {
    Route::get('/users', 'FirebaseController@getAllUsersData')->name('users.getall');
    Route::get('/user/{id}', 'FirebaseController@getUsersDataById')->name('users.getbyId');
    
    Route::post('/user/update/{id}', 'FirebaseController@updateuser')->name('user.update');
    
    Route::get('/contacts/{id}', 'FirebaseController@getUsersContactById')->name('contacts.getbyId');
    Route::post('/contacts/{id}', 'FirebaseController@getUsersContactById')->name('contacts.getbyId');
    Route::get('/income/{id}', 'FirebaseController@getUsersIncomeById')->name('income.getbyId');
    Route::post('/income/{id}', 'FirebaseController@getUsersIncomeById')->name('income.getbyId');
    Route::get('/expense/{id}', 'FirebaseController@getUsersExpenseById')->name('expense.getbyId');
    Route::post('/expense/{id}', 'FirebaseController@getUsersExpenseById')->name('expense.getbyId');

    Route::get('/user/{userid}/expense/{expenseid}', 'FirebaseController@getExpenseByUserIDandExpenseID')->name('user.expense');
    Route::get('/user/{userid}/expense/{expenseid}/update', 'FirebaseController@updateExpense')->name('expense.update');

    Route::get('/user/{userid}/income/{incomeid}', 'FirebaseController@getIncomeByUserIDandExpenseID')->name('user.income');
    Route::get('/user/{userid}/income/{incomeid}/update', 'FirebaseController@updateIncome')->name('income.update');

    Route::get('/user/{userid}/contact/{contactid}', 'FirebaseController@getcontactByUserIDandExpenseID')->name('user.contact');
    Route::get('/user/{userid}/contact/{contactid}/update', 'FirebaseController@updateExpense')->name('contact.update');
});
