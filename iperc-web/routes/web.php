<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');

/**
 * Admin Area
 */

  // Sedes
    Route::get('/sedes', 'HeadquarterController@index')->name('headquarter.index');
    Route::post('/sedes/save', 'HeadquarterController@save')->name('headquarter.save');
    Route::post('/sedes/get', 'HeadquarterController@get')->name('headquarter.get');
    Route::post('/sedes/delete', 'HeadquarterController@delete')->name('headquarter.delete');

  // Usuarios
    Route::get('/usuarios/administradores', 'UserController@indexAdmin')->name('usersadmin.index');
    Route::post('/usuarios/administradores/save', 'UserController@saveAdmin')->name('usersadmin.save');
    Route::post('/usuarios/administradores/get', 'UserController@getAdmin')->name('usersadmin.get');
    Route::post('/usuarios/administradores/delete', 'UserController@deleteAdmin')->name('usersadmin.delete');

    Route::get('/usuarios/trabajadores', 'UserController@indexWorker')->name('usersworker.index');
    Route::get('/usuarios/trabajadores/dt', 'UserController@dt_workera')->name('usersworker.dt');
    Route::post('/usuarios/trabajadores/save', 'UserController@saveWorker')->name('usersworker.save');
    Route::post('/usuarios/trabajadores/get', 'UserController@getWorker')->name('usersworker.get');
    Route::post('/usuarios/trabajadores/delete', 'UserController@deleteWorker')->name('usersworker.delete');
    Route::post('/usuarios/trabajadores/import', 'UserController@importWorker')->name('worker.import');

/**
  * Generales
  */

  // Peligros
    Route::get('/peligros','DangerController@index')->name('danger.index');
    Route::post('/peligros/save', 'DangerController@save')->name('danger.save');
    Route::post('/peligros/get', 'DangerController@get')->name('danger.get');
    Route::post('/peligros/delete', 'DangerController@detete')->name('danger.delete');

    Route::get('/peligros/descripcion','DangerController@indexDescription')->name('description.index');
    Route::get('/peligros/descripcion/dt','DangerController@dtDescription')->name('description.dt');
    Route::post('/peligros/descripcion/save', 'DangerController@saveDescription')->name('description.save');
    Route::post('/peligros/descripcion/get', 'DangerController@getDescription')->name('description.get');
    Route::post('/peligros/descripcion/delete', 'DangerController@deteteDescription')->name('description.delete');
    
    Route::get('/peligros/consecuencia','DangerController@indexConsequence')->name('consequence.index');
    Route::get('/peligros/consecuencia/dt','DangerController@dtConsequence')->name('consequence.dt');
    Route::post('/peligros/consecuencia/save', 'DangerController@saveConsequence')->name('consequence.save');
    Route::post('/peligros/consecuencia/get', 'DangerController@getConsequence')->name('consequence.get');
    Route::post('/peligros/consecuencia/delete', 'DangerController@deteteConsequence')->name('consequence.delete');

  // Areas
    Route::get('/area', 'AreaController@index')->name('area.index');
    Route::get('/area/dt', 'AreaController@dt')->name('area.dt');
    Route::post('/area/save', 'AreaController@save')->name('area.save');
    Route::post('/area/get', 'AreaController@get')->name('area.get');
    Route::post('/area/delete', 'AreaController@detete')->name('area.delete');
    
  // Zonas
    Route::get('/zona', 'ZoneController@index')->name('zona.index');
    Route::get('/zona/dt', 'ZoneController@dt')->name('zona.dt');
    Route::post('/zona/save', 'ZoneController@save')->name('zona.save');
    Route::post('/zona/get', 'ZoneController@get')->name('zona.get');
    Route::post('/zona/delete', 'ZoneController@delete')->name('zona.delete');

    Route::get('/sub-procesos', 'SubProcessController@index')->name('subproceso.index');
    Route::get('/sub-procesos/dt', 'SubProcessController@dt')->name('subproceso.dt');
    Route::post('/sub-procesos/save', 'SubProcessController@save')->name('subproceso.save');
    Route::post('/sub-procesos/get', 'SubProcessController@get')->name('subproceso.get');
    Route::post('/sub-procesos/delete', 'SubProcessController@delete')->name('subproceso.delete');
    
    Route::get('/puestos-trabajo', 'JobPositionController@index')->name('puestotrabajo.index');
    Route::get('/puestos-trabajo/dt', 'JobPositionController@dt')->name('puestotrabajo.dt');
    Route::post('/puestos-trabajo/save', 'JobPositionController@save')->name('puestotrabajo.save');
    Route::post('/puestos-trabajo/get', 'JobPositionController@get')->name('puestotrabajo.get');
    Route::post('/puestos-trabajo/delete', 'JobPositionController@delete')->name('puestotrabajo.delete');
    
    Route::get('/actividades', 'ActivityController@index')->name('actividad.index');
    Route::get('/actividades/dt', 'ActivityController@dt')->name('actividad.dt');
    Route::post('/actividades/save', 'ActivityController@save')->name('actividad.save');
    Route::post('/actividades/get', 'ActivityController@get')->name('actividad.get');
    Route::post('/actividades/delete', 'ActivityController@delete')->name('actividad.delete');
    
    Route::get('/tareas', 'TaskController@index')->name('tarea.index');
    Route::get('/tareas/dt', 'TaskController@dt')->name('tarea.dt');
    Route::post('/tareas/save', 'TaskController@save')->name('tarea.save');
    Route::post('/tareas/get', 'TaskController@get')->name('tarea.get');
    Route::post('/tareas/delete', 'TaskController@delete')->name('tarea.delete');

    Route::post("/danger/get-descriptions", 'DangerController@getDangerDescriptions')->name('name.getdescription');
    Route::post("/danger/get-event-description", 'DangerController@getEventDangerDescription')->name('name.getevent');
    Route::post("/danger/get-consequences", 'DangerController@getConsecuenceDangerDescription')->name('name.getconsquences');

    /**
     *  CONFIGURATION
     */
    Route::post('/configuration/cambiar-sede', 'ConfigurationController@changeHeadquarter')->name('configuration.chageheadquarter');

/**
  *   IPERC
*/
  Route::get('/iperc', 'IPERCController@index')->name('iperc.index');
  Route::get('/iperc/dt', 'IPERCController@dt_iperc')->name('iperc.dt');
  Route::get('/iperc/crear', 'IPERCController@create')->name('iperc.create');
  Route::post('/iperc/store', 'IPERCController@store')->name('iperc.store');
  Route::post('/iperc/delete', 'IPERCController@delete')->name('iperc.delete');
  Route::post('/iperc/import', 'IPERCController@import')->name('iperc.import');

  Route::post('/iperc/get-job/{file}', 'IPERCController@getJobPosition');
  Route::post('/iperc/get-area/{job}', 'IPERCController@getArea');
  Route::post('/iperc/get-zone/{area}', 'IPERCController@getZonas');
  
  Route::post('/iperc/update/{id}', 'IPERCController@update')->name('iperc.update');
  Route::get('/iperc/editar/{id}', 'IPERCController@edit')->name('iperc.edit');
  Route::post('/iperc/get-files', 'IPERCController@getFiles');

  Route::get('/iperc/files', 'IPERCController@files')->name('iperc.files');
  Route::post('/iperc/files/delete', 'IPERCController@deleteFiles')->name('iperc.deletefiles');
  Route::get('/iperc/files/dt', 'IPERCController@dt_files')->name('iperc.dt_files');

  Route::get('/iperc/files/get', 'IPERCController@getFiles');

  Route::get('/iperc/export','IPERCController@export');

  Route::get('/iperc/files-logs', 'IPERCController@fileLogIndex')->name('iperc.logs');
  Route::get('/iperc/files-logs/dt', 'IPERCController@dtFileLog');
  /**
 * General
 */

  //  Zonas
    Route::get('/zonas','ZoneController@index')->name('zone.index');
    Route::get('/zonas/dt','ZoneController@dt_zones')->name('zone.dt');

  
  // Reports
    Route::get('/reportes', 'ReportController@index')->name('report.index');
    Route::post('/reportes/get/home', 'ReportController@getIndexChart')->name('report.indexhome');
    Route::post('/reportes/get/index', 'ReportController@getReportsChart')->name('report.get');

/**
 *  Workers Area
 */

 Route::get('/app', 'AppController@index');

 Route::prefix('workers')->group(function ()
 {
    Route::get('inicio','WorkerController@login')->name('wlogin');
    Route::post('authenticate', 'WorkerController@authenticate')->name('authenticate');
    Route::get('home/{worker}/{headquarter}','WorkerController@welcome')->name('workerhome');
    Route::post('welcome/process','WorkerController@welcomeProcess')->name('workerhome.process');
    Route::get('criterios/{zone}','WorkerController@criteria')->name('criteria');
    Route::post('criteria/process','WorkerController@criteriaProcess')->name('criteria.process');

    Route::get('tareas/{activity}', 'WorkerController@tasks')->name('tasks');

    Route::post('tareas/process', 'WorkerController@tasksProcess')->name('tasks.process');
    
    Route::get('peligros/{task}', 'WorkerController@taskDangers')->name('dangers');

    Route::post('task-danger-process', 'WorkerController@taskDangerProcess')->name('taskdanger.process');
    
    Route::get('iperc/{task}/{danger}', 'WorkerController@getIperc')->name('workers.iperc');
    Route::get('controls/{iperc}', 'WorkerController@getControls')->name('workers.controls');
 });