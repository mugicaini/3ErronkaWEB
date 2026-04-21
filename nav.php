    <!-- Navigation -->
    <nav class="glass">
        <div class="container">
            <div class="logo">
                <a href="index.php">
                    <span class="serif logo-main">IRON STRENGTH</span>
                    <span class="logo-sub">GYM & FITNESS</span>
                </a>
            </div>

            <!-- Hamburger Icon -->
            <div class="hamburger" id="mobile-menu-btn">
                <span></span>
                <span></span>
                <span></span>
            </div>

            <ul class="nav-menu" id="nav-list">
                <li><a href="index.php">Hasiera</a></li>
                <li><a href="index.php#guri-buruz">Guri Buruz</a></li>
                <li><a href="index.php#instalazioak">Instalazioak</a></li>
                <li><a href="index.php#prezioak">Prezioak</a></li>
                <li><a href="klaseak.php">Klaseak</a></li>

                <?php if(isset($_SESSION['user_id'])): ?>
                    <li><a href="profila.php" class="nav-profile-link">Profila</a></li>
                    <li><a href="logout.php" class="btn btn-secondary nav-btn-logout">Irten</a></li>
                <?php else: ?>
                    <li><a href="login.php" class="btn btn-primary nav-btn-login">Sartu</a></li>
                <?php endif; ?>
                
                <li>
                    <form method="POST" action="" class="nav-theme-form">
                        <input type="hidden" name="aldatu_gaia" value="<?php echo $gaia_hurrengoa; ?>">
                        <button type="submit" class="theme-toggle-btn" title="Aldatu gaia">
                            <?php echo $gaia_testua; ?>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>

    <script>
        document.getElementById('mobile-menu-btn').addEventListener('click', function() {
            this.classList.toggle('active');
            document.getElementById('nav-list').classList.toggle('active');
        });

        // Close menu when clicking a link
        document.querySelectorAll('.nav-menu a').forEach(link => {
            link.addEventListener('click', () => {
                document.getElementById('mobile-menu-btn').classList.remove('active');
                document.getElementById('nav-list').classList.remove('active');
            });
        });
    </script>
