<?php

namespace App\Http\Services\admin;

use App\Http\Services\Service;
use App\Jobs\SendEmails;
use App\Models\Category;
use App\Models\Course;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use function Webmozart\Assert\Tests\StaticAnalysis\length;

class CourseService extends Service
{

    /**
     * @return array
     */
    public function getCourses(): array
    {
        try{
            $courses=Course::all();
            if($courses->count()==0){
                return $this->responseError('No course available');
            }
            return $this->responseSuccess('All Courses',['data'=>$courses]);
        }catch (\Exception $exception)
        {
            return $this->responseError($exception->getMessage());
        }
    }

    /**
     * @param $id
     * @return array
     */
    public function getCourse($id): array
    {
        try{
            $course=Course::findOrFail($id);
            return $this->responseSuccess('Specific application',['data'=>$course]);
        }catch (\Exception $exception)
        {
            return $this->responseError($exception->getMessage());
        }
    }

    /**
     * @param $id
     * @return array
     */
    public function deleteCourse($id): array
    {
        try{
            $course=Course::find($id);
            if(!$course)
                return $this->responseError('No course with id given');
            $course->delete();
            return $this->responseSuccess('Course Deleted Successfully');
        }catch (\Exception $exception)
        {
            return $this->responseError($exception->getMessage());
        }
    }

}
