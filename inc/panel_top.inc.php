<?php
$arr_idioma = array(
    'spa' => 'SPA',
    'eng' => 'ENG'
);
$urlYsana=false;
if($_SERVER["REQUEST_URI"]=="/ysana/club_ysana/"){
    $urlYsana=true;
}

?>
<header id="panelTop" class="w-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-6">
                <div class="d-none d-sm-block">
                    <p class="m-0 text-light bienvenido">
                        <?php echo $lng['panel_top'][0]; ?>
                    </p>
                </div>
            </div>
            <div class="col-12 col-sm-6">
                <div class="d-none d-sm-block">
                    <div class="botones">
                        <div class="d-flex justify-content-end">
                            <?php if(!isset($_SESSION['id_usuario'])){ ?>
                            <a href="<?php echo $ruta_inicio;?>login<?php echo ($urlYsana) ? '?cy':''; ?>" class="bienvenido">
                                <?php echo $lng['panel_top'][1]; ?>
                            </a>
                            <span class="vl"></span>
                            <a href="<?php echo $ruta_inicio; echo ($urlYsana) ? 'club_ysana/registro':'registro'; ?>" class="bienvenido">
                                <?php echo $lng['panel_top'][2]; ?>
                            </a>
                            <span class="vl"></span>
                            <?php }else{ ?>
                                <a href="<?php echo $ruta_inicio;?>login?unlogin" class="bienvenido">Cerrar sesión</a>
                                <span class="vl"></span>
                            <?php } ?>
                            <form action="">
                                <?php echo $uM->get_combo_idioma($arr_idioma, 'idioma_seleccionado', $lang, '', true); ?>
                            </form>
                            <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        Próximamente
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-block d-sm-none">
                    <div class="botones">
                        <div class="d-flex justify-content-start">
                            <a href="<?php echo $ruta_inicio;?>login<?php echo ($urlYsana) ? '?cy':''; ?>">
                                <?php echo $lng['panel_top'][1]; ?>
                            </a>
                            <span class="vl"></span>
                            <a href="<?php echo $ruta_inicio; echo ($urlYsana) ? 'club_ysana/registro':'registro'; ?>">
                                <?php echo $lng['panel_top'][2]; ?>
                            </a>
                            <span class="vl"></span>
                            <form action="">
                                <?php echo $uM->get_combo_idioma($arr_idioma, 'idioma_seleccionado', $lang, '', true); ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>