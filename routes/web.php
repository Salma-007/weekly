<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentaireController;
use App\Http\Controllers\AnnonceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Models\Annonce;


// Route::post('annonces/{annonce}/comments', [CommentaireController::class, 'store'])->name('commentaires.store');
// Route::post('/comments', [CommentaireController::class, 'store'])->name('comments.store');
Route::post('comments/{annonce}', [CommentaireController::class, 'store'])->name('comments.store');


Route::get('/annoncess', function () {
    $annonces = Annonce::with('comments')->paginate(10); 

    return view('annonces.comment', ['annonces' => $annonces]);

})->name('annonces.comment');

Route::get('annonces/{annonce}/details', [AnnonceController::class, 'showDetails'])->name('annonces.show.details');
Route::resource('categories', CategoryController::class);
Route::resource('annonces', AnnonceController::class);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
