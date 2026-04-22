<?php 
session_start();
include 'includes/db.php'; 

// Fetch Unique Class Types
$stmt_klaseak = $pdo->query("SELECT * FROM klase_motak WHERE aktiboa = 1");
$klaseak = $stmt_klaseak->fetchAll();

// Fetch Trainers
$stmt_trainers = $pdo->query("SELECT * FROM langileak WHERE rola = 'entrenatzailea'");
$trainers = $stmt_trainers->fetchAll();

// Fetch Subscriptions
$stmt_subs = $pdo->query("SELECT * FROM subskripzioak");
$subscriptions = $stmt_subs->fetchAll();

// Fetch Machines
$stmt_makinak = $pdo->query("SELECT * FROM makinak");
$makinak = $stmt_makinak->fetchAll();
?>

<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IRON STRENGTH ANTIGRAVITY - Arin sentitu. Askatasunez mugitu.</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500&family=Playfair+Display:ital@0;1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/index.css?v=1.1">
    <link rel="stylesheet" href="assets/css/home.css">
</head>
<body class="<?php echo $gaia; ?>">

    <?php include 'includes/nav.php'; ?>

    <!-- Hero Section -->
    <?php $hero_img = 'assets/img/gym-por-fuera.jpeg'; $v_hero = file_exists($hero_img) ? filemtime($hero_img) : time(); ?>
    <section id="hasiera" class="hero" style="background-image: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('<?php echo $hero_img; ?>');">
        <div class="container">
            <div class="hero-content reveal">
                <h1>Iron Strength Gym</h1>
                <p>Zure muga bakarra zuk jartzen duzu. Kalitatezko ekipamendua eta espezialitateko klaseak toki berean.</p>
                <div class="flex hero-btns">
                    <a href="#instalazioak" class="btn btn-primary">Ikusi instalazioak</a>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="guri-buruz" class="secondary-bg section-padding">
        <div class="container">
            <div class="text-center reveal section-header">
                <h2>Zergatik IRON STRENGTH?</h2>
                <div class="accent-line"></div>
            </div>
            <div class="grid benefit-grid">
                <!-- Muskulazioa -->
                <div class="benefit-card reveal">
                    <div class="benefit-icon-wrapper">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 5h2v14H6z"/><path d="M16 5h2v14h-2z"/><path d="M3 8h3v8H3z"/><path d="M18 8h3v8h-3z"/><path d="M8 12h8"/>
                        </svg>
                    </div>
                    <h3>Muskulazioa</h3>
                    <p>Azken belaunaldiko pisu libreak eta makina espezifikoak, zure indar maximoa eta muskulu-garapena modu seguruan lortzeko.</p>
                </div>

                <!-- Indar Funtzionala -->
                <div class="benefit-card reveal">
                    <div class="benefit-icon-wrapper">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 2a5 5 0 0 0-5 5v2a7 7 0 0 0-7 7v3h24v-3a7 7 0 0 0-7-7V7a5 5 0 0 0-5-5z"/><path d="M12 7V2"/>
                        </svg>
                    </div>
                    <h3>Indar Funtzionala</h3>
                    <p>Mugikortasuna eta core-aren indarra sustatzen dugu, zure gorputza eguneroko bizitzako erronketarako prest egon dadin.</p>
                </div>

                <!-- Teknologia -->
                <div class="benefit-card reveal">
                    <div class="benefit-icon-wrapper">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/>
                        </svg>
                    </div>
                    <h3>Teknologia</h3>
                    <p>Matrix eta Technogym makineria digitalizatua, zure aurrerapenaren jarraipen zehatza gure aplikazioaren bidez egiteko.</p>
                </div>

                <!-- Aireko Klaseak -->
                <div class="benefit-card reveal">
                    <div class="benefit-icon-wrapper">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/>
                        </svg>
                    </div>
                    <h3>Aireko Klaseak</h3>
                    <p>Eskegidura-sistema berritzaileak grabitaterik gabe entrenatzeko, bizkarrezurra deskonprimitu eta malgutasuna hobetuz.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Classes Section -->
    <section id="klaseak">
        <div class="container">
            <h2 class="text-center reveal class-header">GURE KLASEAK</h2>
            <div class="class-grid reveal">
                <?php foreach($klaseak as $klase): ?>
                <!-- Class -->
                <article class="class-card">
                    <?php 
                        // Use real image from DB if available
                        $img = $klase['argazkia'] ?: "assets/img/class_antigravity_yoga_1774528634127.png";
                        $v_class = file_exists($img) ? filemtime($img) : time();
                    ?>
                    <img src="<?php echo $img; ?>?v=<?php echo $v_class; ?>" alt="<?php echo $klase['izena']; ?>" class="class-img">
                    <div class="class-card-content">
                        <h3><?php echo $klase['izena']; ?></h3>
                        <p><?php echo $klase['deskripzioa']; ?></p>
                    </div>
                </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Installations / Machines Section -->
    <section id="instalazioak" class="secondary-bg section-padding install-section">
        <div class="container">
            <div class="text-center reveal install-header">
                <span class="install-subtitle">Esperientzia Orokorra</span>
                <h2 class="install-title">Zure Fitness Zentroa</h2>
                <div class="install-line"></div>
            </div>
            
            <div class="machine-grid machine-grid-wrapper">
                <?php foreach($makinak as $makina): ?>
                        <div class="premium-card">
                            <?php if($makina['argazkia']): ?>
                            <div class="machine-img-container">
                                <img src="<?php echo $makina['argazkia']; ?>" class="machine-img">
                            </div>
                            <?php endif; ?>
                            
                            <div class="machine-header">
                                <span class="machine-tag"><?php echo $makina['mota']; ?></span>
                            </div>
                            
                            <h4 class="machine-title"><?php echo $makina['izena']; ?></h4>
                            <p class="machine-info">
                                <span class="machine-location-label">Kokalekua:</span> <?php echo $makina['kokalekua']; ?>
                            </p>
                        </div>
                <?php endforeach; ?>
            </div>
        </div>
        </div>
        
    </section>


    <!-- Trainers Section -->
    <section id="entrenatzaileak" class="secondary-bg section-padding">
        <div class="container">
            <h2 class="text-center reveal trainer-section-header">Gure Taldea</h2>
            <div class="trainer-grid reveal">
                <?php foreach($trainers as $trainer): ?>
                <div class="trainer-card">
                    <div class="trainer-image-container">
                        <?php 
                            $trainer_img = $trainer['argazkia'] ?: "assets/img/trainer_portrait_1_1774528787086.png"; 
                            $v = file_exists($trainer_img) ? filemtime($trainer_img) : time();
                        ?>
                        <img src="<?php echo $trainer_img; ?>?v=<?php echo $v; ?>" alt="<?php echo $trainer['izena']; ?>" class="trainer-img">
                    </div>
                    <h3 class="trainer-name"><?php echo $trainer['izena'] . " " . $trainer['abizena']; ?></h3>
                    <p class="trainer-specialty">
                        <?php echo $trainer['espezializazioa'] ?: $trainer['rola']; ?>
                    </p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Subscription Section -->
    <section id="prezioak" class="pricing-section">
        <div class="container">
            <h2 class="text-center reveal pricing-header">Harpidetzak</h2>
            <div class="pricing-grid reveal">
                <?php foreach($subscriptions as $sub): ?>
                <div class="pricing-card <?php echo ($sub['izena'] == 'Premium') ? 'featured' : ''; ?>">
                    <h3><?php echo $sub['izena']; ?></h3>
                    <div class="price"><?php echo round($sub['prezioa']); ?>€<span>/hil</span></div>
                    <ul class="pricing-list">
                        <li>Gimnasiorako sarbidea</li>
                        <li>Dutxak eta aldagelak</li>
                        <li><strong><?php echo ($sub['klase_limitea'] > 0) ? 'Hilean ' . $sub['klase_limitea'] . ' klase' : 'Klaserik gabe'; ?></strong></li>
                    </ul>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testigantzak" class="testimonial-section">
        <div class="container reveal">
            <h2 class="text-center testimonial-header">Bezeroen Esperientziak</h2>
            <div class="grid testimonial-grid">
                <!-- Testimonial 1 -->
                <div class="glass testimonial-card">
                    <div class="testimonial-stars">★★★★★</div>
                    <p class="testimonial-text">"Inoiz probatu dudan esperientziarik lasaiena. Antigravity saio bakoitzaren ondoren arinago sentitzen naiz, ia flotatzen."</p>
                    <p class="testimonial-author">- Maite G.</p>
                </div>
                <!-- Testimonial 2 -->
                <div class="glass testimonial-card">
                    <div class="testimonial-stars">★★★★★</div>
                    <p class="testimonial-text">"Mikel eta Ane oso profesionalak dira. Instalazioak dotoreak eta giroa ezin hobea da indarra lantzeko."</p>
                    <p class="testimonial-author">- Jon A.</p>
                </div>
                <!-- Testimonial 3 -->
                <div class="glass testimonial-card">
                    <div class="testimonial-stars">★★★★★</div>
                    <p class="testimonial-text">"Gimnasio hoberena eskualdean. Matrix eta Technogym materiala harrigarria da. Hemen entrenatzea plazer bat da."</p>
                    <p class="testimonial-author">- Iker L.</p>
                </div>
                <!-- Testimonial 4 -->
                <div class="glass testimonial-card">
                    <div class="testimonial-stars">★★★★★</div>
                    <p class="testimonial-text">"Antigravity saioekin nire bizkarreko mina desagertu da. Inoiz ez nuen pentsatuko horrenbeste gozatuko nuenik."</p>
                    <p class="testimonial-author">- Leire O.</p>
                </div>
                <!-- Testimonial 5 -->
                <div class="glass testimonial-card">
                    <div class="testimonial-stars">★★★★★</div>
                    <p class="testimonial-text">"Aldagelak eta dutxak hotel batetakoak direla dirudite. Guztia oso garbia eta detale askorekin zainduta."</p>
                    <p class="testimonial-author">- Ander M.</p>
                </div>
            </div>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>

    <script src="assets/js/main.js"></script>
</body>
</html>
