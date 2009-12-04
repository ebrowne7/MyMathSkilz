<?php

function gen_new_comparison_problem($arg_min,$arg_max){
   $argument1 = get_new_number($arg_min,$arg_max);
   if (!$doubles){
      $argument2 = get_new_number($arg_min,$arg_max);
   }else{
      $argument2 = $argument1;
   }
   #echo $argument1.' '.$argument2."\n";
   
   display_comparison_problem($argument1,$argument2);

}

function display_comparison_problem($argument1,$argument2){

   echo " <table  border=0 valign=top cellpadding=0 cellspacing=0>
	<tr valign=top><td>$argument1<input type=hidden name=argument1 value=$argument1>&nbsp;&nbsp;&nbsp;</td><td valign=bottom><u>&nbsp;&nbsp;&nbsp;&nbsp;</u></td><td>&nbsp;&nbsp;&nbsp;&nbsp;$argument2<input type=hidden name=argument2 value=$argument2></td></tr></table>
<input type=radio name=group1 value='gt'>is greater than (&gt;)<br>
<input type=radio name=group1 value='lt'>is less than (&lt;)<br>
<input type=radio name=group1 value='eq'>is equal to (&#61;)<br>
<input type=submit value=submit>
";

}

function verifyComparisonResult(){
   if(isset($_POST['argument1'])){
      if($_SESSION['num_questions'] > 0){
          if(($_POST['argument1'] > $_POST['argument2']) && ( $_POST['group1']=='gt')){
              $_SESSION['correct']++;
              $_SESSION['iscorrect'] = true;
          }elseif(($_POST['argument1'] < $_POST['argument2']) &&($_POST['group1']=='lt')){
              $_SESSION['correct']++;
              $_SESSION['iscorrect'] = true;

          }elseif(($_POST['argument1'] == $_POST['argument2'])&&($_POST['group1'] == 'eq')){
              $_SESSION['correct']++;
              $_SESSION['iscorrect'] = true;
          }else{
              $_SESSION['incorrect']++;
              $_SESSION['iscorrect'] = false;
          } 
          $_SESSION['num_questions']--;
       }
   }
}      

?>
