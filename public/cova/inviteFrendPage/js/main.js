$(function () {
    $("#form-total").steps({
        headerTag: "h2",
        bodyTag: "section",
        transitionEffect: "fade",
        stepsOrientation: "vertical",
        autoFocus: true,
        transitionEffectSpeed: 500,
        onStepChanging: function (event, currentIndex, newIndex) {
            var data = $(this).parents().serializeArray();
            for (var i = 0; i < data.length - 1; i++) {
                if (data[i].value == "") {
                    //  alert("Please add all fields");
                    return false;
                }
            }
            var timer = setTimeout(function () {
                alert("Time is up");
                location.reload();
            }, 50000);
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
        console.log(data);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            type: 'POST',
            data: data,
            success: function (data) {
                // if step 1 
                console.log(data);
                let SMS = document.getElementById('SMS');
                SMS.innerHTML = `<input type="text" class="form-control input-border" 
                                        name="sms" placeholder="SMS Number" required>`;
            }
        });
    });
});
