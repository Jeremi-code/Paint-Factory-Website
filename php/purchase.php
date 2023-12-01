<?php
   session_start();
   $sn="localhost";
   $un="root";
   $pass="";
   $dbName="users";
   $conn= mysqli_connect($sn,$un,$pass,$dbName);

   if(isset($_POST['submit'])){
      $add= $conn->real_escape_string($_POST['address']);
      $coun= $conn->real_escape_string ($_POST['country']);
      $pt= $conn->real_escape_string ($_POST['ptype']);
      $ct= $conn->real_escape_string ($_POST['ctype']);
      $am=$conn->real_escape_string ($_POST['amount']);
      $em= $_SESSION['email'];



    
      $insert="INSERT INTO purchaselist(address,country,ptype,ctype,amount,email) VALUES(?,?,?,?,?,?)";
      $prep= $conn->prepare($insert);
      $prep->bind_param("ssssis",$add,$coun,$pt,$ct,$am,$em);
      $prep->execute();
    
      
      if($qu){
        echo "Your order has been successfully added!";
      }
      else{
        echo "Your order is not successfully added. Please Try again";
      }
   }
?>