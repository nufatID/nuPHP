@extends("layout.layout")

<div class="header pb-5 pt-1 pt-lg-8 d-flex align-items-center" style="min-height: 300px; background-size: cover; background-position: center top;">
    <span class="mask bg-gradient-default opacity-7"></span>
    <div class="container-fluid d-flex align-items-center mt--3">

    </div>
</div>

<div class="container-fluid mt--9 pb-4">
    <div class="row">
        <div class="col-lg-7 col-md-10">
            <h1 class="display-2 text-white">Pengaturan Akun</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <!-- Form untuk mengubah profil -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Perbarui Profil</h5>
                </div>
                <div class="card-body">
                    <?php if (isset($_SESSION['error_update_email'])) : ?>
                        <div class="alert alert-danger"><?php echo $_SESSION['error_update_email'];
                                                        unset($_SESSION['error_update_email']); ?></div>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['status_update_email'])) : ?>
                        <div class="alert alert-success"><?php echo $_SESSION['status_update_email'];
                                                            unset($_SESSION['status_update_email']); ?></div>
                    <?php endif; ?>
                    <form action="<?= get_url('account/setting/updateEmail') ?>" method="POST">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="new_email" required value="<?= $user->email; ?>">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
            </div>

            <!-- Form untuk mengganti password -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Ganti Password</h5>
                </div>
                <div class="card-body">
                    <?php if (isset($_SESSION['error_update_password'])) : ?>
                        <div class="alert alert-danger"><?php echo $_SESSION['error_update_password'];
                                                        unset($_SESSION['error_update_password']); ?></div>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['status_update_password'])) : ?>
                        <div class="alert alert-success"><?php echo $_SESSION['status_update_password'];
                                                            unset($_SESSION['status_update_password']); ?></div>
                    <?php endif; ?>
                    <form action="<?= get_url('account/setting/updatePassword') ?>" method="POST">
                        <input type="hidden" name="action" value="update_password">
                        <div class="form-group">
                            <label for="current_password">Password Lama</label>
                            <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Masukkan password lama" required>
                        </div>
                        <div class="form-group">
                            <label for="new_password">Password Baru</label>
                            <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Masukkan password baru" required>
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Konfirmasi Password Baru</label>
                            <input type="password" class="form-control" id="confirm_password" name="new_password_confirmation" placeholder="Konfirmasi password baru" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Ubah Password</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <!-- Form untuk pengaturan lainnya -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Perbarui Profil</h5>
                </div>
                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control" id="name" placeholder="Masukkan nama">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Masukkan email">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>