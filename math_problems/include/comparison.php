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



function gen_new_comparison_problem($arg_min,$arg_max,$oper,$doubles=false,$nf=true,$word=false){
   if($word){
      $_SESSION['wordproblem']=true;
   }else{
      if(isset($_SESSION['wordproblem'])){
         unset($_SESSION['wordproblem']);  
      }

   }
   $argument1 = get_new_number($arg_min,$arg_max);
   if (!$doubles){
      $argument2 = get_new_number($arg_min,$arg_max);
   }else{
      $argument2 = $argument1;
   }
   #echo $argument1.' '.$argument2."\n";
   
   while(!check_problem($argument1,$oper,$argument2,$arg_min,$arg_max)){
      $argument1 = get_new_number($arg_min,$arg_max);
      if(!$doubles){
         $argument2 = get_new_number($arg_min,$arg_max);
      }else{
         $argument2 = $argument1; 
      }
      
   }
   if(!$word){
      display_comparison_problem($argument1,$oper,$argument2,$nf);
   }else{
      display_comparison_problem($argument1,$oper,$argument2,$nf);
   }

}

function display_comparison_problem($argument1,$oper,$argument2,$nf=false){
   $_SESSION['argument1']=$argument1;
   $_SESSION['argument2']=$argument2;
   $img = get_image($oper);
   $randimg = $img[rand(0,count($img)-1)];
   $info = pathinfo($randimg);
   $img_name=basename($randimg,'.'.$info['extension']);
 
   preg_match('/[A-z]+/',$img_name,$matches);
   $img_name = $matches[0];
   if ($argument1 > 1){
      $img_name.="s";
   }

   echo "There are $argument1 $img_name in the room and $argument2 more come in. How many $img_name in all?
   <table width=440px border=0 valign=top cellpadding=0 cellspacing=0>
	<tr valign=top>";

   if($oper == '+'){
      echo "<td > ";
   }else{
      if($nf){
      echo "<td colspan =5>";
      }else{
      echo "<td >";
      }
   }

   if($nf){
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
   }else{
   echo "</td><td>$argument1</td></tr><tr><td>$oper</td><td>$argument2</td></tr><tr><td colspan=2><hr></td></tr><td colspan=2>";
   }
if($nf){
if($oper == '+'){
   echo "</td><td >&nbsp;</td><td>&nbsp;</td></tr><tr ><td align=center>
   <input type=text size=5 name=rargument1 ></td><td align=center> $oper <input type=hidden name=oper value=$oper></td><td align=center> <input type=text name=rargument2 size=5></td><td>=</td><td><input type=text name='result' value='' size='5'> </td></tr></table><input type=submit value='submit'>";
}else{
   echo "</td></tr><tr ><td align=center>
   <input type=text name=rargument1 size=5></td><td align=center> $oper <input type=hidden name=oper value=$oper></td><td align=center> <input type=text name=rargument2 size=5></td><td>=</td><td><input type=text name='result' value='' size='5'> </td></tr></table><input type=submit value='submit'>";
}
}else{
   echo " <input type=text name=rargument1 size=5><input type=hidden name=oper value=$oper><input type=text name=rargument2 size=5><input type=text name='result' value='' size='5'> </td></tr></table><br><input type=submit value='submit'>";

}

}

function display_comparison_problem($argument1,$oper,$argument2,$nf=true){
   $img = get_image($oper);
   $randimg = $img[rand(0,(count($img) - 1))];
   if($randimg == '' ){
      $randimg='blank.gif';
   }

   if($nf){
   echo "<table width=440px border=0 valign=top cellpadding=0 cellspacing=0>
	<tr valign=top>";
   }else{
   echo "<table border=0 valign=top cellpadding=0 cellspacing=0>
	<tr valign=top>";

   }

   if($oper == '+'){
      echo "<td > ";
   }else{
      if($nf){
      echo "<td colspan =5>";
      }else{
      echo "<td >";
      }
   }

   if($nf){
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
   }else{
   echo "</td><td>$argument1</td></tr><tr><td>$oper</td><td>$argument2</td></tr><tr><td colspan=2><hr></td></tr><td colspan=2>";
   }
if($nf){
if($oper == '+'){
   echo "</td><td >&nbsp;</td><td>&nbsp;</td></tr><tr ><td align=center>
   $argument1<input type=hidden name=argument1 value=$argument1></td><td align=center> $oper <input type=hidden name=oper value=$oper></td><td align=center> $argument2  <input type=hidden name=argument2 value=$argument2></td><td>=</td><td><input type=text name='result' value='' size='5'> </td></tr></table><input type=submit value='submit'>";
}else{
   echo "</td></tr><tr ><td align=center>
   $argument1<input type=hidden name=argument1 value=$argument1></td><td align=center> $oper <input type=hidden name=oper value=$oper></td><td align=center> $argument2  <input type=hidden name=argument2 value=$argument2></td><td>=</td><td><input type=text name='result' value='' size='5'> </td></tr></table><input type=submit value='submit'>";
}
}else{
   echo " <input type=hidden name=argument1 value=$argument1><input type=hidden name=oper value=$oper><input type=hidden name=argument2 value=$argument2><input type=text name='result' value='' size='5'> </td></tr></table><br><input type=submit value='submit'>";

}

}

function verifyComparisonResult(){
   if(isset($_POST['argument1']) || isset($_POST['rargument1'])){
      switch($_POST['oper']){
         case '+': 
               if($_SESSION['num_questions'] > 0){
                  if(isset($_SESSION['wordproblem'])){
                     if(($_SESSION['argument1'] == $_POST['rargument1']) && ($_SESSION['argument2'] == $_POST['rargument2'])&& (($_SESSION['argument1'] + $_SESSION['argument2']) == $_POST['result'])){
                        $_SESSION['correct']++;
                        $_SESSION['iscorrect'] = true;
                     }else{
                        $_SESSION['incorrect']++;
                        $_SESSION['iscorrect'] = false;
                     }
                     #Count down the questions as they are answered.
                     $_SESSION['num_questions']--;

                  }else{
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
               }
            break;
	 case '-':
               if($_SESSION['num_questions'] > 0){
                  if(isset($_SESSION['wordproblem'])){
                     if(($_SESSION['argument1'] == $_POST['rargument1']) && ($_SESSION['argument2'] == $_POST['rargument2'])&& (($_SESSION['argument1'] - $_SESSION['argument2']) == $_POST['result'])){
                        $_SESSION['correct']++;
                        $_SESSION['iscorrect'] = true;
                     }else{
                        $_SESSION['incorrect']++;
                        $_SESSION['iscorrect'] = false;
                     }
                     #Count down the questions as they are answered.
                     $_SESSION['num_questions']--;

                  }else{

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
               }
            
            break;
         default:
            break;
      }      


   }

}
?>
