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
            $user = User::where('email', $data['email'])->first();
            if (!$user) {

                return $this->responseError('Email Not Found');
            }
            if (!Hash::check($data['password'], $user->password)) {
                return $this->responseError("Wrong Email Or Password");
            }
            $authorization=[
                'token' =>  $user->createToken($user->email)->accessToken,
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
            $imagePath = $data['photo']->store('public/student_photo');
            $code = randomNumber(4);
            $formattedData = [
                'name' => $data['name'],
                'email' => $data['email'],
                'number' => $data['number'],
                'verification_code' => $code,
                'password' => Hash::make($data['password']),
                'photo'=>$imagePath,
            ];
            $user = User::create($formattedData);
            $sendEmailJob = new SendEmails($user->email, $user->name, $code);
            dispatch($sendEmailJob);
            return $this->responseSuccess("Registration Successful! Please check email for code");
        }
        catch (\Exception $exception) {
            return $this->responseError($exception->getMessage());
        }
    }

    public function teacherRegistration (array $data): array
    {
        try {
            $user=User::where('email',$data['email'])->get();
            if($user)
                return $this->responseError("user with same email already exists");
            $code = randomNumber(4);
            $imagePath = $data['photo']->store('public/teacher_photo');
            $videoPath = $data['video_resume']->store('public/videos');
            $cvPath = $data['cv']->store('public/cv');

            $formattedData =[
                'name'=>$data['name'],
                'email'=>$data['email'],
                'degree'=>$data['degree'],
                'university'=>$data['university'],
                'video_resume'=>$videoPath,
                'cv'=>$cvPath,
            ];
            $formattedData2 =[
                'name'=>$data['name'],
                'email'=>$data['email'],
                'number'=>$data['number'],
                'photo'=>$imagePath,
                'verification_code'=>$code,
                'password' => Hash::make($data['password']),
            ];
            Teacher::create($formattedData);
            $user=User::create($formattedData2);
            $sendEmailJob = new SendEmails($data['email'],$data['name'],$user->verification_code);
            dispatch($sendEmailJob);
            return $this->responseSuccess("Registration Successful! Please check email for code.");
        }
        catch (\Exception $exception) {
            return $this->responseError($exception->getMessage());
        }
    }
    /**
     * @param array $data
     * @return array
     */
    public function processVerification (array $data): array
    {
        try {
            $user = User::where('email', $data['email'])->where('verification_code', $data['code'])->first();
            if (!$user) {
                return $this->responseError("Invalid Code");
            }
            $formattedData = [
                'verification_code' => null,
                'email_verified' => true
            ];
            User::where('id', $user->id)->update($formattedData);
            return $this->responseSuccess( "Verification Successful!");
        }
        catch (\Exception $exception) {
            return $this->responseError($exception->getMessage());
        }
    }
    public function teacherVerification (array $data): array
    {
        try {
            $teacher = Teacher::where('email', $data['email'])->where('verification_code', $data['code'])->first();
            if (!$teacher) {
                return $this->responseError("Invalid Code");
            }
            $formattedData = [
                'verification_code' => null,
                'email_verified' => true,
                'userRole'=>'teacher'
            ];
            Teacher::where('id', $teacher->id)->update($formattedData);
            return $this->responseSuccess( "Verification Successful!");
        }
        catch (\Exception $exception) {
            return $this->responseError($exception->getMessage());
        }
    }
    public function logout(){
        try{
            $user=User::where('user_id',Auth::id());
            if(!$user){
                return $this->responseError(`User Doesn't Exit`);
            }
            Auth::logout();
            return $this->responseSuccess( "Logout Successful!");
        }catch (\Exception $exception){
            return $this->responseError($exception->getMessage());
        }
    }
    public function teacherLogout(){
        try{
            $user=Teacher::where('user_id',Auth::id());
            if(!$user){
                return $this->responseError(`User Doesn't Exit`);
            }
            Auth::logout();
            return $this->responseSuccess( "Logout Successful!");
        }catch (\Exception $exception){
            return $this->responseError($exception->getMessage());
        }
    }
}
