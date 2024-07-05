<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<form action="traitement.php" method="post">

  <body>
    <center>

      <h1>Dépôt de nouveaux fichiers</h1>
      <form action="depot.php" method="post" enctype="multipart/form-data" />
      <div>
        <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
        <label for="fichier">Fichier à déposer :</label>
        <input type="file" name="fichier" id="fichier" />
        <input type="submit" value="Envoi du fichier" />
      </div>

    </center>

    <input type="text" name="old" id="" placeholder="ancien mot de passe">
    <input type="text" name="new" id="" placeholder="nouveau mot de passe">
    <input type="text" name="new_conf" id="" placeholder="repete mot de passe">
    <input type="submit" name="new_password" value="Valider le mot de passe">

  </body>
</form>

</html>