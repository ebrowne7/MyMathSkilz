<?php
function check_problem($argument1, $oper, $argument2, $arg_min, $arg_max){
   $result = false;
   switch($oper){
      case '+':
          if (($argument1 + $argument2) > $arg_max){
             $result=false;
          }else{
             $result=true;
	  }
          break;
       case '-':
          if (($argument1 - $argument2) > $arg_max){
            $result=false;
          }else{
             $result=false;
          }
          break;
      default:
      echo 'Unknown operator';
      
   }  
   return $result;
}

function get_new_number($arg_min,$arg_max){
   return rand($arg_min,$arg_max);
}

function gen_new_problem($arg_min,$arg_max,$oper){
   $argument1 = get_new_number($arg_min,$arg_max);
   $argument2 = get_new_number($arg_min,$arg_max);
   echo $argument1.' '.$argument2."\n";
   
   while(!check_problem($argument1,$oper,$argument2,$arg_min,$arg_max)){
      $argument1 = get_new_number($arg_min,$arg_max);
      $argument2 = get_new_number($arg_min,$arg_max);
      
   }
   echo $argument1.' '.$argument2."\n";

}

echo gen_new_problem(0,10,'+');

?>
