<?php

namespace App\Http\Services\auth;

use App\Http\Services\Service;
use App\Jobs\SendEmails;
use App\Models\Teacher;
use App\Models\User;
use function App\Helpers\randomNumber;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
class AuthService extends Service
{
    /**
     * @param array $data
     * @return array
     */
    public function test(): array
    {
        try{
            return $this->responseSuccess( "test sucessfull");
        }catch (\Exception $exception){
            return $this->responseError($exception->getMessage());
        }
    }
    public function processLogin (array $data): array
    {
        try {
            $user = User::where('username', $data['username'])->first();
            if (!$user) {

                return $this->responseError('User Not Found');
            }
            if (!Hash::check($data['password'], $user->password)) {
                return $this->responseError("Wrong Username Or Password");
            }
            $authorization=[
                'token' =>  $user->createToken($user->username)->accessToken,
                'token_type' =>  'Bearer'
            ];
            return $this->responseSuccess("Login Successful!",['authorization'=>$authorization]);
        }
        catch (\Exception $exception) {
            return $this->responseError($exception->getMessage());
        }
    }

    public function processRegistration (array $data): array
    {
        try {
            $formattedData = [
                'name' => $data['name'],
                'username' => $data['username'],
                'number' => $data['number'],
                'userRole' => $data['userRole'],
                'password' => Hash::make($data['password']),

            ];
            $user = User::create($formattedData);
            return $this->responseSuccess("Registration Successful!");
        }
        catch (\Exception $exception) {
            return $this->responseError($exception->getMessage());
        }
    }



    public function logout() {
        try {
            $user = Auth::user();

            if (!$user) {
                return $this->responseError('User doesn\'t exist');
            }
            $user->token()->revoke();
            return $this->responseSuccess('Logout successful!');
        } catch (\Exception $exception) {
            return $this->responseError($exception->getMessage());
        }
    }
}
