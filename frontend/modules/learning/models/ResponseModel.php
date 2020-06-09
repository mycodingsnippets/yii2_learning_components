<?php

namespace frontend\modules\learning\models;

class ResponseModel {

    public $message;
    public $status;
    
    public function send(){
        \Yii::$app->response->statusCode = $this->status;
        return [
            'message' => $this->message
        ];
    }
    
}
