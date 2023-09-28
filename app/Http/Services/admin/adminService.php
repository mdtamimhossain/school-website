<?php

namespace App\Http\Services\admin;

use App\Http\Services\Service;
use App\Jobs\ApplicationEmails;
use App\Jobs\SendEmails;
use App\Models\Category;
use App\Models\course;
use App\Models\Teacher;
use App\Models\User;
use App\Models\UserInfo;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use function Webmozart\Assert\Tests\StaticAnalysis\length;

class adminService extends Service
{

    public function courseUpload(array $data): array
    {
        try{
            Course::create([
                'courseName'=>$data['courseName'],
                'className'=>$data['className'],
            ]);
            return $this->responseSuccess('Course Uploaded Successfully');
        }catch (\Exception $exception)
        {
            return $this->responseError($exception->getMessage());
        }
    }
    public function courseDelete($id): array
    {
        try{
            $course=Course::find($id);
            $course->delete();
            return $this->responseSuccess('Course Deleted Successfully');
        }catch (\Exception $exception)
        {
            return $this->responseError($exception->getMessage());
        }
    }
    public function allCourse(): array
    {
        try{
            $courses=Course::all();
            return $this->responseSuccess('All Courses',['courses'=>$courses]);
        }catch (\Exception $exception)
        {
            return $this->responseError($exception->getMessage());
        }
    }
    public function allUser(): array
    {
        try{
            $users=User::all();
            return $this->responseSuccess('All Users',['users'=>$users]);
        }catch (\Exception $exception)
        {
            return $this->responseError($exception->getMessage());
        }
    }
    public function allStudent(): array
    {
        try{
            $users=User::where('userRole','student')->get;
            return $this->responseSuccess('All Students',['users'=>$users]);
        }catch (\Exception $exception)
        {
            return $this->responseError($exception->getMessage());
        }
    }
    public function allTeacher(): array
    {
        try{
            $users=User::where('userRole','teacher')->get;
            return $this->responseSuccess('All Teachers',['users'=>$users]);
        }catch (\Exception $exception)
        {
            return $this->responseError($exception->getMessage());
        }
    }
    public function addUserInfo(array $data): array
    {
        try{
            UserInfo::create([
                'user_id'=>$data['user_id'],
                'fullName'=>$data['fullName'],
                'email'=>$data['email'],
                'number'=>$data['number'],
                'class'=>$data['className'],
                'birthdate'=>$data['birthdate'],
                'fatherName'=>$data['fatherName'],
                'motherName'=>$data['motherName'],
                'address'=>$data['address'],
            ]);
            return $this->responseSuccess('User Information added Successfully',);
        }catch (\Exception $exception)
        {
            return $this->responseError($exception->getMessage());
        }
    }
    public function updateUserInfo(array $data): array
    {
        try{
            UserInfo::where('user_id',$data['user_id'])->update([
                'fullName'=>$data['fullName'],
                'email'=>$data['email'],
                'number'=>$data['number'],
                'class'=>$data['className'],
                'birthdate'=>$data['birthdate'],
                'fatherName'=>$data['fatherName'],
                'motherName'=>$data['motherName'],
                'address'=>$data['address'],
            ]);
            return $this->responseSuccess('User Information updated Successfully',);
        }catch (\Exception $exception)
        {
            return $this->responseError($exception->getMessage());
        }
    }
    public function getUserInfo($id): array
    {
        try{
            $userInfo=UserInfo::where('user_id',$id)->get();
            return $this->responseSuccess('User Information',['userInfo'=>$userInfo]);
        }catch (\Exception $exception)
        {
            return $this->responseError($exception->getMessage());
        }
    }

    public function uploadVideo(array $data): array
    {
        try{

            $videoPath = $data['video']->store(`public/video`);
            Video::create([
                'caption'=>$data['caption'],
                'video'=>$videoPath
            ]);
            return $this->responseSuccess('video upload  successfully');
        }catch (\Exception $exception)
        {
            return $this->responseError($exception->getMessage());
        }
    }
    public function allVideo(): array
    {
        try{

            $videos=Video::all();
            return $this->responseSuccess('All Video',['videos'=>$videos]);
        }catch (\Exception $exception)
        {
            return $this->responseError($exception->getMessage());
        }
    }
    public function deleteVideo($id): array
    {
        try{
            $video=Video::find($id);
            $video->delete();
            return $this->responseSuccess('Video Deleted Successfully');
        }catch (\Exception $exception)
        {
            return $this->responseError($exception->getMessage());
        }
    }
}
