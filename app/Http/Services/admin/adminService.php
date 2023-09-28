<?php

namespace App\Http\Services\admin;

use App\Http\Services\Service;
use App\Jobs\ApplicationEmails;
use App\Jobs\SendEmails;
use App\Models\Category;
use App\Models\course;
use App\Models\Teacher;
use App\Models\User;
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


}
