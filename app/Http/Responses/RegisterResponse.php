<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;

class RegisterResponse implements RegisterResponseContract
{
    public function toResponse($request)
    {
        return back();
        /*return $request->wantsJson()
            ? response()->json(['two_factor' => true])
            : redirect()->intended(config('fortify.home'));*/
    }
}
