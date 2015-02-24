
              <?php
              $dossier='bdd/'.$page;

              $ouverture= opendir($dossier);
              $mtime = date('d/m/Y H:i:s');

              while ($fichier = readdir($ouverture)) {
                if(stristr($fichier,'.txt')){

                  $fichier_tri[filemtime($fichier_tri)]=$fichier;
                ?>

                <h3 style="border: 1px solid grey">
                <a> <?php echo $fichier; ?></a>
                </h2>


                    <div id='<?php echo $fichier; ?>'><?php include('text-edit.php'); ?></div>





              <?php
                  }
                }

              closedir($ouverture);
              ?>
