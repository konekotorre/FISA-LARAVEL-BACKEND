<?php

use App\Http\Middleware\Cors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


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

Route::group([

    'middleware' => ['cors']

], function () {

    // add OPTIONS route to fire cors middleware for preflight

    Route::post('auth/login', 'AuthController@login');

    Route::group([

        'middleware' => ['jwt.auth'],
        'prefix' => 'auth'

    ], function ($router) {

        Route::get('logout', 'AuthController@logout');
        Route::get('refresh', 'AuthController@refreshToken');

        Route::group(['middleware' => ['role:Administrador|MasterUser']], function () {

            // User

            Route::get('User', 'UserController@index');
            Route::post('User/Data', 'UserController@listForms');
            Route::get('User/{user}', 'UserController@show');
            Route::post('User/', 'UserController@store');
            Route::put('User/{user}', 'UserController@update');
            Route::delete('User/{user}', 'UserController@destroy');

            // Administracion

            Route::get('Administracion/Varios', 'AdministracionController@indexOrgVarios');
            Route::get('Administracion/Actividad', 'AdministracionController@indexOrgActividad');
            Route::get('Administracion/InfoFinan', 'AdministracionController@indexInfoFinanciera');
            Route::get('Administracion/OfiCont', 'AdministracionController@indexOfiCont');
            Route::get('Administracion/Seguimiento', 'AdministracionController@indexSeguimiento');

            // Categoria

            Route::get('Categoria/{categoria}', 'CategoriaController@show');
            Route::post('Categoria/', 'CategoriaController@store');
            Route::put('Categoria/{categoria}', 'CategoriaController@update');
            Route::delete('Categoria/{categoria}', 'CategoriaController@destroy');

            // Ciiu

            Route::get('Ciiu/Search', 'CiiuController@search');
            Route::get('Ciiu/{ciiu}', 'CiiuController@show');
            Route::post('Ciiu/', 'CiiuController@store');
            Route::put('Ciiu/{ciiu}', 'CiiuController@update');
            Route::delete('Ciiu/{ciiu}', 'CiiuController@destroy');

            // Ciudad

            Route::post('Ciudad/Dep', 'CiudadController@indexByDepartamento');
            Route::get('Ciudad/{ciudad}', 'CiudadController@show');
            Route::post('Ciudad/', 'CiudadController@store');
            Route::put('Ciudad/{ciudad}', 'CiudadController@update');
            Route::delete('Ciudad/{ciudad}', 'CiudadController@destroy');

            // Clase

            Route::get('Clase/{clase}', 'ClaseController@show');
            Route::post('Clase/', 'ClaseController@store');
            Route::put('Clase/{clase}', 'ClaseController@update');
            Route::delete('Clase/{clase}', 'ClaseController@destroy');

            // Clasificacion

            Route::get('Clasificacion/{clasificacion}', 'ClasificacionController@show');
            Route::post('Clasificacion/', 'ClasificacionController@store');
            Route::put('Clasificacion/{clasificacion}', 'ClasificacionController@update');
            Route::delete('Clasificacion/{clasificacion}', 'ClasificacionController@destroy');

            // Departamento Estado

            Route::post('DepartamentoEstado/Pais', 'DepartamentoEstadoController@indexByPais');
            Route::get('DepartamentoEstado/{departamentoEstado}', 'DepartamentoEstadoController@show');
            Route::post('DepartamentoEstado/', 'DepartamentoEstadoController@store');
            Route::put('DepartamentoEstado/{departamentoEstado}', 'DepartamentoEstadoController@update');
            Route::delete('DepartamentoEstado/{departamentoEstado}', 'DepartamentoEstadoController@destroy');

            //Estado Visita

            Route::get('EstadoVisita/{estadoVisita}', 'EstadoVisitaController@show');
            Route::post('EstadoVisita/', 'EstadoVisitaController@store');
            Route::put('EstadoVisita/{estadoVisita}', 'EstadoVisitaController@update');
            Route::delete('EstadoVisita/{estadoVisita}', 'EstadoVisitaController@destroy');

            //Estado Tarea

            Route::get('EstadoTarea/{estadoTarea}', 'EstadoTareaController@show');
            Route::post('EstadoTarea/', 'EstadoTareaController@store');
            Route::put('EstadoTarea/{estadoTarea}', 'EstadoTareaController@update');
            Route::delete('EstadoTarea/{estadoTarea}', 'EstadoTareaController@destroy');

            // Pais
            Route::get('Pais', 'PaisController@index');
            Route::get('Pais/{pais}', 'PaisController@show');
            Route::post('Pais/', 'PaisController@store');
            Route::put('Pais/{pais}', 'PaisController@update');
            Route::delete('Pais/{pais}', 'PaisController@destroy');

            // Regimen

            Route::get('Regimen/{regimen}', 'RegimenController@show');
            Route::post('Regimen/', 'RegimenController@store');
            Route::put('Regimen/{regimen}', 'RegimenController@update');
            Route::delete('Regimen/{regimen}', 'RegimenController@destroy');

            // Sector

            Route::get('Sector/{sector}', 'SectorController@show');
            Route::post('Sector/', 'SectorController@store');
            Route::put('Sector/{sector}', 'SectorController@update');
            Route::delete('Sector/{sector}', 'SectorController@destroy');

            // Sexo

            Route::get('Sexo/{sexo}', 'SexoController@show');
            Route::post('Sexo/', 'SexoController@store');
            Route::put('Sexo/{sexo}', 'SexoController@update');
            Route::delete('Sexo/{sexo}', 'SexoController@destroy');

            // Subcategoria

            Route::get('Subcategoria/{subcategoria}', 'SubcategoriaController@show');
            Route::post('Subcategoria/', 'SubcategoriaController@store');
            Route::put('Subcategoria/{subcategoria}', 'SubcategoriaController@update');
            Route::delete('Subcategoria/{subcategoria}', 'SubcategoriaController@destroy');

            // Subsector

            Route::post('Subsector/', 'SubsectorController@store');
            Route::put('Subsector/{subsector}', 'SubsectorController@update');
            Route::delete('Subsector/{subsector}', 'SubsectorController@destroy');

            // Tipo Organizacion

            Route::get('TipoOrganizacion/{tipoOrganizacion}', 'TipoOrganizacionController@show');
            Route::post('TipoOrganizacion/', 'TipoOrganizacionController@store');
            Route::put('TipoOrganizacion/{tipoOrganizacion}', 'TipoOrganizacionController@update');
            Route::delete('TipoOrganizacion/{tipoOrganizacion}', 'TipoOrganizacionController@destroy');

            // Tipo Documento Organizacion

            Route::get('TipoDocumentoOrganizacion/{tipoDocumentoOrganizacion}', 'TipoDocumentoOrganizacionController@show');
            Route::post('TipoDocumentoOrganizacion/', 'TipoDocumentoOrganizacionController@store');
            Route::put('TipoDocumentoOrganizacion/{tipoDocumentoOrganizacion}', 'TipoDocumentoOrganizacionController@update');
            Route::delete('TipoDocumentoOrganizacion/{tipoDocumentoOrganizacion}', 'TipoDocumentoOrganizacionController@destroy');

            // Tipo Documento Persona

            Route::get('TipoDocumentoPersona/{tipoDocumentoPersona}', 'TipoDocumentoPersonaController@show');
            Route::post('TipoDocumentoPersona/', 'TipoDocumentoPersonaController@store');
            Route::put('TipoDocumentoPersona/{tipoDocumentoPersona}', 'TipoDocumentoPersonaController@update');
            Route::delete('TipoDocumentoPersona/{tipoDocumentoPersona}', 'TipoDocumentoPersonaController@destroy');

            // Tipo Oficina

            Route::get('TipoOficina/{tipoOficina}', 'TipoOficinaController@show');
            Route::post('TipoOficina/', 'TipoOficinaController@store');
            Route::put('TipoOficina/{tipoOficina}', 'TipoOficinaController@update');
            Route::delete('TipoOficina/{tipoOficina}', 'TipoOficinaController@destroy');
        });

        Route::group(['middleware' => ['role:Administrador|Soporte|MasterUser']], function () {

            // Archivo

            Route::post('Archivo/Upload', 'ArchivoController@upload');
            Route::delete('Archivo/{archivo}', 'ArchivoController@destroy');

            // Contacto

            Route::post('Contacto/', 'ContactoController@store');
            Route::put('Contacto/{contacto}', 'ContactoController@update');
            Route::delete('Contacto/{contacto}', 'ContactoController@destroy');
            Route::post('Contacto/DelSub', 'ContactoController@destroySubcat');

            // Informacion Financiera

            Route::post('InformacionFinanciera/', 'InformacionFinancieraController@store');
            Route::put('InformacionFinanciera/{informacionFinanciera}', 'InformacionFinancieraController@update');
            Route::post('InformacionFinanciera/DelOpe', 'InformacionFinancieraController@destroyOperaciones');
            Route::delete('InformacionFinanciera/{informacionFinanciera}', 'InformacionFinancieraController@destroy');

            // Oficina

            Route::post('Oficina/', 'OficinaController@store');
            Route::put('Oficina/{oficina}', 'OficinaController@update');
            Route::delete('Oficina/{oficina}', 'OficinaController@destroy');

            // Organizacion

            Route::post('Organizacion/', 'OrganizacionController@store');
            Route::put('Organizacion/{organizacion}', 'OrganizacionController@update');
            Route::delete('Organizacion/{organizacion}', 'OrganizacionController@destroy');
            Route::post('Organizacion/DelAct', 'OrganizacionController@destroyActividad');

            //Importaciones

            Route::post('Importaciones/', 'ImportacionesController@store');

            //Exportaciones

            Route::post('Exportaciones/', 'ExportacionesController@store');

            //Subsector

            
        });

        Route::group(['middleware' => ['role:Administrador|Soporte|MasterUser|Comercial|Consulta']], function () {
           
            // User

            Route::post('User/Pass', 'UserController@changePass');

            // Organizacion

            Route::get('Organizacion', 'OrganizacionController@index');
            Route::post('Organizacion/Search', 'OrganizacionController@search');
            Route::post('Organizacion/SimpList', 'OrganizacionController@orgSimpleList');
            Route::post('Organizacion/EditOrg', 'OrganizacionController@editOrg');
            Route::get('Organizacion/{organizacion}', 'OrganizacionController@show');
            Route::post('Organizacion/Data', 'OrganizacionController@listForms');


            // Oficina 

            Route::post('Oficina/Org', 'OficinaController@index');
            Route::get('Oficina/{oficina}', 'OficinaController@show');
            Route::post('Oficina/Data', 'OficinaController@listForms');

            // Contacto

            Route::post('Contacto/Data', 'ContactoController@listForms');
            Route::get('Contacto', 'ContactoController@index');
            Route::post('Contacto/Org', 'ContactoController@indexByOrganizacion');
            Route::post('Contacto/Search', 'ContactoController@search');
            Route::get('Contacto/{contacto}', 'ContactoController@show');

            // Informacion Financiera

            Route::post('InformacionFinanciera/Data', 'InformacionFinancieraController@listForms');
            Route::post('InformacionFinanciera/Org', 'InformacionFinancieraController@show');

            // Visita

            Route::get('Visita', 'VisitaController@index');
            Route::get('Visita/Org', 'VisitaController@indexByOrganizacion');
            Route::post('Visita/OrgData', 'VisitaController@orgData');
            Route::get('Visita/Today', 'VisitaController@today');
            Route::post('Visita/Data', 'VisitaController@listForm');
            Route::post('Visita/Search', 'VisitaController@search');
            Route::get('Visita/{visita}', 'VisitaController@show');

            // Tarea

            Route::post('Tarea/Visita', 'TareaController@index');
            Route::get('Tarea/{tarea}', 'TareaController@show');

             // Archivo
             
            Route::post('Archivo/Org', 'ArchivoController@index');

            // Subsector

            Route::get('Subsector/{subsector}', 'SubsectorController@show');    
            Route::post('Subsector/Sector', 'SubsectorController@indexBySector');
        });

        Route::group(['middleware' => ['role:Administrador|Soporte|MasterUser|Comercial']], function () {

            //Archivo 

            Route::get('Archivo/{archivo}', 'ArchivoController@download');

            // Organizacion

            Route::post('Organizacion/RepFec', 'OrganizacionController@repFecha');
            Route::post('Organizacion/RepBus', 'OrganizacionController@repBusqueda');
            Route::post('Organizacion/RepGen', 'OrganizacionController@repGen');

            //Contacto 

            Route::post('Contacto/RepFec', 'ContactoController@repFecha');
            Route::post('Contacto/RepBus', 'ContactoController@repBusqueda');
            Route::post('Contacto/RepGen', 'ContactoController@repGen');

            //Informacion Financiera InformacionFinanciera/Org

            Route::post('InformacionFinanciera/RepGen', 'InformacionFinancieraController@repGen');
            Route::post('InformacionFinanciera/RepBus', 'InformacionFinancieraController@repBusqueda');
            Route::post('InformacionFinanciera/RepFec', 'InformacionFinancieraController@repFecha');

            // Visita

            Route::post('Visita/', 'VisitaController@store');
            Route::put('Visita/{visita}', 'VisitaController@update');
            Route::delete('Visita/{visita}', 'VisitaController@destroy');

            // Tarea

            Route::post('Tarea/', 'TareaController@store');
            Route::put('Tarea/{tarea}', 'TareaController@update');
            Route::delete('Tarea/{tarea}', 'TareaController@destroy');
        });
    });
});
