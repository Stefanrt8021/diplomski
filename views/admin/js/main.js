(function ($) {
    "use strict";

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1);
    };
    spinner();


    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });


    // Sidebar Toggler
    $('.sidebar-toggler').click(function () {
        $('.sidebar, .content').toggleClass("open");
        return false;
    });


    // Progress Bar
    $('.pg-bar').waypoint(function () {
        $('.progress .progress-bar').each(function () {
            $(this).css("width", $(this).attr("aria-valuenow") + '%');
        });
    }, {offset: '80%'});


    // Calender
    $('#calender').datetimepicker({
        inline: true,
        format: 'L'
    });


    // Testimonials carousel
    $(".testimonial-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        items: 1,
        dots: true,
        loop: true,
        nav : false
    });


    // Chart Global Color
    Chart.defaults.color = "#6C7293";
    Chart.defaults.borderColor = "#000000";


    // Worldwide Sales Chart



    // Salse & Revenue Chart




    // Single Line Chart


})(jQuery);

if(window.location.href.includes("/indexAdmin.php?page=table")) {
    $(document).ready(function () {
        $(".deleteBtn").click(function () {
            console.log("kliknuto")
            var id = $(this).data("id");
            var table = $(this).data("name");

            $.ajax({
                url: "logicAdmin/deleteAdmin.php",
                type: "POST",
                data: {
                    id: id,
                    table: table,
                    deleteBtn: true
                },
                success: function (response) {
                    // osveži tabelu nakon što se red izbriše
                    console.log(response);
                    location.reload();
                }
            });
        });
        $(".updateBtn").click(function () {
            var id = $(this).data("id");
            var table = $(this).data("name");
            $("#updateModal").css("display", "block");

            $.ajax({
                url: "logicAdmin/updateAdmin.php",
                type: "POST",
                data: {
                    idU: id,
                    tableU: table,
                    updateBtnU: true
                },
                success: function (response) {
                    popuniModal(JSON.parse(response));

                }
            });
        });
        $("#insertAdminPanel").click(function () {
            var table = $(this).data("name");
            $("#insertModal").css("display", "block");

            $.ajax({
                url: "logicAdmin/insertAdmin.php",
                type: "POST",
                data: {
                    tableI: table,
                    insertBtnI: true
                },
                success: function (response) {
                    popuniModalInsert(JSON.parse(response));
                }
            });
        });
    });
    $(".close").click(function() {
        $("#updateModal").css("display", "none");
    });
    $(".close").click(function() {
        $("#insertModal").css("display", "none");
    });
    function popuniModalInsert(response) {
        console.log(response)
        let div = document.getElementById("insertForm");
        div.innerHTML = "";
        for(let i of response){
            let split = i.split("_");
            if(split[1] == "id"){
                $.ajax({
                    url: "logicAdmin/returnOptions.php",
                    type: "POST",
                    data: {
                        table: split[0],
                        returnOptions: true
                    },
                    success: function (response) {
                        var table = split[0];
                        if(table == "korisnik"){
                            let upis = "<form enctype=\"multipart/form-data\">";
                            upis+= `${split[0]}<select  name="${i}" class="insertInput stilZaAdmin">`;
                            for (let j of JSON.parse(response)) {
                                upis += `<option value="${j.id}">${j.username}</option>`;
                            }
                            upis+= `</select>`;
                            div.innerHTML += upis;
                        
                        }else if(table=="robnagrupa"){
                            
                            let upis = "<form enctype=\"multipart/form-data\">";
                            upis+= `${split[0]}<select  name="${i}" class="insertInput stilZaAdmin">`;
                            for (let j of JSON.parse(response)) {
                                if(j.kategorija_id == 1){
                                    upis += `<option value="${j.id}">${j.naziv} Male</option>`;
                                }if(j.kategorija_id == 2){
                                    upis += `<option value="${j.id}">${j.naziv} Female</option>`;
                                }if(j.kategorija_id == 3){
                                    upis += `<option value="${j.id}">${j.naziv} Other</option>`;
                                }
                            }
                            upis+= `</select>`;
                            div.innerHTML += upis;
                        }
                        else{
                            let upis = "<form enctype=\"multipart/form-data\">";
                            upis+= `${split[0]}<select  name="${i}" class="insertInput stilZaAdmin">`;
                            for (let j of JSON.parse(response)) {
                                upis += `<option value="${j.id}">${j.naziv}</option>`;
                            }
                            upis+= `</select>`;
                            div.innerHTML += upis;
                        }

                    }
                })
            }
            else if(split[1] == "src"){
                div.innerHTML += `${i}<input type="file" name="${i}" id="insertPhotoA" class="insertInput stilZaAdmin" value="">`;

            }
            else if(split[0] == "date"){
                div.innerHTML += `${i}<input type="date" name="${i}" id="dateInsert" class="insertInput stilZaAdmin" value="">`;
            }

            else {

            div.innerHTML += `${i}<input type="text" data-slika="" name="${i}" id="ChangePhotoAdmin" class="insertInput stilZaAdmin" value="">`;
            }
        }
        var url = new URL(window.location.href);
        var paramName = url.searchParams.get('tabela');
        setTimeout(function() {
            div.innerHTML+=`<button type="button" id="insertButtonColumn" class="dugmeModal" data-name="${paramName}">Save Changes</button>`;
        },300);
        div.innerHTML+=`</form>`;

    }
    function popuniModal(data) {
        let div = document.getElementById("updateForm");
        div.innerHTML = "";
        for(let i in data){
            console.log(i)
            let split = i.split("_");
            if(split[1] == "id"){
                console.log(split[0])
                $.ajax({
                    url: "logicAdmin/returnOptions.php",
                    type: "POST",

                    data: {
                        table: split[0],
                        returnOptions: true
                    },
                    success: function (response) {
                        var table = split[0];
                        if(table == "korisnik"){
                            let upis = "<form enctype=\"multipart/form-data\">";
                            upis+= `${split[0]}<select  name="${i}" class="updateInput stilZaAdmin">`;
                            for (let j of JSON.parse(response)) {
                                upis += `<option ${j.id == data[i] ? "selected" : ""} value="${j.id}">${j.username}</option>`;
                            }
                            upis+= `</select>`;
                            div.innerHTML += upis;
                        }
                        else {
                            let upis = "<form enctype=\"multipart/form-data\">";


                            upis += `${split[0]}<select name="${i}"  class="updateInput stilZaAdmin">`;
                            for (let j of JSON.parse(response)) {

                                upis += `<option ${j.id == data[i] ? "selected" : ""}  value="${j.id}">${j.naziv != undefined ? j.naziv : j.id}</option>`;
                            }
                            upis += `</select>`;
                            div.innerHTML += upis;
                        }
                    }
                })
            }
            else if(split[1] == "src"){
                div.innerHTML += `${i}<input type="file" name="${i}" id="insertPhotoA" class="insertInput stilZaAdmin" value="">`;

            }
            else if(split[0] == "date"){
                var date= data[i].split(" ");
                var date1 = date[0];
                div.innerHTML += `${i}<input type="date" name="${i}" id="dateInsert" class="insertInput stilZaAdmin" value="${date1}">`;

            }
            else {

                    div.innerHTML += `${i}<input type="text" name="${i}" class="updateInput stilZaAdmin" value="${data[i]}">`;


            }
        }
        var url = new URL(window.location.href);
        var paramName = url.searchParams.get('tabela');
        setTimeout(function() {
            div.innerHTML+=`<button type="button" id="updateButtonColumn" class="dugmeModal" data-name="${paramName}">Save Changes</button>`;
        },100);
        div.innerHTML+=`</form>`;

    }
}
    var acc = document.getElementsByClassName("accordion");
    var i;
    for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.display === "block") {
            panel.style.display = "none";
        } else {
            panel.style.display = "block";
        }
    });
}
$(document).on("click", "#insertButtonColumn", function() {
    let inputs = document.getElementsByClassName("insertInput");
    let table = $(this).data("name");
    let data = {};
    for(let i = 0; i < inputs.length; i++) {
        if(inputs[i].name == "naziv_src"){
            data[inputs[i].name] = inputs[i].files[0].name;
        }
        else{
            data[inputs[i].name] = inputs[i].value;

        }
    }
    console.log(data)
    var NewData={};
    for(let i in data){
        if(i != "naziv_src"){
            NewData[i] = data[i];

        }
    }
    if(table == "cena"){
        var x=NewData["proizvod_id"];
        var y=NewData["cena"];
        var z=NewData["date_from"];
        var w=NewData["date_to"];
        NewData={};
        NewData["cena"]=y;
        NewData["date_from"]=z;
        NewData["date_to"]=w;
        NewData["proizvod_id"]=x;

    }
    if(table == "proizvodvelicina"){
        var x=NewData["proizvod_id"];
        var y=NewData["velicina_id"];
        var z=NewData["kolicina"];
        console.log(x);
        console.log(y);
        console.log(z);
        NewData={};
        NewData["kolicina"]=z;
        NewData["proizvod_id"]=x;
        NewData["velicina_id"]=y;
    }
    if(table == "proizvod"){
        var x=NewData["naziv"];
        var y=NewData["brend_id"];
        var z=NewData["kategorija_id"];
        var a = NewData["robnagrupa_id"];
        var b = NewData["boja_id"];
        var c = NewData["popust_id"];
        NewData={};
        NewData["naziv"]=x;
        NewData["brend_id"]=y;
        NewData["kategorija_id"]=z;
        NewData["robnagrupa_id"]=a;
        NewData["boja_id"]=b;
        NewData["popust_id"]=c;
    }
    if(table == "role"){
        var x=NewData["naziv"];
       
        NewData={};
        NewData["naziv"]=x;
        
    }







    NewData = JSON.stringify(NewData);
    console.log(NewData)
    $.ajax({
        url: "logicAdmin/adminInsertTable.php",
        type: "POST",
        data: {
            tableI: table,
            dataI: NewData,
            insertBtnInsert: true
        },
        success: function (response) {
            console.log(response);
           setTimeout(function(){location.reload('true')},100);
        }
    });
});
$(document).on("click", "#updateButtonColumn", function() {
    let inputs = document.getElementsByClassName("updateInput");
    console.log(inputs);
    let id = inputs[0].value;

    let table = $(this).data("name");
    let data = {};

    for(let i = 0; i < inputs.length; i++) {
        data[inputs[i].name] = inputs[i].value;
    }
    data = JSON.stringify(data);
    console.log(data)
    $.ajax({
        url: "logicAdmin/adminUpdateTable.php",
        type: "POST",
        data: {
            id: id,
            table: table,
            data: data,
            updateBtnUpdate: true
        },
        success: function (response) {
            console.log(response);
            location.reload('true');
        }
    });
});
document.querySelectorAll(".brisiPoruku").forEach(function (element) {
        element.addEventListener("click", function () {
            var id=this.getAttribute("data-red");
            $.ajax({
                url: "logicAdmin/brisiPoruku.php",
                type: "POST",
                data: {
                    id: id,
                    brisiPoruku: true
                },
                success: function (response) {
                    console.log(response);
                    location.reload('true');
                },
                error: function (response) {
                    console.log(response);
                }

            });
        });
    });
document.querySelectorAll(".odgovoriNaPoruku").forEach(function (element) {
    element.addEventListener("click", function () {
        var id=this.getAttribute("data-red");
        console.log(id);
    });
});
document.querySelectorAll(".arhivirajPoruku").forEach(function (element) {
    element.addEventListener("click", function () {
        var id=this.getAttribute("data-red");
    $.ajax({
        url: "logicAdmin/arhivirajPoruku.php",
        type: "POST",
        data: {
            id: id,
            arhivirajPoruku: true

        },
        success: function (response) {
            console.log(response);
            location.reload('true');
        },
        error: function (response) {
            console.log(response);
        }
    });
})
});
$(document).on("change", "#insertPhotoA", function() {
    let file = this.files[0];
    let formData = new FormData();
    formData.append("file", file);

    $.ajax({
        url: "logicAdmin/adminresizeImg.php",
        type: "POST",
        processData: false,
        contentType: false,
        data: formData,
        success: function (response) {
            var resizedImage = response;
          
            $(document).on("click", "#insertButtonColumn", function() {
                
                let inputs = document.getElementsByClassName("insertInput");
                let table = $(this).data("name");
                let data = {};
                for(let i = 0; i < inputs.length; i++) {
                    if(inputs[i].name == "naziv_src"){
                        data[inputs[i].name] = inputs[i].files[0].name;
                        
                    }
                    else{
                        data[inputs[i].name] = inputs[i].value;

                    }
                }
                console.log(data)
                var NewData={};
                if(table=="slika") {
                    for (let i in data) {
                        if (i == "naziv_src") {
                            NewData[i] = resizedImage;
                        }
                    }
                    for (let i in data) {
                        if (i != "naziv_src") {
                            NewData[i] = data[i];
                        }
                    }
                    
                }
                else{
                    for (let i in data) {
                        if (i != "naziv_src") {
                            NewData[i] = data[i];
                        }
                        else
                        {
                            NewData[i] = resizedImage;
                        }
                    }

                }



                NewData = JSON.stringify(NewData);
                console.log(NewData)
                $.ajax({
                    url: "logicAdmin/adminInsertTable.php",
                    type: "POST",
                    data: {
                        tableI: table,
                        dataI: NewData,
                        insertBtnInsert: true
                    },
                    success: function (response) {
                        console.log(response);
                        location.reload('true');
                    }
                });
            });
            $(document).on("click", "#updateButtonColumn", function() {
                let inputs = document.getElementsByClassName("updateInput");
                console.log(inputs);
                let id = inputs[0].value;

                let table = $(this).data("name");
                let data = {};
                for(let i = 0; i < inputs.length; i++) {
                    if(inputs[i].name == "naziv_src"){
                        data[inputs[i].name] = inputs[i].files[0].name;
                    }
                    else{
                        data[inputs[i].name] = inputs[i].value;

                    }
                }
                var NewData={};
                if(table=="slika") {
                for(let i in data){
                    if(i != "naziv_src"){
                        NewData[i] = data[i];
                    }
                }
                for(let i in data){
                    if(i == "naziv_src"){
                        NewData[i] = resizedImage;
                    }
                }
                }
                else{
                    for (let i in data) {
                        if (i != "naziv_src") {
                            NewData[i] = data[i];
                        }
                        else
                        {
                            NewData[i] = resizedImage;
                        }
                    }
                }

                NewData = JSON.stringify(NewData);
                console.log(NewData)
                $.ajax({
                    url: "logicAdmin/adminUpdateTable.php",
                    type: "POST",
                    data: {
                        id: id,
                        table: table,
                        data: NewData,
                        updateBtnUpdate: true
                    },
                    success: function (response) {
                        console.log(response);
                        var resizedImage = response;
                        console.log(resizedImage)
                    }
                });
            });

        },
        error: function (response) {
            console.log(response);
        }
    });
});




