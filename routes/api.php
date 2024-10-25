<?

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PasteController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ComplaintController;

//Route::get('/pastes', [PasteController::class, 'index'])->name('post.index');
Route::get('/pastes/{id}', [PasteController::class, 'show'])->name('post.show');
Route::post('/pastes', [PasteController::class, 'store'])->name('post.store');
Route::put('/pastes/{id}', [PasteController::class, 'update'])->name('post.update');
Route::delete('/pastes/{id}', [PasteController::class, 'destroy'])->name('post.destroy');

Route::get('/users', [UserController::class, 'index'])->name('user.index');
Route::get('/users/{id}', [UserController::class, 'show'])->name('user.show');
Route::put('/users/{id}', [UserController::class, 'update'])->name('user.update');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('user.destroy');

Route::get('/complaints', [ComplaintController::class, 'index'])->name('complaint.index');
Route::complaint('/complaints', [ComplaintController::class, 'store'])->name('complaint.store');
