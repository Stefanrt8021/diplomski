<div class="footer" style="box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);">
    <div class="container">
        <div class="col-md-3 footer-grids fgd1">
            <a href="index.php?page=landing"><img src="assets/images/logo2.png" alt=" " /><h3>VREDNE<span>RUKE</span></h3></a>

        </div>

        <div class="col-md-6 footer-grids fgd3">
            <ul class="nav navbar-nav"  >
                <?php
                $nav = GetNavItems();
                foreach ($nav as $item){
                    if($item->naziv == "Clothing"){
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
        <div class="col-md-3 footer-grids fgd4">
            <?php
            if(!isset($_SESSION['user'])):
            ?>
            <h4>Moj Profil</h4>
            
            <ul>

                <li><a href="index.php?page=login">Uloguj se</a></li>
                <li><a href="index.php?page=register">Registruj se</a></li>

            </ul>
            <?php endif;?>
        </div>
        <div class="clearfix"></div>
        <p class="copy-right">© 2016 Vredne ruke . All rights reserved | Design by Stefan.</a></p>
    </div>
</div>
<script src="https://kit.fontawesome.com/bdcc9994aa.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
<script src="assets/js/main.js"></script>

</body>
</html>