<?php

if(!isset($_GET['vid'])){
    header("location:./login.php");
    }else{
        
        $vid = $_GET['vid'];

        echo $vid;

        $stmt = "SELECT * FROM user WHERE `vid` = '$vid'";
        $run = $conn->query($stmt);
        if($run->num_rows > 0){
            $data = $run->fetch_object();
            $userotp = $data->otp;

            if($otp == $userotp){
                
            }
        }


}