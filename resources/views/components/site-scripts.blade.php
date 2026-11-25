<script>
(function () {
    // Preloader
    window.addEventListener('load', function () {
        var preloader = document.querySelector('.preloader');
        if (preloader) {
            preloader.classList.add('fade-out');
            setTimeout(function () { preloader.style.display = 'none'; }, 500);
        }
    });

    // Mobile menu
    var mobileMenuBtn = document.getElementById('mobileMenuBtn');
    var nav = document.getElementById('nav');
    if (mobileMenuBtn && nav) {
        mobileMenuBtn.addEventListener('click', function () {
            nav.classList.toggle('active');
            this.innerHTML = nav.classList.contains('active')
                ? '<i class="fas fa-times"></i>'
                : '<i class="fas fa-bars"></i>';
        });
    }

    // Sticky header
    var header = document.getElementById('header');
    if (header) {
        window.addEventListener('scroll', function () {
            header.classList.toggle('header-scrolled', window.scrollY > 100);
        });
    }

    // Tampilkan tombol Login Admin di desktop
    function showAdminLoginBtn() {
        var btn = document.getElementById('adminLoginBtn');
        if (!btn) return;
        btn.style.display = window.innerWidth >= 992 ? 'flex' : 'none';
    }
    window.addEventListener('resize', showAdminLoginBtn);
    document.addEventListener('DOMContentLoaded', showAdminLoginBtn);
    showAdminLoginBtn();
})();
</script>
