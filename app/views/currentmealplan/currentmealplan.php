<html>

<head>
    <!-- Import Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Import custom css -->
    <link rel="stylesheet" href="../../../daycare-pure/public/css/mealplan.css">
</head>

<body>

<!-- Navugation bar -->
<?php
include($_SERVER['DOCUMENT_ROOT'].'/daycare-pure/app/views/partials/navbar/navbar.php');

?>



<div id="wrapper">

    <?php
    include($_SERVER['DOCUMENT_ROOT'].'/daycare-pure/app/views/partials/sidebar/sidebar.php');

    ?>

    <!-- Page Content -->
    <div id="page-content-wrapper">
        <?php  if($_GET['error'] != null){
            echo "<div class='alert alert-danger mt-5'>" .$_GET['error']. "</div>";
        }; ?>
        <?php  if($_GET['success'] != null){
            echo "<div class='alert alert-primary mt-5'>" .$_GET['success']. "</div>";
        }; ?>
        <div class="container mt-1 ">

                <p class="pt-5">Current Meal Plan</p>
                <hr>

            <table class="table table-bordered table-sm text-color">
                <thead>
                <tr class="table-primary">
                    <th scope="col" class="text-center">Monday</th>
                    <th scope="col" class="text-center">Tuesday</th>
                    <th scope="col" class="text-center">Wednsday</th>
                    <th scope="col" class="text-center">Thursday</th>
                    <th scope="col" class="text-center">Friday</th>
                </tr>
                </thead>
                <tbody>
                <tr class="table-info">
                    <th colspan="5" class="text-center">Breakfast</th>
                </tr>
                <tr class="table-success">
                    <td class="text-center"><?php echo $mdata[$data->mbreakfast]; ?></td>
                    <td class="text-center"><?php echo $mdata[$data->tubreakfast]; ?></td>
                    <td class="text-center"><?php echo $mdata[$data->wbreakfast]; ?></td>
                    <td class="text-center"><?php echo $mdata[$data->thbreakfast]; ?></td>
                    <td class="text-center"><?php echo $mdata[$data->fbreakfast]; ?></td>
                </tr>

                <tr class="table-info">
                    <th colspan="5" class="text-center">Morning Snack</th>
                </tr>
                <tr class="table-success">
                    <td class="text-center"><?php echo $mdata[$data->mmsnack]; ?></td>
                    <td class="text-center"><?php echo $mdata[$data->tumsnack]; ?></td>
                    <td class="text-center"><?php echo $mdata[$data->wmsnack]; ?></td>
                    <td class="text-center"><?php echo $mdata[$data->thmsnack]; ?></td>
                    <td class="text-center"><?php echo $mdata[$data->fmsnack]; ?></td>
                </tr>

                <tr class="table-info">
                    <th colspan="5" class="text-center">Lunch</th>
                </tr>
                <tr class="table-success">
                    <td class="text-center"><?php echo $mdata[$data->mlunch]; ?></td>
                    <td class="text-center"><?php echo $mdata[$data->tulunch]; ?></td>
                    <td class="text-center"><?php echo $mdata[$data->wlunch]; ?></td>
                    <td class="text-center"><?php echo $mdata[$data->thlunch]; ?></td>
                    <td class="text-center"><?php echo $mdata[$data->flunch]; ?></td>
                </tr>

                <tr class="table-info">
                    <th colspan="5" class="text-center">Snack After Lunch</th>
                </tr>
                <tr class="table-success">
                    <td class="text-center"><?php echo $mdata[$data->mlsnack]; ?></td>
                    <td class="text-center"><?php echo $mdata[$data->tulsnack]; ?></td>
                    <td class="text-center"><?php echo $mdata[$data->wlsnack]; ?></td>
                    <td class="text-center"><?php echo $mdata[$data->thlsnack]; ?></td>
                    <td class="text-center"><?php echo $mdata[$data->flsnack]; ?></td>
                </tr>

                </tbody>
            </table>

            <p class="pt-5">Allergic Students</p>
            <hr>
            <ul class="list-group">
            <?php
            foreach($sdata as $child){

                echo "<li class='list-group-item list-group-item-danger'> $child[0] $child[1]</li>";
                echo "<ul >";
                foreach (array_slice($child, 2) as $alergicfood){
                    echo "<li class='list-group-item list-group-item-dark'> $mdata[$alergicfood]</li>";
                };
                echo "</ul>";
            }
            ?>
            </ul>



        </div>

    </div>
</div>
<!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->
<!-- Menu Toggle Script -->
<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>



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