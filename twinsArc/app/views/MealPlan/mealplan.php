<html>

<head>
  <!-- Import Bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <!-- Import custom css -->
  <link rel="stylesheet" href="../../../daycare-pure/public/css/mealplan.css">
</head>

<body>

<?php
include($_SERVER['DOCUMENT_ROOT'].'/daycare-pure/app/views/partials/navbar/navbar.php');

?>
  </div>


  
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
          <form action="newmealplan">
            <p class="pt-5">Meal Plan</p>
            <hr>

            <table class="table table-md">
              <thead>
                <tr class="table-primary">
                  <th scope="col">Monday</th>
                  <th scope="col">Tuesday</th>
                  <th scope="col">Wednsday</th>
                  <th scope="col">Thursday</th>
                  <th scope="col">Friday</th>
                </tr>
              </thead>
              <tbody>
                <tr class="table-info">
                  <th colspan="5" class="text-center">Breakfast</th>
                </tr>
                <tr>
                  <th>
                    <select class="form-control" name="mbreakfast">
                        <?php
                        foreach($data as $food){
                            if($food->foodtype == 'breakfast'){
                                echo "<option value=$food->id>$food->foodname </option>";
                            }

                            // echo $parent->parentName;
                        }
                        ?>
                    </select>
                  </th>
                  <th>
                      <select class="form-control" name="tubreakfast">
                          <?php
                          foreach($data as $food){
                              if($food->foodtype == 'breakfast'){
                                  echo "<option value=$food->id>$food->foodname </option>";
                              }

                              // echo $parent->parentName;
                          }
                          ?>
                      </select>
                  </th>
                  <th>
                      <select class="form-control" name="wbreakfast">
                          <?php
                          foreach($data as $food){
                              if($food->foodtype == 'breakfast'){
                                  echo "<option value=$food->id>$food->foodname </option>";
                              }

                              // echo $parent->parentName;
                          }
                          ?>
                      </select>
                  </th>
                  <th>
                      <select class="form-control" name="thbreakfast">
                          <?php
                          foreach($data as $food){
                              if($food->foodtype == 'breakfast'){
                                  echo "<option value=$food->id>$food->foodname </option>";
                              }

                              // echo $parent->parentName;
                          }
                          ?>
                      </select>
                  </th>
                  <th>
                      <select class="form-control" name="fbreakfast">
                          <?php
                          foreach($data as $food){
                              if($food->foodtype == 'breakfast'){
                                  echo "<option value=$food->id>$food->foodname </option>";
                              }

                              // echo $parent->parentName;
                          }
                          ?>
                      </select>
                  </th>
                </tr>

                <tr class="table-info">
                  <th colspan="5" class="text-center">Morning Snack</th>
                </tr>
                <tr>
                  <th>
                      <select class="form-control" name="mmsnack">
                          <?php
                          foreach($data as $food){
                              if($food->foodtype == 'msnack'){
                                  echo "<option value=$food->id>$food->foodname </option>";
                              }

                              // echo $parent->parentName;
                          }
                          ?>
                      </select>
                  </th>
                  <th>
                      <select class="form-control" name="tumsnack">
                          <?php
                          foreach($data as $food){
                              if($food->foodtype == 'msnack'){
                                  echo "<option value=$food->id>$food->foodname </option>";
                              }

                              // echo $parent->parentName;
                          }
                          ?>
                      </select>
                  </th>
                  <th>
                      <select class="form-control" name="wmsnack">
                          <?php
                          foreach($data as $food){
                              if($food->foodtype == 'msnack'){
                                  echo "<option value=$food->id>$food->foodname </option>";
                              }

                              // echo $parent->parentName;
                          }
                          ?>
                      </select>
                  </th>
                  <th>
                      <select class="form-control" name="thmsnack">
                          <?php
                          foreach($data as $food){
                              if($food->foodtype == 'msnack'){
                                  echo "<option value=$food->id>$food->foodname </option>";
                              }

                              // echo $parent->parentName;
                          }
                          ?>
                      </select>
                  </th>
                  <th>
                      <select class="form-control" name="fmsnack">
                          <?php
                          foreach($data as $food){
                              if($food->foodtype == 'msnack'){
                                  echo "<option value=$food->id>$food->foodname </option>";
                              }

                              // echo $parent->parentName;
                          }
                          ?>
                      </select>
                  </th>
                </tr>


                <tr class="table-info">
                  <th colspan="5" class="text-center">Lunch</th>
                </tr>
                <tr>
                  <th>
                      <select class="form-control" name="mlunch">
                          <?php
                          foreach($data as $food){
                              if($food->foodtype == 'lunch'){
                                  echo "<option value=$food->id>$food->foodname </option>";
                              }

                              // echo $parent->parentName;
                          }
                          ?>
                      </select>
                  </th>
                  <th>
                      <select class="form-control" name="tulunch">
                          <?php
                          foreach($data as $food){
                              if($food->foodtype == 'lunch'){
                                  echo "<option value=$food->id>$food->foodname </option>";
                              }

                              // echo $parent->parentName;
                          }
                          ?>
                      </select>
                  </th>
                  <th>
                      <select class="form-control" name="wlunch">
                          <?php
                          foreach($data as $food){
                              if($food->foodtype == 'lunch'){
                                  echo "<option value=$food->id>$food->foodname </option>";
                              }

                              // echo $parent->parentName;
                          }
                          ?>
                      </select>
                  </th>
                  <th>
                      <select class="form-control" name="thlunch">
                          <?php
                          foreach($data as $food){
                              if($food->foodtype == 'lunch'){
                                  echo "<option value=$food->id>$food->foodname </option>";
                              }

                              // echo $parent->parentName;
                          }
                          ?>
                      </select>
                  </th>
                  <th>
                      <select class="form-control" name="flunch">
                          <?php
                          foreach($data as $food){
                              if($food->foodtype == 'lunch'){
                                  echo "<option value=$food->id>$food->foodname </option>";
                              }

                              // echo $parent->parentName;
                          }
                          ?>
                      </select>
                  </th>
                </tr>

                <tr class="table-info">
                  <th colspan="5" class="text-center"> Snack after lunch</th>
                </tr>
                <tr>
                  <th>
                      <select class="form-control" name="mlsnack">
                          <?php
                          foreach($data as $food){
                              if($food->foodtype == 'lsnack'){
                                  echo "<option value=$food->id>$food->foodname </option>";
                              }
                          }
                          ?>
                      </select>
                  </th>
                  <th>
                      <select class="form-control" name="tulsnack">
                          <?php
                          foreach($data as $food){
                              if($food->foodtype == 'lsnack'){
                                  echo "<option value=$food->id>$food->foodname </option>";
                              }
                          }
                          ?>
                      </select>
                  </th>
                  <th>
                      <select class="form-control" name="wlsnack">
                          <?php
                          foreach($data as $food){
                              if($food->foodtype == 'lsnack'){
                                  echo "<option value=$food->id>$food->foodname </option>";
                              }
                          }
                          ?>
                      </select>
                  </th>
                  <th>
                      <select class="form-control" name="thlsnack">
                          <?php
                          foreach($data as $food){
                              if($food->foodtype == 'lsnack'){
                                  echo "<option value=$food->id>$food->foodname </option>";
                              }
                          }
                          ?>
                      </select>
                  </th>
                  <th>
                      <select class="form-control" name="flsnack">
                          <?php
                          foreach($data as $food){
                              if($food->foodtype == 'lsnack'){
                                  echo "<option value=$food->id>$food->foodname </option>";
                              }
                          }
                          ?>
                      </select>
                  </th>
                </tr>

                
              </tbody>
              </table>


            
            <div class="row">
              <button type="submit" class="btn btn-primary btn-lg mt-5 mx-3">Submit</button>
            </div>

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

</html>