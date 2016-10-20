<?php

class FlashMessage
{

    function __construct()
    {

    }

    function setMessage($szo)
    {
        $_SESSION['flashMessage'] = $szo;
    }

    function show()
    {
        echo '<div id="alert">'.$_SESSION['flashMessage'].'</div>';
    }
}
?>