
<?php
include "models/functions.php";
?>
<div class="header-top-w3layouts">
    <div class="container">
        <div class="col-md-6 logo-w3">
            <a href="index.php?page=landing">
                <img src="assets/images/logo2.png" alt="Stitch style" />
                <h1>VREDNE<span>RUKE</span></h1>
            </a>
        </div>
        <div class="col-md-6 phone-w3l" id="loginRegister">
            <ul>
                <?php
                if(isset($_SESSION['user'])) {
                    echo "<li><a href='models/logout.php' id='logoutbtn'>Izloguj se <i class='fa-solid fa-power-off'></i></a></li>";
                    echo "<li><a href='index.php?page=profile'>Profil <i class='fa-solid fa-id-badge'></i></a></li>";
                    if($_SESSION['user']->role_id == 1) {
                        echo "<li><a href='views/admin/indexAdmin.php?page=admin'>Administrator <i class='fa-solid fa-screwdriver-wrench'></i></a></li>";
                    }
                    if($_SESSION['user']->role_id == 3){
                        echo "<li><a href='index.php?page=manage' style='background-color: green'>Upravljaj porudzbinama <i class='fa-solid fa-list-check'></i></a></li>";
                    }
                } else {
                    echo "<li><a href='index.php?page=login'>Uloguj se</a></li>";
                    echo "<li><a href='index.php?page=register'>Registruj se</a></li>";
                }
                
                if(isset($_SESSION['user'])) echo "<li style='font-size:2.5rem'>".ucfirst($_SESSION['user']->username)." ".ucfirst($_SESSION['user']->prezime)."</li>"
                ?>

            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>


<div class="header-bottom-w3ls">
    <div class="container">
        <div class="col-md-11 navigation-agileits">
            <nav class="navbar navbar-default">
                <div class="navbar-header nav_2">
                    <button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
                    <ul class="nav navbar-nav ">
                        <?php
                        $nav = GetNavItems();
                        foreach ($nav as $item){
                            if($item->naziv == "Odeća"){
                                echo "<li class='dropdown'>";
                                echo "<a href='#' class='dropdown-toggle hyper' data-toggle='dropdown' ><span>".$item->naziv."<b class='caret'></b></span></a>";
                                echo "<ul class='dropdown-menu multi'>";
                                echo "<div class='row'>";
                                echo "<div class='col-sm-9'>";
                                echo "<ul class='multi-column-dropdown'>";
                                $kategorije = GetCategories();
                                foreach ($kategorije as $kategorija){
                                    echo "<li><a href='index.php?page=shop&category=".$kategorija->id."'><i class='fa fa-angle-right' aria-hidden='true'></i>".$kategorija->naziv."</a></li>";
                                }
                                echo "</ul>";
                                echo "</div>";
                                echo "</div>";
                                echo "</ul>";
                                echo "</li>";
                            } else {
                                echo "<li ><a href='index.php?page=".$item->putanja."' class='hyper'><span>".$item->naziv."</span></a></li>";
                            }

                        }

                        ?>



                    </ul>
                </div>
            </nav>
        </div>
        <script>
            $(document).ready(function(){
                $(".dropdown").hover(
                    function() {
                        $('.dropdown-menu', this).stop( true, true ).slideDown("fast");
                        $(this).toggleClass('open');
                    },
                    function() {
                        $('.dropdown-menu', this).stop( true, true ).slideUp("fast");
                        $(this).toggleClass('open');
                    }
                );
            });
        </script>

        <div class="col-md-1 cart-wthree d-flex justify-content-end">
            <div class="cart">

                <a href="index.php?page=checkout" class="w3view-cart" type="submit" value=""><i class="fa fa-cart-arrow-down" aria-hidden="true"></i></a>

            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>