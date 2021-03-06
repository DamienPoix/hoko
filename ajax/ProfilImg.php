<?php

session_start();

include_once '../class/path.php';

$result = array();
$result['success'] = false;
$result['errors'] = array();

    $id = isset($_POST['id']) ? htmlspecialchars($_POST['id']) : 0; //on récupére l'id de l'utilisateur si il exist ou sinon on l'actualise a 0
    $extension = array('png');//on stock les extension de fichier qu'on veut 
    $temp = explode('.', $_FILES['userImage']['name']);
    $file_extension = end($temp);//permet de récuperer la derniere valeur d'un tableau dans notre cas ça sera le png
    $filename = $id; //pour que le nom de l'image soit l'id de l'utilisateur exemple (15)
    $targetPath = path::getUserImage() . $filename; //pour target l'image qui nous interesse 
    $sourcePath = $_FILES['userImage']['tmp_name'];
    //
    if ($_FILES['userImage']['type'] == 'image/png') {//vérification si c'est bien une image png
        if ($_FILES['userImage']['size'] <= 500000) {//500ko max par image 
            if (in_array($file_extension, $extension)) {//vérification si l'extension png est bien présente dans le tableau file_extension
                if (getimagesize($_FILES['userImage']['tmp_name']) != false) {//vérification si il n'y a pas d'erreur détecter
                    if ($_FILES['userImage']['error'] > 0) {
                        $result['errors'][] = 'erreur détecter avec votre image';
                    } else {
                        if (file_exists($targetPath)) {
                            unlink($targetPath); //permet de supprimer un fichier
                        }
                        move_uploaded_file($sourcePath, $targetPath); //Déplace un fichier téléchargé
                        $result['success'] = true; //renvoie true
                    }
                } else {
                    $result['errors'][] = 'Une erreur a été détecter avec votre image';
                }
            } else {
                $result['errors'][] = 'Merci d\'utiliser une image avec l\'extension \"png\" ';
            }
        } else {
            $result['errors'][] = 'Votre Image est trop volumineuse (max 500ko)';
        }
    } else {
        $result['errors'][] = 'Merci d\'utiliser une image avec l\'extension \"png\" ';
    }
echo json_encode($result);

session_write_close();//ferme la session courante aprés avoir envoyé les informations