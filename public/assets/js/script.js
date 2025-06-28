document.addEventListener('DOMContentLoaded', function () {
    const toggleSubmenus = document.querySelectorAll('.toggle-submenu');
    toggleSubmenus.forEach(toggle => {
        toggle.addEventListener('click', function () {
            const submenu = this.nextElementSibling;
            const arrow = this.querySelector('.arrow');

            submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';
            arrow.classList.toggle('rotate');
        });
    });
});