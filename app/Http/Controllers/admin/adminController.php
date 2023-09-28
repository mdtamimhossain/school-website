<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\courseUploadRequest;
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


}
