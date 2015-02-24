  <?php

if(isset($_POST['submit_info']))
{
$info = $_POST['info'];
$info = str_replace("\r\n","</br>",$info);
$fp = fopen("bdd/info.txt","w");
$article = $info;

fseek($fp,0);
fputs($fp,$article);
fclose($fp);

echo '<h6 style="color:grey;margin-top:-10px;">//modified</h6>';


}

?>
<?php
$handle = fopen("bdd/info.txt", "r");
$info_read = fgets($handle, 4096);
$info_read = str_replace("</br>","\r\n",$info_read);
?>
  <form action="edit.php#info" class="text-projet" method="post">
    <textarea class="text-projet" rows="25" style="color:black" type="text" name="info"><?php  echo $info_read; ?> </textarea>
    <input type="submit" name="submit_info" value="SAVE" />
  </form>
<?php
fclose($handle);

?>
