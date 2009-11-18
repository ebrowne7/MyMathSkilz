<?php
function gen_new_countingtable_problem($arg_min,$arg_max){
   
   display_countingtable_problem($arg_min,$arg_max);

}

function display_countingtable_problem($argument1,$argument2){

   echo "Complete the table<br><table  border=1 valign=top cellpadding=0 cellspacing=0>
	<tr valign=top>";
      $x = 0; 
      for($i = $argument1;$i<= $argument2;$i++){
         if($i <= 3){
         echo "<td >$i&nbsp;&nbsp;&nbsp;&nbsp;</td>";
         }else{
            if(rand(0,1)){
               echo "<td >$i&nbsp;&nbsp;&nbsp;&nbsp;</td>";
            }else{
               echo "<td><input type=text name=q$x size=5><input type=hidden name=r$x value=$i></td>";
               $x++;
            }
         }
         if (($i !== 0) && (($i) % 5) ==0){ 
            echo "</tr><tr>";
         }
      }


   echo "</tr></table><input type=hidden name=argument1 value=$argument1><input type=hidden name=argument2 value=$argument2><input type=hidden name=x value=$x><input type=submit value='submit'>";

}

function verifyCountingTableResult(){
/*
This one is a little more complicated then the rest ouput the table again
and display the correct in green the incorrect in red.
*/
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
