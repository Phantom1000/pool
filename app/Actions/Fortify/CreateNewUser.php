<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'user_name' => ['required', 'string', 'max:255', 'unique:users,username'],
            'surname' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'patronymic' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'pass' => $this->passwordRules(),
        ])->validate();

        return User::create([
            'username' => $input['user_name'],
            'surname' => $input['surname'],
            'name' => $input['name'],
            'patronymic' => $input['patronymic'],
            'email' => $input['email'],
            'password' => Hash::make($input['pass']),
        ]);
    }
}
