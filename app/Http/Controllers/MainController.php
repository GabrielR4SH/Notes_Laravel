<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;

class MainController extends Controller
{
    public function index()
    {
        $id = session('user.id');
        
        $user = User::find($id)->toArray();
        $notes = User::find($id)->notes()->get()->toArray();
        
        // echo '<pre>';
        //     print_r($user);
        //     print_r($notes);
        // echo '</pre>';

        // die('Inside MainController index method');

        return view('home', ['notes' => $notes ]); 
    }

    public function newNote()
    {
        echo 'Inside MainController newNote method';
    }

    public function edit($id)
    {
        echo 'Inside MainController edit method with ID: ' . Crypt::decrypt($id);
        // Here you would typically fetch the note by ID and return a view to edit it
        // $note = Note::find($id);
        // return view('editNote', ['note' => $note]);
    }

    public function update(Request $request, $id)
    {
        echo 'Inside MainController update method with ID: ' . Crypt::decrypt($id);
        // Logic to update the note with the given ID
        // $note = Note::find($id);
        // $note->update($request->all());
        // return redirect()->route('home')->with('success', 'Note updated successfully');
    }

    public function delete($id)
    {
        echo 'Inside MainController delete method with ID: ' . Crypt::decrypt($id);
        // Logic to delete the note with the given ID
        // $note = Note::find($id);
        // $note->delete();
        // return redirect()->route('home')->with('success', 'Note deleted successfully');
    }

}
