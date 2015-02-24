<?php


$submit_file = str_replace(".txt","_submit", $fichier);

if(isset($_POST[$submit_file]))
{
$info = $_POST['info'];
$info = str_replace($enter,$exit,$info);
$fp = fopen($dossier.'/'.$fichier,"w");
$article = $info;

fseek($fp,0);
fputs($fp,$article);
fclose($fp);

echo '<div style="color:grey;right:0px;">//modified</div>';
}

$handle = fopen($dossier.'/'.$fichier, "r");

$info_read = fgets($handle, 4096);
$info_read = str_replace($exit,$enter,$info_read);
?>

<form action="" class="text-projet" method="post">
  <textarea class="text-projet" type="text" name="info"><?php  echo $info_read; ?> </textarea>
  <input type="submit" name="<?php echo $submit_file; ?>" value="SAVE" />
</form>


<?php
fclose($handle);

?>
