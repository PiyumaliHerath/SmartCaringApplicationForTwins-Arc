
<?php
// Set your timezone
date_default_timezone_set('Asia/Tokyo');

// Get prev & next month
if (isset($_GET['ym'])) {
    $ym = $_GET['ym'];
} else {
    // This month
    $ym = date('Y-m');
}

// Check format
$timestamp = strtotime($ym . '-01');
if ($timestamp === false) {
    $ym = date('Y-m');
    $timestamp = strtotime($ym . '-01');
}

// Today
$today = date('Y-m-j', time());
$x = date_create("2020-05-15");
$eday = date_format($x,"Y-m-j");
print_r($today);
print_r(date_format($x,"Y-m-j"));


// For H3 title
$html_title = date('Y / m', $timestamp);

// Create prev & next month link     mktime(hour,minute,second,month,day,year)
$prev = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)-1, 1, date('Y', $timestamp)));
$next = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)+1, 1, date('Y', $timestamp)));
// You can also use strtotime!
// $prev = date('Y-m', strtotime('-1 month', $timestamp));
// $next = date('Y-m', strtotime('+1 month', $timestamp));

// Number of days in the month
$day_count = date('t', $timestamp);

// 0:Sun 1:Mon 2:Tue ...
$str = date('w', mktime(0, 0, 0, date('m', $timestamp), 1, date('Y', $timestamp)));
//$str = date('w', $timestamp);


// Create Calendar!!
$weeks = array();
$week = '';

// Add empty cell
$week .= str_repeat('<td></td>', $str);

for ( $day = 1; $day <= $day_count; $day++, $str++) {

    $date = $ym . '-' . $day;

    if ($eday == $date) {
        $week .= '<td class="event">' . $day;
    }else if ($today == $date) {
        $week .= '<td class="today">' . $day;
    } else {
        $week .= '<td>' . $day;
    }
    $week .= '</td>';

    // End of the week OR End of the month
    if ($str % 7 == 6 || $day == $day_count) {

        if ($day == $day_count) {
            // Add empty cell
            $week .= str_repeat('<td></td>', 6 - ($str % 7));
        }

        $weeks[] = '<tr>' . $week . '</tr>';

        // Prepare for new week
        $week = '';
    }

}
?>
<html>

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
?>

<!-- Login page body -->
<div class="bg-reg">
<div class="row mx-5 mt-5">
    <div class="col-md-4 ">
        <div class="row ">
            <div class="card box w-75">
                <div class="card-header">
                    <h3 class="title text-center"> <i class="fas fa-utensils"></i> Meal Plan</h3>
                </div>
                <div class="card-body">
                    <h5 class="card-title"> Tommorow Meal Plan</h5>
                    <?php
                    if($data[0] != "s"){
                        if($data[2] == 1){
                            echo "<text class='foodlist'> Breakfast <span class='foodallergy'> $data[1]</span> </text> <br>";
                            echo '<p class="text-success sub">'. implode(', ', $data[9]) .'</p>';
                        }else{
                            echo "<text class='foodlist'> Breakfast <span class='food'> $data[1]</span> </text><br>";
                        }

                    if($data[4] == 1){
                        echo "<text class='foodlist'> Morning Snack <span class='foodallergy'>  $data[3] </span> </text><br>";
                        echo '<p class="text-success sub">'. implode(', ', $data[10]) .'</p>';

                    }else{
                        echo "<text class='foodlist'> Morning Snack <span class='food'>  $data[3] </span> </text><br>";
                    }

                        if($data[6] == 1){
                            echo "<text class='foodlist'> Lunch <span class='foodallergy'>  $data[5] </span> </text><br>";
                            echo '<p class="text-success sub">'. implode(', ', $data[11]) .'</p>';
                        }else{
                            echo "<text class='foodlist'> Lunch <span class='food'>  $data[5] </span> </text><br>";
                        }

                        if($data[8] == 1){
                            echo "<p class='foodlist'> Snack After Lunch <span class='foodallergy'>  $data[7] </span> </p>";
                            echo '<p class="text-success sub">'. implode(', ', $data[12]) .'</p>';
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
        <div class="row ">
            <div class="card box w-75">
                <div class="card-header">
                    <h3 class="title text-center"> <i class="fas fa-envelope-open-text"></i> Messages</h3>
                </div>
                <div class="card-body">
                    <?php
                         $count = 0;
                            foreach($sdata as $message){
                                echo "<div class='alert alert-primary'> <text>".$message->message."</text><br> <text class='textdate'>".$message->date."</text> <text class='texttime'> ".$message->time."</text></div>";
                                $count++;
                            }
                            if($count ==0){
                                echo "<p> No messages</p>";
                            }

                    ?>
                </div>
                <div class="card-header">
                    <a href="allmessages?id=<?php echo $_GET['id']?>">See full Messages</a>
                </div>
            </div>
        </div>
    </div>

  <div class="col-md-4">

  </div>
        <div class="col-md-4 ">
            <div class="row">
            <div class="card box w-75">
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
            <div class="row">
                <div class="card box w-75">
                <div class="card-header">
                    <h3 class="title text-center"> <i class="fas fa-bell"></i> Calender</h3>
                </div>
                    <div class="card-body">

<!--                            <h3><a href="?ym=--><?php //echo $prev; ?><!--">&lt;</a> --><?php //echo $html_title; ?><!-- <a href="?ym=--><?php //echo $next; ?><!--">&gt;</a></h3>-->
                            <table class="table table-bordered">
                                <tr>
                                    <th>S</th>
                                    <th>M</th>
                                    <th>T</th>
                                    <th>W</th>
                                    <th>T</th>
                                    <th>F</th>
                                    <th>S</th>
                                </tr>
                                <?php
                                foreach ($weeks as $week) {
                                    echo $week;
                                }
                                ?>
                            </table>

                     </div>
                    <div class="card-header">
                        <a href="allevents">See All Events</a>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

</div>


<footer class="fixed-bottom">
    <a href="emergencycall" class="btn btn-success my-2 mx-5"><i class="fas fa-phone-volume mx-3"></i>Call</a>
</footer>
</body>



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