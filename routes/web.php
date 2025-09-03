<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckIsLogged;
use App\Http\Middleware\CheckIsNotLogged;


//Se estiver dentro do middleware CheckIsNotLogged, as rotas abaixo serão acessíveis
//Se já estiver logado, será redirecionado para a rota / que me traz para a página inicial
Route::middleware([CheckIsNotLogged::class])->group(function () {
    Route::get('/login', [AuthController::class, 'login']);
    Route::post('/loginSubmit', [AuthController::class, 'loginSubmit']);
});

//Enquanto estiver dentro do middleware CheckIsLogged, as rotas abaixo serão acessíveis
//Se não estiver logado, será redirecionado para a rota /login
Route::middleware([CheckIsLogged::class])->group(function () {
    //Notes
    Route::get('/', [MainController::class, 'index'])->name('home');
    Route::get('/newNote', [MainController::class, 'newNote'])->name('new');
    Route::post('/newNoteSubmit', [MainController::class, 'newNoteSubmit'])->name('newNoteSubmit');
    
    //Edit
    Route::get('/edit/{id}', [MainController::class, 'edit'])->name('edit');
    Route::post('/editNoteSubmit/{id}', [MainController::class, 'editNoteSubmit'])->name('editNoteSubmit');
    //Update
    Route::post('/update/{id}', [MainController::class, 'update'])->name('update');

    //Delete
    Route::get('/delete/{id}', [MainController::class, 'deleteNote'])->name('delete');
    Route::get('/deleteNoteConfirm/{id}', [MainController::class, 'deleteNoteConfirm'])->name('deleteNoteConfirm');
    
    //Logout
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});






