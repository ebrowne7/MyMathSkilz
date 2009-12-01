<?php
function gen_new_skipcounting_problem(){
   $inc_array = array(1,2,3,4,5,10);
   $inc_max= array(10,10,15,20,30,50);
   $val = rand(0,count($inc_array)-1);
   $inc=$inc_array[$val];
   $argument1 = $inc_max[$val];
   #echo $argument1.' '.$argument2."\n";
   
   display_skipcounting_problem($argument1,$inc);

}

function display_skipcounting_problem($argument1,$inc){
   $_SESSION['inc'] = $inc;
   
   echo "Complete the pattern<br/><table width=440px border=0 valign=top cellpadding=0 cellspacing=0>
	<tr valign=top>";
      $_SESSION['results']=array();
      for($i = $inc;$i<= $argument1;$i+=$inc){
         if(((($argument1 / $inc)/2) +1 ) >= ($i / $inc)   ){
            echo "<td>$i&nbsp;&nbsp;&nbsp;&nbsp;,</td>";
         }else{
            if(($i+$inc) <= $argument1){
               echo "<td><input type=text name=q$i size=5></td><td>,</td>";
            }else{
               echo "<td><input type=text name=q$i size=5></td>";

            }
            array_push($_SESSION['results'],$i);
         }
      
      }

   echo "</tr><tr><td><input type=hidden name=argument1 value=$argument1> </td></tr></table><input type=submit value='submit'>";

}

function verifySkipCountingResult(){
   $isnotcorrect = 0;
   $argument1 = $_POST['argument1'];
   $inc = $_SESSION['inc']; 
   if(isset($_POST['argument1'])){
      if($_SESSION['num_questions'] > 0){
      for($i=$_SESSION['inc']; $i<=$_POST['argument1'];$i+=$_SESSION['inc']){
         if(((($argument1 / $inc)/2) +1 ) >= ($i / $inc)   ){
            //nothing to do here 
         }else{
            if($_POST["q".$i] != array_shift($_SESSION['results'])){
              $isnotcorrect =1;
            }

         }
         
      }
         if(!$isnotcorrect){
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
