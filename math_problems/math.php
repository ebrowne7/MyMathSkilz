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
          if ((($argument1 - $argument2) < $arg_max) && (($argument1 - $argument2) > $arg_min)){
            $result=true;
          }else{
             $result=false;
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
             if (($argument2 !== 0 ) && (($argument1 / $argument2) > $arg_max) ){
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

function get_image($oper){
   switch($oper){
      case '+':
         $dir ="img/add";
         break;
      case '-':
	 $dir="img/sub";
         break;
      default:
         break;
   }

   $ignore = array('.','..');
   if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while(($file = readdir($dh)) !== false) {
            if(!is_dir($file)){
               if(!in_array($file,$ignore,TRUE)){
                  if($file !== NULL){
                     $img[]=  $file;
                  }
               }
            }
        }
        closedir($dh);
        #for($i=0;$i<count($img);$i++){
        #   echo "'$img[$i]'<br>";
        #}     
        #echo $i."<br>";
    }
   }
   return $img;
}

function display_math_problem($argument1,$oper,$argument2){
   $img = get_image($oper);
   $randimg = $img[rand(0,(count($img) - 1))];
   if($randimg == '' ){
      $randimg='blank.gif';
   }

   echo "<table width=440px border=0 valign=top cellpadding=0 cellspacing=0>
	<tr valign=top>";

   if($oper == '+'){
      echo "<td > ";
   }else{
      echo "<td colspan =5>";
   }
   
   if(!$_SESSION['noimage']){
      if($argument1 == 0 ){
         echo "<img src='img/blank.gif'>";
      }
      if($oper == '+'){
      for($i = 0;$i< $argument1;$i++){
         echo "<img src='img/add/$randimg' >";
         if (($i !== 0) && (($i+1) % 5) ==0){ 
            echo "<br/>";
         }
      }
      }else{
         $result = $argument1 - $argument2;
         for($i=0; $i< $result; $i++){
             echo "<img src='img/add/$randimg' >";
            if (($i !== 0) && (($i+1) % 5) ==0){ 
               echo "<br/>";
            }
         }
         for($i=0; $i< $argument2; $i++){
             echo "<img src='img/sub/$randimg' >";
            if (($i !== 0) && (($i+1) % 5) ==0){ 
               echo "<br/>";
            }
         }
         

      }
      echo "</td><td ><img src='img/blank.gif'></td><td >";
      if($argument2 == 0 ){
         echo "<img src='img/blank.gif'>";
      }
      if($oper == '+'){
         for($i = 0;$i< $argument2;$i++){
            echo "<img src='img/add/$randimg' >";
            if (($i !== 0) && (($i+1) % 5) ==0){
               echo "<br/>";
            }
         }
      }
   }else{
      echo "</td><td ><img src='img/blank.gif'></td><td >";
   }

if($oper == '+'){
   echo "</td><td >&nbsp;</td><td>&nbsp;</td></tr><tr ><td align=center>
   $argument1<input type=hidden name=argument1 value=$argument1></td><td align=center> $oper <input type=hidden name=oper value=$oper></td><td align=center> $argument2  <input type=hidden name=argument2 value=$argument2></td><td>=</td><td><input type=text name='result' value='' size='5'> </td></tr></table><input type=submit value='submit'>";
}else{
   echo "</td></tr><tr ><td align=center>
   $argument1<input type=hidden name=argument1 value=$argument1></td><td align=center> $oper <input type=hidden name=oper value=$oper></td><td align=center> $argument2  <input type=hidden name=argument2 value=$argument2></td><td>=</td><td><input type=text name='result' value='' size='5'> </td></tr></table><input type=submit value='submit'>";
}

}


function display_progress(){
   echo "Correct: ".$_SESSION['correct']."<br/>
   Incorrect: ".$_SESSION['incorrect']."</br>
   Percentage: ";
 if(($_SESSION['correct'] + $_SESSION['incorrect'] ) == 0){
   echo '0';
 }else{
   echo ($_SESSION['correct'] / ($_SESSION['correct'] + $_SESSION['incorrect'] )*100);
 }
}

function mySession(){
   if (isset($_REQUEST['num_questions']) && !isset($_SESSION['num_questions'])){
      $_SESSION['num_questions'] = $_REQUEST['num_questions'];
      $_SESSION['correct'] = 0;
      $_SESSION['incorrect'] =0;
   }

   if(!isset($_SESSION['num_questions'])){
      $_SESSION['num_questions'] = 10;
      $_SESSION['correct'] = 0;
      $_SESSION['incorrect'] =0;
   }
}

function verifyResult(){
   if(isset($_POST['argument1'])){
      switch($_POST['oper']){
         case '+': 
               if($_SESSION['num_questions'] > 0){
                  if($_POST['argument1'] + $_POST['argument2'] == $_POST['result']){
                     $_SESSION['correct']++;
                     $_SESSION['iscorrect'] = true;
                  }else{
                     $_SESSION['incorrect']++;
                     $_SESSION['iscorrect'] = false;
                  } 
                  #Count down the questions as they are answered.
                  $_SESSION['num_questions']--;
               }
            break;
	 case '-':
               if($_SESSION['num_questions'] > 0){
                  if($_POST['argument1'] - $_POST['argument2'] == $_POST['result']){
                     $_SESSION['correct']++;
                     $_SESSION['iscorrect'] = true;
                  }else{
                     $_SESSION['incorrect']++;
                     $_SESSION['iscorrect'] = false;
                  } 
                  #Count down the questions as they are answered.
                  $_SESSION['num_questions']--;
               }
            
            break;
         default:
            break;
      }      


   }

}
?>
