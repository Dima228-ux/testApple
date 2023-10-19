<?php


namespace common\models;


use common\models\Lib\Model;

class AppleForm extends Model
{


    public $color;
    public $dateAppearance;
    public $dateFall;
    public $status;
    public $percentEat;
    public $percent;
    public $id;
    /**
     *  constructor.
     *
     * @param Apple $apple
     */

    public function __construct(Apple $apple)
    {
        parent::__construct($apple);
        $this->setAttributes($this->_entity->getAttributes(), false);

    }

    public function save()
    {
//
//        if (!$this->validate()) {
//            return false;
//        }

        /** @var Apple $apple */
        $apple = $this->_entity;


        $apple->color = $this->color;
        $apple->date_appearance = $this->dateAppearance;
        $apple->status = $this->status;
        $apple->date_fall = $this->dateFall;
        $apple->percent_eat = $this->percentEat;

        if($apple->save()){
            return true;
        }
        return false;
    }

    public function generateApple(){
        $count_apple= rand(1,10);

        for ($i=0;$i<$count_apple;$i++){
            $color= rand(1,6);
            $date= mt_rand(1, time());

            $insert_apple[]=[
                $color,
                $date,
                Apple::HANGING_ON_TREE,
                Apple::FULL_APPLE,
            ];
        }
        $count = \Yii::$app->db->createCommand()->batchInsert(Apple::tableName(), ['color', 'date_appearance', 'status', 'percent_eat'],  $insert_apple)->execute();

        if($count>0){
            return true;
        }
        return  false;
    }

    public function updateStatusApple(){
        /** @var Apple $apple */
        $apple = $this->_entity;
        $apple->status=Apple::LYING_ON_GROUND;
        $apple->date_fall=date("Y-m-d H:i:s");
        if($apple->save()){
            return true;
        }
        return false;
    }

    public static function eatingApple($params){
        $percent=$params['percent'];
        $id=$params['id'];
        $date_fall=$params['dateFall'];
        $check=Apple::checkRotten($date_fall);
        if(!$check){
            return false;
        }
        $current_persent=Apple::find()->select(['percent_eat'])->where(['id'=>$id])->one();

        if($current_persent===null){
            return false;
        }

        if($percent>100||$percent<1){
            return false;
        }

        if($percent>$current_persent['percent_eat']||$percent==$current_persent['percent_eat']){
            $count=Apple::deleteAll(['id'=>$id]);
            if ($count>0){
                return true;
            }
        }
        $remain_percent=$current_persent['percent_eat']-$percent;
        $where = ['id' => $id];
       $count= Apple::updateAll(['`percent_eat`'=>$remain_percent],$where);
       if ($count>0){
           return  true;
       }
       return false;
    }
}