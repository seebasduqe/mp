<?php

use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

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


//auth routes
Route::group(['namespace' => 'Auth'], function ()
{
    $array_ips = array(
        'Novaigrup 1' => '188.119.218.21',
        'Novaigrup 2' => '80.28.245.19',
        'Francesc' => '192.168.2.175',
        'Cristian' => '192.168.2.161'
    );

    Route::get('/login', 'LoginController@showLoginForm')->name('login');
    Route::post('/login', 'LoginController@login');
    Route::get('/password/confirm', 'ConfirmPasswordController@showConfirmForm')->name('password.confirm');
    Route::post('/password/confirm', 'ConfirmPasswordController@confirm');

    if (in_array(\Request::ip(), $array_ips))
    {
        Route::get('/register', 'RegisterController@showRegistrationForm')->name('register');
        Route::post('/register', 'RegisterController@register');
    }
    Route::post('/logout', 'LoginController@logout')->name('logout');

    Route::get('/password/confirm', 'ConfirmPasswordController@showConfirmForm')->name('password.confirm');
    Route::post('/password/confirm', 'ConfirmPasswordController@confirm');

    Route::post('/password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('/password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('/password/reset', 'ResetPasswordController@reset')->name('password.update');
    Route::get('/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');


    Route::get('/', function () { return redirect('ordenes-trabajo'); });
    //return view('auth.login');
});
//Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function ()
{
    Route::group(['namespace' => 'MainApp'], function ()
    {
        Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');

        //users
        Route::group(['middleware' => ['can:users']], function ()
        {
            Route::get('/usuarios', 'UserListController@index')->name('users.index');
            Route::get('/usuarios/crear', 'UserController@create')->name('users.create');
            Route::get('/usuarios/modificar/{user_id}', 'UserController@edit')->name('users.edit');
            Route::post('/usuarios/store', 'UserController@store')->name('users.store');
            Route::put('/usuarios/update/{user_id}', 'UserController@update')->name('users.update');
            Route::put('/usuarios/eliminar', 'UserListController@delete')->name('users.delete');
        });

        //companies
        Route::group(['middleware' => ['can:companies']], function ()
        {
            Route::get('/empresas', 'CompanyListController@index')->name('companies.index');
            Route::get('/empresas/crear', 'CompanyController@create')->name('companies.create');
            Route::get('/empresas/modificar/{company_id}', 'CompanyController@edit')->name('companies.edit');
            Route::post('/empresas/store', 'CompanyController@store')->name('companies.store');
            Route::put('/empresas/update/{company_id}', 'CompanyController@update')->name('companies.update');
            Route::put('/empresas/eliminar', 'CompanyListController@delete')->name('companies.delete');
            Route::put('/empresas/toogle-status', 'CompanyListController@toggle_status')->name('companies.toggle_status');
        });
        //subcompanies
        Route::group(['middleware' => ['can:sub_companies']], function ()
        {
            Route::get('/sub-empresas', 'SubCompanyListController@index')->name('sub_companies.index');
            Route::get('/sub-empresas/crear', 'SubCompanyController@create')->name('sub_companies.create');
            Route::get('/sub-empresas/modificar/{sub_company_id}', 'SubCompanyController@edit')->name('sub_companies.edit');
            Route::post('/sub-empresas/store', 'SubCompanyController@store')->name('sub_companies.store');
            Route::put('/sub-empresas/update/{sub_company_id}', 'SubCompanyController@update')->name('sub_companies.update');
            Route::put('/sub-empresas/eliminar', 'SubCompanyListController@delete')->name('sub_companies.delete');
            Route::put('/sub-empresas/toogle-status', 'SubCompanyListController@toggle_status')->name('sub_companies.toggle_status');
        });

        //clients
        Route::group(['middleware' => ['can:clients']], function ()
        {
            Route::get('/clientes', 'ClientListController@index')->name('clients.index');
            Route::get('/clientes/crear', 'ClientController@create')->name('clients.create');
            Route::get('/clientes/modificar/{client_id}', 'ClientController@edit')->name('clients.edit');
            Route::post('/clientes/store', 'ClientController@store')->name('clients.store');
            Route::put('/clientes/update/{client_id}', 'ClientController@update')->name('clients.update');
            Route::put('/clientes/eliminar', 'ClientListController@delete')->name('clients.delete');
        });


        //Providers
        Route::group(['middleware' => ['can:providers']], function () {
            Route::get('/proveedores', 'ProviderListController@index')->name('provider.index');
            Route::put('/proveedores/eliminar', 'ProviderListController@delete')->name('provider.delete');
            Route::get('/proveedores/crear', 'ProviderController@create')->name('provider.create');
            Route::post('/proveedores/store', 'ProviderController@store')->name('provider.store');
            Route::get('/proveedores/modificar/{provider_id}', 'ProviderController@edit')->name('provider.edit');
            Route::put('/proveedores/update/{provider_id}', 'ProviderController@update')->name('provider.update');
        });


        //Provinces
        Route::group(['middleware' => ['can:provinces']], function ()
        {
            Route::get('/provincias', 'ProvinceListController@index')->name('provinces.index');
            Route::get('/provincias/crear', 'ProvinceController@create')->name('provinces.create');
            Route::get('/provincias/modificar/{province_id}', 'ProvinceController@edit')->name('provinces.edit');
            Route::post('/provincias/guardar', 'ProvinceController@store')->name('provinces.store');
            Route::put('/provincias/update/{province_id}', 'ProvinceController@update')->name('provinces.update');
            Route::put('/provincias/eliminar', 'ProvinceListController@delete')->name('provinces.delete');
            Route::get('/provincias/comprobar-provincia-cliente/{province_id}', 'ProvinceListController@checkProvinceHasClient')->name('provinces.check_priovince_has_clients_url');
        });

        //Holiday days
        Route::group(['middleware' => ['can:holiday_days']], function ()
        {
            Route::get('/dias-festivos', 'HolidayDayListController@index')->name('holiday_days.index');
            Route::get('/dias-festivos/obtener-dias', 'HolidayDayListController@getHolidayDays')->name('holiday_days.get_holidays');
            Route::post('/dias-festivos/modificar', 'HolidayDayListController@toogleHolidayDays')->name('holiday_days.toogle_holidays');
        });

        Route::group(['middleware' => ['can:persons']], function ()
        {
            //Persons list
            Route::get('/personas', 'PersonListController@index')->name('persons.index');
            Route::put('/personas/eliminar', 'PersonListController@delete')->name('persons.delete');

            //Persons personal data
            Route::get('/personas/crear', 'PersonController@create')->name('persons.create_personal_data');
            Route::get('/personas/editar/{person_id}', 'PersonController@edit')->name('persons.edit_personal_data');
            Route::post('/personas/guardar', 'PersonController@store')->name('persons.store_perosnal_data');
            Route::put('/personas/modificar/{person_id}', 'PersonController@update')->name('persons.update_perosnal_data');

            //Persons tax social data
            Route::get('/personas/bancos-otros/{person_id}', 'PersonTaxSocialDataController@create')->name('persons.create_tax_social_data');
            Route::put('/personas/bancos-otros/guardar/{person_id}', 'PersonTaxSocialDataController@store')->name('persons.store_tax_social_data');
            Route::get('/personas/bancos-otros/editar/{person_id}', 'PersonTaxSocialDataController@edit')->name('persons.edit_tax_social_data');
            Route::put('/personas/bancos-otros/actualizar/{person_id}', 'PersonTaxSocialDataController@update')->name('persons.update_tax_social_data');

            //Persons documents
            Route::get('/personas/documentos/{person_id}', 'PersonDocumentController@create')->name('persons.create_document');
            Route::put('/personas/documentos/guardar/{person_id}', 'PersonDocumentController@store')->name('persons.store_document');
            Route::get('/personas/documentos/editar/{person_id}', 'PersonDocumentController@edit')->name('persons.edit_document');
            Route::put('/personas/documentos/actualizar/{person_id}/{document_id}', 'PersonDocumentController@update')->name('persons.update_document');
            Route::put('/personas/documentos/eliminar', 'PersonDocumentController@delete')->name('persons.delete_document');


            //Persons cost/hour
            Route::get('/personas/coste-hora/{person_id}', 'PersonCostController@create')->name('persons.create_cost_hour');
            Route::post('/personas/coste-hora/guardar', 'PersonCostController@store')->name('persons.store_cost_hour');
            Route::get('/personas/coste-hora/editar/{person_id}', 'PersonCostController@edit')->name('persons.edit_cost_hour');
            Route::put('/personas/coste-hora/actualizar/{person_id}', 'PersonCostController@update')->name('persons.update_cost_hour');
        });

        //Documents persons List
        Route::group(['middleware' => ['can:person_documents']], function ()
        {
            Route::get('/documentos/personas', 'DocumentPersonListController@index')->name('documents_person.index');
            Route::get('/documentos/personas/edit/{person_id}/{document_id}', 'DocumentPersonListController@edit')->name('document.edit');
            Route::put('/documentos/personas/update/{person_id}', 'DocumentPersonListController@update')->name('document.update');
        });

        //Hour Price Client
        Route::group(['middleware' => ['can:hour_price_client']], function ()
        {
            Route::get('/precios-hora-cliente', 'HourPriceClientListController@index')->name('hour_price_client.index');
            Route::get('/precios-hora-cliente/crear', 'HourPriceClientController@create')->name('hour_price_client.create');
            Route::post('/precios-hora-cliente/guardar', 'HourPriceClientController@store')->name('hour_price_client.store');
            Route::get('/precios-hora-cliente/editar/{hour_price_id}', 'HourPriceClientController@edit')->name('hour_price_client.edit');
            Route::put('/precios-hora-cliente/update/{hour_price_id}', 'HourPriceClientController@update')->name('hour_price_client.update');
            Route::put('/precios-hora-cliente/eliminar', 'HourPriceClientListController@delete')->name('hour_price_client.delete');
        });


        //Roles
        Route::group(['middleware' => ['can:role']], function ()
        {
            Route::get('/roles', 'RoleListController@index')->name('role.index');
            Route::get('/roles/crear', 'RoleController@create')->name('role.create');
            Route::post('/roles/guardar', 'RoleController@store')->name('role.store');
            Route::get('/roles/editar/{role_id}', 'RoleController@edit')->name('role.edit');
            Route::put('/roles/update/{role_id}', 'RoleController@update')->name('role.update');
            Route::get('/role/comprobar-rol-usuario/{role_id}', 'RoleListController@checkRoleHasUser')->name('role.check_role_has_users');
            Route::put('/role/eliminar', 'RoleListController@delete')->name('role.delete');
        });

        //ot
        Route::get('/ordenes-trabajo', 'OtListController@index')->name('ot.index');
        Route::post('/ordenes-trabajo', 'OtListController@getOtList')->name('ot.get_ot_list');
        Route::put('/ordenes-trabajo/eliminar', 'OtListController@delete')->name('ot.delete');
        Route::put('/ordenes-trabajo/cambiar-estado', 'OtListController@changeStatus')->name('ot.change_status');


        //ot common data
        Route::get('/ordenes-trabajo/crear', 'OtController@create')->name('ot.create');
        Route::post('/ordenes-trabajo/guardar', 'OtController@store')->name('ot.store_common_data');
        Route::get('/ordenes-trabajo/editar/{ot_id}', 'OtController@edit')->name('ot.edit_common_data');
        Route::put('/ordenes-trabajo/modificar/{ot_id}', 'OtController@update')->name('ot.update_common_data');

        //ot materials data
        Route::get('/ordenes-trabajo/materiales/crear/{ot_id}', 'OtMaterialsController@create')->name('ot.create_materials');
        Route::get('/ordenes-trabajo/materiales/editar/{ot_id}', 'OtMaterialsController@edit')->name('ot.edit_materials');
        Route::post('/ordenes-trabajo/materiales/guardar/{ot_id}', 'OtMaterialsController@store')->name('ot.store_materials');
        Route::put('/ordenes-trabajo/materiales/eliminar', 'OtMaterialsController@delete')->name('ot.delete_material');

        //ot artículos
        Route::get('/ordenes-trabajo/articulos/crear/{ot_id}', 'OtArticlesController@create')->name('ot.create_articles');
        Route::post('/ordenes-trabajo/articulos/guardar/{ot_id}', 'OtArticlesController@store')->name('ot.store_articles');
        Route::get('/ordenes-trabajo/articulos/editar/{ot_id}', 'OtArticlesController@edit')->name('ot.edit_articles');
        Route::put('/ordenes-trabajo/articulos/modificar/{ot_id}', 'OtArticlesController@update')->name('ot.update_article');

        //ot horas
        Route::get('/ordenes-trabajo/horas/crear/{ot_id}', 'OtHoursController@create')->name('ot.create_hours');
        Route::get('/ordenes-trabajo/horas/editar/{ot_id}', 'OtHoursController@edit')->name('ot.edit_hours');
        Route::post('/ordenes-trabajo/horas/guardar/{ot_id}', 'OtHoursController@store')->name('ot.store_hours');
        Route::get('/ordenes-trabajo/horas/get-person-hour-price', 'OtHoursController@getPersonHourPrice')->name('ot.get_person_hour_price');
        Route::put('/ordenes-trabajo/horas/eliminar', 'OtHoursController@delete')->name('ot.delete_hour');
        Route::post('/ordenes-trabajo/horas/guardar-horas-massivas/{ot_id}', 'OtHoursController@storeBulkLoadHours')->name('ot.store_bulk_load_hours');

        //ot documents
        Route::get('/ordenes-trabajo/documentos/crear/{ot_id}', 'OtDocumentController@create')->name('ot.create_documents');
        Route::get('/ordenes-trabajo/documentos/editar/{ot_id}', 'OtDocumentController@edit')->name('ot.edit_documents');
        Route::post('/ordenes-trabajo/documentos/guardar/{ot_id}', 'OtDocumentController@store')->name('ot.store_documents');
        Route::put('/ordenes-trabajo/documentos/eliminar', 'OtDocumentController@delete')->name('ot.delete_document');

    });
});
