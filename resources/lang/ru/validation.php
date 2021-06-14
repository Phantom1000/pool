<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'required' => 'Заполните :attribute.',
    'string' => 'Поле :attribute должно быть строкой.',
    'unique' => 'attribute уже используется.',
    'max' => [
        'string' => 'Длина :attribute не может быть больше :max',
    ],
    'email' => ':attribute должен быть действительным адресом электронной почты.',
    'confirmed' => 'Подтверждение :attribute не совпадает.',
    'date_format' => 'Поле :attribute должно быть корректной датой или временем.',
    'after' => 'Поле :attribute не может быть позже :date.',
    'numeric' => 'Поле :attribute должно быть числом.',
    'min' => [
        'numeric' => 'Поле :attribute не может быть меньше :min.',
    ],


    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'surname' => 'Фамилия',
        'firstname' => 'Имя',
        'patronymic' => 'Отчество',
        'password' => 'Пароль',
        'pass' => 'Пароль',
        'name' => 'Имя пользователя',
        'username' => 'Имя пользователя',
    ],

];
