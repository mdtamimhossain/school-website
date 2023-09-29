<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\addUserInfoRequest;
use App\Http\Requests\admin\courseUploadRequest;
use App\Http\Requests\admin\resultUploadRequest;
use App\Http\Requests\admin\searchResultRequest;
use App\Http\Requests\admin\searchUserRequest;
use App\Http\Requests\admin\updateUserInfoRequest;
use App\Http\Requests\admin\uploadVideoRequest;
use App\Http\Requests\student\courseEnrollRequest;
use App\Http\Requests\student\postCommentRequest;
use App\Http\Requests\teacher\courseRequest;
use App\Http\Services\admin\adminService;
use App\Http\Services\student\studentService;
use Illuminate\Http\JsonResponse;
class adminController extends Controller
{
    private adminService $service;
    function __construct(adminService $service)
    {
        $this->service=$service;
    }


    public function courseUpload (courseUploadRequest $request): JsonResponse
    {

        return response()->json($this->service->courseUpload($request->all()));

    }
    public function courseDelete ($id): JsonResponse
    {

        return response()->json($this->service->courseDelete($id));

    }
    public function allCourse(): JsonResponse
    {

        return response()->json($this->service->allCourse());

    }
    public function getAllUser(): JsonResponse
    {

        return response()->json($this->service->allUser());

    }
    public function searchUser(searchUserRequest $request): JsonResponse
    {

        return response()->json($this->service->searchUser($request->all()));

    }
    public function getAllStudent(): JsonResponse
    {

        return response()->json($this->service->allStudent());

    }
    public function getAllTeacher(): JsonResponse
    {

        return response()->json($this->service->allTeacher());

    }
    public function addUserInfo(addUserInfoRequest $request): JsonResponse
    {

        return response()->json($this->service->addUserInfo($request->all()));

    }
    public function getUserInfo($id): JsonResponse
    {

        return response()->json($this->service->getUserInfo($id));

    }
    public function updateUserInfo(updateUserInfoRequest $request): JsonResponse
    {

        return response()->json($this->service->updateUserInfo($request->all()));

    }
    public function uploadVideo(uploadVideoRequest $request): JsonResponse
    {

        return response()->json($this->service->uploadVideo($request->all()));

    }
    public function deleteVideo($id): JsonResponse
    {

        return response()->json($this->service->deleteVideo($id));

    }
    public function allVideo(): JsonResponse
    {

        return response()->json($this->service->allVideo());

    }
    public function uploadResult(resultUploadRequest $request): JsonResponse
    {

        return response()->json($this->service->uploadResult($request->all()));

    }
    public function deleteResult($id): JsonResponse
    {

        return response()->json($this->service->deleteResult($id));

    }
    public function getResult($id): JsonResponse
    {

        return response()->json($this->service->getResult($id));

    }
    public function searchResult(searchResultRequest $request): JsonResponse
    {

        return response()->json($this->service->searchResult($request->all()));

    }
    public function disableResult($id): JsonResponse
    {

        return response()->json($this->service->disableResult($id));

    }
    public function pendingApplication(): JsonResponse
    {

        return response()->json($this->service->pendingApplication());

    }
    public function getCompleteApplication(): JsonResponse
    {

        return response()->json($this->service->getCompleteApplication());

    }
    public function completeApplication($id): JsonResponse
    {

        return response()->json($this->service->completeApplication($id));

    }
    public function getApplication($id): JsonResponse
    {

        return response()->json($this->service->getApplication($id));

    }


}
