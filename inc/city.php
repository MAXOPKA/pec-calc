<?php
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
?>