<?php
$folder = "uploads/";
$maxSize = 1000000;
$allowedExtensions = ['png', 'gif', 'jpg'];

$message = '';

if(!empty($_FILES["picture"])) {
    foreach ($_FILES["picture"]["name"] as $file => $file_name) {
        $extension = pathinfo($_FILES['picture']['name'][$file], PATHINFO_EXTENSION);
        $file_name = $folder . uniqid() . "." . $extension;
        $fileType = pathinfo($file_name, PATHINFO_EXTENSION);


        if ($_FILES["picture"]["size"][$file] > $maxSize) {
            $message = "La taille de votre fichier ne peut excéder " . $maxSize/1000000 . " Mo.";
        } elseif (!in_array($extension, $allowedExtensions)) {
            $message = "Votre fichier ne peut être que de type png, gif ou jpg.";
        } elseif (move_uploaded_file($_FILES["picture"]["tmp_name"][$file], $file_name)) {
            $message = "Merci pour vos envois :)";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <title>J'apprends l'upload de files :)</title>
</head>

<body>
<header>
    <h1 class="title" style="text-align: center">Laisse pas trainer ton file</h1>
</header>

<div class="container mt-5">
    <div class="col-10 offset-1">
        <form action="" method="post" enctype="multipart/form-data" multiple="multiple">
            <label>Uploadez vos images ici :</label>
            <input type="file" name="picture[]" id="pictureUpload" multiple />
            <button>Envoyer</button>
        </form>
        <div class="alert alert-secondary" role="alert">
        <?= $message ?>
        </div>
    </div>
</div>

    <?php
    foreach (new DirectoryIterator('uploads/') as $thatFile) :
    if ($thatFile->isFile()){?>
        <div class="card my-4" style="width: 150pt";>
            <?php
            if ($thatFile->isFile()) {
            echo '<img src="'.$thatFile->getPathname().'" alt="'.$thatFile->getFilename().'" ."class="card-img-top"" style="width: 150pt;';?>
            <div class="card-body">
                <?= '<p class="card-text text-center">'.$thatFile->getFilename().'</p>';}?>
            </div>
            <?php } endforeach; ?>
        </div>


