<?php 

    function deleteRenting() {
        require_once 'App/Models/injection.php';

        $renting_id = $_POST['renting_id_delete'];

        removeRentingEquipment($renting_id);
        removeRentingService($renting_id);
        removerenting($renting_id);
        
        header("Location: /admin");
        exit;
    }

?>