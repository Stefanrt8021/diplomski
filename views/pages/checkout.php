<div class="privacy py-sm-5 py-4">
    <div class="container py-xl-4 py-lg-2">
        <!-- tittle heading -->
        <h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
            <span>K</span>orpa
        </h3><br>
        <!-- //tittle heading -->
        <div class="checkout-right ">
            <div class="brojProizvoda">

            </div>
            <div class="table-responsive" id="tabelaKorpa">
                <table class="timetable_sub">
                    <thead class="tableHead">
                    <tr>
                        <th>Rb.</th>
                        <th>Proizvod</th>
                        <th>Količina</th>
                        <th>Naziv</th>

                        <th>Cena</th>
                        <th>Ukloni</th>
                    </tr>
                    </thead>
                    <tbody class="korpaIspis">




                    </tbody>
                    <tr class="rem1 tableFooter">
                        <td class="invert"></td>
                        <td class="invert-image">

                        </td>

                        <td class="invert">

                        </td>
                        <td class="invert"></td>
                        <td class="invert" id="sirina"><span id="TotalCena">Ukupno :</span></td>
                        <td class="invert">
                            <div class="rem">
                                <div class="closeall"><button id="BrisanjeSvega">Ukloni sve</button></div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <?php
        if(isset($_SESSION['user'])):
            ?>
            <div class="checkout-left">
                <div class="address_form_agile">
                    <div class="col-12" id="Form-center">
                        <form id="form" class="sakrivanje my-5">

                            <button id="submit" type="button" class="checkoutButton btn btn-success">Poruči</button>

                            <div id="myModal" class="modal">

                                <!-- Modal content -->
                                <div class="modal-content">
                                    <p>Vaš proizvod je spreman i na putu je ka vama.</p>
                                    <input type="button" value="Ok" id="okModal" />
                                </div>

                            </div>
                            <div id="myModal2" class="modal">

                                <!-- Modal content -->
                                <div class="modal-content">
                                    <p>Nemate proizvoda u korpi</p>
                                    <input type="button" value="Ok" id="okModal2" />
                                </div>

                            </div>
                        </form>
                    </div>

                </div>
            </div>

        <?php else: ?>
            <div class="privacy py-sm-5 py-4" style="display:flex;">
                <div class="container py-xl-4 py-lg-3">
                    <!-- tittle heading -->
                    <div class="alert alert-warning" role="alert">
                        <h4 class="alert-heading">Morate biti ulogovani da bi poručili!</h4>
                        <p>Kliknite <a href="index.php?page=login">ovde</a> da se ulogujete.</p>
                        <h4 class="alert-heading">Nemate registrovan profil?</h4>
                        <p>Kliknite <a href="index.php?page=register">ovde</a> za registraciju.</p>
                    </div>
                </div>
            </div>
        <?php
        endif;
        ?>
    </div>
</div>
<div id="checkoutModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; 
background:rgba(0,0,0,0.5); justify-content:center; align-items:center;">
  <div style="background:#fff; padding:20px; border-radius:5px; width:300px;">
    <h3>Unesite podatke za dostavu</h3>
    <form id="checkoutForm">
    <input type="text" name="imeP" id="imeP" placeholder="Ime" required><br><br>
    <input type="text" name="prezimeP" id="prezimeP" placeholder="Prezime" required><br><br>
      <input type="text" name="adresaP" id="adresaP" placeholder="Adresa" required><br><br>
      <input type="text" name="gradP" id="gradP" placeholder="Grad" required><br><br>
      <input type="text" name="postaP" id="postaP" placeholder="Poštanski broj" required><br><br>
      <input type="text" name="telefonP" id="telefonP" placeholder="Telefon" required><br><br>
      <textarea name="napomenaP" id="napomenaP" placeholder="Napomena (opciono)"></textarea><br><br>
      <button type="button" id="potvrdiPorudzbinu">Potvrdi porudžbinu</button>
      <button type="button" id="closeModal">Otkaži</button>
    </form>
  </div>
  <div id="modal" class="modal">
            <div class="modal-content">
                <p id="modal-text"></p>
            </div>
        </div>
</div>