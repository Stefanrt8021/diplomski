<?php
global $conn;
$id=$_GET['product'];
$sql="SELECT p.id as id, p.naziv, s.naziv_src, c.cena, po.naziv as popust FROM proizvod p 
              INNER JOIN robnagrupa r ON p.robnagrupa_id = r.id 
              INNER JOIN boja b ON p.boja_id = b.id 
              INNER JOIN cena c ON p.id = c.proizvod_id
              INNER JOIN slika s ON p.id = s.proizvod_id 
              INNER JOIN popust po ON p.popust_id = po.id                          
                                          where p.id=$id";

$row=$conn->query($sql)->fetch();
$cena=$row->cena;
$popust=$row->popust;
$popustCena=$cena-($cena*$popust/100);
$slika=$row->naziv_src;
$niz=explode("_",$slika);
?>
<div class="products">
    <div class="container">
        <div class="single-page">
            <div class="single-page-row" id="detail-21">
                <div class="col-md-6 single-top-left">
                    <div class="flexslider">
                        <ul class="slides">
                            <li data-thumb="images/s1.jpg">
                                <div class="thumb-image detail_images"> <img src="assets/images/<?=$niz[1]?>" data-imagezoom="true" class="img-responsive" alt=""> </div>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="col-md-6 single-top-right">
                    <h3 class="item_name"><?=$row->naziv?></h3>
                    <p>Porudžbina će biti isporučena u roku od 1-2 dana. </p>
                    <div class="single-price">
                        <ul>
                            <?php
                                if($popust>0):
                            ?>  
                                <li><?=$popustCena?> RSD</li>
                                <li><del><?=$row->cena?></del></li>
                                <li><span class="w3off"><?=$row->popust?>% OFF</span></li>
                                <?php
                                else:
                                ?>
                                    <li><?=$popustCena?> RSD</li>
                                <?php
                                endif;
                                ?>
                                
                                
                        </ul>
                        <?php
                        $upitBroj="Select * from velicina v inner join proizvodvelicina pv on v.id=pv.velicina_id where pv.proizvod_id=$id";
                        $rezultatBroj=$conn->query($upitBroj)->fetchAll();
                        echo"<select id='velicina'>";
                        foreach ($rezultatBroj as $broj):
                            ?>
                            <option value="<?=$broj->id?>"><?=$broj->naziv?></option>
                        <?php endforeach;?>
                        </select>
                        
                    </div>
                    <form action="#" method="post">
                        <input type="hidden" name="cmd" value="_cart" />
                        <input type="hidden" name="add" value="1" />
                        <input type="hidden" name="w3ls1_item" value="Handbag" />
                        <input type="hidden" name="amount" value="540.00" />
                        <label for="quantitysingle">Količina:</label>
                        <input type="number" name="quantitysingle" id="quantitySingle" value="1" min="1" style="width: 50px; padding: 4px; margin-left: 5px;"><br><br>
                        <button type="button" id="korpaAdd" data-id="<?php echo "$row->id"?>">Add to cart</button>
                    </form>


                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
        <div id="modal" class="modal">
            <div class="modal-content">
                <p id="modal-text"></p>
            </div>
        </div>

        <!-- collapse-tabs -->
        <!-- //collapse -->
    </div>
</div>
