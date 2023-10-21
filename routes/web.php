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

    Route::get('/guest', [App\Http\Controllers\GuestController::class, 'index'])->name('guest');

    Route::get('/', [App\Http\Controllers\Main\IndexController::class, 'index'])->name('main.index');

    //Route::group(['middleware' => ['auth', 'admin']], function () {

    Route::group([
        'prefix' => 'admin',
        'as' => 'admin.',
    ],function(){
            Route::get('/', [App\Http\Controllers\Admin\MainController::class, 'index'])->name('main.index');

    //        Route::prefix('tasks')->group(function () {
    //            Route::get('/', [App\Http\Controllers\Admin\TaskController::class, 'index'])->name('admin.task.index');
    //            Route::get('/create', [App\Http\Controllers\Admin\TaskController::class, 'create'])->name('admin.task.create');
    //            Route::post('/', [App\Http\Controllers\Admin\TaskController::class, 'store'])->name('admin.task.store');
    //            Route::get('/{task}', [App\Http\Controllers\Admin\TaskController::class, 'show'])->name('admin.task.show');
    //            Route::get('/{task}/edit', [App\Http\Controllers\Admin\TaskController::class, 'edit'])->name('admin.task.edit');
    //            Route::patch('/{task}', [App\Http\Controllers\Admin\TaskController::class, 'update'])->name('admin.task.update');
    //            Route::delete('/{task}', [App\Http\Controllers\Admin\TaskController::class, 'delete'])->name('admin.task.delete');
    //        });
    //
//                Route::prefix('categories')->name('admin.category.')->group(function () {
//                    Route::get('/', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('index');
//                    Route::get('/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'show'])->name('show');
//                    Route::get('/form/{id?}', [App\Http\Controllers\Admin\CategoryController::class, 'form'])->name('form');
//                    Route::post('/', [App\Http\Controllers\Admin\CategoryController::class, 'actions'])->name('actions');
//                });



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

    });
