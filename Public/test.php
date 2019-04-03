<?php
echo '<pre>';
$arr=['123','567'];


//[$a1,$a2]=$arr;
//var_dump([$arr]);
//var_dump($a1);
//var_dump($a2);

$f = function ($a,$b){
    echo "$a , $b";
};

call_user_func_array($f,$arr);

//
//$arrayCount=count($arr);
//for($i=0;$i<$arrayCount;$i++){
//   $arrayOfVariables+=["v$i"=>$arr[$i]];
//}
//
//extract($arrayOfVariables);
//$keys = array_keys($arrayOfVariables);
//
//
//
//var_dump($v0);
//var_dump($v1);
//var_dump($v2);
