<?php
class PecParams{
    var $take;
    var $deliver;
    var $places=array();
    var $fast=0;
    var $plombir=0;    //Количество пломб
    var $strah=0;	//Величина страховки
    var $ashan=0;       //Доставка в Ашан
    var $night=0;       //Забор в ночное время
    var $pal=0;         //Требуется запаллечивание груза (0 - не требуется, значение больше нуля - количество паллет)
    var $pallets=0;     //Кол-во паллет для расчет услуги паллетной перевозки (только там, где эта услуга предоставляется)
    
    public function __construct($params) {
        $this->take=new PecTake($params['take']);
        $this->deliver=new PecDeliver($params['deliver']);
        if($params['places_cnt']>0){
            $place=$params['place'];
            for($i=0;$i<$params['places_cnt'];$i++){
                $this->places[]=new PecPlace($place['weight'],$place['length'],$place['width'],$place['height'],$place['volume'],$place['zu'],$place['very_big']);
            }
        }
        $this->plombir=(int)$params['plombir'];
        $this->strah=(int)$params['strah'];
        $this->ashan=(int)$params['ashan'];
        $this->night=(int)$params['night'];
        $this->pal=(int)$params['pal'];
        $this->pallets=(int)$params['pallets'];
    }
    public function getParams(){
        $out=array();
        foreach ($this->places as $place){
            $out['places'][]=$place->getParams();
        }
        $out['take']=$this->take->getParams();
        $out['deliver']=$this->deliver->getParams();
        $out['plombir']=(int)$this->plombir;
        $out['strah']=(int)$this->strah;
        $out['ashan']=(int)$this->ashan;
        $out['night']=(int)$this->night;
        $out['pallets']=(int)$this->pallets;
        $out['fast']=(int)$this->fast;
        return $out;
    }
}

?>