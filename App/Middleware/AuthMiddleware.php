<?php

namespace App\Middleware;

use App\Dao\UserDao;
use Closure;
use Core\Providers\Factory;
use Core\Services\Middleware;

class AuthMiddleware extends Middleware
{
    public function handle($request, Closure $next)
    {
        $token = Factory::header()->token;

        if (empty($token)) {
            Factory::header()->setCode(401);
            $request->Error = 'Token de acesso não informado';
            return $request;
        }
        
        $userDao = UserDao::getInstance();
        $UserModel = $userDao->fetch(['token' => $token]);
        
        if (empty($UserModel)) {
            Factory::header()->setCode(401);
            $request->Error = 'Token de acesso inválido';
            return $request;
         }
        
        return $next($request);
    }
}
