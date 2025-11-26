<?php

function base64url_encode($data) {
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

function gerar_jwt($payload, $secret) {

    // HEADER
    $header = [
        "alg" => "HS256",
        "typ" => "JWT"
    ];

    $header_encoded = base64url_encode(json_encode($header));

    // PAYLOAD
    $payload_encoded = base64url_encode(json_encode($payload));

    // SIGNATURE
    $assinatura = hash_hmac('sha256', "$header_encoded.$payload_encoded", $secret, true);
    $assinatura_encoded = base64url_encode($assinatura);

    return "$header_encoded.$payload_encoded.$assinatura_encoded";
}
