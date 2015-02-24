  <?php


if(isset($_POST['submit_note']))
{
$info = $_POST['info'];
$info = str_replace("\r\n","</br>",$info);
$fp = fopen("bdd/note-page-$page.txt","w");
$article = $info;

fseek($fp,0);
fputs($fp,$article);
fclose($fp);

echo '<div style="color:grey;right:0px;">//modified</div>';
}


$handle = fopen("bdd/note-page-$page.txt", "r");
$info_read = fgets($handle, 4096);
$info_read = str_replace("</br>","\r\n",$info_read);
?>

  <form action="" class="text-projet" method="post">
    <textarea class="text-projet" type="text" name="info"><?php  echo $info_read; ?> </textarea>
    <input type="submit" name="submit_note" value="SAVE" />
  </form>

<?php
fclose($handle);

?>
