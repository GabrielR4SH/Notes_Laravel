<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class MainController extends Controller
{
    public function index()
    {
        $id = session('user.id');
        
        $user = User::find($id)->toArray();
        $notes = User::find($id)->notes()->get()->toArray();
        
        echo '<pre>';
            print_r($user);
            print_r($notes);
        echo '</pre>';

        die('Inside MainController index method');
        return view('home', ['notes' => $notes ]); 
    }

    public function newNote()
    {
        echo 'Inside MainController newNote method';
    }

}
