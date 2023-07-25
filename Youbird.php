<?php
namespace Youbird;
class Youbird
{
    private $links = [];
    private $videoIDs = [];
    private $informations = [];
    protected $errors = [];
    public $autoSetPlatform = true;
    public $acceptedHosts = ["youtube" => "/youtu(be)?(-nocookie)?\.(com|be)/", "facebook"=> "/f(ace)?b(ook)?\.(com|me)/"];
    public function addLink($link): bool {
        $filter_url = filter_var($link, FILTER_VALIDATE_URL);
        if ($filter_url) {
            $this->links[] = $filter_url;
            $this->links = array_unique($this->links);
            if ($this->autoSetPlatform) {
                $host = parse_url($filter_url)["host"];
                foreach ($this->acceptedHosts as $platform => $hostPattern) {
                    if (preg_match($hostPattern, $host)) {
                        $this->setPlatform($platform);
                    }
                }
            }
            return true;
        } else {
            $this->errors[] = "Please enter a valid link.";
            return false;
        }
    }
    public function setPlatform($platform) {
        if ($platform == "youtube") {
            foreach ($this->links as $link) {
                if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?|(?:shorts))/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $link, $vid_id)) {
                    if (isset($vid_id[1])) {
                        $this->videoIDs[] = $vid_id[1];
                    }
                }
            }
            $this->videoIDs = array_unique($this->videoIDs);
        } elseif ($platform == "facebook") {
            $this->errors[] = "Facebook not supported yet.";
        } elseif ($platform == "instagram") {
            $this->errors[] = "Instagram not supported yet.";
        } elseif ($platform == "twitter") {
            $this->errors[] = "Twitter not supported yet.";
        }
    }
    final public function getInformation(): array {
        $videosInformation = [];
        foreach ($this->videoIDs as $vidid) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://www.youtube.com/youtubei/v1/player?key=AIzaSyAO_FJ2SlqU8Q4STEHLGCilw_Y9_11qcW8');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, '{  "context": {    "client": {      "hl": "en",      "clientName": "WEB",      "clientVersion": "2.20210721.00.00",      "clientFormFactor": "UNKNOWN_FORM_FACTOR",   "clientScreen": "WATCH",      "mainAppWebInfo": {        "graftUrl": "/watch?v='.$vidid.'",           }    },    "user": {      "lockedSafetyMode": false    },    "request": {      "useSsl": true,      "internalExperimentFlags": [],      "consistencyTokenJars": []    }  },  "videoId": "'.$vidid.'",  "playbackContext": {    "contentPlaybackContext": {        "vis": 0,      "splay": false,      "autoCaptionsDefaultOn": false,      "autonavState": "STATE_NONE",      "html5Preference": "HTML5_PREF_WANTS",      "lactMilliseconds": "-1"    }  },  "racyCheckOk": false,  "contentCheckOk": false}');
            curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
            $headers = [];
            $headers[] = 'Content-Type: application/json';
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $info = json_decode(curl_exec($ch));
            if (curl_errno($ch)) {
                error_log("Error in CURL:". curl_error($ch), 0);
            }
            curl_close($ch);
            $this->informations[] = $info;
            if (isset($info->playabilityStatus->status)) {
                if ($info->playabilityStatus->status !== "OK") {
                    $this->errors[] = $info->playabilityStatus->reason;
                }
            } else {
                $this->errors[] = "Error: Can not reach to youtube SERVER.";
            }
        }
        return $this->informations;
    }
    public function getErrors(): array {
        return array_unique($this->errors);
    }
}
?>