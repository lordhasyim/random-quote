<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 22/12/2017
 * Time: 14.53
 */
namespace App\Http\Middleware;

use App\Http\Controllers\ApiController;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\JWTAuth;
use Closure;

class AuthJWT extends ApiController
{

    /**
     * Handle incoming request
     *
     * @param $request
     * @param Closure $next
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return $this->_restTemplate(
                    self::HTTP_BAD_REQUEST,
                    false,
                    'User Not found'
                );
            }
        } catch(TokenExpiredException $e) {
            return $this->_restTemplate(
                $e->getStatusCode(),
                false,
                'Token Expired'
            );
        } catch(TokenInvalidException $e) {
            return $this->_restTemplate(
                $e->getStatusCode(),
                false,
                'Token Invalid'
            );
        } catch (JWTException $e) {
            return $this->_restTemplate(
                $e->getStatusCode(),
                false,
                'Token Not Provide'
            );
        }

        return $next($request);
    }
}
