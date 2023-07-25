<?php
// Check if install.php Exists
if (file_exists("./install.php")) {exit("<h3>Please Delete <code>install.php</code> file</h3><div id='help'>Need Help? <a href='https://github.com/almodheshplus/YoubirdHelp' target='_blank' rel='noopener noreferr'>Documentaion</a></div>");}
// Get setting from json file
$info = json_decode(file_get_contents("./settings.json"));
$themeColor = json_decode(file_get_contents("./colorPalettes/palette.".$info->palette.".json"))->themeColor;
// Menu
$menu = json_decode(file_get_contents("./menuLinks.json"));
// Ad Units
function getAd($unit) {
    if (file_exists("./adUnit".$unit.".html")) {
        return file_get_contents("./adUnit".$unit.".html");
    } else {
        return "<!-- WARNING: Ad Unit Doesn't Exist -->";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $info->title; ?></title>
    <!-- Basic informations -->
    <meta name="description" content="<?= $info->description; ?>">
    <meta name="keywords" content="<?= $info->keywords; ?>">
    <!-- Meta tags for Socail Media -->
    <meta property="og:title" content="<?= $info->title; ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= $info->url; ?>">
    <meta property="og:image" content="<?= $info->socialMediaImage; ?>">
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= $info->favicon; ?>" type="image/x-icon">
    <link rel="icon" href="<?= $info->pngIcon; ?>" sizes="any">
    <link rel="icon" href="<?= $info->svgIcon; ?>" type="image/svg+xml">
    <link rel="apple-touch-icon" href="<?= $info->pngIcon; ?>">
    <!-- 
        ## Manifest File ##
        # Web Application Manifest
        ## provides information about a web application
        ### provide information that the browser needs to install a progressive web app
     -->
    <link rel="manifest" href="./site.webmanifest">
    <!-- Theme color -->
    <meta name="theme-color" content="<?= $themeColor; ?>">
    <!-- Google Fonts (Wrok Sans) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100;0,300;0,400;0,500;0,600;0,700;0,800;1,800&display=swap" rel="stylesheet">
    <!-- Render Elements Normaly -->
    <link rel="stylesheet" href="./assets/css/normalize.css">
    <!-- Font Awesome Free 6.4.0 by @fontawesome -->
    <link rel="stylesheet" href="./assets/css/all.min.css">
    <!-- Main CSS File -->
    <link rel="stylesheet" href="./assets/css/main.css">
    <?= (file_exists("./customHeadCode.html")) ? file_get_contents("./customHeadCode.html")."\n": "<!-- Custom Head Code File Doesn't Exists -->\n"; ?>
    <!-- Structured Data (json+ld) -->
    <script type="application/ld+json">
    {
        "@context":"https://schema.org/",
        "@graph":[
            {
                "@type":"WebSite",
                "url":<?= json_encode($info->url); ?>,
                "name":<?= json_encode($info->title); ?>,
                "description":<?= json_encode($info->description); ?>,
                "inLanguage":"en-US",
                "potentialAction":[
                    {
                        "@type":"SearchAction",
                        "target":<?= json_encode($info->url."/watch?v={link}"); ?>,
                        "query-input":"required name=link"}
                ]
            } 
        ]
    }
    </script>
    <!-- Structured Data (json+ld) -->
</head>
<body>
    <div class="d-none transparent-cover"></div> <!-- A Transparent Cover -->
    <div class="d-none modal-container">
        <div class="modal">
            <div class="progress-bar"></div>
            <div class="big-icon"></div>
            <div class="modal-body"></div>
            <div class="for-script-tag"></div>
        </div>
    </div>
    <div class="background-behind"></div> <!-- The Image Behind .landing -->
    <!-- Start Header -->
    <div class="header">
        <div class="container">
            <!-- Logo -->
            <div class="logo">
                <img src="<?= $info->logo; ?>" alt="<?= $info->title; ?>" class="logoimg">
            </div>
            <!-- Huburger Button -->
            <div class="links">
                <button class="ready-button icon">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>
    </div>
    <!-- Menu Links -->
    <div class="d-none links-menu">
        <!-- Close Button -->
        <div class="cm-c"><button class="ready-button close-menu"><i class="fa fa-times"></i></button></div>
        <!-- Menu Links -->
        <ul>
            <?php
                foreach ($menu->menu as $link) {
            ?>
                <li><a href="<?= $link->link; ?>"><i style="<?= $link->iconColor; ?>" class="fa fa-<?= $link->iconClass; ?>"></i> <?= $link->text; ?></a></li>
            <?php } ?>
        </ul>
    </div>
    <!-- End Header -->
    <!-- Start Lannding Section -->
    <div class="landing">
        <!-- Start .intro-box -->
        <?= getAd(1); ?>
        <div class="intro-box">
            <div class="text"> <!-- Intro Text Container -->
                <h1><?= $info->boldText; ?></h1>
                <p><?= $info->smallText; ?></p>
            </div>
            <?= getAd(2); ?>
            <form action="./data.json" method="GET" id="video-form" class="url-form">
                <input autofocus id="url" class="form-input" name="link" type="text" value="<?= (isset($_GET["v"]) && !empty($_GET["v"])) ? "https://youtube.com/watch?v=".htmlspecialchars($_GET["v"]): ""; ?>" placeholder="Enter youtube video link here...">
                <button type="submit" class="submit-button"><i class="fa fa-arrow-right"></i></button>
            </form>
        </div>
        <?= getAd(3); ?>
        <!-- Start video Download V1 -->
        <div class="d-none video-information">
            <div class="container">
                <div class="thumbnailandtitle">
                    <img src="./waiting.svg" alt="Thumbnail" class="thumbnail">
                    <h3 class="title">Waiting Response...</h3>
                </div>
                <div class="downloadlinks">
                    <table>
                        <tbody id="download">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- End video Download V1 -->
        <?= getAd(4); ?>
    </div>
    <!-- End Lannding Section -->
    <!-- Start Footer -->
    <div class="footer">
        <div class="container">
            <!-- Copy Right Text -->
            <div class="copy-right"><?= $info->copyrightText; ?></div>
        </div>
    </div>
    <!-- End Footer -->
    <!-- Javascript Erea -->
    <!-- jQuery v3.7.0  -->
    <script src="./assets/js/jquery.min.js"></script>
    <!-- Main JS File -->
    <script src="./assets/js/main.js"></script>
    <?= (isset($_GET["v"]) && !empty($_GET["v"])) ? "<script>window.onload = function () {setTimeout(()=> {\$(\"#video-form\").submit();}, 300);}</script>": ""; ?>
</body>
</html>