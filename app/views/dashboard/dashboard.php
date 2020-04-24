x<html>

<head>
    <!-- Import Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Import custom css -->
    <link rel="stylesheet" href="../../../daycare-pure/public/css/dashboard.css">
</head>

<body>

<!--Import Navbar from partial folder-->
<?php
include($_SERVER['DOCUMENT_ROOT'].'/daycare-pure/app/views/partials/navbar/navbar.php');
//
//$day = date("l",strtotime(' +1 day'));
//
//
//
////Get the first letter of the day
//$temp = strtolower($day[0]);
//if ($temp == "t"){
//    $fletter = substr(strtolower($day),0,2); //if first letter of the day is "t" then it take first two letters
//}else if($temp=="s"){
//    $fletter = "w"; //if the day is saturday or sunday
//}else{
//    $fletter = $temp;
//}
//
//
//if($fletter != "w"){
//    //meal names
//    $m1 =$fletter."breakfast";
//    $m2 =$fletter."msnack";
//    $m3 =$fletter."lunch";
//    $m4 =$fletter."lsnack";
//
////to get real name from foodlist
//    $m11 = $data[$m1];
//    $m21 = $data[$m2];
//    $m31 = $data[$m3];
//    $m41 = $data[$m4];
//}

?>

<!-- Login page body -->
<div class="bg-reg">
    <div class="row mt-5">
        <div class="col-md-3">
            <div class="card box">
                <div class="card-header">
                    <h3 class="title text-center"> <i class="fas fa-utensils"></i> Meal Plan</h3>
                </div>
                <div class="card-body">
                    <h5 class="card-title"> Tommorow Meal Plan</h5>
                    <?php
                    if($data[0] != "s"){
                        if($data[2] == 1){
                            echo "<text class='foodlist'> Breakfast <span class='foodallergy'> $data[1]</span> </text> <br>";
                        }else{
                            echo "<text class='foodlist'> Breakfast <span class='food'> $data[1]</span> </text><br>";
                        }

                    if($data[4] == 1){
                        echo "<text class='foodlist'> Morning Snack <span class='foodallergy'>  $data[3] </span> </text><br>";
                    }else{
                        echo "<text class='foodlist'> Morning Snack <span class='food'>  $data[3] </span> </text><br>";
                    }

                        if($data[6] == 1){
                            echo "<text class='foodlist'> Lunch <span class='foodallergy'>  $data[5] </span> </text><br>";
                        }else{
                            echo "<text class='foodlist'> Lunch <span class='food'>  $data[5] </span> </text><br>";
                        }

                        if($data[8] == 1){
                            echo "<p class='foodlist'> Snack After Lunch <span class='foodallergy'>  $data[7] </span> </p>";
                        }else{
                            echo "<p class='foodlist'> Snack After Lunch <span class='food'>  $data[7] </span> </p>";
                        }




                    }else{
                        echo "<p>Tommorow is weekday</p>";
                    }
                    ?>

                </div>
                <div class="card-header">
                    <a href="currentmealplan">See full Meal Plan</a>
                </div>
            </div>
        </div>

        <div class="col-md-6">

        </div>
        <div class="col-md-3">
            <div class="card box">
                <div class="card-header">
                    <h3 class="title text-center"> <i class="fas fa-bell"></i> Notifications</h3>
                </div>
                    <div class="card-body">
                        <?php
                            foreach($mdata as $notification){
                             echo "<div class='alert alert-".$notification->type."'>".$notification->message ." </div>";
                            }
                        ?>
                    </div>
                <div class="card-header">
                    <a href="allnotifications">See All Notifications</a>
                </div>

            </div>
        </div>
    </div>

</div>




<!-- Font Awsome -->
<script src="https://kit.fontawesome.com/75dbf31c78.js" crossorigin="anonymous"></script>


<!-- Import JQurey in bootstrap -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>

<!-- import custom java script -->
<script src="home.js" type="text/javascript"></script>

</body>

</html>