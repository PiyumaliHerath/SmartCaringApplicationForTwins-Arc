<html>

<head>
    <!-- Import Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Import custom css -->
    <link rel="stylesheet" href="../../../daycare-pure/public/css/studentreg.css">
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

        <div class="container mt-5 ">
            <form action="newstudent">
                <p class="pt-1">Basic information</p>
                <hr>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
<!--                            <label for="firstname">First Name </label>-->
                            <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Enter First Name">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
<!--                            <label for="lastname"> Lastname</label>-->
                            <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Enter Last Name">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
<!--                            <label for="gender"> Gender</label>-->
                            <select class="form-control" name="gender" id="gender">
                                <option value="" disabled selected >Gender</option>
                                <option>Male</option>
                                <option>Female</option>
                            </select>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
<!--                            <label for="address">Address</label>-->
                            <input type="text" class="form-control" name="address" id="address" placeholder="Enter address">
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
<!--                            <label for="birthday">Birthday</label>-->
                            <input type="date" class="form-control datepicker" id="birthday" name="birthday" placeholder="Enter Birthday">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
<!--                            <label for="hofcare">Hours of Childcare </label>-->
                            <input type="text" class="form-control" id="hoursofchildcare" name="hoursofchildcare"placeholder="Enter Hours of Chilldcare">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
<!--                            <label for="daysofweek">Days of Week </label>-->
                            <input type="text" class="form-control" id="daysofweek" name="daysofweek" placeholder="Enter Days of Weeks">
                        </div>
                    </div>
                </div>

                <div class="row ">
                    <div class="col-md-12">
                        <!--                    <label for="parent">Parent</label>-->
                        <?php
                        echo '<select class="form-control" name="parent" id="parent">
                                                <option value="" selected disabled> Parent Name</option>';
                        foreach($data as $parent){
                            echo "<option value=$parent->id>$parent->parentName</option>";
                            // echo $parent->parentName;
                        }
                        echo "</select>"
                        ?>
<!--                        <select class="form-control" name="parent" id="parent">-->
<!--                            <option>Nimal</option>-->
<!--                            <option>Kamal</option>-->
<!--                        </select>-->
                    </div>

                </div>

                <p class="pt-3">Emergency Contacts</p>
                <hr>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
<!--                            <label for="ename">Name</label>-->
                            <input type="text" class="form-control" id="ename" name="ename" placeholder="Enter Name">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
<!--                            <label for="ephoneno">Phone no</label>-->
                            <input type="text" class="form-control" id="ephoneno" name="ephoneno"placeholder="Enter Phone no">
                        </div>
                    </div>

                </div>

                <p class="pt-3">Other information</p>
                <hr>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
<!--                            <label for="height">Height </label>-->
                            <input type="text" class="form-control" id="height" name="height" placeholder="Enter Height">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
<!--                            <label for="weight"> Weight</label>-->
                            <input type="text" class="form-control" id="weight" name="weight" placeholder="Enter Weight">
                        </div>
                    </div>
                </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
<!--                                <label for="alergies">Medication Allergies</label>-->
                                <select class="form-control form-control" name="medicationallergies" id="alergies" >
                                    <option value="" disabled selected>Medication Allergies</option>
                                    <option>Yes</option>
                                    <option>No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
<!--                               <label for="foodalergies">Food Allergies </label>-->
                                <select class="form-control form-control selectpicker" name="foodallergies[]" id="foodalergies" multiple>
                                    <option value="no" disabled selected>Food Allergies</option>
                                    <?php
                                    foreach($mdata as $food){
                                        echo "<option value=$food->id>$food->foodname </option>";
                                        // echo $parent->parentName;
                                    }
                                    ?>
                                </select>

                            </div>
                        </div>
                    </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
<!--                            <label for="foodprefference">Food Prefference</label>-->
                            <input type="text" class="form-control" id="foodprefference" name="foodprefference" placeholder="Enter Food Prefference">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
<!--                            <label for="cronichealthconser">Cronic Health Concern </label>-->
                            <input type="text" class="form-control" id="cronichealthconser" name="cronichealthconsern" placeholder="Enter Cronic Health Concern">
                        </div>
                    </div>
                </div>

                <div class="row ">
                    <div class="form-group col-md-12">
                        <!--                    <label for="narrations">Other Narrations</label>-->
                        <textarea class="form-control" id="narrations" name="narrations" rows="3" placeholder="Other Narration"></textarea>
                    </div>

                </div>

                <div class="row ">
                    <div class="form-group col-md-12">
                        <!--                    <label for="specialnotes">Special Notes</label>-->
                        <textarea class="form-control" id="specialnotes" name="specialnotes" rows="3" placeholder="Special notes"></textarea>
                    </div>

                </div>


                <div class="row">
                    <button type="submit" class="btn btn-primary btn-lg mt-5 mx-3">Submit</button>
                </div>


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



<!--DateTime Picker-->

</body>

</html>