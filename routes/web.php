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
Route::group(['prefix' => '/', 'namespace' => 'Frontend'], function () {
    Route::get('/', 'IndexController@index') -> name('index');
    Route::get('/search', 'IndexController@search') -> name('index.search');
    Route::get('/{module}/list.html', 'ModulesController@list') -> name('module.list');
    Route::get('/{module}/show/{id}.html', 'ModulesController@show') -> name('module.detail');
});

Route::group(['prefix' => 'admin', 'namespace' => 'Backend'], function() {
    Route::get('sign/in', 'SignController@in') -> name('backend.sign.in');
    Route::post('sign/in', 'SignController@doIn') -> name('backend.sign.in.post');
    Route::get('sign/out', 'SignController@doOut') -> name('backend.sign.out');
    Route::post('sign/resetpwd', 'SignController@doResetPwd') -> name('backend.sign.resetpwd');
    Route::get('/', 'BackendController@index') -> name('backend.index');

    Route::get('contents', 'ContentsController@list') -> name('backend.contents');
    Route::get('contents/add', 'ContentsController@form') -> name('backend.contents.add');
    Route::get('contents/edit', 'ContentsController@form') -> name('backend.contents.edit');
    Route::post('contents/store', 'ContentsController@store') -> name('backend.contents.store');
    Route::get('contents/delete', 'ContentsController@delete') -> name('backend.contents.delete');


    Route::get('index/sections', 'SectionsController@list') -> name('backend.sections');
    Route::post('index/sections/store', 'SectionsController@store') -> name('backend.sections.store');
    Route::get('index/sections/delete', 'SectionsController@delete') -> name('backend.sections.delete');

    Route::get('modules', 'ModulesController@list') -> name('backend.modules');
    Route::get('modules/add', 'ModulesController@form') -> name('backend.modules.add');
    Route::get('modules/edit', 'ModulesController@form') -> name('backend.modules.edit');
    Route::post('modules/store', 'ModulesController@store') -> name('backend.modules.store');
    Route::get('modules/delete', 'ModulesController@delete') -> name('backend.modules.delete');

    Route::get('navigation', 'NavigationController@list') -> name('backend.navigation');
    Route::post('navigation/store', 'NavigationController@store') -> name('backend.navigation.store');
    Route::get('navigation/delete', 'NavigationController@delete') -> name('backend.navigation.delete');

    Route::get('settings/footnav', 'SettingsController@footnav') -> name('backend.settings.footnav');
    Route::get('settings/footnav/add', 'SettingsController@footnavForm') -> name('backend.settings.footnav.add');
    Route::get('settings/footnav/edit', 'SettingsController@footnavForm') -> name('backend.settings.footnav.edit');
    Route::post('settings/footnav/store', 'SettingsController@footnavStore') -> name('backend.settings.footnav.store');
    Route::get('settings/footnav/delete', 'SettingsController@footnavDel') -> name('backend.settings.footnav.delete');
    Route::get('settings/link', 'SettingsController@link') -> name('backend.settings.link');
    Route::get('settings/link/add', 'SettingsController@linkForm') -> name('backend.settings.link.add');
    Route::get('settings/link/edit', 'SettingsController@linkFrom') -> name('backend.settings.link.edit');
    Route::post('settings/link/store', 'SettingsController@linkStore') -> name('backend.settings.link.store');
    Route::get('settings/link/delete', 'SettingsController@linkDel') -> name('backend.settings.link.delete');
    Route::get('settings/set', 'SettingsController@set') -> name('backend.settings.set');

    Route::get('system/actions', 'SystemController@actions') -> name('backend.system.actions');
    Route::get('system/actions/add', 'SystemController@actionForm') -> name('backend.system.actions.add');
    Route::get('system/actions/edit', 'SystemController@actionForm') -> name('backend.system.actions.edit');
    Route::post('system/actions/store', 'SystemController@actionStore') -> name('backend.system.actions.store');
    Route::get('system/actions/delete', 'SystemController@actionDelete') -> name('backend.system.actions.delete');

    Route::get('system/departments', 'SystemController@departments') -> name('backend.system.departments');
    Route::get('system/departments/add', 'SystemController@departmentForm') -> name('backend.system.departments.add');
    Route::get('system/departments/edit', 'SystemController@departmentForm') -> name('backend.system.departments.edit');
    Route::post('system/departments/store', 'SystemController@departmentStore') -> name('backend.system.departments.store');
    Route::get('system/departments/delete', 'SystemController@departmentDelete') -> name('backend.system.departments.delete');
    Route::get('system/department', 'SystemController@getDepartment') -> name('backend.system.department');

    Route::get('system/users', 'SystemController@users') -> name('backend.system.users');
    Route::get('system/users/add', 'SystemController@userForm') -> name('backend.system.users.add');
    Route::get('system/users/edit', 'SystemController@userForm') -> name('backend.system.users.edit');
    Route::post('system/users/store', 'SystemController@userStore') -> name('backend.system.users.store');
    Route::get('system/users/delete', 'SystemController@userDelete') -> name('backend.system.users.delete');

    Route::get('system/roles', 'SystemController@roles') -> name('backend.system.roles');
    Route::get('system/roles/add', 'SystemController@roleForm') -> name('backend.system.roles.add');
    Route::get('system/roles/edit', 'SystemController@roleForm') -> name('backend.system.roles.edit');
    Route::post('system/roles/store', 'SystemController@roleStore') -> name('backend.system.roles.store');
    Route::get('system/roles/delete', 'SystemController@roleDelete') -> name('backend.system.roles.delete');

    Route::any('upload/ue', 'UploadController@ueUpload') -> name('backend.upload.ue');
    Route::post('upload/thumbnail', 'UploadController@thumbnail') -> name('backend.upload.thumbnail');
});
