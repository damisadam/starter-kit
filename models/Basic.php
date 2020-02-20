<?php
/**
 * Created by PhpStorm.
 * User: sadamhussain
 * Date: 8/6/19
 * Time: 4:16 PM
 */
namespace app\models;
use phpDocumentor\Reflection\Types\Null_;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Exception;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

class Basic extends \yii\db\ActiveRecord
{
    public $active_status=1;
    public $inactive_status=1;
    public $delete_status=1;

    const active_status=1;
    const inactive_status=2;
    const page_limit=3;


    public function behaviors()
    {
        return [
            [
                'class' => BlameableBehavior::className(),
            ],
            [
                'class' => TimestampBehavior::className(),
                'value' => date('Y-m-d H:i:s')
            ],
        ];
    }

    public function beforeSave($insert)
    {

        if (parent::beforeSave($insert)) {
            if(empty($this->updated_by) || $this->updated_by===null)
            $this->updated_by=0;
            if(empty($this->created_by) || $this->created_by===null)
            $this->created_by=0;

            return true;
        } else {
            return false;
        }
    }



    public function getRowStatus(){
        return $this->status_array[$this->status];
    }



    public function getCreated(){
        return $this->hasOne(User::className(),['id'=>'created_by']);
    }
    public function getUpdated(){
        return $this->hasOne(User::className(),['id'=>'updated_by']);
    }


    //Images upload to local
    public function uploadImage($attribute,$path,$old_image=''){

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        $image = UploadedFile::getInstance($this, $attribute);

        if ($image!=null) {
            $imageName = \Yii::$app->security->generateRandomString(7) . "_" . time().'.'.$image->extension;

            $this->{$attribute}=$imageName;
            $image->saveAs($path.$this->{$attribute});
            $this->save();
            @unlink($path.$old_image);
        }else{
            $this->{$attribute}=$old_image;
            $this->save();
        }

    }


}