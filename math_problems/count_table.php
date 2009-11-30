<?php 
session_start();
include("./include/common.php");
include("./include/countingtable.php");
mySession();

verifyCountingTableResult();
   
?>
<?php 
if($_SESSION['num_questions'] > 0){
?>
<html>
<body>

<form name=form1 method='post' action=count_table.php>
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

if(isset($_SESSION['results'])){
unset($_SESSION['results']);
echo "<input type=submit>";
}else{
gen_new_countingtable_problem(1,25);
}
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

