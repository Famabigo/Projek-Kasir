<?php
/**
 * Helper untuk lihat Laravel log dengan mudah
 * Akses: http://127.0.0.1:8000/lihat_log.php
 */

$logFile = __DIR__ . '/storage/logs/laravel.log';

if (!file_exists($logFile)) {
    die('Log file tidak ditemukan!');
}

// Ambil 100 baris terakhir
$lines = file($logFile);
$lastLines = array_slice($lines, -100);

echo "<!DOCTYPE html>
<html>
<head>
    <title>Laravel Log Viewer</title>
    <style>
        body {
            font-family: 'Courier New', monospace;
            background: #1e1e1e;
            color: #d4d4d4;
            padding: 20px;
            margin: 0;
        }
        h1 {
            color: #4ec9b0;
            border-bottom: 2px solid #4ec9b0;
            padding-bottom: 10px;
        }
        .log-line {
            padding: 5px;
            margin: 2px 0;
            border-left: 3px solid #333;
            background: #252526;
        }
        .log-line.info {
            border-left-color: #4ec9b0;
        }
        .log-line.error {
            border-left-color: #f48771;
            background: #2d1e1e;
        }
        .log-line.debug {
            border-left-color: #dcdcaa;
        }
        .highlight {
            background: yellow;
            color: black;
            font-weight: bold;
        }
        .refresh-btn {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #0e639c;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }
        .refresh-btn:hover {
            background: #1177bb;
        }
    </style>
</head>
<body>
    <button class='refresh-btn' onclick='location.reload()'>🔄 Refresh Log</button>
    <h1>📋 Laravel Log - 100 Baris Terakhir</h1>
    <div style='margin-bottom: 20px; color: #888;'>
        File: " . $logFile . "<br>
        Total Lines: " . count($lines) . "<br>
        Showing: Last 100 lines
    </div>";

foreach ($lastLines as $line) {
    $class = 'log-line';
    
    if (stripos($line, 'ERROR') !== false || stripos($line, 'Exception') !== false) {
        $class .= ' error';
    } elseif (stripos($line, 'INFO') !== false) {
        $class .= ' info';
    } elseif (stripos($line, 'DEBUG') !== false) {
        $class .= ' debug';
    }
    
    // Highlight important keywords
    $line = htmlspecialchars($line);
    $line = str_replace('member_id', "<span class='highlight'>member_id</span>", $line);
    $line = str_replace('TRANSAKSI STORE', "<span class='highlight'>TRANSAKSI STORE</span>", $line);
    
    echo "<div class='$class'>$line</div>";
}

echo "</body></html>";
