<?php

namespace App\Http\Controllers\student;
use App\Http\Controllers\Controller;
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


    /**
     * @param courseRequest $request
     * @return JsonResponse
     */
    public function courseEnroll ($id): JsonResponse
    {

        return response()->json($this->service->courseEnroll($id));

    }

    /**
     * @return JsonResponse
     */
    public function enrolledCourses(): JsonResponse
    {
        return response()->json($this->service->enrolledCourses());
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function enrolledCourse($id): JsonResponse
    {
        return response()->json($this->service->enrolledCourse($id));
    }
    public function courseVideo($id): JsonResponse
    {
        return response()->json($this->service->courseVideo($id));
    }
    public function cancelCourse($id): JsonResponse
    {
        return response()->json($this->service->cancelCourse($id));
    }

    public function getPosts($id): JsonResponse
    {

        return response()->json($this->service->getPosts($id));

    }
    public function comment(postCommentRequest $request): JsonResponse
    {

        return response()->json($this->service->comment($request->all()));

    }
    public function allComment($id): JsonResponse
    {

        return response()->json($this->service->allComment($id));

    }
    public function deleteComment($id): JsonResponse
    {

        return response()->json($this->service->deleteComment($id));

    }

}
