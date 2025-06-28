<?= $this->include('templates/header') ?>
<?= $this->include('templates/sidebar') ?>

        <div class="container-fluid">
            <h3>Pengaturan Situs</h3>
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success"> <?= session()->getFlashdata('success') ?> </div>
            <?php elseif (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"> <?= session()->getFlashdata('error') ?> </div>
            <?php endif; ?>

            <div class="card p-3">
                <form action="<?= base_url('pengaturan/simpan') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label for="siteName" class="form-label">Nama Situs</label>
                        <input type="text" class="form-control" id="siteName" name="site_name" value="<?= esc($pengaturan['site_name'] ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="siteSlogan" class="form-label">Slogan Situs</label>
                        <textarea id="siteSlogan" class="form-control" name="site_slogan" rows="4"> <?= esc($pengaturan['site_slogan'] ?? '') ?> </textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="reset" class="btn btn-danger">Batal</button>
                </form>
            </div>
        </div>

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
   <?= $this->include('templates/footer') ?>