<?php
  
    function checkEnchere(){
        $db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        $email=$_SESSION["email"];
        if($db === false){
            die("ERROR: Could not connect. " . $db->connect_error);
        }

        $sql = "SELECT * FROM enchere";
        if($stmt = $db->prepare($sql)){
            if($stmt->execute()){
                $result = mysqli_stmt_get_result($stmt);
                while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                    $stack[] = (
                        $row
                    );      
                }  
            }
            $stmt->close();
        }
        parcoursEnchere($stack);
        mysqli_free_result($result);
        $db->close();
    }

    function parcoursEnchere($stack){
        $db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if($db === false){
            die("ERROR: Could not connect. " . $db->connect_error);
        }
        foreach($stack as &$it){
            $maDate = new  DateTime();date_add($maDate, date_interval_create_from_date_string("2 hours"));
            $debut = new  DateTime($it["debut"]);
            $duree = strval($it["fin"]);
            $duree .= " hours";
            $maDateFin   = date_add($debut, date_interval_create_from_date_string($duree));
            $dteDiff  = $maDate->diff($maDateFin);
            $json =  @json_encode($dteDiff->format("%D:%H:%I:%S"));
            print "<script>console.log($json);</script>";
            if(strcmp($dteDiff->format("%D:%H:%I:%S"),"00:00:00:00") == 0 )
            {
                $json =  @json_encode("oui");
                print "<script>console.log($json);</script>";
                $sql = "UPDATE items SET sold = 1 WHERE id = ?";
                if ($stmt = $db->prepare($sql)) {
                    $stmt->bind_param("i",$param_id_item);
                    $param_id_item = $it["id_item"];
                    $json =  @json_encode($param_id_item);
                    print "<script>console.log($json);</script>";
                    if ($stmt->execute()) {
                        $json =  @json_encode("Sold");
                        print "<script>console.log($json);</script>";
                    }
                    else{
                        $json =  @json_encode("ailleouille");
                        print "<script>console.log($json);</script>";
                    }

        $stmt->close();

    }
            }
        }
        $db->close();


    }
?>