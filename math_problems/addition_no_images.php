<?php 
session_start();
$_SESSION['noimage']=true;
include("./common.php");
include("./math.php");
mySession();

verifyResult();
   
?>
<?php 
if($_SESSION['num_questions'] > 0){
?>
<html>
<body>

<form name=form1 method='post' action=addition_no_images.php>
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

gen_new_problem(0,20,'+');
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
<form method='post' action='../index.html'>
<?php 
display_progress();
session_destroy();
echo "<br/>";
?>
<input type=submit value=submit>
</form>
</body>
</html>
<?php
}
?>

