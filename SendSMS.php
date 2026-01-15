<?php

define('FITSMS_ENDPOINT', 'https://app.fitsms.lk/api/v4/sms/send');
define('FITSMS_SENDER_ID', 'xxxxxxxxxxx');

// You can find your auth token in your dashboard -> developers section
define('FITSMS_AUTH_TOKEN', 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx');

function send_sms(string $number, string $message)
{

    $data = [
        'recipient' => $number,
        'sender_id' => FITSMS_SENDER_ID,
        'type' => 'plain',
        'message' => $message
    ];

    $ch = curl_init(FITSMS_ENDPOINT);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . FITSMS_AUTH_TOKEN,
        'Content-Type: application/json',
        'Accept: application/json'
    ]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $response = curl_exec($ch);

    if ($response === false) {
        echo "cURL Error: " . curl_error($ch) . "\n";
        curl_close($ch);
        return false;
    }

    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode !== 200) {
        echo "HTTP Error: $httpCode - $response\n";
        return false;
    }

    $responseData = json_decode($response, true);
    if (isset($responseData['status']) && $responseData['status'] === 'success') {
        echo "Message sent successfully to $number\n";
        return true;
    } else {
        $errorMessage = $responseData['message'] ?? 'Unknown error';
        echo "Failed to send message to $number: $errorMessage\n";
        return false;
    }
}

//Country Code Is Mandatory  = +94

send_sms('+947XXXXXXXX', 'This is a test message');

// OR For Multiple,
// send_sms('+947XXXXXXXX, +947XXXXXXX', 'This is a test message');