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
use App\Models\Token;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{

    use ApiResponse;

    public function register(RegisterRequest $request)
    {
        // Validate the request data
        $validated = $request->validated();
        // Hash the password
        $validated['password'] = Hash::make($validated['password']);

        try {
            // Create the client
            $client = Client::create($validated);
            // Generate a token for the client
            $token = JWTAuth::fromUser($client);
            // Return the client data and token
            $data = [
                'token' => $token,
                'client' => new ClientResource($client),
            ];

            return $this->successResponse($data, 'تم التسجيل بنجاح', 201);

        } catch (\Exception $e) {
            // Handle any exceptions that occur during registration
            return $this->errorResponse('فشل في عملية التسجيل', 422);
        }
    }

    public function login(LoginRequest $request)
    {
        // Validate the request data
        $credentials = $request->validated();

        try {
            // Attempt to authenticate the client
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
            // Handle any exceptions that occur during authentication
            return $this->errorResponse('حدث خطأ غير متوقع', 500);
        }
    }
    public function logout()
    {
        try {
            // Logout the authenticated client
            auth('api')->logout();
            return $this->successResponse(null, 'تم تسجيل الخروج بنجاح', 200);
        } catch (\Exception $e) {
            return $this->errorResponse('حدث خطأ غير متوقع', 500);
        }
    }

    public function resetPassword(ResetPasswordRequest $request)
    {

        try {
            // Validate the request data
            $validated = $request->validated();
            // Find the client by phone number
            $client = Client::where('phone', $validated['phone'])->first();
            // Check if the client exists
            if (!$client) {
                return $this->errorResponse('الرقم المدخل غير موجود', 404);
            }
            // Generate a new pin code
            $code = rand(100000, 999999);
            // Update the client's pin code
            $client->update(['pin_code' => $code]);
            // Send the pin code to the client's email
            Mail::to($client->email)->send(new ResetPassword($client));
            // Return a success response
            return $this->successResponse(null, 'تم ارسال كود التحقق بنجاح', 200);

        } catch (\Exception $e) {
            // Handle any exceptions that occur during the process
            return $this->errorResponse('حدث خطأ أثناء إعادة تعيين كلمة المرور', 500);
        }
    }
    public function newPassword(NewPasswordRequest $request)
    {
        try {
            // Validate the request data
            $validated = $request->validated();
            // Find the client by phone number and pin code
            $client = Client::where('phone', $validated['phone'])
                ->where('pin_code', $validated['pin_code'])
                ->first();
            // Check if the client exists
            if (!$client) {
                return $this->errorResponse(' كود التحقق غير صحيح', 401);
            }
            // Update the client's password
            $client->update([
                'password' => Hash::make($validated['password']),
                'pin_code' => null,
            ]);
            // Return a success response
            return $this->successResponse(null, 'تم تغيير كلمة المرور بنجاح', 200);
        } catch (\Exception $e) {
            // Handle any exceptions that occur during the process
            return $this->errorResponse('حدث خطأ أثناء تغيير كلمة المرور', 500);
        }
    }
}
