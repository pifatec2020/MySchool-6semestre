<?php
if(isset($_POST['option'])){
$size = $option[] = $_POST['option'];
}else {$option = []; $size = 1;}

intval($sz = count($size)).'<br/>';
// $num = intval(1);
// $resp = intval($sz) - $num;   

for($i = 0; $i<$sz; $i++){
    echo $option[0][$i].'<br/>';
    
}
?>


