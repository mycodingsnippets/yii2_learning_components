<?php

namespace frontend\modules\learning\models;

use yii;

class RequestFormModel extends yii\base\Model{

    public $name;
    public $email;
    
    public function rules() {
    
        return [
            [['name', 'email'], 'required'],
            ['email','email']
        ];
        
    }
    
}
