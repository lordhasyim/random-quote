<?php
/**
 * Created by PhpStorm.
 * User: hasyim
 * Date: 12/21/17
 * Time: 4:16 PM
 */

namespace App\Traits;

use Illuminate\Http\Request;

trait RestTrait
{
    /**
     * Determines if request is an api call
     *
     * @param Requset $requset
     * @return bool
     */
    protected function isApiCall(Requset $requset)
    {
        return strpos($requset->getUri(), '/api') !== false;
    }
}