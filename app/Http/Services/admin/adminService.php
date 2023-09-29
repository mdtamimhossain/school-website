<?php

namespace App\Http\Services\admin;

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
    public function searchUser(array $data): array
    {
        try{
            $searchString=$data['string'];
            $users = User::where('name', 'LIKE', "%$searchString%")
                ->orWhere('username', 'LIKE', "%$searchString%")
                ->get();

            return $this->responseSuccess('Search Related User',['users'=>$users]);
        }catch (\Exception $exception)
        {
            return $this->responseError($exception->getMessage());
        }
    }
    public function allStudent(): array
    {
        try{
            $users=User::where('userRole','student')->get();
            return $this->responseSuccess('All Students',['users'=>$users]);
        }catch (\Exception $exception)
        {
            return $this->responseError($exception->getMessage());
        }
    }
    public function allTeacher(): array
    {
        try{
            $users=User::where('userRole','teacher')->get();
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

            $videoPath = $data['video']->store('video', 'public');
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
            $filepath='public/' .$video->video;
            if (Storage::exists($filepath))
            {
                Storage::delete($filepath);
            }
            $video->delete();
            return $this->responseSuccess('Video Deleted Successfully');
        }catch (\Exception $exception)
        {
            return $this->responseError($exception->getMessage());
        }
    }
    public function uploadResult(array $data): array
    {
        try{
            $filePath = $data['resultSheet']->store('resultSheet', 'public');
            Result::create([
                'title'=>$data['title'],
                'courseName'=>$data['courseName'],
                'className'=>$data['className'],
                'courseId'=>$data['courseId'],
                'resultSheet'=>$filePath,
            ]);
            return $this->responseSuccess('Result sheet uploaded successfully ');
        }catch (\Exception $exception)
        {
            return $this->responseError($exception->getMessage());
        }
    }
    public function deleteResult($id): array
    {
        try{
            $result=Result::find($id);
            $filepath='public/' .$result->resultSheet;
            if (Storage::exists($filepath))
            {
                Storage::delete($filepath);
            }
            $result->delete();
            return $this->responseSuccess('Result sheet Deleted Successfully');
        }catch (\Exception $exception)
        {
            return $this->responseError($exception->getMessage());
        }
    }
    public function getResult($id): array
    {
        try{
            $results=Result::where('courseId',$id)->where('disable',false)->get();
            return $this->responseSuccess('All Result related this course',['results'=>$results]);
        }catch (\Exception $exception)
        {
            return $this->responseError($exception->getMessage());
        }
    }
    public function searchResult(array $data): array
    {
        try{
            $searchString=$data['string'];
            $results = Result::where('disable',false)->where('courseName', 'LIKE', "%$searchString%")
                ->orWhere('title', 'LIKE', "%$searchString%")
                ->get();
            return $this->responseSuccess('All Result related your search',['results'=>$results]);
        }catch (\Exception $exception)
        {
            return $this->responseError($exception->getMessage());
        }
    }
    public function disableResult($id): array
    {
        try{
            Result::where('id',$id)->update(['disable'=>true]);
            return $this->responseSuccess('Disable result sheet successfully');
        }catch (\Exception $exception)
        {
            return $this->responseError($exception->getMessage());
        }
    }
    public function pendingApplication(): array
    {
        try{
            $applications=Admission::where('status','pending')->get();
            return $this->responseSuccess('ALl pending application',['applications'=>$applications]);
        }catch (\Exception $exception)
        {
            return $this->responseError($exception->getMessage());
        }
    }
    public function getCompleteApplication(): array
    {
        try{
            $applications=Admission::where('status','complete')->get();
            return $this->responseSuccess('ALl complete application',['applications'=>$applications]);
        }catch (\Exception $exception)
        {
            return $this->responseError($exception->getMessage());
        }
    }
    public function getApplication($id): array
    {
        try{
            $application=Admission::find($id);
            return $this->responseSuccess('Single application',['application'=>$application]);
        }catch (\Exception $exception)
        {
            return $this->responseError($exception->getMessage());
        }
    }
    public function completeApplication($id): array
    {
        try{
           Admission::where('id',$id)->update(['status'=>'complete']);
            return $this->responseSuccess('Application status change to complete');
        }catch (\Exception $exception)
        {
            return $this->responseError($exception->getMessage());
        }
    }
}
