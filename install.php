<?php
function __INSTALL($arr) {
    $palette = json_decode(file_get_contents("./colorPalettes/palette.".$arr["palette"].".json"));
    $encodedJson = json_encode($arr);
    // Set Settings
    file_put_contents("./settings.json", $encodedJson);
    // Set Webmanifest
    file_put_contents("./site.webmanifest", "{
\"short_name\": \"YB\",
\"name\": \"".$arr["title"]."\",
\"icons\": [{
    \"src\": \"".$arr["logo"]."\",
    \"type\": \"image/png\",
    \"sizes\": \"192x192\"
}],
\"start_url\": \"".$arr["url"]."\",
\"display\": \"standalone\", 
\"background_color\": \"".$palette->mainColor."\",
\"theme_color\": \"".$palette->themeColor."\"
}
");
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["install"])) {
    __INSTALL(
        [
        "palette"=>$_POST["pallete"],
        "url"=>(substr($_POST["url"], -1,1) == "/") ? substr($_POST["url"], 0,-1): $_POST["url"],
        "title"=>$_POST["title"],
        "description"=>$_POST["description"],
        "keywords"=>$_POST["keywords"],
        "socialMediaImage"=>$_POST["smg"],
        "favicon"=>$_POST["favicon"],
        "svgIcon"=>$_POST["svgfavicon"],
        "pngIcon"=>$_POST["pngfavicon"],
        "logo"=>$_POST["logo"],
        "boldText"=>$_POST["boldText"],
        "smallText"=>$_POST["smallText"],
        "copyrightText"=>$_POST["copyrightText"],
        "customDownloadPage"=>(!empty($_POST["cdp"])) ? true: false
        ]
    );
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youbird Install Page</title>
    <link rel="stylesheet" href="./assets/css/normalize.css">
</head>
<body>
    <style>
        body {
            background: linear-gradient(120deg,#27368a,#511c9e,#c852bb);
            background-size: cover;
        }
        .container {
            background: #eeeeee54;
            color: #fff;
            width: 500px;
            max-width: 100%;
            margin: 10px auto;
            padding: 10px;
            border-radius: 6px;
            /* text-align: center; */
            box-shadow: 4px 0 8px 0px #c852bb, -4px 0px 8px 0px #27368a;
        }
        .title {
            text-align: center;
        }
        table {
            border-collapse: collapse;
        }
        table tbody tr:not(:last-child) {
            border-bottom: 1px solid rgba(255, 255, 255, 0.836);
        }
        textarea, input {
            background: #eee;
            width: 100%;
            color: #303030;
            resize: none;
            border: none;
            outline: none;
            border-bottom: 3.5px solid #5519c0;
            padding: 7px;
            border-radius: 2px;
            transition: background 0.3s;
        }
        textarea {
            height: 80px;
        }
        textarea:hover, input:not([type=checkbox]):hover {
            background: #d6d2d2;
        }
        textarea:focus, input:focus {
            background: #eed;
        }
        td {
            padding-top: 10px;
            color: #fff;
        }
        td:not(last-child) {
            padding-bottom: 10px;
        }
        button {
            padding: 10px;
            outline: none;
            border: none;
            border-radius: 10px;
            font-size: 1.2rem;
            padding-left: 20px;
            padding-right: 20px;
            background: linear-gradient(200deg,#27368a,#c852bb);
            color: #ffd;
            cursor: pointer;
            transition: padding-right 0.5s ease-in-out;
        }
        label {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }
        label input[type=checkbox] {
            opacity: 0;
            width: 0;
            height: 0;
        }
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: 0.4s;
            transition: 0.4s;
        }
        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: #fff;
            -webkit-transition: 0.4s;
            transition: 0.4s;
        }
        input:checked  + .slider {
            background: #2196f3;
        }
        input:focus  + .slider {
            box-shadow: 0 0 1px #2196f3;
        }
        input:checked  + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }
        .slider.round {
            border-radius: 34px;
        }
        .slider.round:before {
            border-radius: 50%;
        }
        #help {
            text-align: center;
            margin-bottom: 15px;
            padding: 10px 5px;
            background: #2b338c;
            color: #fff;
            border-left: 6px solid #53be2d;
        }
        #help a {
            text-decoration: none;
            color: #f895db;
        }
        #help a:hover {
            color: #f4bce4;
        }
    </style>

    <div class="container">
        <h2 class="title">Youbird Install</h2>
        <div id="help">Need Help? <a href="https://github.com/almodheshplus/YoubirdHelp" target="_blank" rel="noopener noreferr">Documentaion</a></div>
        <table>
            <tbody>
                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                <tr>
                    <td>Color Palette: </td>
                    <td>
                        <select name="pallete" required>
                            <option selected value="1">Palette 1</option>
                            <option value="2">Palette 2</option>
                            <option value="3">Palette 3</option>
                            <option value="4">Palette 4</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>WebSite Title: </td>
                    <td><input type="text" name="title" placeholder="Enter Website title" required></td>
                </tr>
                <tr>
                    <td>WebSite Url: </td>
                    <td><input type="url" name="url" placeholder="Enter website URL Or Link" required></td>
                </tr>
                <tr>
                    <td>WebSite Description: </td>
                    <td><textarea name="description" placeholder="Enter website Description" required></textarea></td>
                </tr>
                <tr>
                    <td>WebSite Keywords: </td>
                    <td><textarea placeholder="Enter website keywords, Like (Youtube, download, download youtube videos)" name="keywords" required></textarea></td>
                </tr>
                <tr>
                    <td>Social Media Image Link: </td>
                    <td><input type="url" placeholder="https://example.com/smg.png" name="smg" required></td>
                </tr>
                <tr>
                    <td>Favicon Image Link: </td>
                    <td><input type="url" placeholder="https://example.com/favicon.ico" name="favicon" required></td>
                </tr>
                <tr>
                    <td>SVG Favicon Link: </td>
                    <td><input type="url" placeholder="https://example.com/svgicon.svg" name="svgfavicon" required></td>
                </tr>
                <tr>
                    <td>PNG Favicon Link: </td>
                    <td><input type="url" placeholder="https://example.com/favicon.png" name="pngfavicon" required></td>
                </tr>
                <tr>
                    <td>Logo Link: </td>
                    <td><input type="url" placeholder="https://example.com/logo.png" name="logo" required></td>
                </tr>
                <tr>
                    <td>Home Page Heading: </td>
                    <td><input type="text" placeholder="Free Online Video Downloader" name="boldText" required></td>
                </tr>
                <tr>
                    <td>Home Page UnderHeading: </td>
                    <td><input type="text" placeholder="Download video from YouTube for free" name="smallText" required></td>
                </tr>
                <tr>
                    <td>Copy Right Text: </td>
                    <td><textarea placeholder="Appers in footer, You can add HTML code" name="copyrightText" required></textarea></td>
                </tr>
                <tr>
                    <td>Custom Download Page: </td>
                    <td>
                        <label>
                            <input type="checkbox" checked name="cdp">
                            <span class="slider round"></span>
                        </label>
                    </td>
                </tr>
                <tr><td>Install Script: </td><td><button name="install" type="submit">Install</button></td></tr>
                </form>
            </tbody>
        </table>
    </div>

</body>
</html>