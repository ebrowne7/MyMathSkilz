<?php
function gen_new_skipcounting_problem($arg_min,$arg_max,$inc=2){
   $argument1 = $arg_max;
   #echo $argument1.' '.$argument2."\n";
   
   display_skipcounting_problem($argument1,$inc);

}

function display_skipcounting_problem($argument1,$inc){

   echo "<table width=440px border=1 valign=top cellpadding=0 cellspacing=0>
	<tr valign=top>";

   
      for($i = $inc;$i<= $argument1;$i+=$inc){
         if(((($argument1 / $inc)/2) +1 ) >= ($i / $inc)   ){
            echo "<td>$i</td>";
         }else{
            echo "<td><input type=text name=q$i></td>";
         }
      
      }

   echo "</tr><tr><td><input type=hidden name=argument1 value=$argument1> </td></tr></table><input type=submit value='submit'>";

}

function verifySkipCountingResult(){
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
