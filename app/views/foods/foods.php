<html>

<head>
    <!-- Import Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Import custom css -->
    <link rel="stylesheet" href="../../../daycare-pure/public/css/parentreg.css">
</head>

<body>

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
            <form action="/daycare-pure/public/admin/newfood">
                <p class="pt-5">Foods for Meals</p>
                <hr>


                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="foodname">Food Name </label>
                            <input type="text" class="form-control" id="foodname" name="foodname" placeholder="Enter Food Name">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="foodtype">Food type </label>
                        <select class="form-control" name="foodtype" id="foodtype">
                            <option value="breakfast">Breakfast</option>
                            <option value="msnack">Morning Snack</option>
                            <option value="lunch">Lunch</option>
                            <option value="lsnack">Snack after Lunch</option>
                        </select>
                    </div>

                </div>

                <div class="row">
                    <button type="submit" class="btn btn-primary btn-lg mt-3 mx-3">Submit</button>
                </div>

            </form>



        </div>
        <div class="container mt-1 ">
            <p class="pt-3">Foods for Meals</p>

            <form>
                <table class="table table-border table-sm">
                    <thead>
                    <th scope="col">Food Name</th>
                    <th scope="col">Food Type</th>
                    <th scope="col">action</th>
                    </thead>
                    <tbody>
                    <?php
                    foreach($data as $food){
                        $foodtypes = "";
                        if($food->foodtype == 'msnack'){
                           $foodtypes = 'Morning Snack';
                        }else if ($food->foodtype == 'breakfast') {
                            $foodtypes = 'Breakfast';
                        }else if ($food->foodtype == 'lunch') {
                            $foodtypes = 'Lunch';
                        }
                        elseif ($food->foodtype == 'lsnack') {
                            $foodtypes = 'Snack after Lunch';
                        }
                        echo "<tr><td '>$food->foodname</td> <td scope='col'>$foodtypes</td><td ><a href='foodremove?id=$food->id' class='btn btn-primary'> Delete</a></td> </tr>";
                    }
                    ?>

                    </tbody>
                </table>
            </form>
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