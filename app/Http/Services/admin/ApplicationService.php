<?php

namespace App\Http\Services\admin;

use App\Http\Services\Service;
use App\Jobs\ApplicationEmails;
use App\Jobs\SendEmails;
use App\Models\Category;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use function Webmozart\Assert\Tests\StaticAnalysis\length;

class ApplicationService extends Service
{

    public function getApplications(): array
    {
        try{
            $applications=Teacher::where('isApproved',false)->get();
            if($applications->count()==0)
            {
                return $this->responseError("No unreviewed application available");
            }
            return $this->responseSuccess('All teaching application',['data'=>$applications]);
        }catch (\Exception $exception)
        {
            return $this->responseError($exception->getMessage());
        }
    }
    public function getApplication($id): array
    {
        try{
            $application=Teacher::find($id);
            if(!$application) return $this->responseError('No application with associate with id ');
            return $this->responseSuccess('Specific application',['data'=>$application]);
        }catch (\Exception $exception)
        {
            return $this->responseError($exception->getMessage());
        }
    }
    public function approveApplication($id): array
    {
        try{
            $application=Teacher::find($id);
            if(!$application)
                return $this->responseError('No application with associate with id ');
            $application->update(['isApproved'=>true]);
            $content = "Congratulations  $application->name.\nWe have reviewed your application and now you become a member of our teaching panel.\nYou can now login as a Teacher" ;

            $sendEmailJob = new ApplicationEmails($application->email, $application->name,$content);
            dispatch($sendEmailJob);
            return $this->responseSuccess('Teacher approved successfully');
        }catch (\Exception $exception)
        {
            return $this->responseError($exception->getMessage());
        }
    }
    public function rejectApplication($id): array
    {
        try{
            $application=Teacher::find($id);
            if(!$application)
                return $this->responseError('No application with associate with id ');
            $content=$application->name."We have already reviewed your application.We can't accept your application.\nBut you can apply again with more details requirement";
            $sendEmailJob = new ApplicationEmails($application->email, $application->name,$content);
            dispatch($sendEmailJob);
            return $this->responseSuccess('Teacher approved successfully');
        }catch (\Exception $exception)
        {
            return $this->responseError($exception->getMessage());
        }
    }

}
