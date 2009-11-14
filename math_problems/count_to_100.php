<?php 
session_start();
include(".include/common.php");
include(".include/counting.php");
mySession();

verifyCountingResult();
   
?>
<?php 
if($_SESSION['num_questions'] > 0){
?>
<html>
<body>

<form name=form1 method='post' action=count_to_100.php>
<?php 
#foreach($_POST as $key => $value){
#   echo "Name: $key, Value: $value <br/>";
#}
if (isset($_SESSION['iscorrect'])){
   if($_SESSION['iscorrect']){
      echo "<H3><font color=green>CORRECT</font></H3>";
   }else{
      echo "<H3><font color=red>Incorrect</font></H3>";
   }
}
echo "<p>";

gen_new_counting_problem(0,100);
?>
</form>
<script language="javascript">
<!--
document.form1.result.focus()
//-->
</script>
<br/>
<br/>
<?php
   display_progress();
?>
</body>
</html>
<?php 
}else{
?>
<html>
<body>
<?php 
display_progress();
session_destroy();
echo "<br/>";
?>
<a href=../index.html>Main</a>
</body>
</html>
<?php
}
?>

