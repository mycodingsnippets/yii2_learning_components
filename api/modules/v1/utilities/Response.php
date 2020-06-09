<?php

namespace api\modules\v1\utilities;

class Response {

    public function send($status, $message){
        \Yii::$app->response->statusCode = $status;
        
        return [
            'message' => $message
        ];
    }
    
}
