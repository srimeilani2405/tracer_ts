<nav class="p-3" style="width:250px; height:100vh; position:fixed;">
    <style>
        nav {
            background: linear-gradient(180deg, #d6e0f0, #c4d0e3);
            color: #2c3e50;
            width: 250px;
            height: 100vh;
            padding: 20px;
            position: fixed;
            top: 0;
            left: 0;
            overflow-y: auto;
            font-family: 'Segoe UI', sans-serif;
            box-shadow: 4px 0 10px rgba(0, 0, 0, 0.08);
        }

        .container-fluid {
            margin-left: 250px;
            padding: 20px;
        }

        nav h4 {
            text-align: center;
            font-weight: bold;
            margin-bottom: 20px;
            color: #1f2f45;
            font-size: 22px;
            letter-spacing: 1px;
        }

        nav ul {
            list-style: none;
            padding: 0;
        }

        nav ul li {
            margin: 10px 0;
        }

        nav ul li a {
            text-decoration: none;
            color: #2f3d52;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        nav ul li a:hover {
            background: linear-gradient(90deg, #a6b6d7, #dce2f0);
            padding-left: 15px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        }

        .submenu {
            list-style: none;
            padding-left: 20px;
            display: none;
        }

        .submenu.open {
            display: block;
        }

        .toggle-submenu {
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .arrow {
            transition: transform 0.3s ease;
            font-size: 12px;
        }

        .arrow.rotate {
            transform: rotate(90deg);
        }

        nav::-webkit-scrollbar {
            width: 6px;
        }

        nav::-webkit-scrollbar-thumb {
            background-color: #a9b6c8;
            border-radius: 3px;
        }
    </style>

    <h4>Tracer Study</h4>
    <ul class="navigation">
        <li><a href="<?= base_url('/users') ?>"><i class="bi bi-people"></i> Pengguna</a></li>
        <li><a href="<?= base_url('/Kuesioner') ?>"><i class="bi bi-ui-checks"></i> Kuesioner</a></li>
        <li><a href="<?= base_url('/welcomepage') ?>"><i class="bi bi-house-door"></i> Welcome Page</a></li>
        <li>
            <a href="#" class="toggle-submenu" id="toggleOrganisasi">
                <span><i class="bi bi-building"></i> Organisasi</span>
                <span class="arrow">❯</span>
            </a>
            <ul class="submenu" id="submenuOrganisasi">
                <li><a href="<?= base_url('/organisasi/units') ?>"><i class="bi bi-diagram-3"></i> Satuan Organisasi</a></li>
                <li><a href="<?= base_url('/organisasi/types') ?>"><i class="bi bi-tags"></i> Tipe Organisasi</a></li>
            </ul>
        </li>
        <li><a href="<?= base_url('/pengaturan') ?>"><i class="bi bi-gear"></i> Pengaturan Situs</a></li>
        <li><a href="<?= base_url('/contacts') ?>"><i class="bi bi-telephone"></i> Kontak</a></li>
        <li><a href="<?= base_url('/pages') ?>"><i class="bi bi-info-circle"></i> Tentang</a></li>
        <li><hr class="dropdown-divider"></li>
    </ul>
</nav>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const toggleOrganisasi = document.getElementById("toggleOrganisasi");
        const submenuOrganisasi = document.getElementById("submenuOrganisasi");
        const arrow = toggleOrganisasi.querySelector(".arrow");

        if (localStorage.getItem("submenuOrganisasi") === "open") {
            submenuOrganisasi.classList.add("open");
            arrow.classList.add("rotate");
        }

        toggleOrganisasi.addEventListener("click", function(e) {
            e.preventDefault();
            const isOpen = submenuOrganisasi.classList.contains("open");
            submenuOrganisasi.classList.toggle("open");
            arrow.classList.toggle("rotate");
            localStorage.setItem("submenuOrganisasi", isOpen ? "closed" : "open");
        });
    });
</script>
