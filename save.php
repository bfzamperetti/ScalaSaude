<?php //Generate text file on the fly
   header("Content-type: text/plain");
   header("Content-Disposition: attachment; filename=".$_POST['name'].".cal");
   print $_POST['name'].'|'.$_POST['type'].'|'.$_POST['content'];
?>
