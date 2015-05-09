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

?>