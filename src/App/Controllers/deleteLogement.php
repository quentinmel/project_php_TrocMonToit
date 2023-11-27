<?php 

    function deleteLogement() {
        require_once 'App/Models/injection.php';

        $logement_id = $_POST['renting_id_delete'];

        removeRentingEquipment($logement_id);
        removeRentingService($logement_id);
        removerenting($logement_id);
        
        header("Location: /admin");
        exit;
    }

?>