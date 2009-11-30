<?php
function gen_new_countingtable_problem($arg_min,$arg_max){
   
   display_countingtable_problem($arg_min,$arg_max);

}

function display_countingtable_problem($argument1,$argument2){

   echo "Complete the table<br><table  border=1 valign=top cellpadding=0 cellspacing=0>
	<tr valign=top>";
      $results =array();
      for($i = $argument1;$i<= $argument2;$i++){
         if($i <= 3){
         echo "<td >$i&nbsp;&nbsp;&nbsp;&nbsp;</td>";
         }else{
            if(rand(0,1)){
               echo "<td >$i&nbsp;&nbsp;&nbsp;&nbsp;</td>";
            }else{
               echo "<td><input type=text name=q$i size=5></td>";
               array_push($results,$i);
               
            }
         }
         if (($i !== 0) && (($i) % 5) ==0){ 
            echo "</tr><tr>";
         }
      }
      $_SESSION['results']=$results;


   echo "</tr></table><input type=hidden name=argument1 value=$argument1><input type=hidden name=argument2 value=$argument2><input type=submit value='submit'>";

}

function verifyCountingTableResult(){
/*
This one is a little more complicated then the rest ouput the table again
and display the correct in green the incorrect in red.
*/
   $isincorrect=0;
   if(isset($_POST['argument1'])){
      if($_SESSION['num_questions'] > 0){
   
   echo "<br><table  border=1 valign=top cellpadding=0 cellspacing=0>
	<tr valign=top>";
      for($i = $_POST['argument1'];$i<=$_POST['argument2'];$i++){         
         if($i<3){
            echo "<td >$i&nbsp;&nbsp;&nbsp;&nbsp;</td>";
         }else{
            if(isset($_POST["q".$i])){
              if($_POST["q".$i] == array_shift($_SESSION['results'])){
                 echo "<td><font color=green>$i&nbsp;&nbsp;&nbsp;&nbsp;</font></td>";

              }else{
                 echo "<td><font color=red>$i&nbsp;&nbsp;&nbsp;&nbsp;</font></td>";
                 $isincorrect =1;
              } 
            }else{
               echo "<td >$i&nbsp;&nbsp;&nbsp;&nbsp;</td>";
            }
         }
         if (($i !== 0) && (($i) % 5) ==0){ 
            echo "</tr><tr>";
         }
      } 
         if(!$isincorrect){
             $_SESSION['correct']++;
             $_SESSION['iscorrect'] = true;
         }else{
             $_SESSION['incorrect']++;
             $_SESSION['iscorrect'] = false; 
         }
   echo "</tr></table>";
         #Count down the questions as they are answered.
         $_SESSION['num_questions']--;
   }      
 }
}



?>
