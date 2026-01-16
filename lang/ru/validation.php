<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    */

    'accepted' => 'Поле :attribute должно быть принято.',
    'accepted_if' => 'Поле :attribute должно быть принято, когда :other равно :value.',
    'active_url' => 'Поле :attribute должно быть действительным URL-адресом.',
    'after' => 'Поле :attribute должно быть датой позже :date.',
    'after_or_equal' => 'Поле :attribute должно быть датой позже или равной :date.',
    'alpha' => 'Поле :attribute должно содержать только буквы.',
    'alpha_dash' => 'Поле :attribute может содержать только буквы, цифры, дефисы и подчёркивания.',
    'alpha_num' => 'Поле :attribute может содержать только буквы и цифры.',
    'any_of' => 'Поле :attribute имеет недопустимое значение.',
    'array' => 'Поле :attribute должно быть массивом.',
    'ascii' => 'Поле :attribute должно содержать только ASCII-символы.',
    'before' => 'Поле :attribute должно быть датой раньше :date.',
    'before_or_equal' => 'Поле :attribute должно быть датой раньше или равной :date.',

    'between' => [
        'array' => 'Поле :attribute должно содержать от :min до :max элементов.',
        'file' => 'Размер файла :attribute должен быть от :min до :max КБ.',
        'numeric' => 'Значение поля :attribute должно быть между :min и :max.',
        'string' => 'Длина поля :attribute должна быть от :min до :max символов.',
    ],

    'boolean' => 'Поле :attribute должно иметь значение true или false.',
    'can' => 'Поле :attribute содержит недопустимое значение.',
    'confirmed' => 'Подтверждение поля :attribute не совпадает.',
    'contains' => 'Поле :attribute не содержит обязательного значения.',
    'current_password' => 'Текущий пароль указан неверно.',
    'date' => 'Поле :attribute должно быть корректной датой.',
    'date_equals' => 'Поле :attribute должно быть датой, равной :date.',
    'date_format' => 'Поле :attribute должно соответствовать формату :format.',
    'decimal' => 'Поле :attribute должно содержать :decimal знаков после запятой.',
    'declined' => 'Поле :attribute должно быть отклонено.',
    'declined_if' => 'Поле :attribute должно быть отклонено, когда :other равно :value.',
    'different' => 'Поля :attribute и :other должны отличаться.',
    'digits' => 'Поле :attribute должно содержать :digits цифр.',
    'digits_between' => 'Поле :attribute должно содержать от :min до :max цифр.',
    'dimensions' => 'Поле :attribute имеет недопустимые размеры изображения.',
    'distinct' => 'Поле :attribute содержит повторяющееся значение.',
    'doesnt_contain' => 'Поле :attribute не должно содержать значения: :values.',
    'doesnt_end_with' => 'Поле :attribute не должно заканчиваться на: :values.',
    'doesnt_start_with' => 'Поле :attribute не должно начинаться с: :values.',
    'email' => 'Поле :attribute должно быть корректным email-адресом.',
    'encoding' => 'Поле :attribute должно быть закодировано в :encoding.',
    'ends_with' => 'Поле :attribute должно заканчиваться на: :values.',
    'enum' => 'Выбранное значение поля :attribute недопустимо.',
    'exists' => 'Выбранное значение поля :attribute недопустимо.',
    'extensions' => 'Файл :attribute должен иметь одно из расширений: :values.',
    'file' => 'Поле :attribute должно быть файлом.',
    'filled' => 'Поле :attribute должно быть заполнено.',

    'gt' => [
        'array' => 'Поле :attribute должно содержать больше :value элементов.',
        'file' => 'Размер файла :attribute должен быть больше :value КБ.',
        'numeric' => 'Значение поля :attribute должно быть больше :value.',
        'string' => 'Длина поля :attribute должна быть больше :value символов.',
    ],

    'gte' => [
        'array' => 'Поле :attribute должно содержать :value или более элементов.',
        'file' => 'Размер файла :attribute должен быть не меньше :value КБ.',
        'numeric' => 'Значение поля :attribute должно быть не меньше :value.',
        'string' => 'Длина поля :attribute должна быть не меньше :value символов.',
    ],

    'hex_color' => 'Поле :attribute должно быть корректным HEX-цветом.',
    'image' => 'Поле :attribute должно быть изображением.',
    'in' => 'Выбранное значение поля :attribute недопустимо.',
    'in_array' => 'Поле :attribute должно существовать в :other.',
    'integer' => 'Поле :attribute должно быть целым числом.',
    'ip' => 'Поле :attribute должно быть корректным IP-адресом.',
    'ipv4' => 'Поле :attribute должно быть корректным IPv4-адресом.',
    'ipv6' => 'Поле :attribute должно быть корректным IPv6-адресом.',
    'json' => 'Поле :attribute должно быть корректной JSON-строкой.',
    'lowercase' => 'Поле :attribute должно быть в нижнем регистре.',

    'max' => [
        'array' => 'Поле :attribute не должно содержать более :max элементов.',
        'file' => 'Размер файла :attribute не должен превышать :max КБ.',
        'numeric' => 'Значение поля :attribute не должно превышать :max.',
        'string' => 'Длина поля :attribute не должна превышать :max символов.',
    ],

    'min' => [
        'array' => 'Поле :attribute должно содержать минимум :min элементов.',
        'file' => 'Размер файла :attribute должен быть не меньше :min КБ.',
        'numeric' => 'Значение поля :attribute должно быть не меньше :min.',
        'string' => 'Длина поля :attribute должна быть не меньше :min символов.',
    ],

    'numeric' => 'Поле :attribute должно быть числом.',
    'present' => 'Поле :attribute должно присутствовать.',
    'regex' => 'Поле :attribute имеет неверный формат.',
    'required' => 'Поле :attribute обязательно для заполнения.',
    'same' => 'Поле :attribute должно совпадать с :other.',
    'string' => 'Поле :attribute должно быть строкой.',
    'timezone' => 'Поле :attribute должно быть корректным часовым поясом.',
    'unique' => 'Такое значение поля :attribute уже существует.',
    'uploaded' => 'Не удалось загрузить файл :attribute.',
    'uppercase' => 'Поле :attribute должно быть в верхнем регистре.',
    'url' => 'Поле :attribute должно быть корректным URL.',
    'uuid' => 'Поле :attribute должно быть корректным UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    */

    'attributes' => [
        'site_name' => 'Название сайта',
        'site_short_name' => 'Короткое название сайта',
        'site_url' => 'Адрес сайта',
        'site_description' => 'Описание сайта',
        'site_keywords' => 'Ключевые слова',
        'site_offline' => 'Режим обслуживания',
    ],

];
