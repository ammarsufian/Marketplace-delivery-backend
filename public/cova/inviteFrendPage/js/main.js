$(function () {
    $("#form-total").steps({
        headerTag: "h2",
        bodyTag: "section",
        transitionEffect: "fade",
        stepsOrientation: "vertical",
        autoFocus: true,
        transitionEffectSpeed: 500,
        onStepChanging: function (event, currentIndex, newIndex) {
            // let data = $(this).parents().serializeArray();
            // for (let i = 0; i < data.length - 1; i++) {
            //     if (data[i].value == "") {
            //         //  alert("Please add all fields");
            //         return false;
            //     }
            // }
            //

            if (currentIndex < newIndex) {
                $("#form-total").submit();
                return true;
            }
        },
        onFinishing: function (event, currentIndex) {
            let data = $(this).parents().serializeArray();
            if (data[data.length - 1].value == "") {
                return false;
            }
            $("#form-total").submit();
        },
        titleTemplate: '<div class="title">#title#</div>',
        labels: {
            previous: 'Back Step',
            next: '<i class="zmdi zmdi-arrow-right"></i>',
            finish: '<i class="zmdi zmdi-check"></i>',
            current: ''
        },
    })
});

$(function () {
    $("#form-total").submit(function (e) {
        e.preventDefault();

        url = $(this).parents().attr('action');
        let data = $(this).parents().serializeArray();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            type: 'POST',
            data: data,
            success: function (data) {
                let SMS = document.getElementById('SMS');
                SMS.innerHTML = `<input type="text" class="form-control input-border" 
                                        name="sms" placeholder="SMS Number" >`;
                let countDownDate = new Date(Date.now() + 1000 * 60 * 2).getTime();
                let x = setInterval(function () {
                    let now = new Date().getTime();
                    let distance = countDownDate - now;
                    let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    let seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    document.getElementById("timer").innerHTML = 'Time Out '+ minutes + ":" + seconds;
                    if (distance < 0) {
                        clearInterval(x);
                        document.getElementById("timer").innerHTML = "EXPIRED";
                    }
                }, 1000);

                let timer = setTimeout(function () {
                    location.reload();
                }, 120000);
                if (data) {
                    alert(data.message);
                }
            },
            error: function (data) {
                // return responce message 
                let errors = data.responseJSON.errors;
                let message = '<ul>';
                for (let i in errors) {
                    message += '<li>' + errors[i] + '</li>';
                } 
                message += '</ul>';
                 
                if (data.status == 400) {
                    message= data.responseJSON.message;
                    alert(message);
                    document.getElementById('closeBtn').onclick= function () {
                        removeCustomAlert();
                        return false;
                    }
                }
                 else{
                    alert(message);
                 }
            
            }
        });
    });
});


// Alert this pages
let ALERT_TITLE = "Good luck !!";
let ALERT_BUTTON_TEXT = "Ok";

if (document.getElementById) {
    window.alert = function (txt) {
        createCustomAlert(txt);
    }
}

function createCustomAlert(txt) {
    d = document;

    if (d.getElementById("modalContainer")) return;

    mObj = d.getElementsByTagName("body")[0].appendChild(d.createElement("div"));
    mObj.id = "modalContainer";
    mObj.style.height = d.documentElement.scrollHeight + "px";

    alertObj = mObj.appendChild(d.createElement("div"));
    alertObj.id = "alertBox";
    if (d.all && !window.opera) alertObj.style.top = document.documentElement.scrollTop + "px";
    alertObj.style.left = (d.documentElement.scrollWidth - alertObj.offsetWidth) / 2 + "px";
    alertObj.style.top = '30%';
    alertObj.style.visiblity = "visible";

    h1 = alertObj.appendChild(d.createElement("h1"));
    h1.appendChild(d.createTextNode(ALERT_TITLE));

    msg = alertObj.appendChild(d.createElement("div"));
    //msg.appendChild(d.createTextNode(txt));
    msg.innerHTML = txt;

    btn = alertObj.appendChild(d.createElement("a"));
    btn.id = "closeBtn";
    btn.appendChild(d.createTextNode(ALERT_BUTTON_TEXT));
    btn.href = "#";
    btn.focus();
    btn.onclick = function () {
        location.reload();
        removeCustomAlert();
        return false;
    }

    alertObj.style.display = "block";

}

function removeCustomAlert() {
    document.getElementsByTagName("body")[0].removeChild(document.getElementById("modalContainer"));
}
function ful() {
    alert('Alert this pages');
}