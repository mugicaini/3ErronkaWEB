<?php
$xml_path = __DIR__ . '/../tema.xml';

// Handle theme change via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['aldatu_gaia'])) {
    if (file_exists($xml_path)) {
        $xml = simplexml_load_file($xml_path);
        $xml->gaia = $_POST['aldatu_gaia'];
        $xml->asXML($xml_path);
    }
}

// Load current theme
$gaia = 'iluna'; // default
if (file_exists($xml_path)) {
    $xml = simplexml_load_file($xml_path);
    $gaia = (string) $xml->gaia;
}

// Define toggle values
if ($gaia === 'argia') {
    $gaia_hurrengoa = 'iluna';
    $gaia_testua = 'Gai Iluna';
} else {
    $gaia_hurrengoa = 'argia';
    $gaia_testua = 'Gai Argia';
}
?>
