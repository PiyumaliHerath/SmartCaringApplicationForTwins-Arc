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
        
        <div class="container mt-1 ">
        <p class="pt-5">Report Generator</p>
            <hr>
            <div class="row mt-5">
                <a class="btn btn-outline-light btn-lg btn-block" href="childrenreport" role="button">Children report</a>
            </div>
            <div class="row mt-5">
                <a class="btn btn-outline-light btn-lg btn-block" href="parentreport" role="button">Parent report</a>
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
  <script src="home.js" type="text/javascript"></script>

</body>

</html>