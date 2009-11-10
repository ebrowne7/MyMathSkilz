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

?>
