<?php 

    function deleteLogement() {
        require_once 'App/Models/injection.php';

        $logement_id = $_POST['renting_id_delete'];

        removeLocationEquipement($logement_id);
        removeLocationService($logement_id);
        removeLocation($logement_id);
        
        header("Location: /admin");
        exit;
    }

?>