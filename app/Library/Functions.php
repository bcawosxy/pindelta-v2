<?php
if (! function_exists('inserttime')) {
    /**
     * 回傳制式時間格式
     * <p>v1.0 2017-06-07</p>
     * @param string $second
     * @return string
     */
    function inserttime($second = null)
    {
        return date('Y-m-d H:i:s', time() + (int)$second);
    }
}

if (! function_exists('json_encode_return')) {
    /**-
     * Ajax呼叫時制式的回傳 return json
     * <p>v1.0 2017-06-07</p>
     * @param number $result
     * @param string $message
     * @param string $redirect
     * @param string /array $data
     * @return response;
     */
    function json_encode_return($result, $message = null, $redirect = null, $data = null)
    {
        $return = [];
        $return['status'] = $result;
        switch ($result) {
            case 0 :
                $HttpStatus = 401;
                break;
            case 1 :
                $HttpStatus = 200;
                break;
        }
        if ($message !== null) $return['message'] = $message;
        if ($redirect !== null) $return['redirect'] = $redirect;
        if ($data !== null) $return['data'] = $data;

        return response(json_encode($return), $HttpStatus)->header('Content-Type', 'application/json');
    }
}