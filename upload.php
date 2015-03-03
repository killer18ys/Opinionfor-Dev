<?php
    require_once "core/init.php";

    $user = new User();


    $target_dir = "img/profile_picture/";
    $target_file = $target_dir . basename($_FILES["imageToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["imageToUpload"]["tmp_name"]);
        if($check !== false) {
             Session::flash('Error', "File is an image - " . $check["mime"] . ".");
             Redirect::to("settings-profile.php");
            $uploadOk = 1;
        } else {
             Session::flash('Error', "File is not an image.");
             Redirect::to("settings-profile.php");
            $uploadOk = 0;
        }
    }
    // Check if file already exists
    if (file_exists($target_file)) {
         Session::flash('Error', "Sorry, file already exists.");
         Redirect::to("settings-profile.php");
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["imageToUpload"]["size"] > 500000) {
        Session::flash('Error', "Sorry, your file is too large.");
        Redirect::to("settings-profile.php");
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        Session::flash('Error', "Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
        Redirect::to("settings-profile.php");
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        Session::flash('Error', "Sorry, your file was not uploaded.");
        Redirect::to("settings-profile.php");
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["imageToUpload"]["tmp_name"], $target_file)) {    
            $path = "./";
            $path = realpath($path);

            $prev_img = "./" . $user->data()->avatar;

             $user->update(array(
                    'avatar' => basename( $_FILES["imageToUpload"]["name"])
            ));


            if (file_exists($prev_img)) {
                Session::flash('Error', "bi trqbvalo da stane");
                Redirect::to("settings-profile.php");

                unlink($prev_img);

            }else{
                Session::flash('Error', "ZAshot ne staaa");
                Redirect::to("settings-profile.php");
            }


            Redirect::to("settings-profile.php");
        } else {
            Session::flash('Error', "Sorry, there was an error uploading your file.");
            Redirect::to("settings-profile.php");
        }
    }



?> 