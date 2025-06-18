const params = new URLSearchParams(window.location.search);
var cat=params.get("category");
function ubacivanje(naziv, vrednost){
    localStorage.setItem(naziv, JSON.stringify(vrednost));
}
function dohvatanje(naziv){
    return JSON.parse(localStorage.getItem(naziv));
}
if(dohvatanje("korpa") == null){
    ubacivanje("korpa", []);
}
function showModal(type) {
    var modal = document.getElementById("modal");
    var modalText = document.getElementById("modal-text");

    switch (type) {
        case "success":
            modalText.textContent = "Uspešno dodat proizvod u korpu!";
            break;
        case "error":
            modalText.textContent = "Proizvod već postoji u korpi!";
            break;
        default:
            modalText.textContent = "";
    }

    modal.style.display = "block";
}
function showModalLog(message) {
    var modal = document.getElementById("modal");
    var modalText = document.getElementById("modal-text");

    modalText.textContent = message;
    // switch (type) {
    //     case "success":
    //         modalText.textContent = "Uspešno logovanje!";
    //         break;
    //     case "error":
    //         modalText.textContent = "Morate aktivirati nalog da bi ste se logovali!";
    //         break;
    //     default:
    //         modalText.textContent = "";
    // }

    modal.style.display = "block";
    setTimeout(function () {
        modal.style.display = "none";
    }, 1500);
}
function showModalMan(message) {
    var modal = document.getElementById("modal");
    var modalText = document.getElementById("modal-text");

    modalText.textContent = message;
    // switch (type) {
    //     case "success":
    //         modalText.textContent = "Uspešno logovanje!";
    //         break;
    //     case "error":
    //         modalText.textContent = "Morate aktivirati nalog da bi ste se logovali!";
    //         break;
    //     default:
    //         modalText.textContent = "";
    // }

    modal.style.display = "block";
    setTimeout(function () {
        modal.style.display = "none";
    }, 1500);
}
function showModalChPass(message) {
    var modal = document.getElementById("modal");
    var modalText = document.getElementById("modal-text");

    modalText.textContent = message;
    // switch (type) {
    //     case "success":
    //         modalText.textContent = "Uspešno logovanje!";
    //         break;
    //     case "error":
    //         modalText.textContent = "Morate aktivirati nalog da bi ste se logovali!";
    //         break;
    //     default:
    //         modalText.textContent = "";
    // }

    modal.style.display = "block";
    setTimeout(function () {
        modal.style.display = "none";
    }, 1500);
}
function showModalPor(message) {
    var modal = document.getElementById("modal");
    var modalText = document.getElementById("modal-text");

    modalText.textContent = message;
    // switch (type) {
    //     case "success":
    //         modalText.textContent = "Uspešno logovanje!";
    //         break;
    //     case "error":
    //         modalText.textContent = "Morate aktivirati nalog da bi ste se logovali!";
    //         break;
    //     default:
    //         modalText.textContent = "";
    // }

    modal.style.display = "block";
    setTimeout(function () {
        modal.style.display = "none";
    }, 1500);
}

function hideModal() {
    var modal = document.getElementById("modal");
    modal.style.display = "none";
}
function ispisProizvodaKorpa(){

    var proizvodi=dohvatanje("products");
    let korpa=dohvatanje("korpa")
    console.log(korpa)
    console.log(proizvodi)
    var korpaDiv=document.querySelector(".korpaIspis");
    
    let html="";
    let idK=0;
    var totalCena=0;
    if(korpa.length===0)
    {
        //if(document.querySelector(".checkout-left")){
        document.querySelector(".checkout-left").innerHTML="";
        document.querySelector(".tableFooter").innerHTML="";
        document.querySelector(".tableHead").innerHTML="";
        document.querySelector(".brojProizvoda").innerHTML=`<h4 class="mb-sm-4 mb-3">Vaša korpa sadrži:
        <span>0 Proizvoda</span></h4>`;
   // }
    }else if(korpa.length>0){
      
        for(let i of proizvodi){
            for(let j of korpa){
                if(i.proizvod_id==j.id)
                {
                    totalCena+=i.cena_popust*j.quantity;
                    html+=`<tr class="rem1">
                <td class="invert">${++idK}</td>
                <td class="invert-image">
                    <a href="index.php?page=single&product=${i.proizvod_id}">
                        <img src="assets/images/img-resize/${i.naziv_src}" alt="" class="img-responsive">
                    </a>
                </td>
                <td class="invert">
                    <div class="quantity">
                        <div class="quantity-select">
                            <div class="entry value-minus" data-id="${i.proizvod_id}">&nbsp;</div>
                            <div class="entry value">
                                <span class="quantity">${j.quantity}</span>
                            </div>
                            <div class="entry value-plus" data-id="${i.proizvod_id}">&nbsp;</div>
                        </div>
                    </div>
                </td>
                <td class="invert">${i.naziv}</td>
                <td class="invert" id="sirina"><span class="ukupnaCena">${j.quantity * i.cena_popust}</span></td>
                <td class="invert">
                    <button class="btn btn-danger btn-sm obrisi" data-id="${i.proizvod_id}">Obrisi</button>
                </td>
            </tr>`;
                }
            }
        }

        document.getElementById("TotalCena").innerHTML= "Total: "+totalCena+" RSD";
        ubacivanje("total", totalCena)

        korpaDiv.innerHTML=html;
        
    }
}
$().ready(function(){
    var quantitySinglDiv = document.querySelector("#quantitySingle");

    quantitySinglDiv.innerHTML=html;
})

function GetProductsFilter(){
    let category=[];
    let color=[];
    let size=[];
    var sort=$('#sortProducts').val();
    let discount = new URLSearchParams(window.location.search).get("popust");

    $('.categoryFilter:checked').each(function(){
        category.push($(this).val());
    });
    $('.colorFilter:checked').each(function(){
        color.push($(this).val());
    });
    $('.sizeFilter:checked').each(function(){
        size.push($(this).val());
    });



    $.ajax({
        url: "models/getProductsFilter.php",
        method: "POST",
        data: {
            category1:category,
            color:color,
            size:size,
            cat:cat,
            sort:sort,
            discount: discount,
            page:$('.pagination .active').text(),
            getProductsFilter:true
        },
        dataType: "json",
        success: function (response) {
            var html="";
            var div=document.getElementById("productsIspis");

            for(var i=0;i<response.length-1;i++){
                html+=`<div class="col-lg-3 col-md-6 col-sm-12 women-dresses">
                            <div class="women-grids wp1 animated wow slideInUp" data-wow-delay=".5s">
                                <a href="index.php?page=single&product=${response[i].id}"><div class="product-img">
                                <img src="assets/images/img-resize/${response[i].naziv_src}" alt="" />
                                    <div class="p-mask">
                                        <form action="#" method="post">
                                            <input type="hidden" name="cmd" value="_cart" />
                                            <input type="hidden" name="add" value="1" />
                                            <input type="hidden" name="w3ls1_item" value="Casual shirt" />
                                            <input type="hidden" name="amount" value="50.00" />
                                            
                                            <button type="submit" class="w3ls-cart pw3ls-cart korpa" data-proizvodid="${response[i].id}"><i class="fa fa-cart-plus" aria-hidden="true"></i> Add to cart</button>
                                        </form>
                                    </div>
                                    </div></a>
                                    
                                <h4>${response[i].naziv}</h4>
                                <h5>${response[i].cena}</h5>
                              </div>
                            
                            
                            
                            </div>`;
            }
            div.innerHTML=html;
            

            var div1=document.getElementsByClassName("pagination");
            var html1="";
            for(var i=1;i<=response[response.length-1].broj;i++){
                if(i==$('.pagination .active').text()){
                    html1+=`<li class="page-item active"><a class="page-link" href="#productPosition">${i}</a></li>`;
                    continue;
                }
                html1+=`<li class="page-item"><a class="page-link" href="#productPosition">${i}</a></li>`;
            }

            
            div1[0].innerHTML=html1;
           
            $('.page-link').on('click', function() {
                $('.pagination li').each(function() {
                    $(this).removeClass('active');
                })
                $(this).parent().addClass('active');
                GetProductsFilter()
            });
           

        },
        error: function (response) {

        }
    });
}

$(document).ready(function() {
    const params = new URLSearchParams(window.location.search);
    var stranica = params.get("page");
    console.log(stranica);
    if(stranica=="checkout" || stranica == "single" || stranica == "manage" ){
        const footer = document.querySelector(".footer");
        footer.style.position = "absolute";
        footer.style.bottom = "0";
        footer.style.width = "100%";

    }
    // let cart = dohvatanje("korpa");
    // if(cart.length === 0){
    //     document.querySelector(".timetable_sub").style.display="none";
    // }else{
    //     document.querySelector(".timetable_sub").style.display=""; 
    // }
    GetProductsFilter();
    setTimeout(() => {



        let dugmici = document.querySelectorAll('.korpa')
        console.log(dugmici);

        dugmici.forEach(dugme => {
            dugme.addEventListener('click',function(e){
                e.preventDefault();
                if(dohvatanje("korpa") != null){
                    let korpa = dohvatanje("korpa");
                    let br = 0;
                    for(let i of korpa){
                        if(i.id == this.getAttribute("data-proizvodid")){
                            br++;
                        }
                    }
                    if(br > 0){
                        showModal("error");
                        setTimeout(() => {
                            hideModal("error");
                        }, 1000)
                    }
                    else{
                        korpa.push({"id": this.getAttribute("data-proizvodid"), "quantity":1});
                        ubacivanje("korpa", korpa);
                        showModal("success");
                        setTimeout(() => {
                            hideModal("success");
                        }, 1000)


                    }

                }
            })
        }) }, 2000);


});
$(document).on("click",".izmeni_status", function(){
    const id = $(this).data('id');
    //const status = $(this).closest("td").find(".status-select").val();
    const status = $(this).closest('tr').find('select[name="status"]').val();


    $.ajax({
        url : "models/updateManageStr.php",
        method : "POST",
        data : {
            id : id,
            status : status,
            managerTrue : true
        },
        success : function(response){
            showModalMan(response);
        }
    });
})

GetProductsFilter();

$('#logoutbtn').on("click", function () {
    $.ajax({
        url: "models/logout.php",
        method: "POST",
        success: function (response) {
            // Ovde možeš dodati ponovni poziv za ispis proizvoda
            const cart = JSON.parse(localStorage.getItem('korpa')) || [];
            if (cart.length > 0) {
                ispisProizvodaKorpa(cart); // Ispisi proizvode u korpi
            }
            // Redirekcija na početnu stranicu
            window.location.href = "index.php?page=landing";
        },
        error: function (xhr, status, error) {
            alert(xhr.responseText);
        }
    });
});

    
    $('#loginBtn').on("click", function () {
        let email = $('#loginEmail').val();
        let password = $('#loginPassword').val();

        let data = {
            email: email,
            password: password,
            loginBtn: true
        };

        $.ajax({
            url: "models/loginUser.php",
            method: "POST",
            data: data,
            dataType: "json",
            success: function (response) {
                if(response.status === "success"){
                    // Ako je logovanje uspešno, preusmeri korisnika
                    window.location.href = "index.php?page=landing";
                } else if(response.status === "error"){
                    // Ako je došlo do greške, prikaži odgovarajuću poruku
                    showModalLog(response.message);
                    $("#loginEmail").val("");
                    $("#loginPassword").val("");

                // if(response === "False"){
                //     alert("Nalog nije aktiviran!");

                // }else{
                //     if (response != "Wrong password!") {
                //         window.location.href = "index.php?page=landing";
                //     } else {
                //         //document.querySelector("#passwordErrorLog").textContent = "Pogrešna šifra!";
                //         alert(response);
                //     }
                // }
                
                }else if(response.status == "not_activated"){
                    document.getElementById('activationModal').style.display = 'block';
                }
            }
        });


    });
  

    const registerUsername = document.getElementById('registerUsername');
    const registerLastName = document.getElementById('registerLastName');
    const registerEmail = document.getElementById('registerEmail');
    const registerPassword = document.getElementById('registerPassword');
    const registerConfirm = document.getElementById('registerConfirm');
    const usernameError = document.getElementById('usernameError');
    const lastnameError = document.getElementById('lastnameError');
    const emailError = document.getElementById('emailError');
    const passwordError = document.getElementById('passwordError');
    const confirmPasswordError = document.getElementById('confirmPasswordError');

    function validateUsername() {
        const username = registerUsername.value.trim();
        const usernameRegex = /^[a-zA-Z]{3,16}$/;

        if (!usernameRegex.test(username)) {
            registerUsername.style.border = '1px solid red';
            usernameError.textContent = 'Korisničko ime mora sadržavati 3 do 16 slova.';
            return false;
        } else {
            usernameError.textContent = '';
            return true;
        }
    }
    function validateLastName() {
        const lastName = registerLastName.value.trim();
        const lastNameRegex = /^[a-zA-Z]{3,16}$/;

        if (!lastNameRegex.test(lastName)) {
            registerLastName.style.border = '1px solid red';
            lastnameError.textContent = 'Korisničko prezime mora sadržavati 3 do 16 slova.';
            return false;
        } else {
            lastnameError.textContent = '';
            return true;
        }
    }
    function validateEmail() {
        const email = registerEmail.value.trim();
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!emailRegex.test(email)) {
            registerEmail.style.border = '1px solid red';
            emailError.textContent = 'Neispravan format email adrese.';
            return false;
        } else {
            emailError.textContent = '';
            return true;
        }
    }

    function validatePassword() {
        const password = registerPassword.value.trim();

        // Provjeri dodatne zahtjeve za lozinku ovdje ako su potrebni

        if (password.length < 8) {
            registerPassword.style.border = '1px solid red';
            passwordError.textContent = 'Lozinka mora sadržavati najmanje 8 znakova.';
            return false;
        } else {
            passwordError.textContent = '';
            return true;
        }
    }

    function validateConfirmPassword() {
        const confirmPassword = registerConfirm.value.trim();
        const password = registerPassword.value.trim();

        if (confirmPassword !== password) {
            registerConfirm.style.border = '1px solid red';
            confirmPasswordError.textContent = 'Lozinke se ne podudaraju.';
            return false;
        } else {
            confirmPasswordError.textContent = '';
            return true;
        }
    }

    var x = params.get("page");
    if (x == "register") {
        document.getElementById('registerbtn').addEventListener('click', function (event) {
            const isUsernameValid = validateUsername();
            const isLastNameValid = validateLastName();
            const isEmailValid = validateEmail();
            const isPasswordValid = validatePassword();
            const isConfirmPasswordValid = validateConfirmPassword();
            if (isUsernameValid && isLastNameValid && isEmailValid && isPasswordValid && isConfirmPasswordValid) {
                event.preventDefault();
                $.ajax({
                    url: "models/registerUser.php",
                    method: "POST",
                    data: {
                        registerbtn: true,
                        username: registerUsername.value,
                        lastname: registerLastName.value,
                        email: registerEmail.value,
                        password: registerPassword.value

                    },
                    dataType: "text",
                    success: function (response) {
                        console.log(response);
                        window.location.href = "index.php?page=login";
                    },
                    error: function (xhr, status, error) {
                        console.log(xhr.responseText);
                        console.log(status);
                        console.log(error);
                    }

                })
            }
        });
    }
    if(x == "contactus") {
        document.getElementById('sendMessage').addEventListener('click', function () {
            let name = $('#nameMessage').val();
            let email = $('#emailMessage').val();
            let subject = $('#subjectMessage').val();
            let phone = $('#phoneMessage').val();
            let message = $('#yourMessage').val();
            
            if(name != "" && email != "" && subject != "" && phone != "" && message != "") {
            let data = {
                name: name,
                email: email,
                subject: subject,
                phone: phone,
                message: message,
                sendMessage: true
            };
            
            $.ajax({
                url: "models/contactUs.php",
                method: "POST",
                data: data,
                dataType: "text",
                success: function (response) {
                    alert(response);
                }
            });
        }

        });
    }
    if(x == "profile") {
    $('input[type="file"]').on('change', function() {
        var data = new FormData();
        jQuery.each(jQuery('#ChangePhoto')[0].files, function(i, file) {
            data.append('photo', file);
        });

        $.ajax({
            url: 'models/ChangePhoto.php',
            type: 'POST',
            data: data,
            processData: false,
            contentType: false,
            success: function(response) {
                console.log(response);
                location.reload();
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    });
        $('#changePasswordBtn').on("click", function(){
            let passwordRegex=/^[A-Za-z0-9]{8,}$/;
            let password = $('#oldPassword').val();
            let passwordNew = $('#newPassword').val();
            let passwordConfirm = $('#confirmPassword').val();
            let errors = [];
            if(password == "" || passwordNew == "" || passwordConfirm == ""){
                errors.push("Nedostaju podaci!");
            }else if(!passwordRegex.test(passwordNew)){
                errors.push("Nova šifra nije validna!");
            }else if(passwordNew != passwordConfirm){
                errors.push("Šifre se ne podudaraju!");
            }
        
                

            if(errors.length != 0){
                showModalChPass(errors[0]);
            }
            else {
                $.ajax({
                    url: "models/changePassword.php",
                    method: "post",
                    data: {
                        oldPassword: password,
                        newPassword: passwordNew,
                        changePasswordBtn: true
                    },

                    success: function (response, status, xhr) {
                            showModalChPass(response);
                            console.log(response);
                            
                    },
                    error: function (xhr, status, error) {
                        
                        console.log(xhr);
                        console.log(status);
                        console.log(error);
                    }
                })
            }
            
    })

    }
    if(x == "shop") {
       $('.categoryFilter').on('change', function() {
            GetProductsFilter();
        });
        $('.colorFilter').on('change', function() {
           GetProductsFilter();
        });
        $('.sizeFilter').on('change', function() {
            GetProductsFilter();
        });
        $('#sortProducts').on('change', function() {
            GetProductsFilter();
        });

        $('.page-link').on('click', function() {
            $('.pagination li').each(function() {
                $(this).removeClass('active');
            })
            $(this).parent().addClass('active');
            GetProductsFilter();
        });
    }
window.addEventListener("load", function() {

    const urlParams = new URLSearchParams(window.location.search);
    
    if (urlParams.has('activated') && urlParams.get('activated') === 'true') {
        window.location.href = '/pages/login.php';
    }
    if(JSON.parse(this.localStorage.getItem("korpa")).length == 0){
        document.querySelector("#BrisanjeSvega").click();
    }
    $.ajax({
        url:"models/ispisLocal.php",
        method: "GET",
        dataType: "JSON",
        success: function(response){
            console.log(response)
            localStorage.setItem("products", JSON.stringify(response));
        },
        error: function(xhr){
            console.log(xhr);

        }
    })
    if(x=="checkout"){
        ispisProizvodaKorpa();
        
    }

});
$(document).on("click",".value-plus",function (){
    var quantity=this.parentElement.children[1].children[0].innerHTML;
    quantity=parseInt(quantity);
    quantity++;
    this.parentElement.children[1].children[0].innerHTML=quantity;
    var korpa=dohvatanje("korpa");
    let pomocni_niz=[];
    korpa.forEach(e => {

                if(e.id==this.getAttribute("data-id")){
                    e.quantity=quantity;
                    pomocni_niz.push(e)
                }
                else{
                    pomocni_niz.push(e)
                }

    });
    ubacivanje("korpa",pomocni_niz)
    ispisProizvodaKorpa();

})
$(document).on("click",".value-minus",function (){
    var quantity=this.parentElement.children[1].children[0].innerHTML;
    quantity=parseInt(quantity);
    quantity--;
    if(quantity<1){
        quantity=1;

    }
    this.parentElement.children[1].children[0].innerHTML=quantity;
    var korpa=dohvatanje("korpa");
    let pomocni_niz=[];
    korpa.forEach(e => {

            if(e.id==this.getAttribute("data-id")){
                e.quantity=quantity;
                pomocni_niz.push(e)
            }
            else{
                pomocni_niz.push(e)
            }

    });
    ubacivanje("korpa",pomocni_niz)
    ispisProizvodaKorpa();


})
$(document).on("click",".obrisi",function (){
    let id=$(this).data("id");
    let pom=[];
    let proizvodiKorpe=JSON.parse(localStorage.getItem("korpa"));
    pom=proizvodiKorpe.filter((e)=>{
        return e.id != id;
    });
    localStorage.setItem("korpa", JSON.stringify(pom));

    if(pom.length==0){
        localStorage.removeItem("total");
        document.querySelector("#tabelaKorpa").innerHTML="";
        document.querySelector(".sakrivanje").innerHTML="";
        document.querySelector(".brojProizvoda").innerHTML=`<h4 class="mb-sm-4 mb-3">Vaša korpa sadrži:
    <span>0 Proizvoda</span></h4>`;

    }
    else{

        ispisProizvodaKorpa()
    }
})

function BrisanjeKorpa(div){
    $(div).on("click",function(){
        ubacivanje("korpa",[]);
        document.querySelector("#tabelaKorpa").innerHTML="";

        document.querySelector(".brojProizvoda").innerHTML=`<h4 class="mb-sm-4 mb-3">Vaša korpa sadrži:
    <span>0 Proizvoda</span></h4>`;
        localStorage.removeItem("total");
        document.querySelector(".sakrivanje").innerHTML="";



    })
}
BrisanjeKorpa("#BrisanjeSvega");

$(document).on("click",".checkoutButton",function (){
    // let korpa=dohvatanje("korpa");
    // $.ajax({
    //     url:"models/checkoutCart.php",
    //     method:"POST",
    //     data:{
    //         korpa:korpa,
    //         checkout:true

    //     },
    //     success:function (data,status,xhr){
    //         if(xhr.status==201){
    //             ubacivanje("korpa",[]);
    //             ispisProizvodaKorpa();

    //             }
    //             location.reload();

    //     },
    //     error:function (xhr,status,error){
    //         console.log(xhr);
    //     }

    // })

    
    $("#checkoutModal").css("display", "flex");
})
$(document).on("click", "#closeModal", function() {
    $("#checkoutModal").css("display", "none");
});
$(document).on("click","#potvrdiPorudzbinu", function(){
     let korpa=dohvatanje("korpa");
     let ime = $("#imeP").val();
     let prezime = $("#prezimeP").val();
     let adresa = $("#adresaP").val();
     let grad = $("#gradP").val();
     let postBroj = $("#postaP").val();
     let telefon = $("#telefonP").val();
     let napomena = $("#napomenaP").val();


    $.ajax({
        url:"models/checkoutCart.php",
        method:"POST",
        data:{
            korpa:korpa,
            ime:ime,
            prezime:prezime,
            adresa:adresa,
            grad:grad,
            postBroj:postBroj,
            telefon:telefon,
            napomena:napomena,
            checkout:true
        },
        success:function (data,status,xhr){
            if(xhr.status==201){
                ubacivanje("korpa",[]);
                ispisProizvodaKorpa();
                showModalPor("Uspešno ste poručili proizvod.");
                }
                location.reload();

        },
        error:function (xhr,status,error){
            console.log(xhr);
        }

    })
})

if(x=="single"){
    document.querySelector("#korpaAdd").addEventListener("click",function (){
        let id=this.getAttribute("data-id");
        let kolicina = document.querySelector("#quantitySingle").value;
        if(dohvatanje("korpa") != null){
            let korpa = dohvatanje("korpa");
            let br = 0;
            for(let i of korpa){
                if(i.id == this.getAttribute("data-proizvodid")){
                    br++;
                }
            }
            if(br > 0){
                showModal("error");
                setTimeout(() => {
                    hideModal("error");
                }, 1000)
            }
            else{
                korpa.push({"id": this.getAttribute("data-id"), "quantity":kolicina});
                ubacivanje("korpa", korpa);
                showModal("success");
                setTimeout(() => {
                    hideModal("success");
                }, 1000)


            }
            console.log(JSON.stringify(korpa, null, 2))

        }
    })
}