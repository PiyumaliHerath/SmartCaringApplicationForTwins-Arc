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
            <form action="/daycare-pure/public/admin/newevent">
                <p class="pt-5">Events Management</p>
                <hr>


                <div class="row ">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">Title </label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter Event Title ">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="date">Date </label>
                            <input type="date" class="form-control" id="date" name="date">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="status">Type</label>
                        <select class="form-control" name="status" id="status">
                            <option value="1">Event</option>
                            <option value="0">Holiday</option>
                        </select>
                    </div>
                </div>


                <div class="row">
                    <button type="submit" class="btn btn-primary btn-lg mt-3 mx-3">Submit</button>
                </div>



            </form>

            <div class="container mt-1 ">
                <p class="pt-3">Foods for Meals</p>

                <form>
                    <table class="table table-border table-sm text-color">
                        <thead>
                        <th scope="col">Event Name</th>
                        <th scope="col">Event Type</th>
                        <th colspan="2" scope="col">action</th>
                        </thead>
                        <tbody>
                        <?php
                        foreach($data as $event){
                           echo "<tr><td '>$event->title</td> <td scope='col'>$event->date</td><td ><a href='eventedit?id=$event->id' class='btn btn-primary mx-3'> Edit</a><a href='eventremove?id=$event->id' class='btn btn-primary'> Delete</a></td> </tr>";
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

<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });

</script>
</body>