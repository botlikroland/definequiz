<?php
session_start();

// TODO túl hosszú

include_once('db.php');
include_once('FlashMessage.php');
$flashMessage = new FlashMessage();
if (isset($_SESSION['flashMessage']) && $_SESSION['flashMessage']!="")
{
    $flashMessage->show();
    $flashMessage->setMessage("");
}


//BE VAN JELENTKEZVE
if(isset($_SESSION['userid'])){

    //JELSZÓT AKAR VÁLTOZTATNI
    if(isset($_POST['changepw']))
    {
        header("Location: /changepw.php \n");
    }

    //TÉNYLEG JELSZÓT VÁLTOZTAT
    if(isset($_POST['change']))
    {
        $db = new DB();

        $userid = $_SESSION['userid'];
        $oldpw = $db->escape($_POST['oldpw']);
        $newpw = $db->escape($_POST['newpw']);
        $newpw2 = $db->escape($_POST['newpw2']);

        $oldPwCheck = $db->query("SELECT * FROM login WHERE id = '$userid' AND password = MD5('$oldpw');");
        if(count($oldPwCheck))
        {
            if($newpw == $newpw2)
            {
                $db->query("UPDATE login SET password = MD5('$newpw') where id = '$userid'");
                $flashMessage->setMessage("Sikeres jelszó változtatás!");
                header("Location: /main.php \n");
            }
            else
            {
                $flashMessage->setMessage("Nem egyezik a két új jelszó!");
                header("Location: /changepw.php \n");
            }
        }
        else
        {
            $flashMessage->setMessage("Rossz a régi jelszó!");
            header("Location: /changepw.php \n");
        }
    }

    //KIJELENTKEZIK
    if(isset($_POST['logout']))
    {
        unset($_SESSION['userid']);
        $flashMessage->setMessage("Sikeres kijelentkezés!");
        header("Location: /login.php \n");
    }

    //MÉG NINCS BEJELENTKEZVE
} else {
    if(isset($_POST['username']) && isset($_POST['password'])){
        //BEJELENTKEZIK
        if(isset($_POST['login'])){
            $db = new DB();

            $username = $db->escape($_POST['username']);
            $password = $db->escape($_POST['password']);

            $result = $db->query("SELECT * FROM login WHERE username = '$username' AND password = MD5('$password');");

            if(count($result)){
                $_SESSION['username'] = $username;
                $_SESSION['userid']   = $result[0]['id'];
            } else {
                $flashMessage->setMessage("Sikertelen bejelentkezés!");
                header("Location: /login.php \n");
            }

            $db->close();
            //REGISZTRÁL
        } elseif($_POST['register']) {
            $db = new DB();

            $username = $db->escape($_POST['username']);
            $password = $db->escape($_POST['password']);

            if(!($db->query("SELECT * FROM login WHERE username = '$username';"))) {
                $db->update("INSERT INTO login (username,password) VALUES ('$username',MD5('$password'));");
                $_SESSION['username'] = $username;
                $userid = $db->query("SELECT id FROM login WHERE username = '$username' AND password = MD5('$password');");
                $_SESSION['userid']   = $userid[0]['id'];
            }
        } else {
            //Ez a rész nem fog lefutni, de később hátha kell ide valami:D
        }

    } else {
        header("Location: /login.php \n");
    }
}
?>