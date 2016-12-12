<?php

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/customers', 'CustomerController@index');
Route::get('/api/customers', 'CustomerController@getApiCustomers');

Route::get('projects', 'ProjectController@index');
Route::get('/api/projects', 'ProjectController@getApiProjects');

Route::get('projects/{project}', 'ProjectController@show');
Route::get('api/projects/{project}', 'ProjectController@getTasksData');


Route::get('/customers/{customer}', 'CustomerController@show')->name('customers.show');
Route::get('/customers/{customer}/projects', 'CustomerController@customerProjects')->name('customer.projects');

Route::get('/files', 'FileController@index')->name('files');
Route::get('/links', 'LinkController@index')->name('links');
Route::get('/activities', 'ActivityController@index')->name('activities');

Route::get('/oauth2callback', 'OauthController@login')->name('google.login');

Route::get('/dashboard', 'AdminController@index')->name('dashboard');

Route::get('/stats', 'StatController@index')->name('stats');
Route::get('/api/stats', 'StatController@getStatsData')->name('api.stats');
