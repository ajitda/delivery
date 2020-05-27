<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($aresponse, $message=null)
    {
        $response['status'] = 'success';
        $response['success'] = true;
        $response['data'] = $aresponse;
        return response()->json($response, 200);
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $code = 404)
    {
        $response = [
            'stausCode'=>$code,
            'status'=>'error',
            'success' => false,
            'error' => $error,
        ];
        return response()->json($response, 200);
    }
}
