<?php
if (isset($_POST['gaia'])) {
  $xml = simplexml_load_file('tema.xml');
  $xml->gaia = $_POST['gaia'];
  $xml->asXML('tema.xml');
}

$xml  = simplexml_load_file('tema.xml');
$gaia = (string) $xml->gaia;

if ($gaia === 'argia') {
  $botoi_testua = ' Gai iluna';
  $botoi_balioa = 'iluna';
} else {
  $botoi_testua = ' Gai argia';
  $botoi_balioa = 'argia';
}
?>
<!DOCTYPE html>
<html lang="eu">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lokuura Gym - Hasiera</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body class="<?php echo $gaia; ?>">

  <header>
    <h1>Lokuura Gym</h1>
    <nav>
      <a href="index.php" class="aktibo">Hasiera</a>
      <form method="POST" action="" style="display:inline;">
        <button class="gaia-botoia" name="gaia" value="<?php echo $botoi_balioa; ?>">
          <?php echo $botoi_testua; ?>
        </button>
      </form>
    </nav>
  </header>

  <div class="hero">
    <h2>Ongi etorri Lokuura Gym-era</h2>
    <p>Zure bertsio onena izaten hasten den gimnasioa.</p>
  </div>

  <section>
    <h2>Nor gara?</h2>
    <p>Lokuura Gym-ek 2026an ireki zituen ateak, maila guztietako pertsonentzako espazio irisgarri, profesional eta motibatzailea eskaintzeko helburuarekin.</p>
    <p>1.500 m²-ko instalazioak ditugu, ekipamendu modernoa eta zure aurrerapenarekin konprometitutako entrenatzaile ziurtatuen taldea.</p>
  </section>

  <section>
    <h2>Gure zerbitzuak</h2>
    <div class="txartelak">
      <div class="txartela">
        <h3>Muskugintza</h3>
        <p>Pisu libreen eta makinen gela, entrenatzaileen gainbegiradapean.</p>
      </div>
      <div class="txartela">
        <h3>Yoga eta Pilates</h3>
        <p>Malgutasuna, oreka eta ongizatea lantzeko taldeko klaseak.</p>
      </div>
      <div class="txartela">
        <h3>Spinning</h3>
        <p>Bizikleta estatikoaren klaseak musika biziarekin eta giro motibatzailearekin.</p>
      </div>
      <div class="txartela">
        <h3>Arte Martzialak</h3>
        <p>Boxeoa, Muay Thai eta Kickboxinga helduei eta haurrei zuzenduta.</p>
      </div>
      <div class="txartela">
        <h3>Crossfit eta HIIT</h3>
        <p>Intentsitate altuko taldeko entrenamendua kalorien erretzeko.</p>
      </div>
      <div class="txartela">
        <h3>Nutrizioa</h3>
        <p>Dietista ziurtatuen elikadura plan pertsonalizatuak.</p>
      </div>
    </div>
  </section>

  <section>
    <h2>Gimnasioaren informazioa</h2>
    <div class="info-koadroa">
      <p><strong>Helbidea:</strong> Arranomendia, 2, 20240 Ordizia, Gipuzkoa</p>
      <p><strong>Telefonoa:</strong> +34 945 000 000</p>
      <p><strong>Emaila:</strong> info@Lokuura.eus</p>
      <p><strong>Ordutegia:</strong> Astelehenetik Ostiralera 6:00–23:00 · Larunbata 8:00–20:00</p>
    </div>
    <iframe
      src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2903.8!2d-2.1824307!3d43.0475306!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd50377e2184cd6b%3A0x3019c899f4e0c303!2sGoierri+Eskola!5e0!3m2!1ses!2ses!4v1"
      class="mapa" allowfullscreen="" loading="lazy">
    </iframe>
  </section>

  <footer>
    <p> Lokuura Gym — Eskubide guztiak erreserbatuta</p>
  </footer>

</body>
</html>
