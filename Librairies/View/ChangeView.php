<?php
use App\Objet\Billets;
use App\Modele\BilletsManager;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>administration</title>  
    <link rel="stylesheet" type="text/css" href="style/admin.css">
    <script src="https://cdn.tiny.cloud/1/5ya0hoc0tjh102vqr3m520w8306eqxcu8mz71btr0zmc1z2t/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>tinymce.init({selector: '#formulaire'});</script>    
</head>
<body>
    <p><a href="index.php">Accueil</a></p>    
    <form action="index.php" method="post">
      <p>
<?php
if (isset($message))
{
  echo $message, '<br />';
}
foreach($billetUnique as $billets):
?>              
        <?php if(isset($erreurs) && in_array(Billets::TITRE_INVALIDE, $erreurs)) echo 'Le titre est invalide.<br />'; ?>
        Titre : <input type="text" name="titre" value="<?php if (isset($billets)) echo $billets->titre(); ?>" /><br />
        
        <?php if (isset($erreurs) && in_array(Billets::CONTENU_INVALIDE, $erreurs)) echo 'Le contenu est invalide.<br />'; ?>
        Contenu :<br /><textarea id="formulaire" type="text" name="contenu"><?php if (isset($billets)) echo $billets->contenu(); ?></textarea><br />
<?php
if(isset($billets) && !$billets->isNew())
{
?>
        <input type="hidden" name="id" value="<?= $billets->id() ?>" />
        <input type="submit" value="Modifier" name="modifier" />
<?php
}
else
{
?>
        <input type="submit" value="Ajouter" />
<?php
}
endforeach;
?>
    </p>
    </form> 
         <p style="text-align: center">Il y a actuellement <?= $billetCount ?> billets. En voici la liste :</p>
    
    <table>
         <tr><th>Titre</th><th>Date d'ajout</th><th>Dernière modification</th><th>Action</th></tr> 
   
<?php
     foreach($billetList as $billet):
             $date1 = date('d/m/y à H:i:s', strtotime($billet->dateAjout()));
             $date2 = date('d/m/y à H:i:s', strtotime($billet->dateModif()));      
             echo '<tr><td>',$billet->titre(), '</td><td>', $date1, '</td><td>', ($date1 == $date2 ? '-' : $date2),
                  '</td><td><a href="index.php?modifier='. $billet->id(),  '">Modifier</a> | <a href="index.php?supprimer='. $billets->id(),  '">Supprimer</a></td></tr>', "\n";
     endforeach;                 
?>   
    </table>            
</body>
</html>