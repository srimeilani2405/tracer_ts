<script>
    document.addEventListener("DOMContentLoaded", function() {
        const toggleOrganisasi = document.getElementById("toggleOrganisasi");
        const submenuOrganisasi = document.getElementById("submenuOrganisasi");
        const arrow = toggleOrganisasi.querySelector(".arrow");

        if (localStorage.getItem("submenuOrganisasi") === "open") {
            submenuOrganisasi.style.display = "block";
            arrow.classList.add("rotate");
        }

        toggleOrganisasi.addEventListener("click", function(e) {
            e.preventDefault();
            if (submenuOrganisasi.style.display === "block") {
                submenuOrganisasi.style.display = "none";
                arrow.classList.remove("rotate");
                localStorage.setItem("submenuOrganisasi", "closed");
            } else {
                submenuOrganisasi.style.display = "block";
                arrow.classList.add("rotate");
                localStorage.setItem("submenuOrganisasi", "open");
            }
        });
    });
</script>

</body>
</html>