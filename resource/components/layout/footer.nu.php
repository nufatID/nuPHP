</div>
<div class="container-fluid bg-dark">
    <footer class="d-flex flex-wrap justify-content-between py-3 text-end">

        <div class="col-md-4 d-flex align-items-center">


        </div>

        <div class="col-md-4 d-flex align-items-center justify-content-end">

            <a href="<?= getBaseUrl(); ?>" class="col-md-4 d-flex align-items-center justify-content-center mb-1 mb-md-0 me-md-auto link-dark text-decoration-none">
                <img src="<?= getBaseUrl(); ?>assets/img/brand/white.png" class="navbar-brand-img" height="45">

            </a>
        </div>

    </footer>
</div>



<!--   Core   -->
<script src="<?= getBaseUrl(); ?>assets/js/plugins/jquery/dist/jquery.min.js"></script>
<script src="<?= getBaseUrl(); ?>assets/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

<?php if (!isMobile()) { ?>
<script src="<?= getBaseUrl(); ?>assets/js/main/menuside.js"></script>
<?php } ?>
<?= $this['scriptsfooter'] ?>
</body>

</html>