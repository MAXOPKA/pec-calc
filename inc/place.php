<?php
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