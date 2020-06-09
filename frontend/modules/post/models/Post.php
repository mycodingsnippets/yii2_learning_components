<?php

namespace frontend\modules\post\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property string $title
 * @property string $text
 * @property string $slug
 * @property string|null $image
 * @property string $created_at
 * @property string $updated_at
 */
class Post extends \yii\db\ActiveRecord
{
    
    public $imageFile;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post';
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
            ],
            [
                'class'=> \yii\behaviors\SluggableBehavior::className(),
                'attribute' => 'title'
            ]
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'text'], 'required'],
            [['text'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'image'], 'string', 'max' => 255],
            [['slug'], 'string', 'max' => 512],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions'=>'png,jpg,jpeg']
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
            'text' => 'Text',
            'slug' => 'Slug',
            'image' => 'Image',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    
    public function getPreview(){
        $words = 60;
        
        if(\yii\helpers\StringHelper::countWords($this->text) > $words){
            return \yii\helpers\StringHelper::truncateWords($this->text, $words);
        }
        
        return $this->text;
    }
    
    public function uploadAndSave(){
        if($this->validate()){
            if(isset($this->imageFile)){
                $this->image = 'uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension;
                $this->imageFile->saveAs($this->image);
                
            }
            
            return $this->save(false);
        }
        return false;
    }
}
