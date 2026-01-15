<?php

function handle_fitsms_webhook()
{

    $rawInput = file_get_contents('php://input');

    if (!$rawInput) {
        http_response_code(400);
        echo json_encode(['error' => 'No data received']);
        exit;
    }

    $data = json_decode($rawInput, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid JSON']);
        exit;
    }

    if (!isset($data['status']) || $data['status'] !== 'success') {
        http_response_code(200);
        echo json_encode(['message' => 'Status not success, ignoring']);
        exit;
    }

    $smsData = $data['data'] ?? [];

    $to = $smsData['to'] ?? null;
    $from = $smsData['from'] ?? null;
    $message = $smsData['message'] ?? null;
    $smsType = $smsData['sms_type'] ?? null;
    $smsCount = $smsData['sms_count'] ?? null;
    $cost = $smsData['cost'] ?? null;
    $sendBy = $smsData['send_by'] ?? null;
    $ruid = $smsData['ruid'] ?? null;
    $receivedAt = $smsData['received_at'] ?? null;
    $expiredAt = $smsData['expired_at'] ?? null;

    /*
      Save to database or log or do whatever you want
    */

    http_response_code(200);

    echo json_encode(['message' => 'Webhook received successfully']);
}
