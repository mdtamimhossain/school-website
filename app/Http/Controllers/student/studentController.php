<?php

namespace App\Http\Controllers\student;
use App\Http\Controllers\Controller;
use App\Http\Requests\student\admissionRequest;
use App\Http\Requests\student\courseEnrollRequest;
use App\Http\Requests\student\postCommentRequest;
use App\Http\Requests\teacher\courseRequest;
use App\Http\Services\student\studentService;
use Illuminate\Http\JsonResponse;
class studentController extends Controller
{
    private studentService $service;
    function __construct(studentService $service)
    {
        $this->service=$service;
    }



    public function getUserInfo(): JsonResponse
    {

        return response()->json($this->service->getUserInfo());

    }
    public function getProfileInfo(): JsonResponse
    {

        return response()->json($this->service->getProfileInfo());

    }
    public function admission(admissionRequest $request): JsonResponse
    {

        return response()->json($this->service->admission($request->all()));

    }
}
