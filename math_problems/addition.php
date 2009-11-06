<?php 
session_start();
if (isset($_REQUEST['num_questions']) && !isset($_SESSION['num_questions'])){
   $_SESSION['num_questions'] = $_REQUEST['num_questions'];
}

if(!isset($_SESSION['num_questions'])){
   $_SESSION['num_questions'] = 10;
}

if(isset($_POST['argument1']) ){
   if($_SESSION['num_questions'] > 0){
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
?>
<?php 
if($_SESSION['num_questions'] > 0){
?>
<html>
<body>

<form name=form1 method='post' action=addition.php>
<?php 
include("./math.php");
#foreach($_POST as $key => $value){
#   echo "Name: $key, Value: $value <br/>";
#}
if (isset($_SESSION['iscorrect'])){
   if($_SESSION['iscorrect']){
      echo "<H3>CORRECT</H3>";
   }else{
      echo "<H3>Incorrect</H3>";
   }

}
echo "<p>";

gen_new_problem(0,10,'+');
?>
</form>
</body>
</html>
<?php 
}else{
?>
<html>
<body>
<form method='post' action='addition.php'>
<?php 
echo "You got ".$_SESSION['correct']." questions correct <br/>";
echo "You got ".$_SESSION['incorrect']." questisons wrong <br/>";
echo ($_SESSION['correct'] / ($_SESSION['correct'] + $_SESSION['incorrect'])) * 100;
echo "%<br/>";
session_destroy();
?>
<input type=submit value=submit>
</form>
</body>
</html>
<?php
}
?>

