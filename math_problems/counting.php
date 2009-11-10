<?php
function get_new_number($arg_min,$arg_max){
   return rand($arg_min,$arg_max);
}

function gen_new_problem($arg_min,$arg_max){
   $argument1 = get_new_number($arg_min,$arg_max);
   #echo $argument1.' '.$argument2."\n";
   
   display_counting_problem($argument1);

}

function display_counting_problem($argument1){
   $img = get_image('+');
   $randimg = $img[rand(0,(count($img) - 1))];
   if($randimg == '' ){
      $randimg='blank.gif';
   }

   echo "<table width=440px border=0 valign=top cellpadding=0 cellspacing=0>
	<tr valign=top>";

      echo "<td > ";
   
      if($argument1 == 0 ){
         echo "<img src='img/blank.gif'>";
      }
      for($i = 0;$i< $argument1;$i++){
         echo "<img src='img/add/$randimg' >";
         if (($i !== 0) && (($i+1) % 5) ==0){ 
            echo "<br/>";
         }
      }
      echo "</td>";

   echo "</tr><tr><td><input type=hidden name=argument1 value=$argument1>How Manay ? <input type=text name='result' value='' size='5'> </td></tr></table><input type=submit value='submit'>";

}

function verifyResult(){
   if(isset($_POST['argument1'])){
      if($_SESSION['num_questions'] > 0){
         if($_POST['argument1'] == $_POST['result']){
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
