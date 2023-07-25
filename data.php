<?php
use Youbird\Youbird;
include_once "./Youbird.php";
$youbird = new Youbird();
$icon = "exclamation-circle";
$iconColor = "var(--warning-color)";
$message = "Warning, Invalid youtube link";
$status = "warning";
// Get setting from json file
$info = json_decode(file_get_contents("./settings.json"));
// Set Header
header("Content-Type: application/json;charset=UTF-8");
function icon($type) : string {
    if ($type == "video") {
        return "<i class='fa fa-volume-mute'></i>";
    } elseif ($type == "audio") {
        return "<i class='fa fa-headphones'></i>";
    }
}
if (isset($_GET["link"])) {
    $link = htmlspecialchars($_GET["link"]);
    if ($youbird->addLink($link) && !empty($youbird->getInformation()) && empty($youbird->getErrors())) {
        $icon = "check-circle";
        $iconColor = "var(--success-color)";
        $message = "Done, Preparing links...";
        $status = "success";
        $video = $youbird->getInformation()[0];
    }
}
?> 
{
    "icon": "<?= $icon; ?>",
    "iconColor": "<?= $iconColor; ?>",
    "message": "<?= $message; ?>",
    "status": "<?= $status; ?>", 
    <?php if (isset($video->videoDetails)) { ?>
    "title": "<?= $video->videoDetails->title; ?>",
    "thumbnail": "<?= end($video->videoDetails->thumbnail->thumbnails)->url; ?>",
    <?php } ?>
    "downloadLinks": [
            <?php
            if (isset($video)) {
                $i = 0;
                foreach ($video->streamingData->formats as $format) {
                    $i++;
            ?>
        {
            "type": "<?= (preg_match("/^.*(?=\/[webmp4]+;)/", $format->mimeType, $match1)) ? "": "UNKNOWEN" ; ?>",
            "extention": "<?= (preg_match("/(?<=[videoaud]\/).[\w\d]+/", $format->mimeType, $match2)) ? $match2[0] : "UNKNOWEN" ; ?>",
            "quality": "<?= $format->qualityLabel; ?>",
            "downloadLink": "<?= ($info->customDownloadPage) ? $info->url."/download/?".http_build_query(["title"=>$video->videoDetails->title, "link"=>$format->url, "contentLength"=>(isset($format->contentLength)) ? $format->contentLength: "", "mimetype"=>$format->mimeType]): $format->url; ?>"
        },
        <?php
        }
                $i = 0;
                foreach ($video->streamingData->adaptiveFormats as $format) {
                    $i++;
            ?>
        {
            "type": "<?= (preg_match("/^.*(?=\/[webmp4]+;)/", $format->mimeType, $match1)) ? icon($match1[0]) : "UNKNOWEN" ; ?>",
            "extention": "<?= (preg_match("/(?<=[videoaud]\/).[\w\d]+/", $format->mimeType, $match2)) ? $match2[0] : "UNKNOWEN" ; ?>",
            "quality": "<?= (isset($format->quality)) ? ($match1[0] == "video") ? $format->qualityLabel:"Audio": $format->qualityLabel; ?>",
            "downloadLink": "<?= ($info->customDownloadPage) ? $info->url."/download/?".http_build_query(["title"=>$video->videoDetails->title, "link"=>$format->url, "contentLength"=>(isset($format->contentLength)) ? $format->contentLength: "", "mimetype"=>$format->mimeType]): $format->url; ?>"
        }<?= ($i >= count($video->streamingData->adaptiveFormats)) ? "" : ","; ?>
        <?php
        }}
        ?>
    ]
}