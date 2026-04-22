<?php
session_start();
require_once 'includes/db.php';
?>
<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klaseak - IRON STRENGTH</title>
    
    <!-- FullCalendar -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,800;1,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/index.css">
    
    <link rel="stylesheet" href="assets/css/klaseak.css">

</head>
<body class="<?php echo $gaia; ?>">

    <?php include 'includes/nav.php'; ?>

    <header class="hero-classes">
        <div class="container reveal">
            <h1 class="serif">Klaseen Egutegia</h1>
            <p>Iron Strength Experience</p>
        </div>
    </header>

    <div class="calendar-container">
        <div class="container">
            <div class="calendar-card reveal">
                <p class="calendar-info">
                    Aukeratu zure gogoko klasea eta egin erreserba klik batetan. 
                    <?php if(!isset($_SESSION['user_id'])): ?>
                        <br><strong class="login-notice">Erreserba egiteko saioa hasi behar duzu.</strong>
                    <?php endif; ?>
                </p>
                <div id="calendar"></div>
            </div>
        </div>
    </div>

    <!-- Modal System -->
    <div class="modal-overlay" id="booking-modal">
        <div class="modal-content">
            <h2 id="modal-title" class="modal-title"></h2>
            <p id="modal-text" class="modal-text"></p>
            <div class="modal-btns">
                <button class="btn btn-secondary" onclick="closeModal()">Utzi</button>
                <button class="btn btn-primary" id="confirm-booking-btn">Bai, Erreserbatu</button>
            </div>
        </div>
    </div>

    <!-- Tooltip -->
    <div id="event-tooltip">
        <div class="tip-title" id="tip-title"></div>
        <div class="tip-time" id="tip-time"></div>
    </div>

    <?php include 'includes/footer.php'; ?>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const calendarEl = document.getElementById('calendar');
        const tooltip = document.getElementById('event-tooltip');
        const tipTitle = document.getElementById('tip-title');
        const tipTime = document.getElementById('tip-time');

        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'eu',
            firstDay: 1, // Monday
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: window.innerWidth < 768 ? 'dayGridMonth' : 'dayGridMonth,timeGridWeek'
            },
            buttonText: {
                today: 'Gaur',
                month: 'Hila',
                week: 'Astea'
            },
            events: 'get_klaseak.php',
            
            eventMouseEnter: function (info) {
                const start = info.event.start;
                const end = info.event.end;
                const props = info.event.extendedProps;
                const isSpecial = !props.id_klase_mota; // No template ID means it's a special class
                
                tipTitle.textContent = (isSpecial ? "★ BEREZIA: " : "") + info.event.title;
                if (start) {
                    const fmt = (d) => d.toLocaleTimeString('eu', { hour: '2-digit', minute: '2-digit' });
                    tipTime.textContent = fmt(start) + (end ? ' – ' + fmt(end) : '');
                }
                tooltip.classList.add('visible');
            },
            eventMouseLeave: function () {
                tooltip.classList.remove('visible');
            },
            eventClick: function(info) {
                info.jsEvent.preventDefault();
                
                <?php if(!isset($_SESSION['user_id'])): ?>
                    showModal("Saioa Hasi", "Erreserba egiteko saioa hasi behar duzu. Login orrira joan nahi duzu?", () => {
                        window.location.href = "login.php";
                    });
                    return;
                <?php endif; ?>

                const klase_izena = info.event.title;
                const klase_id = info.event.id;
                const props = info.event.extendedProps;
                const isSpecial = !props.id_klase_mota; // No template ID means it's a special class
                
                if (isSpecial) {
                    showModal("Erreserba Berretsi", `"${klase_izena}" klasean izena eman nahi duzu?`, () => {
                        const formData = new FormData();
                        formData.append('id_klasea', klase_id);
                        
                        fetch('erreserba_egin.php', {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            showModal("Emaitza", data.message, null, true);
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            showModal("Errorea", "Arazo bat egon da zerbitzariarekin konektatzerakoan.", null, true);
                        });
                    });
                } else {
                    showModal(klase_izena, "Klase hau informatzailea da soilik, ezin da erreserbatu.", null, true);
                }
            },
            eventDidMount: function (info) {
                const props = info.event.extendedProps;
                const isSpecial = !props.id_klase_mota;
                
                if (isSpecial) {
                    info.el.classList.add('event-special');
                } else {
                    info.el.classList.add('event-normal');
                }
                
                info.el.style.fontWeight = '600';
                info.el.style.borderRadius = '4px';
                info.el.style.padding = '2px 8px';
                info.el.style.transition = 'all 0.3s ease';
            }
        });

        calendar.render();

        // Modal Logic
        const modal = document.getElementById('booking-modal');
        const modalTitle = document.getElementById('modal-title');
        const modalText = document.getElementById('modal-text');
        const confirmBtn = document.getElementById('confirm-booking-btn');

        window.showModal = function(title, text, onConfirm, singleButton = false) {
            modalTitle.textContent = title;
            modalText.textContent = text;
            modal.classList.add('active');
            
            if (singleButton) {
                confirmBtn.style.display = 'none';
                document.querySelector('.modal-content .btn-secondary').textContent = 'Itxi';
            } else {
                confirmBtn.style.display = 'inline-block';
                document.querySelector('.modal-content .btn-secondary').textContent = 'Utzi';
                confirmBtn.onclick = () => {
                    if (onConfirm) onConfirm();
                    closeModal();
                };
            }
        };

        window.closeModal = function() {
            modal.classList.remove('active');
        };

        document.addEventListener('mousemove', function (e) {
            tooltip.style.left = (e.clientX + 16) + 'px';
            tooltip.style.top = (e.clientY - 10) + 'px';
        });
    });
    </script>
    <script src="assets/js/main.js"></script>
</body>
</html>
