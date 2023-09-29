<?php

namespace App\Http\Services\student;

use App\Http\Services\Service;
use App\Models\Admission;
use App\Models\course;
use App\Models\Result;
use App\Models\User;
use App\Models\UserInfo;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use function Webmozart\Assert\Tests\StaticAnalysis\length;

class studentService extends Service
{

    public function getUserInfo(): array
    {
        try{

            $userInfo=UserInfo::where('user_id',auth::id())->first();

            if(!$userInfo) {
                return $this->responseError('User Information need to add or update');
            }

            return $this->responseSuccess('User Information',['userInfo'=>$userInfo]);
        }catch (\Exception $exception)
        {
            return $this->responseError($exception->getMessage());
        }
    }
    public function getProfileInfo(): array
    {
        try{

            $userInfo=User::find(auth::id());


            return $this->responseSuccess('Profile Information',['userInfo'=>$userInfo]);
        }catch (\Exception $exception)
        {
            return $this->responseError($exception->getMessage());
        }
    }
    public function admission(array $data): array
    {
        try{

            Admission::create([
                'name'=>$data['name'],
                'fName'=>$data['fName'],
                'mName'=>$data['mName'],
                'address'=>$data['address'],
                'age'=>$data['age'],
                'birthdate'=>$data['birthdate'],
                'number'=>$data['number'],
                'gender'=>$data['gender'],
                'email'=>$data['email'],
                'currentClass'=>$data['currentClass'],
                'intendedClass'=>$data['intendedClass'],

            ]);

            return $this->responseSuccess('Application completed.We will contact you soon');
        }catch (\Exception $exception)
        {
            return $this->responseError($exception->getMessage());
        }
    }
}
