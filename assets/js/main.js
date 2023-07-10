$(() => {
    "use strict"
    const mainTimeAction = 280;
    var videoUrl     = $(".form-input").val(),
    transparentCover = $(".transparent-cover"),
    modalContainer   = $(".modal-container"),
    bigIcon          = $(".big-icon"),
    modalBody        = $(".modal-body"), 
    torf             = true;

    function hideTC() {transparentCover.hide(mainTimeAction-150);}
    function showTC() {transparentCover.show(mainTimeAction-150);}
    function hideMC() {modalContainer.hide(mainTimeAction);}
    function showMC() {modalContainer.show(mainTimeAction);}
    function resetProgressBar() {$(".progress-bar").css("width", "100%");}

    $(".links").click(() => {
        $(".links-menu").show(mainTimeAction);
        showTC();
    });
    $("button.close-menu").click(() => {
        $(".links-menu").hide(mainTimeAction);
        hideTC();
        // hideMC();
    });
    $("#video-form").submit((e) => {
        e.preventDefault();
        function actionBeforeSend() {
            showMC();
            showTC();
            bigIcon.html('<i class="fa fa-gear fa-spin fa-6x"></i>');
            bigIcon.css("color", "rgb(52, 72, 154)");
            modalBody.html("Preparing video...");
        }
        $.ajax(
            {
                url: "test.json",
                /* contentType: , */
                type: "get",
                dataType: "application/json",
                cache: false,
                data: "",
                beforeSend: actionBeforeSend(),
                success: function (data) {
                    console.log(data);
                },
                error: function (xhr, status, error) {
                    console.log(xhr+" - "+status+" - "+error);
                }
            }
        );
        // bigIcon.html('<i class="fa fa-times-circle fa-6x"></i>');
        // bigIcon.css("color", "rgb(199, 70, 48)");
        // $(".progress-bar").css("width", "0%");
        // setTimeout(() => {
        //     hideMC();
        //     hideTC();
        //     resetProgressBar();
        // }, 5000);
        // modalBody.html("Please enter a valid link");
        
    });
});