<?php

// Проверяем получение ключа и реальную HTTP-форму тела на локальном сервере.
if (!isset($_SERVER['HTTP_AUTHORIZATION']) || $_SERVER['HTTP_AUTHORIZATION'] !== 'Bearer loopback-test-key') {
    http_response_code(401);
    return;
}
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if ($path === '/redirect/v1/workspaces') {
    header('Location: /v1/workspaces', true, 302);
    return;
}
if ($path === '/v1/workspaces') {
    header('Content-Type: application/json');
    echo '{"workspaces":[]}';
    return;
}
if ($path === '/error/v1/workspaces') {
    http_response_code(429);
    header('X-Request-ID: large-error');
    header('Retry-After: 10');
    echo str_repeat('x', 524288);
    return;
}

// Проверяем multipart-загрузку и обновление JSON-записи через cURL.
$method = $_SERVER['REQUEST_METHOD'];
$upload = $method === 'POST' && $path === '/v1/workspaces/ws-loopback/recordings';
$update = $method === 'PATCH' && $path === '/v1/workspaces/ws-loopback/recordings/fl-loopback';
if ($upload) {
    // Для файла сверяем размер и Content-Length, для канала принимаем chunked.
    $file = isset($_FILES['file']) ? $_FILES['file'] : [];
    $external = isset($_POST['metadata']) ? json_decode($_POST['metadata'], true) : [];
    $small = isset($external['mode']) && $external['mode'] === 'pipe';
    $size = $small ? 5 : 16777216;
    if (!isset($file['error']) || $file['error'] !== UPLOAD_ERR_OK
        || $file['name'] !== 'Звонок.wav' || $file['size'] !== $size
        || ($small ? file_get_contents($file['tmp_name']) !== 'audio' : !isset($_SERVER['CONTENT_LENGTH']))
        || !isset($_POST['check_duplicates']) || $_POST['check_duplicates'] !== 'false'
    ) {
        http_response_code(422);
        return;
    }
}
if ($update && (!isset($_SERVER['CONTENT_TYPE']) || $_SERVER['CONTENT_TYPE'] !== 'application/json'
    || file_get_contents('php://input') !== '{"metadata":{},"update_mask":"metadata"}'
)) {
    http_response_code(422);
    return;
}
if ($upload || $update) {
    header('Content-Type: application/json');
    echo json_encode(['recording' => [
        'id' => 'fl-loopback',
        'source' => 'upload',
        'file' => ['filename' => 'Звонок.wav', 'checksum_algorithm' => 'sha256'],
        'metadata' => (object) [],
        'storage' => ['uploaded_at' => '2026-11-27T10:00:00Z'],
        'processing' => ['status' => 'completed'],
        'statistics' => ['transcriptions_count' => 0, 'analyses_count' => 0],
    ]]);
    return;
}

if ($path === '/v1/workspaces/ws-loopback/recordings/fl-loopback/download') {
    if (isset($_SERVER['HTTP_RANGE']) && $_SERVER['HTTP_RANGE'] === 'bytes=5-9') {
        http_response_code(206);
        header('Content-Range: bytes 5-9/16777216');
        echo 'audio';
        return;
    }

    // Возвращаем тело больше клиентского лимита памяти, не собирая его в одну строку.
    header('Content-Type: application/octet-stream');
    header('Content-Length: 16777216');
    $part = str_repeat('z', 65536);
    for ($index = 0; $index < 256; $index++) {
        echo $part;
    }
    return;
}

http_response_code(404);
