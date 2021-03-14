<?php

namespace common\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\helpers\HtmlPurifier;

/**
 * This is the model class for table "Company".
 *
 * @property int $id
 * @property string $name
 * @property string|null $country
 * @property string|null $vat_id
 * @property int $fk_user
 */
class Company extends ActiveRecord
{

    public static function getCountries():array
    {
        return ['SK' => 'Slovakia', 'CZ' => 'Czech republic', 'UK' => 'United Kingdom', 'RU' => 'Russia', 'PL'=> 'Poland'];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName():string
    {
        return '{{%company}}';
    }

    /**
     * @return ActiveQuery
     */
    public function getUser(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'fk_user']);
    }

    public function getOwnerName(){
        return $this->getUser()->pro;
    }
    /**
     * {@inheritdoc}
     */
    public function rules():array
    {
        return [
            [['name', 'fk_user'], 'required'],
            [['fk_user'], 'integer'],
            [['name', 'country'], 'string', 'max' => 255],
            ['name', 'trim'],
            ['name','filter','filter' => function($attribute){
                return HtmlPurifier::process($attribute);
            }, 'skipOnArray' => false],
            [['country'], 'in', 'range' => array_keys(self::getCountries()), 'strict' => true],
            [['vat_id'], 'string', 'max' => 40],
            [['vat_id'], 'match', 'pattern' => '/^SK[0-9]{10}$/','message' => 'Please input valid format.Check whether ALL letters are capitalized AND there are EXACTLY 10 digits.'],
            ['vat_id','unique','message' => 'Such Vat Id is already in the system. Please input a different one.'],
            [['fk_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['fk_user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels():array
    {
        return [
            'id' => 'ID',
            'name' => 'Company name',
            'country' => 'Country',
            'vat_id' => 'Vat ID',
            'fk_user' => 'Owner',
        ];
    }
}
