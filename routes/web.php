    <?php

    use Illuminate\Support\Facades\Route;

    /*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register web routes for your application. These
    | routes are loaded by the RouteServiceProvider and all of them will
    | be assigned to the "web" middleware group. Make something great!
    |
    */

    Auth::routes();

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/', [App\Http\Controllers\GuestController::class, 'index'])->name('guest');



    Route::group([
        'prefix' => 'main',
        'as' => 'main.',
        'middleware' => ['auth'],
    ],function(){
    Route::get('/', [App\Http\Controllers\Main\IndexController::class, 'index'])->name('index');




        Route::group([
            'prefix' => 'lots',
            'as' => 'lot.',
        ],function(){
            Route::get('/view/{id}', [App\Http\Controllers\Main\LotController::class, 'view'])->name('view');
            Route::get('/form/{id?}', [App\Http\Controllers\Main\LotController::class, 'form'])->name('form');
            Route::post('/', [App\Http\Controllers\Main\LotController::class, 'actions'])->name('actions');



            Route::group([
                'prefix' => '{lot}/bets',
                'as' => 'bet.'
            ], function () {
                Route::post('/', [\App\Http\Controllers\Main\BetController::class, 'actions'])->name('actions');
            });
        });



    });
















    Route::group([
        'prefix' => 'admin',
        'as' => 'admin.',
        'middleware' => ['auth', 'admin'],
    ],function(){
            Route::get('/', [App\Http\Controllers\Admin\MainController::class,  'index'])->name('main.index');

            Route::group([
                'prefix' => 'categories',
                'as' => 'category.',
            ],function(){
                Route::get('/', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('index');
                Route::get('/view/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'view'])->name('view');
                Route::get('/form/{id?}', [App\Http\Controllers\Admin\CategoryController::class, 'form'])->name('form');
                Route::post('/', [App\Http\Controllers\Admin\CategoryController::class, 'actions'])->name('actions');
            });

        Route::group([
            'prefix' => 'users',
            'as' => 'user.',
        ],function(){
            Route::get('/', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('index');
            Route::get('/view/{id}', [App\Http\Controllers\Admin\UserController::class, 'view'])->name('view');
            Route::get('/form/{id?}', [App\Http\Controllers\Admin\UserController::class, 'form'])->name('form');
            Route::post('/', [App\Http\Controllers\Admin\UserController::class, 'actions'])->name('actions');
            });

        Route::group([
            'prefix' => 'lots',
            'as' => 'lot.',
        ],function(){
            Route::get('/', [App\Http\Controllers\Admin\LotController::class, 'index'])->name('index');
            Route::get('/view/{id}', [App\Http\Controllers\Admin\LotController::class, 'view'])->name('view');
            Route::get('/form/{id?}', [App\Http\Controllers\Admin\LotController::class, 'form'])->name('form');
            Route::post('/', [App\Http\Controllers\Admin\LotController::class, 'actions'])->name('actions');
        });

        Route::group([
            'prefix' => 'bets',
            'as' => 'bet.'
        ], function () {
            Route::get('/', [\App\Http\Controllers\Admin\BetController::class, 'index'])->name('index');
            Route::get('/view/{id}', [\App\Http\Controllers\Admin\BetController::class, 'view'])->name('view');
            Route::get('/form/{id?}', [\App\Http\Controllers\Admin\BetController::class, 'form'])->name('form');
            Route::post('/', [\App\Http\Controllers\Admin\BetController::class, 'actions'])->name('actions');
        });


    });
