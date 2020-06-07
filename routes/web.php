<?php

Route::prefix('admin')->namespace('Admin')->middleware('auth')->group(function(){
     /**
     * Role x User
     */
    Route::get('users/{id}/role/{idRole}/detach', 'ACL\RoleUserController@detachRoleUser')->name('users.role.detach');
    Route::post('users/{id}/roles', 'ACL\RoleUserController@attachRolesUser')->name('users.roles.attach');
    Route::any('users/{id}/roles/create', 'ACL\RoleUserController@rolesAvailable')->name('users.roles.available');
    Route::get('users/{id}/roles', 'ACL\RoleUserController@roles')->name('users.roles');
    Route::get('roles/{id}/users', 'ACL\RoleUserController@users')->name('roles.users');
    /**
     * Permission x Role
     */
    Route::get('roles/{id}/permission/{idPermission}/detach', 'ACL\PermissionRoleController@detachPermissionRole')->name('roles.permission.detach');
    Route::post('roles/{id}/permissions', 'ACL\PermissionRoleController@attachPermissionsRole')->name('roles.permissions.attach');
    Route::any('roles/{id}/permissions/create', 'ACL\PermissionRoleController@permissionsAvailable')->name('roles.permissions.available');
    Route::get('roles/{id}/permissions', 'ACL\PermissionRoleController@permissions')->name('roles.permissions');
    Route::get('permissions/{id}/role', 'ACL\PermissionRoleController@roles')->name('permissions.roles');
    
    /*
     * Routes Roles
     */
    Route::any('roles.search','ACL\RoleController@search')->name('roles.search');
    Route::resource('roles','ACL\RoleController');
    
    /*
     * Routes Tenants
     */
    Route::any('tenants.search','TenantController@search')->name('tenants.search');
    Route::resource('tenants','TenantController');
    
    /*
     * Routes Tables
     */
    Route::any('tables.search','TableController@search')->name('tables.search');
    Route::resource('tables','TableController');
    
    /*
     * Routes Product
     */
    Route::any('products.search','ProductController@search')->name('products.search');
    Route::resource('products','ProductController');
    
    /*
     * Routes Category
     */
    Route::any('categories.search','CategoryController@search')->name('categories.search');
    Route::resource('categories','CategoryController');
    
    /*
     * Routes User
     */
    Route::any('users.search','UserController@search')->name('users.search');
    Route::resource('users','UserController');
    
    /**
     * Product x Category
     */
    Route::get('products/{id}/category/{idCategory}/detach', 'CategoryProductController@detachCategoryProduct')->name('products.category.detach');
    Route::post('products/{id}/categories', 'CategoryProductController@attachCategoriesProduct')->name('products.categories.attach');
    Route::any('products/{id}/categories/create', 'CategoryProductController@categoriesAvailable')->name('products.categories.available');
    Route::get('products/{id}/categories', 'CategoryProductController@categories')->name('products.categories');
    Route::get('categories/{id}/products', 'CategoryProductController@products')->name('categories.products');
    
    /*
     * Routes Plans x Profiles
     */
    Route::get('plans/{id}/profile/{permissionId}/detach','ACL\PlanProfileController@detachPlanProfile')->name('plans.profile.detach');
    Route::post('plans/{id}/profiles','ACL\PlanProfileController@attachPlansProfile')->name('plans.profiles.attach');
    Route::any('plans/{id}/profiles/create','ACL\PlanProfileController@profilesAvailable')->name('plans.profiles.available');
    Route::get('plans/{id}/profiles','ACL\PlanProfileController@profiles')->name('plans.profiles');
    Route::get('profiles/{id}/plans','ACL\PlanProfileController@plans')->name('profiles.plans');
    
    /*
     * Routes Permissions x Profile
     */
   Route::get('profile/{id}/permission/{permissionId}/detach','ACL\PermissionProfileController@detachPermissionProfile')->name('profile.permissions.detach');
   Route::post('profile/{id}/permissions','ACL\PermissionProfileController@attachPermissionsProfile')->name('profile.permissions.attach');
   Route::any('profile/{id}/permissions/create','ACL\PermissionProfileController@permissionsAvailable')->name('profile.permissions.available');
   Route::get('profile/{id}/permissions','ACL\PermissionProfileController@index')->name('profile.permissions');
   Route::get('permission/{id}/profiles','ACL\PermissionProfileController@profiles')->name('permission.profiles');
    
    /*
     * Routes Permissions
     */
    Route::any('permissions.search','ACL\PermissionController@search')->name('permissions.search');
    Route::resource('permissions','ACL\PermissionController');

    /*
     * Routes Profile
     */
    Route::any('profiles.search','ACL\ProfileController@search')->name('profiles.search');
    Route::resource('profiles','ACL\ProfileController');

    /*
     * Routes DetailPlan
     */
    Route::delete('plans/details/{detail_id}/{url}','DetailPlanController@destroy')->name('details.plan.destroy');
    Route::get('plans/details/create/{url}','DetailPlanController@create')->name('details.plan.create');
    Route::get('plans/details/{detail_id}/{url}','DetailPlanController@show')->name('details.plan.show');
    Route::put('plans/details/{detail_id}/{url}','DetailPlanController@update')->name('details.plan.update');
    Route::get('plans/details/edit/{detail_id}/{url}','DetailPlanController@edit')->name('details.plan.edit');
    Route::post('plans/details/{url}','DetailPlanController@store')->name('details.plan.store');
    Route::get('plans/details/{url}','DetailPlanController@index')->name('details.plan.index');

    /**
     * Routes Plans
     */
    Route::get('plans/create','PlanController@create')->name('plans.create');
    Route::put('plans/{url}','PlanController@update')->name('plans.update');
    Route::get('plans/edit/{url}','PlanController@edit')->name('plans.edit');
    Route::any('plans/search','PlanController@search')->name('plans.search');
    Route::delete('plans/{url}','PlanController@destroy')->name('plans.destroy');
    Route::get('plans/{url}','PlanController@show')->name('plans.show');
    Route::post('plans','PlanController@store')->name('plans.store');
    Route::get('plans','PlanController@index')->name('plans.index');

    /*
     * Route Dashboard
     */
    Route::get('/','PlanController@index')->name('admin.index');
});

/*
 * Route site
 */
Route::get('/plan/{url}','Site\SiteController@plan')->name('plan.subscription');
Route::get('/','Site\SiteController@index')->name('site.home');

/*
 * Auth Routes
 */
Auth::routes();
