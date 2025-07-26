
document.addEventListener('DOMContentLoaded', function () {

    // --- Elemen DOM ---
    const goalNameInput = document.getElementById('goalName');
    const previewNameSpan = document.getElementById('previewName');
    const previewIcon = document.getElementById('previewIcon');
    const iconBoxes = document.querySelectorAll('.icon-box');
    const colorSwatches = document.querySelectorAll('.color-swatch');

    // --- FUNGSI UNTUK MEMILIH IKON ---
    iconBoxes.forEach(box => {
        box.addEventListener('click', function () {
            // Hapus kelas 'active' dari semua ikon
            iconBoxes.forEach(b => b.classList.remove('active'));
            // Tambahkan kelas 'active' ke ikon yang diklik
            this.classList.add('active');
            // Ubah gambar di preview
            const newIconSrc = this.dataset.iconSrc;
            if (newIconSrc) {
                previewIcon.src = newIconSrc;
            }
        });
    });

    // --- FUNGSI UNTUK MEMILIH WARNA ---
    colorSwatches.forEach(swatch => {
        swatch.addEventListener('click', function () {
            // Hapus kelas 'active' dari semua warna
            colorSwatches.forEach(s => s.classList.remove('active'));
            // Tambahkan kelas 'active' ke warna yang diklik
            this.classList.add('active');
            // Ubah warna teks di preview menggunakan data-color
            const newColor = this.dataset.color;
            if (newColor) {
                previewNameSpan.style.color = newColor;
            }
        });
    });
});
