$(function () {
    $("#form-total").steps({
        headerTag: "h2",
        bodyTag: "section",
        transitionEffect: "fade",
        stepsOrientation: "vertical",
        autoFocus: true,
        transitionEffectSpeed: 500,
        onStepChanging: function (event, currentIndex, newIndex) {
            if (currentIndex < newIndex) {

                let data = $(this).parents().serializeArray();
                let url = $(this).parents().attr('action');
                let method = $(this).parents().attr('method');
                let token = $(this).parents().find('input[name="_token"]').val();
                let formData = new FormData();
                formData.append('_token', token);
                for (let i = 0; i < data.length; i++) {
                    formData.append(data[i].name, data[i].value);
                }
                console.log(formData.get('_token'));

                var return_first = function () {
                    var tmp = null;
                    $.ajax({
                        'async': false,
                        'method': method,
                        'global': false,
                        'url': url,
                        'processData': false,
                        'contentType': false,
                        'data': formData,
                        'success': function (data) {
                            let SMS = document.getElementById('otp');
                            SMS.innerHTML = `
                            <legend>SMS</legend>
                            <input type="text" class="form-control"
                                        name="otp" placeholder="SMS Number" >`;
                            let countDownDate = new Date(Date.now() + 1000 * 60 * 2).getTime();
                            let x = setInterval(function () {
                                let now = new Date().getTime();
                                let distance = countDownDate - now;
                                let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                let seconds = Math.floor((distance % (1000 * 60)) / 1000);

                                document.getElementById("timer").innerHTML = 'Time Out ' + minutes + ":" + seconds;
                                if (distance < 0) {
                                    clearInterval(x);
                                    document.getElementById("timer").innerHTML = "EXPIRED";
                                }
                            }, 1000);

                            let timer = setTimeout(function () {
                                location.reload();
                            }, 120000);

                            tmp = data;
                        },
                        'error': function (data) {
                            arr=[ "first_name", "last_name", "email", "mobile_number" ];
                            error=Object.keys(data.responseJSON.errors);
                            result=arr.filter(function (item) {
                                if (error.indexOf(item) === -1) {
                                    document.getElementById(item).classList.remove('error-field');
                                    return false;
                                }
                                document.getElementById(item).classList.add('error-field');
                                return true;
                            });
                            tmp = data;
                        }
                    });
                    return tmp;
                }();
                if (return_first.readyState != 4) {
                    return true;
                }
            }
        },

        onFinishing: function (event, currentIndex) {
                let data = $(this).parents().serializeArray();
                let url = $(this).parents().attr('action').replace('check-data', 'register');
                let method = $(this).parents().attr('method');
                let token = $(this).parents().find('input[name="_token"]').val();
                let formData = new FormData();
                formData.append('_token', token);
                for (let i = 0; i < data.length; i++) {
                    formData.append(data[i].name, data[i].value);
                }
                console.log(formData.get('_token'));

                var return_first = function () {
                    var tmp = null;
                    $.ajax({
                        'async': false,
                        'method': method,
                        'global': false,
                        'url': url,
                        'processData': false,
                        'contentType': false,
                        'data': formData,
                        'success': function (data) {
                            document.getElementById('otp').classList.remove('error-field');
                            alert(data.message);
                        },
                        'error': function (data) {
                            document.getElementById('otp').classList.add('error-field');
                            document.getElementById('otp_message').innerHTML = data.responseJSON.message;
                            console.log(data.responseJSON)
                            tmp = data;
                        }
                    });
                    return tmp;
                }();
                if (return_first.readyState != 4) {
                    return true;
                }
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



 //$(function () {
    //     $("#form-total").submit(function (e) {
    //         e.preventDefault();

    //         url = $(this).parents().attr('action');
    //         let data = $(this).parents().serializeArray();
    //         $.ajax({
    //             headers: {
    //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //             },
    //             url: url,
    //             type: 'POST',
    //             data: data,
    //             success: function (data) {
    //                 let SMS = document.getElementById('SMS');
    //                 SMS.innerHTML = `<input type="text" class="form-control input-border"
    //                                         name="sms" placeholder="SMS Number" >`;
    //                 let countDownDate = new Date(Date.now() + 1000 * 60 * 2).getTime();
    //                 let x = setInterval(function () {
    //                     let now = new Date().getTime();
    //                     let distance = countDownDate - now;
    //                     let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    //                     let seconds = Math.floor((distance % (1000 * 60)) / 1000);

    //                     document.getElementById("timer").innerHTML = 'Time Out '+ minutes + ":" + seconds;
    //                     if (distance < 0) {
    //                         clearInterval(x);
    //                         document.getElementById("timer").innerHTML = "EXPIRED";
    //                     }
    //                 }, 1000);

    //                 let timer = setTimeout(function () {
    //                     location.reload();
    //                 }, 120000);
    //                 if (data) {
    //                     alert(data.message);
    //                 }
    //             },
    //             error: function (data) {
    //                 flag=false;
    //                 if(flag==false){
    //                     // stay in step
    //                     $("#form-total").steps(

    //                     );

    //                 }
    //                 // return responce message
    //                 let errors = data.responseJSON.errors;
    //                 let message = '<ul>';
    //                 for (let i in errors) {
    //                     message += '<li>' + errors[i] + '</li>';
    //                 }
    //                 message += '</ul>';

    //                 if (data.status == 400) {
    //                     message= data.responseJSON.message;
    //                     alert(message);
    //                     document.getElementById('closeBtn').onclick= function () {
    //                         removeCustomAlert();
    //                         return false;
    //                     }
    //                 }
    //                  else{
    //                     alert(message);
    //                  }

    //             }
    //         });
    //     });
    // });


    // Alert this pages
   // let ALERT_TITLE = "Good luck !!";
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


        msg = alertObj.appendChild(d.createElement("h1"));
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

        alertObj.style.display = "flex";
        alertObj.style.flexDirection = "column";
        alertObj.style.justifyContent = "center";
        alertObj.style.alignItems = "center";

    }

    function removeCustomAlert() {
        document.getElementsByTagName("body")[0].removeChild(document.getElementById("modalContainer"));
    }
