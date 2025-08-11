<?php

namespace App\Http\Controllers;

use App\Services\Operations;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use PhpParser\Node\Expr\Throw_;
use PhpParser\Node\Stmt\Catch_;
use Illuminate\Contracts\Encryption;
use Illuminate\Contracts\Encryption\DecryptException;
use \App\Models\Note;
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

        return view('home', ['notes' => $notes]);
    }

    public function newNote()
    {
        return view('new_note');
    }

    public function newNoteSubmit(Request $request)
    {
        $validatedData = $request->validate(
            [
                'text_title' => 'required|min:3|max:255',  // Changed from 'title' to 'text_title'
                'text_note' => 'required|min:10|max:1000',  // Changed from 'content' to 'text_note'
            ],
            [
                'text_title.required' => 'The title is required.',
                'text_title.max' => 'The title may not be greater than 255 characters.',
                'text_title.min' => 'The title must be at least 3 characters.',

                'text_note.required' => 'The content is required.',
                'text_note.max' => 'The content may not be greater than 1000 characters.',
                'text_note.min' => 'The content must be at least 10 characters.',
            ]
        );

        $id = session('user.id');
        $note = new Note();
        $note->user_id = $id;
        $note->title = $validatedData['text_title'];  // Changed from 'title' to 'text_title'
        $note->text = $validatedData['text_note']; // Changed from 'content' to 'text_note'
        $note->save();

        return redirect()->route('home')->with('success', 'Note created successfully');
    }

    public function edit($id)
    {
        try {
            $id = Operations::decryptId($id);
        } catch (DecryptException $e) {
            redirect()->route('home')->with('error', 'Invalid note ID');
        }
    }

    public function update(Request $request, $id)
    {
        $id = Operations::decryptId($id);
        echo 'Inside MainController update method with ID: ' . $id;
        // Logic to update the note with the given ID
        // $note = Note::find($id);
        // $note->update($request->all());
        // return redirect()->route('home')->with('success', 'Note updated successfully');
    }

    public function delete($id)
    {
        $id = Operations::decryptId($id);
        echo 'Inside MainController delete method with ID: ' . $id;
        // Logic to delete the note with the given ID
        // $note = Note::find($id);
        // $note->delete();
        // return redirect()->route('home')->with('success', 'Note deleted successfully');
    }

    public function show($id)
    {
        $decrytedId = Crypt::decrypt($id);
        echo 'Inside MainController show method with ID: ' . $decrytedId;
    }



}
