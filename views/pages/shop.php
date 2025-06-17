<?php
    if(!isset($_GET['popust'])) $categories=GetSubCategories();
  //  if(!isset($_GET['popust'])){$subcategories=GetSubCategories();}
?>
<div class="sub-banner my-banner3">
<h1><?php
    if(!isset($_GET['popust'])){
        if($categories[0]->kategorija_id == 1){
            echo "MUŠKI KUTAK";
        }elseif($categories[0]->kategorija_id == 2){
            echo "ŽENSKI KUTAK";
        };
    };
    ?>
  </h1>

</div>
<div class="content" id="productPosition">
	<div class="container">
		<div class="col-md-3 w3ls_dresses_grid_left">
			<div class="w3ls_dresses_grid_left_grid">
                <?php
                if(!isset($_GET['popust'])):
                ?>
				<h3>Categories</h3>
					<div class="w3ls_dresses_grid_left_grid_sub">
						<div class="ecommerce_dres-type">
							<ul>
                                <?php
                                    
                                    foreach($categories as $cat){
                                        echo "<li><input type='checkbox' id='categoryFilter' class='categoryFilter' value='$cat->id'>"."&nbsp". $cat->naziv."</li>";
                                    }
                                    
                                    
                                ?>

							</ul>
						</div>
					</div>
                <?php
                endif;
            
                ?>
			</div>
			<div class="w3ls_dresses_grid_left_grid">
            <?php if(!isset($_GET['popust'])):?>
				<h3>Color</h3>
				<div class="w3ls_dresses_grid_left_grid_sub">
					<div class="ecommerce_color">
						<ul>
                            <?php
                                $result=GetColors();
                                foreach ($result as $color) {
                                    echo "<li><input type='checkbox' class='colorFilter' value='$color->id'>"."&nbsp".$color->naziv."</li>";
                                }
                            ?>

						</ul>
					</div>
				</div>
                <?php endif;?>
			</div>
			 <!-- <div class="w3ls_dresses_grid_left_grid">
				<h3>Size</h3>
				<div class="w3ls_dresses_grid_left_grid_sub">
					<div class="ecommerce_color ecommerce_size">
						<ul>
                            <?php
                            $result=GetSizes();
                            foreach ($result as $size) {
                                echo "<li><input type='checkbox' class='sizeFilter' value='$size->id'>".$size->naziv."</li>";
                            }
                            ?>

						</ul>
					</div>
				</div>
			</div>  -->
		</div>
        <div class="col-12">
            <div class="d-flex justify-content-end nediraj">
                <select name="sort" id="sortProducts">
                    <option value="0">Sortiraj po</option>
                    <option value="1">Ceni rastuće</option>
                    <option value="2">Ceni opadajuće</option>
                    <option value="3">Nazivu A-Z</option>
                    <option value="4">Nazivu Z-A</option>
                </select>
            </div>


        </div>
        <div id="modal" class="modal">
            <div class="modal-content">
                <p id="modal-text"></p>
            </div>
        </div>
            <div id="productsIspis">

        <?php
			// if(isset($_GET['popust']) && isset($_GET['category'])){
            //     $popust = $_GET['popust'];
            //     $kategorije = $_GET['category'];
            //     $products = GetProductByDiscount($popust, $kategorije);
            // }else
            if(isset($_GET['category'])){
                $id = $_GET['category'];
                $products=GetProducts($id);
            }

        foreach ($products as $product):
        ?>

		<div class="col-lg-3 col-md-6 col-sm-12 women-dresses">
				<div class="women-grids wp1 animated wow slideInUp" data-wow-delay=".5s">
					<a href="index.php?page=single&product=<?=$product->p.$id?>"><div class="product-img">
						<img src="assets/images/img-resize/<?=$product->naziv_src?>" alt="" />
						<div class="p-mask">
							<form action="#" method="post">
								<input type="hidden" name="cmd" value="_cart" />
								<input type="hidden" name="add" value="1" />
								<input type="hidden" name="w3ls1_item" value="Casual shirt" />
								<input type="hidden" name="amount" value="50.00" />
                                <button type="submit" class="w3ls-cart pw3ls-cart korpa" data-proizvodid="<?=$product->p.$id?>"><i class="fa fa-cart-plus" aria-hidden="true"></i> Add to cart</button>
                            </form>
						</div>
					</div></a>
					<i class="fa fa-star yellow-star" aria-hidden="true"></i>
					<i class="fa fa-star yellow-star" aria-hidden="true"></i>
					<i class="fa fa-star yellow-star" aria-hidden="true"></i>
					<i class="fa fa-star yellow-star" aria-hidden="true"></i>
					<i class="fa fa-star gray-star" aria-hidden="true"></i>
					<h4><?=$product->naziv?></h4>
					<h5>$50.00</h5>
				</div>



		</div>
        <?php endforeach; ?>

        </div>

	</div>

    <div class="container">
        <nav class="d-flex justify-content-start" id="pag" aria-label="Page navigation example">
            <ul class="pagination">
                <?php
                $brojProizvoda=count($products);
                $brojStrana=ceil($brojProizvoda/1);
                for($i=1;$i<=$brojStrana;$i++){
                    if($i==1){
                        echo "<li class='page-item active'><a class='page-link' href='#productPosition'>$i</a></li>";
                        continue;
                    }
                    echo "<li class='page-item'><a class='page-link' href='#productPosition'>$i</a></li>";
                }

                ?>

            </ul>
        </nav>
    </div>


</div>

