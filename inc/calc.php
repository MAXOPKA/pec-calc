<?php

class PecCalcController{
    var $action;
    var $json;
    var $data;
    
    public function __construct($action_name){
        if(in_array($action_name,  $this->getActions())){
            $this->data=$this->$action_name();
        }
    }
    
    private function getActions(){
        $out=array('getCities','PecCalc');
        return $out;
    }
    private function getCities(){
        $this->json=1;
        $q=$_GET['term'];
        $api=new PecAPI('http://pecom.ru/ru/calc/towns.php');
        $out=$api->searchCity($q);
        return $out;
    }
    private function pecCalc(){
        $this->json=1;
        $params=$_POST;
        $api=new PecAPI('http://pecom.ru/bitrix/components/pecom/calc/ajax.php');
        $data=$api->pekCalc($params);
        $data=  json_decode($data,ARRAY_A);
        ob_start();
        include './view/response.tpl';
        $out['html']=ob_get_clean();
        return $out;
    }
}
?>