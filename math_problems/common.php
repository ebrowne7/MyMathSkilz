<?php
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

?>
