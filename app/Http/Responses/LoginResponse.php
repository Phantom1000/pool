<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        return back();
        /*return $request->wantsJson()
            ? response()->json(['two_factor' => true])
            : redirect()->intended(config('fortify.home'));*/
    }
}
