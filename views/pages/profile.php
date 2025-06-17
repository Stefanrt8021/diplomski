<?php
global $conn;
$id = $_SESSION['user']->id;
$sql = "SELECT * FROM korisnik WHERE id = $id";
$rezultat = $conn->query($sql)->fetch();
?>
<div class="profile">
    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    <img class="rounded-circle mt-5" width="150px" src="assets/<?=$rezultat->naziv_src?>">
                    <span class="text-black-50"><?=$rezultat->email?></span>
                    <span> </span>
                    <input type="file" name="file" id="ChangePhoto"/>

                </div>
            </div>
            <div class="col-md-5 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-center">Profile Information</h4>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12"><label class="labels">Username</label><span class="form-control"><?=$rezultat->username?></span></div>
                        <div class="col-md-12"><label class="labels">Email</label><span class="form-control"><?=$rezultat->email?></span></div>
                    </div>

                </div>
            </div>
            <div class="col-md-4" id="changePass">
                <div class="p-3 py-5">
                    <h4 class="mb-3">Change Password</h4>
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <label class="labels">Current Password</label>
                            <input type="text" id="oldPassword" class="form-control" placeholder="enter current password" value="">
                        </div>
                        <div class="col-md-12">
                            <label class="labels">New Password</label>
                            <input type="text" id="newPassword" class="form-control" placeholder="enter new password" value="">
                        </div>
                        <div class="col-md-12">
                            <label class="labels">Confirm Password</label>
                            <input type="text" id="confirmPassword" class="form-control" placeholder="enter confirm password" value="">
                        </div>
                        <div class="mt-5 text-center">
                            <button class="btn btn-primary profile-button" name="changePasswordBtn" id="changePasswordBtn" type="button">Save Password</button>
                        </div>
                        <div id="modal" class="modal">
                        <div class="modal-content">
                            <p id="modal-text"></p>
                        </div>
                      
        </div>
                    </div>


                </div>


            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h1>Your last orders</h1>
                <?php
                $sql = "SELECT id FROM korpa WHERE korisnik_id = $id";
                $rezultat = $conn->query($sql)->fetchAll();
                if($rezultat==null)echo "<h3 style='align:center'>\n\n\nYou don't have orders!</h3>";
                    foreach ($rezultat as $red):
                    $korpa_id = $red->id;
                    $sql = "SELECT *, naziv FROM proizvodkorpa
                    inner join proizvod p on proizvod_id = p.id WHERE korpa_id = $korpa_id";
                    $rezultat2 = $conn->query($sql)->fetchAll();
                
               
           
                ?>
                <table class="table table-bordered">
                    <thead class="thead-dark">
                    <tr>
                        <th>Proizvod</th>
                        <th>Datum</th>
                        <th>Kolicina</th>
                        <th>Cena/komad</th>‚
                        <th>Status posiljke</th>
                    </tr>
                    </thead>
                    <tbody>

                        <?php
                        $total = 0;
                        foreach ($rezultat2 as $red2):

                            $proizvod_id = $red2->proizvod_id;
                            // $sql2 = "select pk.id, c.cena, po.naziv as popust from proizvodkorpa pk
                            // inner join proizvod p on pk.proizvod_id = p.id
                            // inner join cena c on p.id = c.proizvod_id
                            // inner join popust po on p.popust_id = po.id
                            // where p.id = $proizvod_id";

                            $sql = "SELECT cena_finalna, pz.status FROM proizvodkorpa pk
                             INNER JOIN porudzbine pz on pk.korpa_id = pz.korpa_id 
                             WHERE proizvod_id = $proizvod_id";
                            $rezultat3 = $conn->query($sql)->fetch();
                            // if($rezultat3->popust != "0"){
                            //     $cena = $rezultat3->cena;
                            //     $popust = $rezultat3->popust;
                            //     $popustCena = $cena - ($cena * $popust/100);
                            // }
                            
                           
                            $cena = $rezultat3->cena_finalna;
                            
                            
                            $total += $cena * $red2->kolicina;
                        ?>
                        <tr>
                        <td><?=$red2->naziv?></td>
                        <td><?=$red2->date_order?></td>
                        <td><?=$red2->kolicina?></td>
                        <td><?=$cena?></td>
                        <td><?=$rezultat3->status?></td>
                        <tr>

                        <?php endforeach; ?>

                        <tr>
                            <td colspan="3">Total</td>
                            <td><?=$total?></td>
                        </tr>



                    </tbody>
                </table>
                <?php endforeach; ?>
            </div>

        </div>
    </div>
</div>









