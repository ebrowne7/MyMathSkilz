<?php 
session_start();
include("./math.php");
mySession();

verifyResult();
   
?>
<?php 
if($_SESSION['num_questions'] > 0){
?>
<html>
<body>

<form name=form1 method='post' action=addition.php>
<?php 
#foreach($_POST as $key => $value){
#   echo "Name: $key, Value: $value <br/>";
#}
if (isset($_SESSION['iscorrect'])){
   if($_SESSION['iscorrect']){
      echo "<H3>CORRECT</H3>";
   }else{
      echo "<H3>Incorrect</H3>";
   }
   display_progress();
}
echo "<p>";

gen_new_problem(0,10,'+');
?>
</form>
<script language="javascript">
<!--
document.form1.result.focus()
//-->
</script>
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
echo "You got ".$_SESSION['incorrect']." questions wrong <br/>";
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

