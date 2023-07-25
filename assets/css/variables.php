<?php
header("Content-Type: text/css;charset=UTF-8");
// $cvariables = json_decode(file_get_contents("../../cssvariables.json"));
$settings = json_decode(file_get_contents("../../settings.json"));
$cvariables = json_decode(file_get_contents("../../colorPalettes/palette.".$settings->palette.".json"));
?>
/* Start Variables */
:root {
    --main-color: <?= $cvariables->mainColor; ?>;
    --second-color: <?= $cvariables->secondColor; ?>;
    --third-color: <?= $cvariables->thirdColor; ?>;
    --button-color: <?= $cvariables->buttonColor; ?>;
    --header-bg: <?= $cvariables->headerBg; ?>;
    --landing-bg: <?= $cvariables->landingBg; ?>;
    --footer-bg: <?= $cvariables->footerBg; ?>;
    --bg-behind: <?= $cvariables->bgBehind; ?>;
    --main-transition-time: <?= $cvariables->MTT; ?>;
    --transparent-cover-opacity: <?= $cvariables->TCO; ?>;
    --progress-bar-bgcolor: <?= $cvariables->PBBgColor; ?>;
    --bar-transition-time: <?= $cvariables->barTransTime; ?>;
    --vid-title-color: <?= $cvariables->VTitleColor; ?>;
    --success-color: <?= $cvariables->successColor; ?>;
    --error-color: <?= $cvariables->errorColor; ?>;
    --warning-color: <?= $cvariables->warningColor; ?>;
    --video-infobgcolor: <?= $cvariables->VInfoBgColor; ?>;
    --video-infobordercolor: <?= $cvariables->VIBorderColor; ?>;
    --td-color: <?= $cvariables->tdColor; ?>;
    --download-btn-bgcolor: <?= $cvariables->DBtnBgColor; ?>;
    --vid-title-bordercolor: <?= $cvariables->VTitleBorderColor; ?>;
    --mute-color: <?= $cvariables->muteColor; ?>;
    --headphones-color: <?= $cvariables->headphonesColor; ?>;
}
/* End Variables */