<?php

$conn=new mysqli("localhost","root","","phonebook") OR die("Error: ".mysqli_error($conn));
 session_start();


// code to save user's data
if(isset($_POST['save'])) {
    if(!empty($_POST['name']) && !empty($_POST['date']) && !empty($_POST['phone']) && !empty($_POST['email']))
    {
       
        $name=$_POST['name'];
        $date=$_POST['date'];
        $phone=$_POST['phone'];
        $email=$_POST['email'];

    
            $SELECT="SELECT phone From `contacts` Where phone = ? Limit 1";
            $INSERT="INSERT Into `contacts` (name,date,phone,email) values(?,?,?,?)";

            $stmt=$conn->prepare($SELECT);
            $stmt->bind_param("s",$phone);
            $stmt->execute();
            $stmt->bind_result($phone);
            $stmt->store_result();
            $rnum=$stmt->num_rows;

            if($rnum==0)
            {
                $stmt->close();

                $stmt=$conn->prepare($INSERT);
                $stmt->bind_param("ssss",$name,$date,$phone,$email);
                if($stmt->execute())
                {
                    $_SESSION['msg'] = "saved successfully";
                    $_SESSION['alert'] = "alert alert-success";
                }
                
            }
            else{
                $_SESSION['msg'] = "mobile Number registered already";
                $_SESSION['alert'] = "alert alert-warning";

            }
            $stmt->close();
            $conn->close();
        

    }
    else{
        $_SESSION['msg'] = "all fields are required";
        $_SESSION['alert'] = "alert alert-warning";
        
    }
    header("location: index.php");
}


//delete 
if(isset($_POST['remove'])) {
    $id=$_POST['remove'];

    $dQuery="DELETE FROM contacts WHERE id = ?";
    $stmt= $conn->prepare($dQuery);
    $stmt->bind_param('i',$id);
    if($stmt->execute())
    {
        $_SESSION['msg'] = "removed";
        $_SESSION['alert']="alert alert-danger";
    }
    $stmt->close();
    $conn->close();
    header("location:index.php");
}



//update
if(isset($_POST['edit'])) {
    if(!empty($_POST['name']) && !empty($_POST['date']) && !empty($_POST['phone']) && !empty($_POST['email']))
    {
        $name=$_POST['name'];
        $date=$_POST['date'];
        $phone=$_POST['phone'];
        $email=$_POST['email'];
        $id=$_POST['edit'];

        $uQuery="UPDATE contacts SET name=?, date=?,phone=?,email=? WHERE id=?";

        
          

            $stmt=$conn->prepare($uQuery);
            $stmt->bind_param("issss",$id,$name,$date,$phone,$email);
            if($stmt->execute())
            {
                $_SESSION['msg'] = "updated";
                $_SESSION['alert'] = "alert alert-success";
            }
        $stmt->close();
        $conn->close();

    }
    else{
        $_SESSION['msg'] = "all fields are required";
        $_SESSION['alert'] = "alert alert-warning";
        
    }
    header("location:index.php");
}

// search

  
if(isset($_POST['submit2']))
{

    $ssm=mysqli_query($conn,"SELECT * FROM contacts where Name='name' ");
    
     $stmt=$conn->prepare($ssm);
     $stmt->bind_param("issss",$id,$name,$date,$phone,$email);
     $stmt->execute();

     $stmt->close();
     $conn->close();
    
}

?>