<?php

$uname1= $_POST['uname1'];
$email= $_POST['email'];
$phno= $_POST['phno'];
$upwd1= $_POST['upwd1'];
$upwd2= $_POST['upwd2'];

if(!empty($uname1) || !empty($email) || !empty($phno) || !empty($upwd1) || !empty($upwd2)  )
{
    $host ="localhost";
    $dbusername ="root";
    $dpoasswird ="";
    $dbname ="new project";

   $conn =new mysqli($host,$dbusername,$dbpassword,$dbname);

   if( mysqli_connect_error())
   {
    die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
   }
   else{
    $SELECT = "SELECT email From signup where email=? Limit 1";

    $INSERT = "INSERT Into signup(uname1,email,phno,upwd1,upwd2)values(?.?.?.?.?)";

    $stmt = $conn->prepare($SELECT);
    $stmt->bind_param("S",$email);
    $stmt->execute();
    $stmt->bind_result($email);
    $stmt->store_result();
    $rnum=$stmt->num_rows;


 
    if($rnum==0)
    {
        $stmt->close();
        $stmt = $conn->prepare($INSERT);
        $stmt->bind_param("ssiss",$uname1,$email,$phno,$upwd1,$upwd2);
        $stmt->execute();
        echo "New record insert succesfully";
    }
    else{
        echo "Some one aldredy register this email";

    }
    $stmt->close();
    $conn->close();
    }
}
else{
    echo "All field are required";
    die();

}   
?>

