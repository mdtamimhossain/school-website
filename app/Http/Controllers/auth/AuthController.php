<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegistrationRequest;
use App\Http\Requests\Auth\VerificationRequest;
use App\Http\Requests\Auth\TeacherRegistrationRequest;
use App\Http\Services\auth\AuthService;
use Illuminate\Http\JsonResponse;
use function App\Helpers\randomNumber;

class AuthController extends Controller
{
    private AuthService $service;
    function __construct(AuthService $service)
    {
        $this->service=$service;
    }

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login (LoginRequest $request): JsonResponse
    {

        return response()->json($this->service->processLogin($request->all()));

    }
    public function test(): JsonResponse
    {

        return response()->json($this->service->test());

    }

    /**
     * @param RegistrationRequest $request
     * @return JsonResponse
     */
    public function register (RegistrationRequest $request): JsonResponse
    {

        return response()->json($this->service->processRegistration($request->all()));

    }
    public function verification (VerificationRequest $request): JsonResponse
    {

        return response()->json($this->service->processVerification($request->all()));

    }

    public function teacherRegister (TeacherRegistrationRequest $request): JsonResponse
    {

        return response()->json($this->service->teacherRegistration($request->all()));

    }
    public function teacherVerification (VerificationRequest $request): JsonResponse
    {

        return response()->json($this->service->teacherVerification($request->all()));

    }

    /**
     * @param VerificationRequest $request
     * @return JsonResponse
     */
    public function verify (VerificationRequest $request): JsonResponse
    {

        return response()->json($this->service->processVerification($request->all()));

    }

    /**
     * @return JsonResponse
     */
    public function logout():JsonResponse
    {
        return response()->json($this->service->logout());
    }
    public function teacherLogout():JsonResponse
    {
        return response()->json($this->service->teacherLogout());
    }
}
