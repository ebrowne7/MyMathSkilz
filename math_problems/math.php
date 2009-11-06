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
             $result=true;
          }
          break;
	case '*':
          if (($argument1 * $argument2) > $arg_max){
            $result=false;
          }else{
             $result=true;
          }
          break;
	case '/':
             if (($argument2 != 0 ) && (($argument1 / $argument2) > $arg_max) ){
               $result=false;
             }else{
                $result=true;
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
   #echo $argument1.' '.$argument2."\n";
   
   while(!check_problem($argument1,$oper,$argument2,$arg_min,$arg_max)){
      $argument1 = get_new_number($arg_min,$arg_max);
      $argument2 = get_new_number($arg_min,$arg_max);
      
   }
   display_math_problem($argument1,$oper,$argument2);

}

function display_math_problem($argument1,$oper,$argument2){

   echo "<table>"
	."<tr><td> ";
   for($i = 0;$i< $argument1;$i++){
      echo "<img src=img/penguin.gif height=50 width=50>";
   }
   echo "</td><td></td><td>";
   for($i = 0;$i< $argument2;$i++){
      echo "<img src=img/penguin.gif height=50 width=50>";
   }
   echo "</td><td></td></tr><tr><td align=center>";
   echo "$argument1<input type=hidden name=argument1 value=$argument1></td><td align=center> $oper <input type=hidden name=oper value=$oper></td><td align=center> $argument2  <input type=hidden name=argument2 value=$argument2></td><td>=<input type=text name='result' value='' size='5'> </td></tr></table><input type=submit value='submit'>";
}


?>
