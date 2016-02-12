<?php
foreach (glob(dirname(__FILE__)."/inc/*.php") as $filename){
    include $filename;
}

$controller=new PecCalcController($_GET['action_calc']);
if($controller->json){
    echo(json_encode($controller->data));
}else{
    echo($controller->data);
}
?>
