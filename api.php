<?php
/**
 * Реализация API
 */
class PecAPI{
    var $url;
    function __construct($url) {
        $this->url=$url;
    }
    public function getCitiesList(){
        $out=array();
        $ch=curl_init($this->url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,TRUE);
        $out=curl_exec($ch);
        if($out!=''){
            $out=  json_decode($out,ARRAY_A);
        }
        return $out;
    }
    public function searchCity($q_string,$limit=10){
        $cities=$this->getCitiesList();
        $out=array();
        if(mb_strlen($q_string)>2){
            $l=mb_strlen($q_string)/2;
            foreach ($cities as $region){
                  if(is_array($region)){
                      foreach ($region as $key=>$city){
                        if(mb_stripos(mb_strtolower($city,'utf-8'),mb_strtolower($q_string,'utf-8'))!==FALSE){
                            $c['label']=$city;
                            $c['value']= $city;
                            $c['id']=$key;
                            $out[$c['id']]=$c;
                            if(count($out)>=$limit){
                                $out=array_reverse($out);
                                return  $out;
                            }
                        }
                      }
                  }
            }
            $out=array_reverse($out);
            return  $out;
        }
    }
    public function pecCalc($params){
        $s_params=new PecParams($params);
        $encoded_params=http_build_query($s_params->getParams());
        $ch=curl_init($this->url.'?'.$encoded_params);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,TRUE);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $encoded_params);
        $out=curl_exec($ch);
        return $out;
    }
}
/**
 * Параметры для города забора/доставки
 */
abstract class PecCity{
    var $town;
    var $tent;
    var $gidro;
    var $speed;
    var $moscow;
    private $error_desc;

    public function __construct($params) {
        $this->town=$params['town'];
        $this->tent=$params['tent'];
        $this->gidro=$params['gidro'];
        $this->speed=$params['speed'];
        $this->moscow=$params['moscow'];
    }
    public function getParams(){
        $out=array();
        $out['town']=  (int)$this->town;
        $out['tent']=  (int)$this->tent;
        $out['gidro']=  (int)$this->gidro;
        $out['speed']=  (int)$this->speed;
        $out['moscow']=  (int)$this->moscow;
        return $out;
    }
    public function validate(){
        $errors=array();
        if(!$this->town){$errors[]='Укажите город '.$this->error_desc;}
    }
}
class PecDeliver extends PecCity{
    var $error_desc='доставки';
}
class PecTake extends PecCity{
    var $error_desc='забора';
}
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
class PecPlace{
    var $weight;
    var $length;
    var $width;
    var $height;
    var $volume;
    var $very_big;
    var $zu;
    
    public function __construct($weight=0.5,$length,$width,$height,$volume,$zu,$very_big) {
        $this->weight=$weight;
        $this->length=$length;
        $this->width=$width;
        $this->height=$height;
        $this->volume=$volume;
        $this->very_big=$very_big;
        $this->zu=$zu;
        
    }
    public function getParams(){
        $out=array();
        $out[0]=(float)$this->width;
        $out[1]=(float)$this->length;
        $out[2]=(float)$this->height;
        $out[3]=(float)$this->volume;
        $out[4]=(float)$this->weight;
        $out[5]=(int)$this->very_big;
        $out[6]=(int)$this->zu;
        return $out;
    }
}
?>