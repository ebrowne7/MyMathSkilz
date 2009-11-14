<?php
function gen_new_odd_even_problem($arg_min,$arg_max){
   $argument1 = get_new_number($arg_min,$arg_max);
   #echo $argument1.' '.$argument2."\n";
   
   display_odd_even_problem($argument1);

}

function display_odd_even_problem($argument1){
   $img = get_image('+');
   $randimg = $img[rand(0,(count($img) - 1))];
   if($randimg == '' ){
      $randimg='blank.gif';
   }

   echo "<table border=0 valign=top cellpadding=0 cellspacing=0>
	<tr valign=top>";

      echo "<td > ";
   
      if($argument1 == 0 ){
         echo "<img src='img/blank.gif'>";
      }
      for($i = 0;$i< $argument1;$i++){
         echo "<img src='img/add/$randimg' >";
         if (($i !== 0) && (($i+1) % 2) ==0){ 
            echo "</td><td>&nbsp;&nbsp;</td><td>";
         }
      }
      echo "</td></tr></table>";

   echo "<table><tr><td><input type=hidden name=argument1 value=$argument1>$argument1 is Odd or Even ?</td></tr><tr><td> <input type=radio name='Odd_Even' value='Odd' >Odd </td></tr><td><input type=radio name='Odd_Even' value='Even'>Even</td></tr></table><input type=submit value='submit'>";

}

function verifyOddEvenResult(){
   if(isset($_POST['argument1'])){
      if($_SESSION['num_questions'] > 0){
         if(strcmp(is_odd($_POST['argument1']), $_POST['Odd_Even'])==0){
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
}



?>
