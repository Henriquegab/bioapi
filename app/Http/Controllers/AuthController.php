<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Mail\CadastroEmail;
use App\Mail\ForgotPassword;
use App\Models\User;
use App\Services\UpdatePasswordService;
use Exception;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Expr\Instanceof_;

use function PHPUnit\Framework\isInstanceOf;

class AuthController extends Controller
{
    private $updatePassword;

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->updatePassword = app(UpdatePasswordService::class) ;
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (! $token = auth()->attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Credenciais Inválidas!'
            ], 401);
        }

        if(is_null(auth()->user()->email_verified_at)){

            auth()->user()->sendEmailVerificationNotification();
            return response()->json([
                'success' => false,
                'message' => 'Email não verificado! Por favor verifique seu email.'
            ], 403);
        }
        return response()->json([
            'success' => true,
            'message' => 'Usuário logado com sucesso!',
            'data' => [
                'token' => $token,
                'user' => auth()->user()
            ]
        ], 200);


    }

    public function register(RegisterRequest $request)
    {

        try {

            $data = $request->all();



            $user = new User([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),

            ]);

            $user->save();

            $user->sendEmailVerificationNotification();





            return response()->json([
                'success' => true,
                'message' => 'Usuário criado com sucesso! verifique seu email!',
                'data' => [
                    'user' => $user,

                ]
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'erro',
                'data' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        try {
            return response()->json([
                'success' => true,
                'message' => 'Dados do seu usuário recuperado!',
                'data' => auth()->user()
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Dados não recuperados!',

            ], 500);
        }



        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {

        try{
            auth()->logout();

            return response()->json([
                'success' => true,
                'message' => 'Deslogado com sucesso!'
            ]);
        }
        catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'Não foi possível deslogar!',
                'data' => $e->getMessage()
            ]);
        }


    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    protected function verify_email(EmailVerificationRequest $request)
    {
        $request->fulfill();

        return view('auth.email.validado');
    }
    protected function update(UpdateUserRequest $request)
    {

        if($this->updatePassword->verifySamePassword($request->password,auth()->user()->password)){
            return response()->json([
                'success' => false,
                'message' => 'A senha não pode ser a mesma!'
            ], 400);
        }

        $this->updatePassword->changePassword($request->password);

        return response()->json([
            'success' => true,
            'message' => 'Senha alterada com sucesso!'
        ], 200);

    }

    protected function forgotPassword(ForgotPasswordRequest $request)
    {

        $user = User::where('email',$request->email)->first();

        $senha = rand(100000, 999999);

        Mail::to($user)->send(new ForgotPassword($user, $senha));

        $this->updatePassword->changePasswordWithoutAuth($senha, $user);

        return response()->json([
            'success' => true,
            'message' => 'Senha alterada com sucesso! verifique seu email.'
        ], 200);

    }
}
