<?php

namespace App\Http\Controllers\IdentityAndAccess\Controllers;

use App\UseCases\IdentityAndAccess\LoginUser;
use App\UseCases\IdentityAndAccess\LoginUserDTO;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LoginUserController
{
    public function __construct(private readonly LoginUser $loginUser)
    {

    }

    public function __invoke(Request $request):JsonResponse
    {
        $this->loginUser->execute(new LoginUserDTO(
            $request->get('email'),
            $request->get('password')
        ));
    }
}
