<!--Edition Back-up False CMS-->

<!--<div id="tab">
  <ul>
    <li><a class="btn_footer" href="#courant"><h6>Courant</h6></a></li>

    <li><a class="btn_footer" href="#note"><h6>Notes</h6></a></li>
  </ul>
</div>-->
<?php echo $select_page; ?>

<br><br>
  <div id="accordion">
  <?php include ('mark-edit.php'); ?>
  <?php

$page = $select_page;
  include ('call-txt.php');
  ?>

  </div>
