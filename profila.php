<?php
session_start();
require_once 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Handle sub cancellation
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cancel_sub'])) {
    $stmt_cancel = $pdo->prepare("UPDATE bezero_subskripzioa SET berritze_automatikoa = 0 WHERE id_bezeroa = ? AND egoera = 'aktiboa'");
    $stmt_cancel->execute([$user_id]);
    $cancel_success = true;
}

// Handle reservation cancellation
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cancel_res'])) {
    $id_klasea = $_POST['id_klasea'];
    $stmt_cancel_res = $pdo->prepare("UPDATE erreserbak SET egoera = 'desapuntatuta', checkin = 0 WHERE id_bezeroa = ? AND id_klasea = ? AND egoera = 'konfirmatuta'");
    $stmt_cancel_res->execute([$user_id, $id_klasea]);
    $res_cancel_success = true;
}

// Get user data with sub details
$stmt = $pdo->prepare("
    SELECT b.*, s.izena as sub_izena, s.prezioa as sub_prezioa, bs.amaiera_data as sub_amaiera_data, bs.id_sub, bs.egoera, bs.berritze_automatikoa 
    FROM bezeroak b 
    LEFT JOIN bezero_subskripzioa bs ON b.id_bezeroa = bs.id_bezeroa AND bs.egoera = 'aktiboa'
    LEFT JOIN subskripzioak s ON bs.id_sub = s.id_sub 
    WHERE b.id_bezeroa = ?
");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

// Get reservations
$stmt_res = $pdo->prepare("
    SELECT e.*, k.izena as klase_izena, k.data as klase_data, k.sarrera_ordua, k.egoera as klase_egoera 
    FROM erreserbak e 
    JOIN klaseak k ON e.id_klasea = k.id_klasea 
    WHERE e.id_bezeroa = ? AND k.data >= CURRENT_DATE
    ORDER BY k.data ASC, k.sarrera_ordua ASC
");
$stmt_res->execute([$user_id]);
$reservations = $stmt_res->fetchAll();
?>
<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nire Profila - IRON STRENGTH</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,800;1,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="assets/css/profila.css">
</head>
<body class="<?php echo $gaia; ?>">

    <?php include 'includes/nav.php'; ?>

    <div class="profile-container">
        <div class="container">
            <h2 class="serif profile-title">Nire Profila</h2>
            
            <div class="profile-card">
                <div class="user-header">
                    <?php if($user['argazkia']): ?>
                        <img src="<?php echo $user['argazkia']; ?>" class="user-avatar" alt="Profila">
                    <?php else: ?>
                        <div class="user-avatar"><?php echo substr($user['izena'], 0, 1); ?></div>
                    <?php endif; ?>
                    <div>
                        <h3 class="user-name"><?php echo $user['izena'] . " " . $user['abizena']; ?></h3>
                        <p class="user-id">Bazkide zenbakia: #<?php echo str_pad($user['id_bezeroa'], 5, '0', STR_PAD_LEFT); ?></p>
                    </div>
                </div>

                <div class="info-grid">
                    <div class="info-item">
                        <label>Emaila</label>
                        <span><?php echo $user['email']; ?></span>
                    </div>
                    <?php if($user['telefonoa']): ?>
                    <div class="info-item">
                        <label>Telefonoa</label>
                        <span><?php echo $user['telefonoa']; ?></span>
                    </div>
                    <?php endif; ?>
                    <div class="info-item">
                        <label>Jaiotze Data</label>
                        <span><?php echo $user['jaiotze_data'] ? date('Y/m/d', strtotime($user['jaiotze_data'])) : '-'; ?></span>
                    </div>
                    <div class="info-item">
                        <label>Inskripzio Data</label>
                        <span><?php echo date('Y/m/d', strtotime($user['inskripzio_data'])); ?></span>
                    </div>
                </div>
            </div>
            
            <h3 class="serif section-title">Nire Subskripzioa</h3>
            <div class="profile-card">
                <div class="info-grid">
                    <div class="info-item">
                        <label>Plana</label>
                        <span><?php echo $user['sub_izena'] ?: 'Hasi gabea'; ?></span>
                    </div>
                    <div class="info-item">
                        <label>Prezioa</label>
                        <span><?php echo $user['sub_prezioa'] ? $user['sub_prezioa'] . '€' : '-'; ?></span>
                    </div>
                    <div class="info-item">
                        <?php 
                            // Check if sub_berritzea field still exists (optional check)
                            $has_renewal = isset($user['sub_berritzea']) ? $user['sub_berritzea'] : false;
                            $date_label = ($user['id_sub'] && $has_renewal) ? 'Hurrengo ordainketa' : 'Sarbide amaiera';
                            $display_date = $user['sub_amaiera_data'];
                            
                            if (!$display_date && $user['id_sub']) {
                                // Calculate next billing day based on inscription day
                                $day = date('d', strtotime($user['inskripzio_data']));
                                $display_date = date('Y-m-') . $day;
                                if (strtotime($display_date) <= time()) {
                                    $display_date = date('Y-m-d', strtotime('+1 month', strtotime($display_date)));
                                }
                            }
                        ?>
                        <label><?php echo $date_label; ?></label>
                        <span><?php echo $display_date ? date('Y/m/d', strtotime($display_date)) : '-'; ?></span>
                    </div>
                    <div class="info-item">
                        <label>Egoera</label>
                        <?php if($user['id_sub'] && ($user['egoera'] === 'aktiboa') && $user['berritze_automatikoa']): ?>
                            <span class="status-active">Aktibatuta </span>
                            <form method="POST" onsubmit="return confirm('Ziur zaude berritzea kanzelatu nahi duzula?')" class="cancel-form">
                                <button type="submit" name="cancel_sub" class="btn btn-secondary btn-cancel-sub">Kanzelatu Subskripzioa</button>
                            </form>
                        <?php elseif($user['id_sub'] && ($user['egoera'] === 'aktiboa')): ?>
                            <span class="status-canceled">Kanzelatuta (Sarbidea <?php echo date('Y/m/d', strtotime($display_date)); ?>-ra arte)</span>
                        <?php elseif($user['id_sub']): ?>
                            <span class="status-canceled">Desaktibatuta</span>
                        <?php else: ?>
                            <span>Ez dago subskripziorik</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <h3 class="serif section-title">Nire Erreserbak</h3>
            <div class="profile-card">
                <?php if(count($reservations) > 0): ?>
                    <table class="res-table">
                        <thead>
                            <tr>
                                <th>Klasea</th>
                                <th>Data</th>
                                <th>Ordua</th>
                                <th>Egoera</th>
                                <th>Ekintzak</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($reservations as $res): ?>
                                <tr>
                                    <td><strong><?php echo $res['klase_izena']; ?></strong></td>
                                    <td><?php echo date('Y/m/d', strtotime($res['klase_data'])); ?></td>
                                    <td><?php echo substr($res['sarrera_ordua'], 0, 5); ?></td>
                                    <td>
                                        <?php if ($res['klase_egoera'] === 'kanzelatuta'): ?>
                                            <span class="status-badge status-kanzelatuta">
                                                Klasea Kanzelatuta
                                            </span>
                                        <?php else: ?>
                                            <span class="status-badge status-<?php echo $res['egoera']; ?>">
                                                <?php echo $res['egoera']; ?>
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($res['egoera'] === 'konfirmatuta' && $res['klase_data'] >= date('Y-m-d') && $res['klase_egoera'] !== 'kanzelatuta'): ?>
                                            <form method="POST" onsubmit="return confirm('Ziur zaude klase honetatik desapuntatu nahi duzula?')">
                                                <input type="hidden" name="id_klasea" value="<?php echo $res['id_klasea']; ?>">
                                                <button type="submit" name="cancel_res" class="btn btn-secondary btn-cancel-res">Desapuntatu</button>
                                            </form>
                                        <?php else: ?>
                                            -
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p class="no-reservations">Oraindik ez duzu erreserbarik egin. <a href="klaseak.php" class="accent-link">Ikusi klaseak</a></p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
    <script src="assets/js/main.js"></script>
</body>
</html>