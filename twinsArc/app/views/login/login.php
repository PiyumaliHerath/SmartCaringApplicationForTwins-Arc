x<html>

<head>
    <!-- Import Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Import custom css -->
    <link rel="stylesheet" href="../../../daycare-pure/public/css/login.css">
</head>

<body>

<!--Import Navbar from partial folder-->
<?php
include($_SERVER['DOCUMENT_ROOT'].'/daycare-pure/app/views/partials/navbar/navbar.php');

?>

<!-- Login page body -->
<div class="bg-reg">
    <div class="row">
        <div class="card mb-5 round card-bg">
            <h3 class="card-title text-center mt-5 title "> <span class="text-white">Welcome to </span>  <span class="text-primary">DayCare</span> </h3>
            <div class="text-center">
                <p class="slogan text-white"> " Providing an all-inclusive, safe, and caring environment for children " </p>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <img src="../../../daycare-pure/public/images/dad.png" class="w-75 float-center mx-5">
                </div>
                <div class="col-md-8">

                    <form class="mx-3 mb-3" action="/daycare-pure/public/login/index">

                        <div class="form-row">
                            <!-- Email input field -->
                            <div class="form-group col-md-12 col-sm-12 my-3">
                                <label for="inputEmail">Email</label>
                                <input type="email" name="email" #email="ngModel" [(ngModel)]="model.email"
                                       class="form-control" id="inputEmail" placeholder="Enter Email" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <!-- Password input field -->
                            <div class="form-group col-md-12 col-sm-12 my-3">
                                <label for="inputPassword">Password</label>
                                <input type="password" name="password" #password="ngModel" [(ngModel)]="model.password"
                                       class="form-control" id="inputPassword" placeholder="Enter Password" required>
                            </div>
                        </div>

                        <button type="submit" class="btn my-3 submit-btn mr-3 round">Sign Up</button>

                            <?php  if($_GET['error'] != null){
                                echo "<div class='alert alert-danger'>" .$_GET['error']. "</div>";
                            }; ?>


                    </form>
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