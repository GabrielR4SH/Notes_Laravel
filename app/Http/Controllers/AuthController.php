<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
//
use Exception;
use PDOException;
use Illuminate\Support\Facades\DB;
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
        'email:rfc,dns', // Validação padrão de e-mail com verificação de DNS
        'max:100', // Tamanho máximo comum para e-mails
        function ($attribute, $value, $fail) {
            // Verifica se é um e-mail administrativo reservado
            $reservedEmails = ['admin@', 'administrator@', 'root@', 'sysadmin@'];
            foreach ($reservedEmails as $reserved) {
                if (strpos(strtolower($value), $reserved) === 0) {
                    $fail('O endereço de e-mail "'.$reserved.'" é reservado.');
                }
            }
            
            // Verifica provedores de e-mail temporários
            $tempDomains = ['tempmail.com', 'mailinator.com', '10minutemail.com'];
            $domain = substr(strrchr($value, "@"), 1);
            if (in_array(strtolower($domain), $tempDomains)) {
                $fail('E-mails temporários não são permitidos.');
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

        $users = User::all()->toArray();
        echo '<pre>';
        print_r($users);

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
