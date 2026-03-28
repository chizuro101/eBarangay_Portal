<?php 

$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "ebarangay_portal";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables with defaults
$informations = [];
$photos       = [];
$themes       = [];
$steps        = [];
$cover_home   = null;

$title       = '';
$title_sub   = '';
$description = '';
$logo        = '';

$contact = '';
$email   = '';
$address = '';

$login = '';

$color1 = '';
$color2 = '';
$color3 = '';
$color4 = '';

$step1 = ['title' => '', 'description' => ''];
$step2 = ['title' => '', 'description' => ''];
$step3 = ['title' => '', 'description' => ''];

$cover_activity    = '';
$cover_title       = '';
$cover_date        = '';
$cover_place       = '';
$cover_photo       = '';
$cover_description = '';

// Fetch settings
$sql = "SELECT * FROM settings WHERE id = 1";
$result = $conn->query($sql);

if ($result && $row = $result->fetch_assoc()) {
    $title       = $row['title']       ?? '';
    $title_sub   = $row['title_sub']   ?? '';
    $description = $row['description'] ?? '';
    $logo        = $row['logo']        ?? '';
    $cover_home  = $row['cover']       ?? null;

    $informations = json_decode($row['information'], true) ?? [];
    $photos       = json_decode($row['photo'],       true) ?? [];
    $themes       = json_decode($row['theme'],       true) ?? [];
    $steps        = json_decode($row['step'],        true) ?? [];
}

// Fetch cover activity if set
if ($cover_home) {
    $sql = "SELECT * FROM activity WHERE id = " . intval($cover_home);
    $cover_info = $conn->query($sql);

    if ($cover_info && $cover_row = $cover_info->fetch_assoc()) {
        $cover_activity    = $cover_row['activity']    ?? '';
        $cover_title       = $cover_row['title']       ?? '';
        $cover_date        = $cover_row['date']        ?? '';
        $cover_place       = $cover_row['place']       ?? '';
        $cover_photo       = $cover_row['photo']       ?? '';
        $cover_description = $cover_row['description'] ?? '';
    }
}

// Extract information fields
$contact = $informations['contact'] ?? '';
$email   = $informations['email']   ?? '';
$address = $informations['address'] ?? '';

// Extract photo fields
$login = $photos['login'] ?? '';

// Extract theme fields
$color1 = $themes['color1'] ?? '';
$color2 = $themes['color2'] ?? '';
$color3 = $themes['color3'] ?? '';
$color4 = $themes['color4'] ?? '';

// Extract steps — kept as arrays so index.php can access ['title'] and ['description']
$step1 = $steps[0] ?? ['title' => '', 'description' => ''];
$step2 = $steps[1] ?? ['title' => '', 'description' => ''];
$step3 = $steps[2] ?? ['title' => '', 'description' => ''];

$conn->close();
?>