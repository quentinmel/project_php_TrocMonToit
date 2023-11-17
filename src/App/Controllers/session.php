<?php 

function addSession() {
    session_start();

    $_SESSION['id_session'] = session_id();
}

?>