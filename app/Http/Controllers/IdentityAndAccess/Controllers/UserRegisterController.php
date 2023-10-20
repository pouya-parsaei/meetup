<?php

namespace App\Http\Controllers\IdentityAndAccess\Controllers;

use App\Http\Controllers\Controller;
use App\UseCases\IdentityAndAccess\RegisterUser;
use App\UseCases\IdentityAndAccess\UserRegisterDTO;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserRegisterController
{
    public function __construct(private readonly RegisterUser $registerUser)
    {

    }
    public function __invoke(Request $request):JsonResponse
    {
        $this->registerUser->execute(new UserRegisterDTO(
            $request->get('full_name'),
            $request->get('email'),
            $request->get('password')
        ));

        return response()->json([
           'success' => true,
           'message' => 'User registered successfully'
        ]);
    }
}
