<?php
$title = (isset($_GET["title"])) ? urldecode($_GET["title"]): "";
$sourceURL = (isset($_GET["link"])) ? urldecode(trim($_GET["link"], "\\\"'<>")): "";
$contentLength = (isset($_GET["contentLength"])) ? (int)$_GET["contentLength"]: "";
$mimeType = (isset($_GET["mimetype"])) ? urldecode($_GET["mimetype"]): "";
if (isset(parse_url($sourceURL)["scheme"]) && parse_url($sourceURL)["scheme"] === "https") {
    header("Cache-Control: public");
    header("Pragma: public");
    header("Content-Description: File Transfer");
    if (!empty($contentLength)) {
        header("Content-Length: $contentLength");
    }
    header("Content-Type: $mimeType");
    header("Content-Disposition: attachment; filename=\"$title\"");
    header("Content-Transfer-Encoding: binary");

    readfile($sourceURL);
    exit;
} else {
    echo file_get_contents("./404.html");
}
?>