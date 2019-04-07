<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "short".
 *
 * @property int $id
 * @property string $url
 * @property string $short_key
 */
class Short extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'short';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['url'], 'required'],
            [['short_key'], 'string'],
            [['url'], 'url'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url' => 'Enter Url:',
            'short_key' => 'Short Key',
        ];
    }

    /*---- Генерация уникального иднтификатора(short_key) взято и публичного доступа в интернете----*/
    /**
     * @return string
     */
    public function shortUrl()
    {
        $letters = 'qwertyuiopasdfghjklzxcvbnm1234567890';
        $count = strlen($letters);
        $intval = time();
        $result = '';
        for ($i = 0; $i < 4; $i++) {
            $last = $intval % $count;
            $intval = ($intval - $last) / $count;
            $result .= $letters[$last];
        }
        return $result;
    }

    // Определение существования ссылки(Url) в базе
    /**
     * @param $url
     * @return bool
     */
    public function notExistUrl($url)
    {
        if (empty($model = Short::find()->andWhere(['url' => $url])->one())) {
            return true;
        }
        return false;
    }
}
