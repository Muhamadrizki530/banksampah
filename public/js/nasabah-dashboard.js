

document.addEventListener('DOMContentLoaded', function () {

    /* 1. Animasi progress bar rank saat halaman dimuat */
    var progressBar = document.querySelector('.bsl-progress .progress-bar');
    if (progressBar) {
        var target = parseInt(progressBar.dataset.progress || '0', 10);
        requestAnimationFrame(function () {
            setTimeout(function () {
                progressBar.style.width = target + '%';
            }, 150);
        });
    }

    /* 2. Tutup banner informasi tanpa reload (client-side only) */
    document.querySelectorAll('.bsl-banner-close').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var banner = btn.closest('.bsl-banner');
            if (!banner) return;
            banner.style.transition = 'opacity .2s ease, transform .2s ease';
            banner.style.opacity = '0';
            banner.style.transform = 'translateY(-6px)';
            setTimeout(function () {
                banner.remove();
            }, 200);
        });
    });

    /* 3. Efek tekan (active state) pada quick menu untuk perangkat sentuh */
    document.querySelectorAll('.bsl-menu-card').forEach(function (card) {
        card.addEventListener('touchstart', function () {
            card.classList.add('is-pressed');
        }, { passive: true });
        card.addEventListener('touchend', function () {
            card.classList.remove('is-pressed');
        }, { passive: true });
    });

});