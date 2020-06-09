<?php

namespace frontend\modules\learning\models;

use Yii;

/**
 * This is the model class for table "testing".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $data
 * @property int|null $status
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int|null $createdBy
 *
 * @property User $createdBy0
 */
class Testing extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'testing';
    }
    
    public function behaviors() {
        return [
            [
                'class' => \yii\behaviors\TimestampBehavior::className(),
                'attributes' => [
                      \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                      \yii\db\ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at']
                ],
                'value' => new \yii\db\Expression('NOW()')
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['data'], 'string'],
            [['status', 'createdBy'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['createdBy'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\User::className(), 'targetAttribute' => ['createdBy' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'data' => 'Data',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'createdBy' => 'Created By',
        ];
    }

    /**
     * Gets query for [[CreatedBy0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy0()
    {
        return $this->hasOne(User::className(), ['id' => 'createdBy']);
    }
    
    public function save($runValidation = true, $attributeNames = null) {
        $this->createdBy = Yii::$app->user->id;
        
        $saved = parent::save($runValidation, $attributeNames);
        
        if(!$saved){
            return false;
        }
        
        return true;
    }
}
