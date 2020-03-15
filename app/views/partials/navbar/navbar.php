 <!-- Navugation bar -->
 <div class="d-flex flex-row mb-3">
    <header class="header">
        <nav class="navbar navbar-expand-lg fixed-top    py-3 bg-white txt-blue ">
            <div class="container">
                <a href="#" class="navbar-brand text-uppercase font-weight-bold">DayCare </a>
                <button type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"
                    class="navbar-toggler navbar-toggler-right"><span class="navbar-toggler-icon"></span></button>
                <div id="navbarSupportedContent" class="collapse navbar-collapse">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item "><a href="/daycare-pure/public/home/homepage"
                                class="nav-link text-uppercase font-weight-bold txt-blue">Home <span
                                    class="sr-only">(current)</span></a></li>
                        <li class="nav-item "><a href="#"
                                class="nav-link text-uppercase font-weight-bold txt-blue">About</a></li>
                        <li class="nav-item "><a href="#"
                                class="nav-link text-uppercase font-weight-bold txt-blue">Gallery </a></li>

                        <?php
                            if(empty($_SESSION['login_email'])){
                                echo ' <li class="nav-item "><a href="/daycare-pure/public/home/login?error="
                                class="nav-link text-uppercase font-weight-bold txt-blue">LogIn</a></li>
                        <li class="nav-item "><a href="/signup"
                                class="nav-link text-uppercase font-weight-bold txt-blue">SignUp</a></li>';
                            }else{
                                echo '<li class="nav-item "><a href="/daycare-pure/public/login/logout" class="nav-link text-uppercase font-weight-bold txt-blue">logout</a></li>
                                      <li class="nav-item "><a href="/daycare-pure/public/admin/studentreg" class="nav-link text-uppercase font-weight-bold txt-blue"><i class="fas fa-user-tie mx-2 "></i>'.$_SESSION['user_name'].'</a></li>';

                            }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
</div>
