<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function loginSubmit(Request $request)
    {
        $advancedValidation = $request->validate([
            'text_username' => [
            'required',
            'string',
            'min:5',
            'max:20',
            'regex:/^[a-zA-Z0-9_\-\.]+$/u', // Permite apenas caracteres alfanuméricos, underline, hífen e ponto
            function ($attribute, $value, $fail) {
                if (strtolower($value) === 'admin') {
                    $fail('O nome de usuário "admin" é reservado.');
                }
            },
        ],
        'text_password' => [
            'required',
            'string',
            'min:8',
            'max:32',
            'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
            // Exige pelo menos: 1 maiúscula, 1 minúscula, 1 número e 1 caractere especial
        ],
    ], [
        'text_username.regex' => 'O nome de usuário contém caracteres inválidos.',
        'text_password.regex' => 'A senha deve conter pelo menos 1 letra maiúscula, 1 minúscula, 1 número e 1 caractere especial.',
    ]);


        // $request->validate(
        //     ['text_username' => 'required'],
        //     ['text_password' => 'required']
        // );

        // //get user input
        // $username = $request->input('text_username');
        // $password = $request->input('text_password');

        // echo $username . '=>' . $password; 
    }

    public function logout()
    {
        echo 'logout';
    }
}
