<?php
    $messages = file("data/contactUs.txt");
?>
<div class="banner-agile">
    <div class="container">
        <h2>DOBRO DOŠLI</h2>
        <h3>VREDNE <span>RUKE</span></h3>
        <p>Otkrijte svoj stil - inspirišite se našom kolekcijom vrhunske garderobe i istaknite se u svakoj prilici!</p>
        <!-- <a href="index.php?page=about"></a> -->
    </div>
</div>
<div class="banner-bootom-w3-agileits">
    <div class="container">
        <?php
        global $conn;
        $sql="SELECT * FROM popust order by id";
        $result=$conn->query($sql)->fetchAll();
        foreach($result as $r):
            if($r->naziv!="0"):
        ?>
        <div class="col-md-4 bb-grids bb-left-agileits-w3layouts">
            <a href="index.php?page=shop&popust=<?=$r->naziv?>&category=all"><div class="bb-left-agileits-w3layouts-inner">
                    <h3>RASPRODAJA</h3>
                    <h4>čak do<span><?=$r->naziv?>%</span></h4>
                </div></a>
        </div>
    
        <?php 
        endif;
        endforeach; ?>

        <div class="clearfix"></div>
    </div>
</div>

<div class="fandt">
    <div class="container">
        <div class="col-md-6 features" <?php if($messages==null) echo "style='margin-left:30%;'"?>>
            <h3>Naš servis
            </h3>
            <div class="support">
                <div class="col-md-2 ficon hvr-rectangle-out">
                    <i class="fa fa-user " aria-hidden="true"></i>
                </div>
                <div class="col-md-10 ftext">
                    <h4>24/7 smo tu za vas</h4>
                    <p>Naša podrška je dostupna non-stop, 24 sata dnevno i 7 dana u nedelji. Uvek smo tu da vam pomognemo i odgovorimo na sva vaša pitanja.</p>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="shipping">
                <div class="col-md-2 ficon hvr-rectangle-out">
                    <i class="fa fa-bus" aria-hidden="true"></i>
                </div>
                <div class="col-md-10 ftext">
                    <h4>Besplatna dostava</h4>
                    <p>Uživajte u brzoj i besplatnoj dostavi. Vaša narudžbina će stići do vas u najkraćem mogućem roku, bez ikakvih dodatnih troškova.</p>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="money-back">
                <div class="col-md-2 ficon hvr-rectangle-out">
                    <i class="fa fa-money" aria-hidden="true"></i>
                </div>
                <div class="col-md-10 ftext">
                    <h4>100% povraćaj novca</h4>
                    <p>Vaše zadovoljstvo nam je najvažnije. Ukoliko niste potpuno zadovoljni vašom kupovinom, vratite proizvod i dobićete povrat novca bez ikakvih pitanja.</p>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <?php
            if($messages!=null):
        ?>
        <div class="col-md-6 testimonials">
            <div class="test-inner">
                <div class="wmuSlider example1 animated wow slideInUp" data-wow-delay=".5s">
                    <div class="wmuSliderWrapper">
                        <?php
                        foreach ($messages as $key=>$m){
                            list($email,$name,$phone,$subject,$message,$status)= explode("__", $m);
                            $objekat[$key]["email"]=$email;
                            $objekat[$key]["name"]=$name;
                            $objekat[$key]["phone"]=$phone;
                            $objekat[$key]["subject"]=$subject;
                            $objekat[$key]["message"]=$message;
                            $objekat[$key]["status"]=$status;
                        }
                        foreach ($objekat as $o):
                            ?>
                            <article style="position: absolute; width: 100%; opacity: 0;">
                                <div class="banner-wrap">
                                    <img src="assets/images/profileImg.jpg" alt=" " class="img-responsive" />
                                    <p><?=$o["message"]?></p>
                                    <h4># <?=$o["name"]?></h4>
                                </div>
                            </article>
                        <?php endforeach; ?>



                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <div class="clearfix"></div>
    </div>
    <script src="assets/js/jquery.wmuSlider.js"></script>
    <script>
        $('.example1').wmuSlider();
    </script>
</div>
