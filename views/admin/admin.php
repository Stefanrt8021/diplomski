<?php
include "stats.php";
global $conn;
if(isset($_SESSION['user']) && $_SESSION['user']->role_id == 1) {
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Admin</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <!-- Favicon -->
        <link href="img/setting.ico" rel="icon">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">

        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" media="all" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
        <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

        <!-- Customized Bootstrap Stylesheet -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="css/style.css" rel="stylesheet">
    </head>

    <body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                <a href="../../index.php?page=landing" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>Shop</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="../../assets/<?= $_SESSION['user']->naziv_src?>" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0"><?= $_SESSION['user']->username?></h6>
                        <span>Admin</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <?php
                    $sql = "show tables from shop";
                    $rezultat = $conn->query($sql);
                    $red = $rezultat->fetchAll();
                    $niz = [];
                    foreach ($red as $key=>$r)
                    {
                        $niz[$key]=$r->Tables_in_shop;

                    }
                    foreach ($niz as $table_name){
                        echo "<a href='indexAdmin.php?page=table&tabela=$table_name' class='nav-item nav-link'><i class='fa fa-table me-2'></i>$table_name</a>";
                    }



                    ?>





                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav id="adminNav" class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
            </nav>
            <!-- Navbar End -->


            <!-- Sale & Revenue Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-line fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Orders</p>
                                <h6 class="mb-0" id="totalOrders">
                                    <?php 
                                        echo $ukupnoPorudzbina;
                                    ?>
                                   
                                </h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-bar fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Sale</p>
                                <h6 class="mb-0">
                                    <?php 
                                        echo $ukupnaZarada;
                                    ?>


                                </h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-area fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Today Orders</p>
                                <h6 class="mb-0">
                                
                                    <?php 
                                        echo $ukupnoPorudzbinaDanas;
                                    ?>

                                </h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-pie fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Today profit</p>
                                <h6 class="mb-0">
                                    <?php 
                                        echo $ukupnaZaradaDanas;
                                    ?>

                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
                <!--<div class="row" id="UserMessages">
                    <h3 class="text-primary">Neprocitane poruke</h3>
                    <?php
                    include "logicAdmin/functions.php";
                    $objekat = GetMessages();
                    foreach ($objekat as $key=>$o):
                        if ($o["status"]==1){
                    ?>

                      <div class=" col-sm-6 col-xl-3" >
                    <div class="p-3">
                        <div class="bg-secondary d-flex row ">
                                <h6 class="pt-2">Poruka od:</h6>
                                <div class="panelText">
                                    <p>Email: <?=$o["email"]?></p>
                                    <p>Ime: <?=$o["name"]?></p>
                                    <p>Telefon: <?=$o["phone"]?></p>
                                    <p>Subject: <?=$o["subject"]?></p>
                                </div>
                                <button class="accordion">Poruka <i class='fa fa-arrow-circle-down me-2'></i></button>
                                <div class="panel">
                                    <p class="porukamsg"><?=$o["message"]?></p>
                                    <div class="row col-9 d-flex justify-content-center align-items-center buttonsmsgs">
                                    <button data-red="<?=$key?>" class="messageButtons brisiPoruku">Izbrisi</button>
                                    <button data-red="<?=$key?>" class="messageButtons odgovoriNaPoruku">Odgovori</button>
                                    <button data-red="<?=$key?>" class="messageButtons arhivirajPoruku">Arhiviraj</button>
                                    </div>
                                </div>

                        </div>
                    </div>
                </div>
                    <?php
                        }
                    endforeach;
                    ?>
                </div>
                <div class="row" id="UserMessages">
                    <h3 class="text-primary">Procitane poruke</h3>
                    <?php
                    $objekat=GetMessages();
                    foreach ($objekat as $key=>$o):
                        if ($o["status"]==2){
                            ?>

                            <div class=" col-sm-6 col-xl-3" >
                                <div class="p-3">
                                    <div class="bg-secondary d-flex row ">
                                        <h6 class="pt-2">Poruka od:</h6>
                                        <div class="panelText">
                                            <p>Email: <?=$o["email"]?></p>
                                            <p>Ime: <?=$o["name"]?></p>
                                            <p>Telefon: <?=$o["phone"]?></p>
                                            <p>Subject: <?=$o["subject"]?></p>
                                        </div>
                                        <button class="accordion">Poruka <i class='fa fa-arrow-circle-down me-2'></i></button>
                                        <div class="panel">
                                            <p class="porukamsg"><?=$o["message"]?></p>
                                            <div class="row col-9 d-flex justify-content-center align-items-center buttonsmsgs">
                                                <button data-red="<?=$key?>" class="messageButtons brisiPoruku">Izbrisi</button>
                                                <button data-red="<?=$key?>" class="messageButtons odgovoriNaPoruku">Odgovori</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    endforeach;
                    ?>
                </div>-->
                <br>
                <h3>Posećenost stranica</h3>
                
                <hr style="color:white;">
                <?php
                $log_file = '../../data/log.txt';

                // Čitanje log fajla
                $log_data = file($log_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

                // Brojanje posećenosti svake stranice
                $page_visits = array();
                $total_visits = 0;

                foreach ($log_data as $line) {
                    $parts = explode("\t", $line);
                    $page_with_query = $parts[0];

                    // Izdvajanje vrednosti parametra "page" iz query stringa
                    $parsed_url = parse_url($page_with_query);
                    $query_params = [];
                    parse_str($parsed_url['query'], $query_params);
                    $page = isset($query_params['page']) ? $query_params['page'] : '';

                    if (!isset($page_visits[$page])) {
                        $page_visits[$page] = 0;
                    }

                    $page_visits[$page]++;
                    $total_visits++;
                }

                // Izračunavanje procenata posećenosti
                $page_percentages = array();

                foreach ($page_visits as $page => $visits) {
                    $percentage = ($visits / $total_visits) * 100;
                    $page_percentages[$page] = round($percentage, 2);
                }

                // Sortiranje stranica po procenatima posećenosti
                arsort($page_percentages);

                // Ispisivanje rezultata u tabelu
                echo '<table id="procenatPoseta">';
                echo '<tr><th>Stranica</th><th>Procenat posećenosti</th></tr>';

                foreach ($page_percentages as $page => $percentage) {
                    echo '<tr>';
                    echo '<td>' . $page . '</td>';
                    echo '<td>' . $percentage . '%</td>';
                    echo '</tr>';
                }

                echo '</table>';
                ?>




            </div>
            <!-- Sale & Revenue End -->
        </div>


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="https://kit.fontawesome.com/bdcc9994aa.js" crossorigin="anonymous"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    </body>

    </html>

<?php
}
else {
    header("Location: ../../index.php?page=login");
}


?>