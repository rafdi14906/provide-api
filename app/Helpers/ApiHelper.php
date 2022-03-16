<?php
namespace App\Helpers;

class ApiHelper {

    public function makeResponse($status, $message, $total_data = 0, $data = [])
    {
        return ['status' => $status, 'message' => $message, 'total_data' => $total_data, 'data' => $data];
    }

}
