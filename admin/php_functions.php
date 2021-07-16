<?php 

include "serverconnect.php";    

function canteen_login($can_id)
{
    global $connect;
    $query="SELECT canteen_status,canteen_name from canteen WHERE canteen_id='$can_id'";
    echo "The canteen selected is ".$can_id;
    $result=mysqli_query($connect,$query);
    if(!$result)
    {
        die(mysqli_error($connect));   
    }
    else
    {
        
        $value=mysqli_fetch_assoc($result);
        
        if($value['canteen_status']==1)
        {
            $cname=$value['canteen_name'];
            setcookie('canteen_id', $can_id, 0, "/","", 0);
            setcookie('canteen_name', $cname, 0, "/","", 0);
            header("Location:menu.php");
        }
        else if($value['canteen_status']==0)
        {
            echo "<script> alert('Canteen Closed'); </script>" ;
        }
    }
}

function validate_user()
{
    global $connect;
    $id=$_POST['id'];
    $passwd=$_POST['password'];
    if(empty($id)||empty($passwd))
    {
        echo "Invalid Roll number or Password";
        return;
    }
    $query="SELECT * FROM student WHERE stud_id='$id'";
    $result=mysqli_query($connect,$query);
    if($result)
    {
        $value=mysqli_fetch_assoc($result); 
        if($value['stud_password']==$passwd)
        {
            if(! mysqli_query($connect, "REPLACE INTO orders (stud_id) VALUES ('$id')"))
                die('Failed to Insert Id in Order Table' );

            setcookie('login_id', $id, 0, "/","", 0);

            $_SESSION['logsts']='set';
            
            header("Location:canteen.php");
        }
        else
            header("Location:login.php");
    }
    else
        echo "<center style='color:red;'>Invalid Roll Number or Password</center><br>";
}


// function add_food($canteen,$food_id, $food_name ,$food_price,$food_qty,$food_start_time,$food_end_time)
// {
//     global $connect;
//     if($food_qty)
//     {
//         $food_status = 1;
//     }
//     else{
//         $food_status = 0;
//     }
//     $query = "INSERT INTO food VALUES('$food_id','$food_name',$food_price,$food_qty,$food_status,'$food_start_time','$food_end_time','$canteen')";
//     $result=mysqli_query($connect,$query);
//     if(!$result)
//     {
//         die(mysqli_error($connect));
//         echo '<small class="text-center text-success">Invalid credentials. Please try again </small>'; 
//     }
//     else
//     {
//         echo "Success";
//     }         
// }

function photo_upload_status($uploads_dir1){
    $photo_upload_confirm = 1;
            
            //Checking file size
            if($_FILES["photo_upload"]["size"]>26214400){
                echo "Image is too larger. Try uploading image of size less than 5MB";
                $photo_upload_confirm = 0;
            }
            
            //Checking file type
            $extension = $_FILES["photo_upload"]["type"];
            if(!(($extension != "image/png")||($extension != "image/jpeg")||($extension != "image/jpg"))){
                echo "Only .jpg, .png, .jpeg  image file types are suported";
                $photo_upload_confirm = 0;
            }
            
            //Check if the file already exist
            if(file_exists($uploads_dir1)){
                echo "Photo already exists. Cannot upload again";
                $photo_upload_confirm = 0;
            }
    return $photo_upload_confirm;
}

function add_food($canteen,$food_id,$food_name,$session,$food_price,$food_qty)
{
    global $connect;
    
    $pname1 = $_FILES["photo_upload"]["name"];
    $tname1 = $_FILES["photo_upload"]["tmp_name"];
    $uploads_dir1 = 'C:/xampp/htdocs/food_img/'.$pname1;
    $photo_upload_confirm = photo_upload_status($uploads_dir1);
    
    
    if($food_qty)
    {
        $food_status = 1;
    }
    else{
        $food_status = 0;
    }
    if($photo_upload_confirm)
    {
        $food_name=strtoupper($food_name);
        move_uploaded_file($tname1, $uploads_dir1);
        $dir='/food_img/'.$pname1;
        $query = "INSERT INTO food VALUES('$food_id','$food_name',$food_price,$food_qty,$food_qty,'$dir',$food_status,'$session','$canteen')";
        $result=mysqli_query($connect,$query);
        if(!$result)
        {
            die(mysqli_error($connect));
            echo '<small class="text-center text-success">Invalid credentials. Please try again </small>'; 
        }
        else
        {
            echo '<center style="color:green;">Item Added Successfully</center>'; 
        }  
    }
}
    
function view_food_details($canteen,$session, $food)
{
    global $connect;
    /*$query="UPDATE food SET food.food_start_time=$st_time , food.food_end_time=$end_time where food.canteen_id='$canteen' and food.food_name='$food'";*/
    $query = "SELECT * FROM food where food.canteen_id='$canteen' and food.food_name='$food' and food.session='$session'";
    $result=mysqli_query($connect,$query);
    if(!$result)
    {
        die(mysqli_error($connect));
        echo '<small class="text-center text-success">Invalid credentials. Please try again later</small>'; 
    }
    else
    {
        $row = mysqli_fetch_assoc($result);
        if(!$row){
           echo '<small class="text-center text-success">Invalid credentials. Please try again later</small>';
        }
        else{
            $food_id = $row['food_id'];  
            $food_name = $row['food_name'];  
            $food_price = $row['food_price'];  
            $food_avail_qty = $row['food_qty'];  
            $food_status = $row['food_status'];  
            
            echo "<br><b>Food Details</b><br><br>";
            echo "<b>ID : </b>" . $food_id . "<br>";
            echo "<b>NAME : </b>" . $food_name . "<br>";
            echo "<b>PRICE : </b>" . $food_price . "<br>";
            echo "<b>QUANTITY : </b>" . $food_avail_qty . "<br>";
            echo "<b>STATUS : </b>" . $food_status . "<br>";
            echo "<b>SESSION : </b>" . $row['session'] . "<br>";
            echo "<b>CANTEEN ID : </b>" . $row['canteen_id'] . "<br>";
            
        }
        
    }
}


function change_food_status($canteen,$session,$food,$status)
{
    
    global $connect;
    $query="UPDATE food SET food.food_status=$status where food.canteen_id='$canteen' and food.food_name='$food' and food.session='$session'";
    $result=mysqli_query($connect,$query);
    if(!$result)
    {
        die(mysqli_error($connect));
        echo '<small class="text-center text-success">Invalid credentials. Please try again later</small>'; 
    }
    else
    {
        echo '<small class="text-center text-success">Food Status Updated Successfully</small>'; 
    }
}

function change_food_quantity($canteen,$session,$food,$quantity)
{
    global $connect;
    $query="UPDATE food SET food.food_qty=$quantity where food.canteen_id='$canteen' and food.food_name='$food' and food.session='$session'";
    $result=mysqli_query($connect,$query);
    if(!$result)
    {
        //die(mysqli_error($connect));
        echo '<small class="text-center text-success">Invalid credentials. Please try again later</small>'; 
    }
    else
    {
        echo '<small class="text-center text-success">Food quantity updated</small>'; 
    }
}

function change_food_price($canteen,$session,$food,$price)
{
    global $connect;
    $query="UPDATE food SET food.food_price=$price where food.canteen_id='$canteen' and food.food_name='$food' and food.session='$session'";
    $result=mysqli_query($connect,$query);
    if(!$result)
    {
        die(mysqli_error($connect));
    }
    else
    {
        echo '<small class="text-center text-success">Food price updated</small>'; 
    }
}

function validateOTP($user)
{
    global $connect;
    //$user=$_POST['username'];
    $otp=$_POST['otp'];
    $new_pass=$_POST['new_pass'];
    $new1_pass=$_POST['new1_pass'];
    $query="SELECT * FROM otp_details WHERE stud_id='$user' AND otp='$otp'";
    $result=mysqli_query($connect,$query);
    $row=mysqli_fetch_assoc($result);
    //echo $row['stud_id'].$row['otp'];
    if(!empty($row))
    {
        if($new_pass==$new1_pass)
        {
            $query1="UPDATE student SET stud_password='$new_pass' WHERE student.stud_id='$user'";
            $result=mysqli_query($connect,$query1);
            if($result)
            {
                echo '<h5 class="text-center text-success"><br>Password updated</h5>';
                $query2="DELETE FROM otp_details WHERE otp_details.stud_id = '$user' AND otp_details.otp ='$otp'";
                $result=mysqli_query($connect,$query2);
                if(!$result)
                {
                    die(mysqli_error());
                }
            }
            else
            {
                die(mysqli_error());
            }
        }
        else
        {
            echo '<h5 class="text-center text-danger"><br>Password does not match</h5>';
        }
    }
    else
    {
        echo '<h5 class="text-center text-danger"><br>Invalid username or OTP</h5>';
    }
    
}

function generateOTP()
{
    global $connect;
    require('forget_pass_textlocal.class.php');
    require('forget_pass_credentials.php');
    $textlocal = new Textlocal(false,false,apikey);
    $user=$_POST['username'];
    $query="SELECT * FROM student WHERE stud_id='$user'";
    $result=mysqli_query($connect,$query);
    
    if($result)
    {
        $row=mysqli_fetch_assoc($result); 
        //echo $row['stud_mobile_no'];
        $user=$row['stud_id'];
        $numbers = array($row['stud_mobile_no']);
        $sender = 'TXTLCL';
        $otp = mt_rand(10000,99999);
        $message = "Dear ". $_POST['username'] . ", \nSingle-use code(OTP) for altering your password is " .$otp .". Secure your account. \nRegards, \n PSG Tech Canteen";
        try {
                //$result = $textlocal->sendSms($numbers, $message, $sender);
                echo "<br><center>OTP successfully sent</center>";
                //echo $message;
                $query1="INSERT INTO otp_details (stud_id,otp) VALUES ('$user',$otp)";
                $result1=mysqli_query($connect,$query1);
                if(!$result1)
                {
                    mysqli_error($result);
                }
                
                //print_r($result);
        } 
        catch(Exception $e)
        {
            echo('Error: ' . $e->getMessage());
        }
    }
    else
    {
        echo mysqli_error($connect);
    }
}

function change_canteen_status($status,$canteen)
{
    global $connect;
    $query="UPDATE canteen SET canteen_status=$status WHERE canteen.canteen_name='$canteen'";
    //$query = "UPDATE student SET stud_name='$Username', stud_password='$Password' where stud_id=$id ";
    
    $result=mysqli_query($connect,$query);
    if($result)
    {
        echo '<small class="text-center text-success">Canteen status updated</small>'; 
    }
    else
    {
        die(mysqli_error($connect));
    }
}

function check_id($id){
  
    if((strlen($id)!=6) or !(preg_match('/1\d[AMZILTEUCz][2-3][0-7]\d/', $id)))
    {    echo '<script>alert("Invalid Roll Number");</script>';
        return 0;
    }
    return 1;
    
}


function check_username($name){
    if (!ctype_alpha($name)){
        echo '<script>alert("Invalid Name")</script>';
        return 0;
    }
    return 1;
}

function check_password($pass){
    if(strlen($pass)<8)
    {
        echo '<script>alert("Password should be atleast eight characters")</script>';
        return 0;
    }
    return 1;
}

function check_equality_of_password($pass,$c_pass){
    if($pass!=$c_pass){
        echo '<script>alert("Passwords does not match")</script>';
        return 0;
    }
    return 1;
}

function check_mobileno($mobile){
    if(ctype_alpha($mobile) or strlen($mobile)!=10){
        echo '<script>alert("Invalid Phone Number")</script>';
        return 0;
    }
    return 1;
}


function createRows()
{ 
    global $connect;


    $user=$_POST['username'];
    $pass=$_POST['password'];
    $ide=$_POST['id'];
    $c_pass=$_POST['c_password'];
    $mobile=$_POST['m_no'];
    
    $user=mysqli_real_escape_string($connect,$user);
    $pass=mysqli_real_escape_string($connect,$pass);
    $ide=mysqli_real_escape_string($connect,$ide);
    
    
    $a = check_id($ide);
    $b = check_password($pass);
    $c = check_equality_of_password($pass,$c_pass);
    $d = check_mobileno($mobile);
    $e= check_username($user);


    if($a&&$b&&$c&&$d&&$e){   
        $user=strtoupper($user);
         if($connect)
         {

            $query="INSERT INTO student(stud_name,stud_password,stud_id,balance_amt,stud_mobile_no) VALUES ('$user','$pass','$ide',0,$mobile)";
            $result=mysqli_query($connect,$query);
            if(!$result)
            {
                    die(mysqli_error($connect));
            }else
            {
                    echo '<script>alert("Account created successfully")</script>';   
            }

         }   
    }
    else
    {
        echo '<script>alert("Sign Up Failed")</script>';
    }
}
    



function createRows1()
{ 
    global $connect;
    if(isset($_POST['submit']))
    {
        $user=$_POST['username'];
        $pass=$_POST['password'];
        $ide=$_POST['id'];
        $c_pass=$_POST['c_password'];
        $mobile=$_POST['m_no'];
        $user=mysqli_real_escape_string($connect,$user);
        $pass=mysqli_real_escape_string($connect,$pass);
        $ide=mysqli_real_escape_string($connect,$ide);



        $a = check_username($user);
        $b = check_password($pass);
        $c = check_equality_of_passwords($pass,$c_pass);
        $d = check_mobileno($mobile);

        if($a&&$b&&$c&&$d){
                  //$salt='$5$rounds=3000$onlyyouandonlyyoucan$';
            //$pass=crypt($pass,$salt);    
            if($connect)
            {
               /*if(strlen(strval($_POST['m_no']))!=10)
               {
                   echo '<small class="text-danger text-center"><center>Enter 10 digit phone number</center></small><br>';
               }*/
                /*else
                {*/
                $query="INSERT INTO student(stud_name,stud_password,stud_id,balance_amt,stud_mobile_no) VALUES ('$user','$pass','$ide',500,'$mobile')";
                /*
                        if($pass===$c_pass)
                        {*/
                            $result=mysqli_query($connect,$query);
                            if(!$result)
                            {
                                    die(mysqli_error($connect));
                            }else
                            {
                                    echo '<script>alert("Account created successfully")</script>';   
                            }
                        /*}
                        else
                        {
                   echo '<small class="text-danger text-center"><center>Passwords does not match</center></small><br>';
                        }*/
                /*}*/
            }   
        }
        else
        {
            die("Login failed");
        }
    }
    
}

function validateAdmin()
{
    global $connect;
    $id=$_POST['Admin_name'];
    $passwd=$_POST['Password'];
    //$salt='$5$rounds=3000$onlyyouandonlyyoucan$';
    //$passwd=crypt($passwd,$salt);
    if(empty($id)||empty($passwd))
    {
        echo "<br><center style='color:red';>Invalid Username or Password</center>";
        return;
    }
    $query="SELECT * FROM admin WHERE admin_id='$id' AND admin_password='$passwd'";
    $result=mysqli_query($connect,$query);
    if($result)
    {
        $value=mysqli_fetch_assoc($result); 
        if($value)
        {
            $_SESSION['adminlog']='set';
            header("Location:admin.php");
        }
        else{
            echo "<br><center style='color:red';>Invalid Username or Password</center>"; 
        }
    }    
    else
        header("Location:adminlogin.php");
  
}

function showAlldata()
{
        global $connect;
        $query="SELECT * FROM student";
        $result=mysqli_query($connect,$query);
         while($row = mysqli_fetch_assoc($result))
         {
             $id=$row['stud_id'];
             echo "<option value='$id'>$id</option>";    
        }
}

function UpdateData()
{       global $connect;
        $Username=$_POST['Username'];
        $Password=$_POST['Password'];
        $id=$_POST['id'];
        $query = "UPDATE student SET stud_name='$Username', stud_password='$Password' where stud_id=$id ";
        $result = mysqli_query($connect,$query);
        if(!$result)
        {
            die(mysqli_error($connect));
        }
}

function displayData()
{
     global $connect;
     $query="SELECT * FROM student";
     $result=mysqli_query($connect,$query);
     if($result)
     {
         while($value = mysqli_fetch_assoc($result))
         {
            //             echo "<br>".$value[0]." ".$value[1]." ".$value[2]." "."<br>";
        ?>
         <pre>                  
         <?php                    
             print_r($value);
         ?>                   
         </pre>
        <?php
         }
       }
}

function deleteRows()
{
    global $connect;
    $id=$_POST['id'];
    $query = "DELETE FROM user WHERE stud_id=$id";
    $result = mysqli_query($connect,$query);
    if(!$result)
    {
        die("<br>".mysqli_error($connect));
    }
}


















// function validateOTP()
// {
    
//     global $connect;
//     $user=$_POST['username'];
//     $otp=$_POST['otp'];
//     $new_pass=$_POST['new_pass'];
//     $new1_pass=$_POST['new1_pass'];
    
//     $query="SELECT * FROM otp_details WHERE stud_id='$user' AND otp='$otp'";
//     $result=mysqli_query($connect,$query);
//     $row=mysqli_fetch_assoc($result);
//     echo $row['stud_id'].$row['otp'];
//     if(!empty($row))
//     {
//         if($new_pass==$new1_pass)
//         {
//             $query1="UPDATE student SET stud_password='$new_pass' WHERE student.stud_id='$user'";
//             $result=mysqli_query($connect,$query1);
//             if($result)
//             {
//                 echo "Password updated";  
//                 $query2="DELETE FROM otp_details WHERE otp_details.stud_id = '$user' AND otp_details.otp ='$otp'";
//                 $result=mysqli_query($connect,$query2);
//                 if(!$result)
//                 {
//                     die(mysqli_error());
//                 }
//             }
//             else
//             {
//                 die(mysqli_error());
//             }
//         }
//         else
//         {
//             echo "Password does not match";
//         }
//     }
//     else
//     {
//         echo "Invalid username or OTP";
//     }
    
// }


// function generateOTP()
// {
//     global $connect;
//      require('forget_pass_textlocal.class.php');
//         require('forget_pass_credentials.php');
//         $textlocal = new Textlocal(false,false,apikey);
//         $user=$_POST['username'];
//         $query="SELECT * FROM student WHERE stud_id='$user'";
//         $result=mysqli_query($connect,$query);
        
//         if($result)
//         {
//             $row=mysqli_fetch_assoc($result); 
//             echo $row['stud_mobile_no'];
//             $user=$row['stud_id'];
//             $numbers = array($row['stud_mobile_no']);
//             $sender = 'TXTLCL';
//             $otp = mt_rand(10000,99999);
//             $message = "Hello " . $_POST['username'] . " Your one time password for changing the password is " .$otp ;
//             try {
//                     $result = $textlocal->sendSms($numbers, $message, $sender);
//                     echo "OTP successfully sent".$otp;
//                     $query1="INSERT INTO otp_details (stud_id,otp) VALUES ('$user',$otp)";
//                     $result1=mysqli_query($connect,$query1);
//                     if(!$result1)
//                     {
//                         mysqli_error($result);
//                     }
                    
//                     //print_r($result);
//             } catch (Exception $e)
//             {
//                     die('Error: ' . $e->getMessage());
//             }
//         }
//         else
//         {
//             mysqli_error($connect);
//         }
// }


// function change_canteen_status($status,$canteen)
// {
//     global $connect;
//         $query="UPDATE canteen SET canteen_status=$status WHERE canteen.canteen_id='$canteen'";
// }

/*function f_block()
{
    global $connect;
    $query="SELECT canteen_status from canteen WHERE canteen_id='C1'";
    $result=mysqli_query($connect,$query);
    if(!$result)
    {
        die(mysqli_error($connect));   
    }
    else
    {
        $value=mysqli_fetch_assoc($result);
        if($value==1)
        {
            
        }
        else if($value==0)
        {
            echo "Canteen closed";
        }
    }
}*/





// function createRows()
// { 
//     global $connect;
//     if(isset($_POST['submit']))
//     {
//     $user=$_POST['username'];
//     $pass=$_POST['password'];
//     $ide=$_POST['id'];
//     $c_pass=$_POST['c_password'];
//     $mobile=$_POST['m_no'];
//     $user=mysqli_real_escape_string($connect,$user);
//     $pass=mysqli_real_escape_string($connect,$pass);
//     $ide=mysqli_real_escape_string($connect,$ide);
        
//     //$salt='$5$rounds=3000$onlyyouandonlyyoucan$';
//     //$pass=crypt($pass,$salt);    
//     if($connect)
//     {
//         //echo "<br><br>huh! we are connected!!!";
//         $query="INSERT INTO student(stud_name,stud_password,stud_id,balance_amt,stud_mobile_no) VALUES ('$user','$pass','$ide',500,'$mobile')";
        
//       if($pass===$c_pass)
//       {
//         $result=mysqli_query($connect,$query);
//         if(!$result)
//         {
//             die(mysqli_error($connect));
//         }else
//         {
//             echo '<script>alert("Account created successfully")</script>';   
//         }
//       }
//       else
//       {
//           echo "Password does not match";
//       }
//     }
//     else
//     {
//         echo "Failed";
//         die("Login failed");
//     }
    
// }
// }





/*
Fatal error: Cannot redeclare canteen_login() (previously declared in C:\xampp\htdocs\demo\original\php_functions.php:7) in C:\xampp\htdocs\demo\original\php_functions.php on line 7
*/









// function showAlldata()
// {
//         global $connect;
//         $query="SELECT * FROM student";
//         $result=mysqli_query($connect,$query);
//          while($row = mysqli_fetch_assoc($result))
//          {
//              $id=$row['stud_id'];
//              echo "<option value='$id'>$id</option>";    
//         }
// }



// function UpdateData()
// {       global $connect;
//         $Username=$_POST['Username'];
//         $Password=$_POST['Password'];
//         $id=$_POST['id'];
//         $query = "UPDATE student SET stud_name='$Username', stud_password='$Password' where stud_id=$id ";
//         $result = mysqli_query($connect,$query);
//         if(!$result)
//         {
//             die(mysqli_error($connect));
//         }
// }


// function displayData()
// {
//      global $connect;
//      $query="SELECT * FROM student";
//      $result=mysqli_query($connect,$query);
//      if($result)
//      {
//          while($value = mysqli_fetch_assoc($result))
//          {
//             //             echo "<br>".$value[0]." ".$value[1]." ".$value[2]." "."<br>";

//          }
//        }
// }

// function deleteRows()
// {
//     global $connect;
//     $id=$_POST['id'];
//     $query = "DELETE FROM user WHERE stud_id=$id";
//     $result = mysqli_query($connect,$query);
//     if(!$result)
//     {
//         die("<br>".mysqli_error($connect));
//     }
// }
