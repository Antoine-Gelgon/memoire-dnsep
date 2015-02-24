#Memoire DNSEP

Mon mémoire de fin d'étude s'intitule «Documenter une production en design grapique».
Ces fichiers sont ceux de sa mise en page.
Vous pouvez aller voir le cahier ouvert de mes recherche sur:
http://antoine-gelgon.fr/html-memoire

//photo de l'édition.

Cette édition à été réalisée avec différents langages (PHP, HTML, CSS et Javascript).
Je me suis réapproprié l'outil Html2Print d'Open Source Publishing. Cet outil est
une organisation de fichiers web, un environnement qui permet de concevoir un objet 
imprimé à partir d'une page web. Plus besoin de logiciel de mise en page, tout se passe 
entre un simple éditeur de code et un navigateur. L'impression se fait directement par 
le navigateur, avec un «Crtl + P».

Sur la base de ce qu'avait entrepris O.S.P j'ai pu développer pour ce projet 
de nouvelles fonctions. Notamment un éditeur de contenu, qui m'a permis 
de ne pas insérer le texte dans le code source, mais directement dans le navigateur.

Format de l'édition: 165mm sur 228mm.
Typographies: Autopia (Antoine Gelgon); Work Sans (Wei Huang), Univers Else(OSP).

Pour toute question ou réflexion vous pouvez me joindre sur antoine.gelgon@gmail.com

####Sources et références.

La balsamine (Osp) : http://osp.kitchen/work/balsamine.2014-2015/ (Travail réalisé avec Html2Print)
Wikipapier (Etienne Ozeray) : https://github.com/EtienneOz/WikiPapier
Le blog http://computedlayout.tumblr.com/ CSS Print, generative layouts, alternative publishing tools and more.

#Documentation
<pre><code>

Ce n'est pas très propre mais je vais essayé d'expliquer la méthode que j'ai appliqué.

Je n'ai malheuresement pas réussi à utiliser les CSS régions qui permettent de faire couler
 le texte d'un div à un autre. Ces CSS ne marchent pas sur : chrome, chromium, firefox... 
mais doivent normalement marcher sur Epiphany et Arora (je l'ai su après avoir fini l'édition).

###Définir un document.

Pour définir la taille de votre document il faut modifier les variables dans le fichier print.less :

Le format:
@page-width: 165mm; //largeur
 @page-height: 228mm; //hauteur

Les marges:

@page-margin-inside: 13mm;  //marge intérieure
@page-margin-outside: 27mm; //marge extérieure
@page-margin-top: 15mm;     //marge du haut de page
@page-margin-bottom: 7mm;   //marge du bas de page
 

###Créer une page.

Dans index.php dans la balise id="pages" créer un div avec comme classe "preview-page" et un id qui lui est propre.
Exemple:
< div id="page-1" class="preview-page"></ div> 


###Définir un gabarit de page.

La structure du gabarit de la page se trouve dans index.php dans l'id="master-page.
Tout ce qui se trouve dans le master-page se retrouvera dans toutes les pages, c'est à dire dans les balises avec la class="preview-page".

Le gabarit (#master-page) est injecté dans les pages (.preview-page) par du javascript dans le fichier print.js.


$(".preview-page").each(function(){
$(this).append("<div class='inside'>");
$("#master-page").children().clone().appendTo($(".inside", $(this)));
$(".cahier", $(this)).appendTo($(".page", $(this)));
$(".courant", $(this)).appendTo($(".cahier", $(this)));
});


Si vous souhaitez appliquer des styles différents aux pages paires ou impaires, il faut aller dans print.less

div.preview-page {
  &:nth-child(odd) {
    .page{
      //ici le style des pages impaires
    	}
  }	
  &:nth-child(even) {
    .page{
      //ici le style des pages paires.
    }
    }
  }

###Inséré du contenu aux pages


J'ai créé une méthode (Edit Txt) pour injecter du contenu aux pages directement par le navigateur. Les styles CSS sont appliqués par des marqueurs dans le texte.
Ça reste du bidouillage, mais ça fonctionne et ça peut-être pratique si on veut faire des retours à la ligne,
notamment pour travailler le drapeau d'un texte. Cette méthode reste à améliorer, des actions seraient peut-être automatisables.
Je l'ai fait un peu sur-mesure pour ce travail, donc je pense qu'il faut pouvoir le réadapter.

Photo de l'interface avec l'éditeur.
 
Tout d'abord il faut créer un fichier texte (.txt) dans vos dossier pour ensuite pouvoir l'associer à une page ou juste une balise d'une page.
Il ne faut pas oublier de déclarer ce fichier.txt en "lecture et écriture" dans les propriétés.

Le fichier call-txt.php appel grâce à la fonction PHP «opendir» le fichier texte de la page pour l'afficher dans la partie «Edit Txt» de la page web.
Il contient un formulaire (text-edit.php), pour pouvoir éditer ou rééditer le contenu.

Le fichier load.php appel et ouvre le fichier pour après l'injecter non pas dans l'éditeur mais dans la page.

Pour associer un fichier.txt à une balise il faut aller dans print.js et écrire.

$("#page").load('bdd/load.php?page=direction&txt=nom_du_fichier_texte');

-#page : l'endroit qui doit recevoir le contenu du fichier.txt

-direction : le chemin du dossier qui contient le fichier.txt

-nom_du_fichier_texte ne doit pas contenir sont extension (.txt) il est déjà indiqué dans load.php

###Les marqueurs


Les styles peuvent être mis directement dans la partie édition de la page web.
On peut également créer des marqueurs grâce à la fonction PHP str_replace.

Ici vous pouvez changer et rajouter des marqueurs dans le fichier mark-edit.php.

Exemple:

$enter = array('/.','./')

$exit  = array('<h1>','</h1>')

Ici le marqueur /. est enregistré <h1> dans le fichier texte.
Le marqueur inverse ./ est enregistré comme </h1>.

/.Titre./
Ce qui est écrit dans l'éditeur de la page web.

<h1>Titre<h1>
Ce qui est véritablement écrit dans le fichier.txt

Nous pouvons même afficher des images simplement.
J'ai créé la syntaxe suivante pour placer et légender les images dans les pages.

[IL]image[jpg]50[/L]Légende l'image[/F]

[IL] : l'image sera placé à gauche dans la page. ([IC] = centré, [IR] = à droite)
image : le nom du fichier image.
[jpg] : son format. 
50 : l'image fera 50% de la largeur de la page.
[/L] : ferme la balise image.
[/F] : ferma la balise de la légende.
</code></pre>
