# Nuphp Framework MVC and NoMVC

Bootstrap 5 dan PHP untuk membuat website dengan cepat dan mudah

Designed with  for developers

## Mulailah membangun website dengan mudah dan cepat!

Gunkan Git Clone [git](https://github.com/nufatID/nuPHP-Framework.git) to install NuPHP Framework.

```bash
git clone https://github.com/nufatID/nuPHP-Framework.git
```
# USING MVC
## Usage Model -> model.php

```php
<?php
class UserModel extends Database
{
    protected $table = 'pegawai';
}
```

## Usage View -> view.php

```php
<?php $this->extend("layout/layout.php") ?>


<div class="container-fluid mt-2">

    <a href="<?= getBaseUrl(); ?>/absensi/insert" class="btn btn-primary">tambah</a>
    <div class="row m-2">
        <div class="col-sm-4 mx-auto text-center">
            <?= $data->pagelist(); ?></div>

    </div>
    <div class="container-fluid">
        <?= $data->getTablePage(); ?>
    </div>

    <div class="row m-2">
        <div class="col-sm-4 mx-auto text-center">
            <?= $data->pagelist(); ?></div>

    </div>
</div>
```
## Usage Controller -> Controler.php

```php
<?php

class Absensi extends Controller
{

    public function index()
    {
        $model = $this->model('UserModel');
        $model->set_pagination(5);
        $model->jarak = 1;
        $adrow = [
            "Detail" => "<a href='" . getBaseUrl() . "/absensi/detail/{{id}}' class='btn btn-primary' id='{{id}}'>Detail</a>",
            "Edit" => "<a href='" . getBaseUrl() . "/absensi/edit/{{id}}' type='button' class='btn btn-warning'>Edit</a>",
            "Delete" => "<a href='" . getBaseUrl() . "/absensi/hapus/{{id}}' onclick='return confirm('Anda Yakin??');' type='button' class='btn btn-danger'>Delete</a>"
        ];
        $model->Add_row($adrow);
        $data['data'] = $model;
        View('absensi/index', $data);
    }
}
```
# USING NON MVC
## Usage Model -> model.php

```php
<?php $this->extend('layout/layout.php'); ?>


<div class="page-wrapper">

    <!-- ******Header****** -->
    <header class="header text-center">
        <div class="container">
            <div class="branding">
                <h1 class="logo">
                    <span aria-hidden="true" class="fas fa-exclamation-circle" style="font-size: xxx-large;"></span>
                    <p>
                        <span class="text-highlight">Error </span>
                    </p>
                    <p><span class="text-bold">404</span>
                    </p>
                </h1>
            </div>
            <!--//branding-->
            <div class="tagline">
                <h1 class="logo text-warning">MAAF ...!! <br>HALAMAN TIDAK DITEMUKAN</h1>

            </div>



        </div>
        <!--//container-->
    </header>
    <!--//header-->

</div>
```
## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## Kunjungi
[https://webdev.nufat.id/](https://webdev.nufat.id/)

## License
[MIT](https://choosealicense.com/licenses/mit/)
