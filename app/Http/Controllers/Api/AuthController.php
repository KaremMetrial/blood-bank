<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\NewPasswordRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Requests\Api\ResetPasswordRequest;
use App\Http\Resources\ClientResource;
use App\Mail\ResetPassword;
use App\Models\Client;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{

    use ApiResponse;

    public function register(RegisterRequest $request)
    {
        try {
            $validated = $request->validated();
            $validated['password'] = Hash::make($validated['password']);

            $client = Client::create($validated);
            $token = JWTAuth::fromUser($client);
            $data = [
                'token' => $token,
                'client' => new ClientResource($client),
            ];
            return $this->successResponse($data, 'تم التسجيل بنجاح', 201);

        } catch (\Exception $e) {
            return $this->errorResponse('فشل في عملية التسجيل', 422);
        }
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        try {

            if (!$token = auth('api')->attempt($credentials)) {
                return $this->errorResponse('رقم الهاتف او كلمة المرور غير صحيح', 401);
            }
            $client = Auth::guard('api')->user();

            $data = [
                'token' => $token,
                'client' => new ClientResource($client),
            ];
            return $this->successResponse($data, 'تم تسجيل الدخول بنجاح', 200);

        } catch (JWTException $e) {
            return $this->errorResponse('حدث خطأ غير متوقع', 500);
        }
    }
    public function logout()
    {
        auth('api')->logout();
        return $this->successResponse(null, 'تم تسجيل الخروج بنجاح', 200);
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        try {
            $client = Client::where('phone', $request->phone)->firstOrFail();

            $code = rand(100000, 999999);

            $client->update(['pin_code' => $code]);

            Mail::to($client->email)->send(new ResetPassword($client));

            return $this->successResponse(null, 'تم ارسال كود التحقق بنجاح', 200);

        } catch (\Exception $e) {
            return $this->errorResponse('حدث خطأ أثناء إعادة تعيين كلمة المرور', 500);
        }
    }
    public function newPassword(NewPasswordRequest $request)
    {
        $validated = $request->validated();

        $client = Client::where('phone', $validated['phone'])
            ->where('pin_code', $validated['pin_code'])
            ->first();

        if (!$client) {
            return $this->errorResponse(' كود التحقق غير صحيح', 401);
        }

        $client->update([
            'password' => Hash::make($validated['password']),
            'pin_code' => null,
        ]);

        return $this->successResponse(null, 'تم تغيير كلمة المرور بنجاح', 200);

    }
}
