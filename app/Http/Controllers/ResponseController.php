<?php

namespace App\Http\Controllers;

class ResponseController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($message, $data, $code = 200)
    {
        $response = [
            'success' => true,
            'message' => $message,
            'data'    => $data,
        ];
  
        return response()->json($response, $code);
    }
  
    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($message, $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $message,
        ];
  
        return response()->json($response, $code);
    }
}
