<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
   $response =  \Illuminate\Support\Facades\Http::withToken(config('services.openai.secret'))->post('https://api.openai.com/v1/chat/completions', [
        "model" => "gpt-3.5-turbo",
        "messages" => [
            [
                "role" => "system",
                "content" => "You are a poetic assistant, skilled in explaining complex programming concepts with creative flair."
            ],
            [
                "role" => "user",
                "content" => "Compose a poem that explains the concept of recursion in programming."
            ]
        ]
   ])->json();

    dd($response);
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/posts', [PostController::class, 'index'])->name('post.index');
