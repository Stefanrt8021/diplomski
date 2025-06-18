<div class="login">

    <div class="main-agileits">
        <div class="form-w3agile">
            <h3>Uloguj se</h3>
            <form action="#" method="post">
                <div class="key">
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                    <input  type="text" name="Email" required="" placeholder="Email" id="loginEmail">
                    <div class="clearfix"></div>
                </div>
                <div class="key">
                    <i class="fa fa-lock" aria-hidden="true"></i>
                    <input  type="password" name="Password" required="" placeholder="Šifra" id="loginPassword">
                    <p class="error" id="passwordErrorLog"></p>
                    <div class="clearfix"></div>
                </div>
                <button type="button" id="loginBtn"> Uloguj se</button>
            </form>
        </div>
        <div class="forg">
            <a href="index.php?page=register" class="forg-right">Registruj se</a>
            <div class="clearfix"></div>
            
        </div>
    </div>
        <div id="modal" class="modal">
            <div class="modal-content">
                <p id="modal-text"></p>
            </div>
        </div>
        <div id="activationModal" class="modal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background-color:rgba(0,0,0,0.5); z-index:1050;">
    <div style="background:#fff; max-width:400px; margin:100px auto; padding:20px; border-radius:10px; text-align:center;">
        <p id="activationText">Vaš nalog nije aktiviran.</p>
        <button onclick="window.open('https://mailtrap.io/inboxes/3626760/messages'); window.location.reload()" id="activBtn" class="btn btn-primary m-2">Otvori MailTrap</button>
        <button onclick="document.getElementById('activationModal').style.display='none'" class="btn btn-secondary m-2">Otkaži</button>
    </div>
</div>
</div>
