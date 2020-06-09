<?php

namespace frontend\modules\notes\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $name
 * @property int|null $parent_id
 * @property int|null $status
 *
 * @property Category $parent
 * @property Category[] $categories
 * @property Notes[] $notes
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['parent_id', 'status'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['parent_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'parent_id' => 'Parent ID',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[Parent]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Category::className(), ['id' => 'parent_id']);
    }

    

    /**
     * Gets query for [[Notes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotes()
    {
        return $this->hasMany(Notes::className(), ['category_id' => 'id']);
    }
    
    public function getAllCategory(){
        return Category::find()
                ->andWhere(['status' => 1])
                ->asArray()
                ->all();
    }
    
    public $data;

    public function getCategoryParent($parent = NULL, $level = ""){
        $result = Category::find()
                    ->asArray()
                    ->andWhere(['parent_id'=>$parent])
                    ->all();
        
        $level .= "-";
        
        foreach ($result as $key=>$value){
            if($parent == NULL){
                $level = "";
            }
            
            $this->data[$value['id']] = $level . $value['name'];
            
            self::getCategoryParent($value['id'], $level);
        }
        
        return $this->data;
    }
}
