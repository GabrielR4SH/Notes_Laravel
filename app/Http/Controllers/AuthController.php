<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
//
use Exception;
use PDOException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function loginSubmit(Request $request)
    {
        $request->validate([
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
                            $fail('O endereço de e-mail "' . $reserved . '" é reservado.');
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

        //$users = User::all()->toArray();

        $users = new User();


        // $request->validate(
        //     ['text_username' => 'required'],
        //     ['text_password' => 'required']
        // );

        // //get user input
        $username = $request->input('text_username');
        $password = $request->input('text_password');

        // echo $username . '=>' . $password; 

        //check if user exists
        $user = User::where('username', $username)->where('deleted_at', null)->first();
        if (!$user) {
            // return redirect()->back()->withErrors(['text_username' => 'Usuário não encontrado.']);

            return redirect()->back()->withInput()->with('loginError', 'Usuário ou senha encontrados');

        }

        //check if password matches
        if (!Hash::check($password, $user->password)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('loginError', 'Usuário ou senha incorretos.');
        }
        //update last login
        // $user->last_login = date('Y-m-d H:i:s');
        $user->last_login = now();
        $user->save();

        //login user
         session([
            'user' => [
                'id' => $user->id,
                'username' => $user->username
            ]
        ]);

        //redirect to main page
        return redirect()->to('/')->with('success', 'Login realizado com sucesso!');
    }

    public function logout()
    {
        //logout from application
         session()->forget('user');
        // session()->flush();
        //redirect to login page
        return redirect('/login');
    }
}
