<?php 

include "serverconnect.php";

if(isset($_POST['filter3']))
{
    $cid=mysqli_real_escape_string($connect,$_POST['canteen1']);
    $ses=mysqli_real_escape_string($connect,$_POST['session1']);


    $query="SELECT * FROM food where canteen_id= '$cid' AND session= '$ses'";
    echo $query;
    $result=mysqli_query($connect,$query);

    echo"<div class='row'>
            <div class='col-sm-5'>
                <div class='form-group'>
                    <label>FOOD NAME:</label>";
    echo "<select class='form-control' name='food2' onchange='foodselect(this.value)'>
    <option value=-1> --SELECT-- </option>";
    while($row = mysqli_fetch_assoc($result))
    {
        $id=$row['food_name'];
        echo "<option value='" .$id. "'>" .$id. "</option>";    
    }
    echo "          </select>
                </div>
                <div class='col-sm-4'>
            <label>CURRENT STATUS:</label>
        </div>
                <div id='currentsts'></div>
            </div>
        </div>";

    echo"    <div class='row'>
                <div class='col-sm-5'>
                <div class='form-group'>
                <label for='status'>FOOD AVAILABILTY:</label>
                <select class='form-control' name='status1' id='status'>
                    <option value=-1>--SELECT--</option>
                    <option value=1>Available</option>
                    <option value=0>Not Available</option>
                </select>
                </div>
                </div>
            </div>
            <br>
            <div class='row'>
                <div class='col-sm-5'>
                <button type='submit' name='status_change' class='btn btn-success'>Change Status</button>
                </div>
            </div>";
}


if(isset($_POST['foodselect2'])){

    $cid=mysqli_real_escape_string($connect,$_POST['canteen1']);
    $ses=mysqli_real_escape_string($connect,$_POST['session1']);
    $foodname=mysqli_real_escape_string($connect,$_POST['foodselect2']);

    $query="SELECT food_status FROM food where canteen_id= '$cid' AND session= '$ses' AND food_name='$foodname'";
    $result=mysqli_query($connect,$query);
    $row = mysqli_fetch_assoc($result);

    echo "<div class='col-sm-4'>
            <label>CURRENT STATUS:</label>
            <div>".$row['food_status']."</div>
        </div>";
}
?>