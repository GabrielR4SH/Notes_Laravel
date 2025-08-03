<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        echo 'Inside MainController index method';
    }

    public function newNote()
    {
        echo 'Inside MainController newNote method';
    }

}
