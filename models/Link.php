<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "links".
 *
 * @property int $link_id
 * @property string $url
 * @property string $short_url
 * @property int|null $clicks
 * @property string|null $created_at
 *
 * @property User[] $users
 */
class Link extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'links';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['clicks'], 'default', 'value' => 0],
            [['url', 'short_url'], 'required'],
            [['clicks'], 'integer'],
            [['created_at'], 'safe'],
            [['url', 'short_url'], 'string', 'max' => 255],
            [['short_url'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'link_id' => 'Link ID',
            'url' => 'Url',
            'short_url' => 'Short Url',
            'clicks' => 'Clicks',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::class, ['link_id' => 'link_id']);
    }

}
