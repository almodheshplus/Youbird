$(() => {
    "use strict"
    const mainTimeAction = 280;
    let transparentCover = $(".transparent-cover"),
    modalContainer       = $(".modal-container"),
    bigIcon              = $(".big-icon"),
    modalBody            = $(".modal-body"), 
    videoDownload        = $("#download"),
    dataJson;
    function hideTC() {transparentCover.hide(mainTimeAction-150);}
    function showTC() {transparentCover.show(mainTimeAction-150);}
    function hideMC() {modalContainer.hide(mainTimeAction);}
    function showMC() {modalContainer.show(mainTimeAction);}
    function resetProgressBar() {$(".progress-bar").css("width", "100%");}
    function progressBarTimeOut() {setTimeout(() => {hideMC();hideTC();resetProgressBar();}, 5000);}
    function actionBeforeSend() {
        showMC();
        showTC();
        bigIcon.html('<i class="fa fa-gear fa-spin fa-6x"></i>');
        bigIcon.css("color", "rgb(52, 72, 154)");
        modalBody.html("Preparing video...");
    }
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
        let videoUrl = $("#url").val();
        e.preventDefault();
        $.ajax(
            {
                url: "./data.json",
                method: "GET",
                dataType: "json",
                data: {
                    "link": videoUrl
                },
                beforeSend: actionBeforeSend(),
                success: function (data) {
                    dataJson = data;
                    if (dataJson.status == "success") {
                        $(".video-information").removeClass("d-none");
                        videoDownload.html(""); /* Clear Items */
                        $(".thumbnail").attr("src", dataJson.thumbnail);
                        $(".title").html(dataJson.title);
                        let vidDownloadInfo = dataJson.downloadLinks;
                        vidDownloadInfo.forEach(vidInfo => {
                            videoDownload.append('<tr><td><b>'+vidInfo.quality+'</b>.'+vidInfo.extention+' '+vidInfo.type+'</td><td><a href="'+vidInfo.downloadLink+'" target="_blank" rel="noopener noreferrer"><i class="fa fa-cloud-download"></i> Download</a></td></tr>');
                        });
                    }
                    $(".progress-bar").css("width", "0%");
                    setTimeout(() => {
                        bigIcon.html('<i class="fa fa-'+dataJson.icon+' fa-6x"></i>');
                        bigIcon.css("color", dataJson.iconColor);
                        modalBody.html(dataJson.message);
                    }, 500);
                },
                error: function (xhr, status, error) {
                    showMC();
                    showTC();
                    $(".progress-bar").css("width", "0%");
                    bigIcon.html('<i class="fa fa-times-circle fa-6x"></i>');
                    bigIcon.css("color", "var(--error-color)");
                    modalBody.html("Something went wrong, <br><br><b class='custom'>Error: " + error + "</b>");
                },
                complete: function (xhr, status) {
                    progressBarTimeOut();
                }
            }
        );
    });
});