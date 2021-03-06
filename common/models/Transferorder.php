<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\web\IdentityInterface;
use yii\base\NotSupportedException;

/**
 * This is the model class for table "transferorder".
 *
 * @property integer $id
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $lastname
 * @property string $firstname
 * @property string $email
 * @property string $phone
 * @property string $phone1
 * @property string $flightnumber
 * @property string $notes
 * @property string $type
 * @property string $from
 * @property string $to
 * @property string $anotherd
 * @property string $anotherd1
 * @property string $anotherd2
 * @property integer $pickuptime
 * @property integer $car
 * @property integer $amount
 * @property string $currency
 * @property string $return
 * @property integer $seat
 * @property string $gsign
 * @property string $address
 */
class Transferorder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $date;
    public $time;
    public $rdate;
    public $rtime;
    public $fplaceid;
    public $tplaceid;
    public $chauffeurDestPlaceId;
    public $placeStart, $placeEnd, $distance, $duration;
    
    public static function tableName()
    {
        return 'transferorder';
    }
 public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at', 'pickuptime','rpickuptime', 'car', 'amount', 'seat'], 'integer'],
            [['lastname', 'firstname', 'email', 'phone', 'from', 'to', 'pickuptime', 'car', 'amount','date' ,'time'], 'required'],
            [['type', 'return'], 'string'],
            [['type', 'cseat'], 'string'],
            [['lastname', 'firstname', 'email', 'flightnumber', 'gsign'], 'string', 'max' => 45],
            [['phone', 'phone1'], 'string', 'max' => 15],
            [['notes'], 'string', 'max' => 255],
            [['from', 'to', 'anotherd', 'anotherd1', 'anotherd2', 'address','faaddress','raaddress','aaddress','aaddress1','aaddress2'], 'string', 'max' => 100],
            [['currency'], 'string', 'max' => 10],
            [['rdate','rtime'], 'safe'],
            [['reference'],'string','max' => 82],
            [['type', 'return'], 'string'],
             [['type', 'status'], 'string'],
            [['fplaceid', 'tplaceid', 'chauffeurDestPlaceId',
                'placeStart', 'placeEnd', 'distance', 'duration'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('yii', 'ID'),
            'created_at' => Yii::t('yii', 'Created At'),
            'updated_at' => Yii::t('yii', 'Updated At'),
            'lastname' => Yii::t('yii', 'Lastname'),
            'firstname' => Yii::t('yii', 'Firstname'),
            'email' => Yii::t('yii', 'Email'),
            'phone' => Yii::t('yii', 'Phone'),
            'phone1' => Yii::t('yii', 'Phone1'),
            'flightnumber' => Yii::t('yii', 'Flight number'),
            'notes' => Yii::t('yii', 'Notes'),
            'type' => Yii::t('yii', 'Type'),
            'from' => Yii::t('yii', 'From'),
            'to' => Yii::t('yii', 'To'),
            'anotherd' => Yii::t('yii', 'Another destination 1'),
            'anotherd1' => Yii::t('yii', 'Another destination 2'),
            'anotherd2' => Yii::t('yii', 'Another destination 3'),
            'pickuptime' => Yii::t('yii', 'Pickup time'),
            'car' => Yii::t('yii', 'Car'),
            'amount' => Yii::t('yii', 'Amount'),
            'currency' => Yii::t('yii', 'Currency'),
            'return' => Yii::t('yii', 'Return'),
            'seat' => Yii::t('yii', 'Seat'),
            'gsign' => Yii::t('yii', 'Greating sign'),
            'address' => Yii::t('yii', 'Address'),
        ];
    }
    
    public function getAutos()
    {
        return $this->hasMany(Auto::className(), ['id' => 'car']);
    }
     public function getAuto()
    {
        return $this->hasOne(Auto::className(), ['id' => 'car']);
    }
}
