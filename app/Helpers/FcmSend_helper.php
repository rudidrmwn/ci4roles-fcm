<?php

function sendPushNotification($title,$description, $to)
{  
    $url = "https://fcm.googleapis.com/fcm/send";
    $subscription_key  = "key=AAAAVGWTjwE:APA91bEMtUuuVdenup0wxz4Lhc70SXrFBAEIKeVuXba4l7IP0aPopmBQJoDA9z67wP6RJmtodqgfudvmJKeAqlcIKVhpfUbAmJp7LqAh6hSn_5N_DPqcni4GcsKmkhBYeOntauoS46L7";


    $request_headers = array(
        "Authorization:" . $subscription_key,
        "Content-Type: application/json"
    );
    
    $postRequest = [
        "to" =>  $to,
        "notification" => [
            "title" =>  $title,
            "body" =>  $description
        ]
    ];

    /** CURL POST code */
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postRequest));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $season_data = curl_exec($ch);

    if (curl_errno($ch)) {
        print "Error: " . curl_error($ch);
        exit();
    }
    // Show me the result
    curl_close($ch);
    $json = json_decode($season_data, true);

    echo '<pre>';
    print_r($json);
}