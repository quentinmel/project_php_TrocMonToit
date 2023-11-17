<?php 

session_start();

function addSession() {

    $_SESSION['id_session'] = session_id();
}

?>