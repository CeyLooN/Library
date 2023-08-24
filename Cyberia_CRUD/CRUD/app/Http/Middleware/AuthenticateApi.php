<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class AuthenticateApi extends Middleware
{
    protected function authenticate($request, array $guards)
    {
        //Даем пользователю возможность передать токен (api-ключ) разными способами
        //1. в адресе запроса
        $token = $request->query('api_token');
        if (empty($token)) {
            //2. Через url-form-encoded поля POST запроса
            $token = $request->input('api_token');
        }
        if (empty($token)) {
            //3. Через заголовок Authorization: Bearer ......
            $token = $request->bearerToken();
        }

        //Сравниваем токен с тем, что хранится в наших настройках. Здесь можно заменить логику на свою. Например сделать поиск токена в базе
        if ($token === config('apitokens')[0]) return;
        //В случае неуспеха, вызываем метод сообщающий о статусе "Неавторизован"
        $this->unauthenticated($request, $guards);

    }
}
