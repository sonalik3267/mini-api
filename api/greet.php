<?php

header("Content-Type: application/json");
date_default_timezone_set("Asia/Kolkata");

try {

    $name = isset($_GET["name"]) && trim($_GET["name"]) != ""
        ? htmlspecialchars(trim($_GET["name"]))
        : "Guest";

    $hour = date("H");

    if ($hour < 12) {

        $greeting = "Good Morning";

    } elseif ($hour < 18) {

        $greeting = "Good Afternoon";

    } else {

        $greeting = "Good Evening";

    }

    echo json_encode(
        [
            "status" => true,
            "message" => "$greeting $name! Welcome to Fashion Store Dashboard.",
            "time" => date("d M Y | h:i:s A"),
            "api_status" => "Active"
        ],
        JSON_PRETTY_PRINT
    );

} catch (Exception $e) {

    echo json_encode(
        [
            "status" => false,
            "message" => $e->getMessage()
        ],
        JSON_PRETTY_PRINT
    );

}

?>