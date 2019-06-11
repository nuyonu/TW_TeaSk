<nav class="navbar">
    <img src="../images/logo.png" alt="Skill Enhancer"/>
    <ul>
        <li><a href="/home"><i class="fas fa-home"></i>Acasă</a></li>
        <li><a href="/events"><i class="fas fa-calendar-week"></i>Evenimente</a></li>
        <li><a href="/trainings"><i class="fas fa-user-graduate"></i>Training-uri</a></li>
        <li><a href="/contact"> <i class="fas fa-mobile-alt"></i>Contact</a></li>
        <li><a href="/support"><i class="fas fa-question-circle"></i>Suport</a></li>
        <li><a href="/about"><i class="fas fa-info-circle"></i>Despre</a></li>
        <a href="home/disconnect">
            <button class="btn" id="signin">
                Disconnect
            </button>
        </a>
        <?php NavigatorUsers::isAdmin(); ?>
    </ul>
</nav>