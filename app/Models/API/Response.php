<?php

namespace App\Models\API;

class Response
{
  public static function success($data, $message = '')
  {
    return [
      'status' => 'success',
      'message' => $message,
      'data' => $data
    ];
  }

  public static function failed($error, $message = '')
  {
    return [
      'status' => 'failed',
      'message' => $message,
      'error' => $error
    ];
  }
}
