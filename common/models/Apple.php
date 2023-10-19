<?php


namespace common\models;


use DateInterval;
use DateTime;
use yii\db\ActiveRecord;

/**
 * Class Apple
 * @property int $id [int(11)]
 * @property string $color [varchar(255)]
 * @property int $date_appearance       [timestamp]
 * @property int $date_fall       [timestamp]
 * @property bool $status       [tinyint(1)]
 * @property int $percent_eat   [int(11)]

 */
class Apple extends ActiveRecord
{
    public const HANGING_ON_TREE = 0;
    public const LYING_ON_GROUND = 1;
    public const ROTTEN_APPLE = 0;
    public const NOT_ROTTEN_APPLE = 1;

    public const COLOR_GREEN = 1;
    public const COLOR_GOLDEN = 2;
    public const COLOR_YELLOW = 3;
    public const COLOR_WHITE = 4;
    public const COLOR_BLACK = 5;
    public const COLOR_RED = 6;

    public  const FULL_APPLE=100;

    public const  BASE_URL_BACKEND_IMAGE='\backend\web\images\images_apples';

    public static function tableName(): string
    {
        return 'apple';
    }

    /**
     * @param $status
     *
     * @return string|string[]
     */
    public static function getStatuses($status = null)
    {
        $list = [
            self::HANGING_ON_TREE => 'Hanging on the tree',
            self::LYING_ON_GROUND => 'Lying on the ground',
        ];

        return $list[$status] ?? $list;
    }


    /**
     * @param $status
     *
     * @return string|string[]
     */
    public static function getAppleColor($status = null)
    {
        $list = [
            self::COLOR_RED => '\red_apple.png',
            self::COLOR_GREEN => '\green.png',
            self::COLOR_GOLDEN => '\golden_apple.png',
            self::COLOR_YELLOW => '\yellow_apple.png',
            self::COLOR_WHITE => '\white_apple.png',
            self::COLOR_BLACK => '\black_apple.png'
        ];

        return $list[$status] ?? $list;
    }

    public static function checkRotten($date){
        $today_dt = new DateTime('now');
        $rotten_dt = new DateTime($date);
        $rotten_dt->add(new DateInterval('PT5H'));
        if($rotten_dt<$today_dt){
            return self::ROTTEN_APPLE;
        }
        return self::NOT_ROTTEN_APPLE;
    }

}