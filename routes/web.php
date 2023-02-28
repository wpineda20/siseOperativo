<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\MunicipalityController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\MonthsController;
use App\Http\Controllers\PeriodsController;
use App\Http\Controllers\YearsController;
use App\Http\Controllers\InstitutionsController;
use App\Http\Controllers\DirectionsController;
use App\Http\Controllers\OrganizationalUnitsController;
use App\Http\Controllers\UnitsController;
use App\Http\Controllers\TrackingStatusesController;
use App\Http\Controllers\IndicatorsController;
use App\Http\Controllers\MonthlyClosingController;
use App\Http\Controllers\CronClosingController;


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
    return view('auth/login');
});

Auth::routes(['verify' => true, 'remember_me' => false]);

Route::group(['middleware' => ['auth', 'verified', 'log', 'throttle:web']], function () {
    Route::group(['middleware' => ['has.role:Administrador']], function () {
        // Apis
        Route::resource('/api/web/department', DepartmentController::class);
        Route::resource('/api/web/municipality', MunicipalityController::class);
        Route::resource('/api/web/user', UserController::class);
        Route::resource('/api/web/role', RoleController::class);

        Route::resource('/api/web/month', MonthsController::class);
        Route::delete('/api/web/month', [MonthsController::class, 'destroy']);
        Route::resource('/api/web/period', PeriodsController::class);
        Route::delete('/api/web/period', [PeriodsController::class, 'destroy']);
        Route::resource('/api/web/year', YearsController::class);
        Route::delete('/api/web/year', [YearsController::class, 'destroy']);
        Route::resource('/api/web/institution', InstitutionsController::class);
        Route::delete('/api/web/institution', [InstitutionsController::class, 'destroy']);
        Route::resource('/api/web/direction', DirectionsController::class);
        Route::delete('/api/web/direction', [DirectionsController::class, 'destroy']);
        Route::resource('/api/web/organizationalUnit', OrganizationalUnitsController::class);
        Route::delete('/api/web/organizationalUnit', [OrganizationalUnitsController::class, 'destroy']);
        Route::resource('/api/web/unit', UnitsController::class);
        Route::delete('/api/web/unit', [UnitsController::class, 'destroy']);
        Route::resource('/api/web/trackingStatus', TrackingStatusesController::class);
        Route::delete('/api/web/trackingStatus', [TrackingStatusesController::class, 'destroy']);
        Route::resource('/api/web/indicator', IndicatorsController::class);
        Route::delete('/api/web/indicator', [IndicatorsController::class, 'destroy']);
        Route::resource('/api/web/monthlyClosing', MonthlyClosingController::class);
        Route::resource('/api/web/cronClosing', CronClosingController::class);

        // Views
        Route::get('/users', function () {
            return view('user.index');
        });

        Route::get('/months', function () {
            return view('month.index');
        });

        Route::get('/periods', function () {
            return view('period.index');
        });

        Route::get('/years', function () {
            return view('year.index');
        });

        Route::get('/institutions', function () {
            return view('institution.index');
        });

        Route::get('/directions', function () {
            return view('direction.index');
        });

        Route::get('/organizationalUnits', function () {
            return view('organizational_units.index');
        });

        Route::get('/units', function () {
            return view('unit.index');
        });

        Route::get('/trackingStatus', function () {
            return view('tracking_status.index');
        });

        Route::get('/indicators', function () {
            return view('indicator.index');
        });

        Route::get('/cronClosing', function () {
            return view('cron_closing.index');
        });

        Route::get('/monthlyClosings', function () {
            return view('monthly_closing.index');
        });

        // Route::get('/departments', function () {
        //     return view('department.index');
        // });

        // Route::get('/municipalities', function () {
        //     return view('municipality.index');
        // });

    });

    Route::post('/api/web/organizationalUnit/allOrganizationalUnits', [OrganizationalUnitsController::class, 'allOrganizationalUnits']);

    //Reports
    Route::get('generate-pdf', [PDFController::class, 'generatePDF']);

    //Excel
    Route::get('export', [ExcelController::class, 'export']);

    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

Route::post('import', [ExcelController::class, 'import']);
