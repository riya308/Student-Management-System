<?php
    $academic=$_POST['academic'];
    $firstname=$_POST['firstname'];
    $lastname=$_POST['lastname'];
    $email=$_POST['email'];
    $games=$_POST['games'];
    $animation=$_POST['animation'];
    $business=$_POST['business'];
    $softwaretesting=$_POST['softwaretesting'];
    $objectoriented=$_POST['objectoriented'];
    $computersystem=$_POST['computersystem'];
    $project=$_POST['project'];
    $totalscore=$_POST['totalscore'];
    $average=$_POST['average'];
    $classification=$_POST['classify'];
    
    if(!empty($academic) || !empty($firstname) || !empty($lastname) || !empty($email) || !empty($games) || !empty($animation) || !empty($business) || !empty($softwaretesting) || !empty($objectoriented) || !empty($computersystem) || !empty($project) || !empty($totalscore) || !empty($aaverage) || !empty($classification))
    {
        $host="localhost";
        $dbUsername="root";
        $dbpassword="";
        $dbname="login";

        $conn= new mysqli($host,$dbUsername,$dbpassword,$dbname);

        if(mysqli_connect_error()){
            die('Connect Error('.mysqli_connect_error().')'.mysqli_connect_error());
        }   else{
            $SELECT = "SELECT email From `student` where email=? Limit 1";
            $INSERT = "INSERT into `student`(academic,firstname,lastname,email,games,animation,business,
            softwaretesting,objectoriented,computersystem,project,totalscore,average,classification) 
            values(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";


            $stmt = $conn->prepare($SELECT);
            $stmt->bind_param("s",$email);
            $stmt->execute();
            $stmt->bind_result($email);
            $stmt->store_result ();
            $rnum = $stmt->num_rows ;
            if ($rnum==0){
                $stmt->close();
                $stmt=$conn->prepare ($INSERT);
                $stmt->bind_param("ssssssssssssss",$academic,$firstname,$lastname,$email,$games,$animation,$business,$softwaretesting,$objectoriented,$computersystem,$project,$totalscore,$average,$classification);
                $stmt->execute();

                echo"New record inserted successfully";
            }else{
                echo "Someone already registered using this email";
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