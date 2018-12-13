<?php
include_once('../config/config.inc.php'); //cargando archivo de configuracion

$uM = load_model('usuario'); //uM userModel
$hM = load_model('html');
$iM = load_model('inputs');

$id_usuario = (isset($_SESSION['id_usuario'])) ? $_SESSION['id_usuario'] : '';

$id_producto = (isset($_GET['id'])) ? $_GET['id'] : '';

//GET___________________________________________________________________________
if($id_producto!=''){

}
//GET___________________________________________________________________________

//POST__________________________________________________________________________

//POST__________________________________________________________________________

//CONTROL__________________________________________________________________________

//CONTROL__________________________________________________________________________

include_once('../inc/cabecera.inc.php'); //cargando cabecera
?>
<script type="text/javascript">

</script>

<body>
    <?php include_once('../inc/panel_top_clubysana.inc.php'); ?>
    <?php include_once('../inc/navbar_inicio.inc.php'); ?>
    <div class="container-fluid px-0">
        <ul id="nav-clubysana" class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link" id="areapersonal-tab" href="<?php echo $ruta_inicio; ?>club_ysana/areapersonal">Tu Area Personal</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="experiencia-tab" href="<?php echo $ruta_inicio; ?>club_ysana/areapersonal">Tu Experiencia</a>
            </li>
        </ul>
    </div>
    <div id="recomendaciones" class="container-fluid my-5">
        <h1 class="titulo-consejo">Recomendaciones generales sobre hábitos de sueño saludables</h1>
        <div class="carousel-personalizado">
            <div class="consejos">
                <div class="consejo consejo-1">
                    <div class="consejo-responsive">
                        <div class="texto">
                            <h1>1</h1>
                            <h2>Evitar dormir siesta</h2>
                            <p>En caso de dificultades en la conciliación del sueño o de presentar sueño fraccionado, o bien limitarla a 20-30 minutos tras la comida.</p>
                        </div>
                        <div class="imagen">
                            <a href="https://survey.zohopublic.eu/zs/fbB8dr">
                                <img src="<?php echo $ruta_inicio; ?>img/club-ysana-picto-sueño-1.png" alt="">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="consejo consejo-2">
                    <div class="consejo-responsive">
                        <div class="texto">
                            <h1>2</h1>
                            <h2>Horas de sueño</h2>
                            <p>Dormir la cantidad de horas suficientes. Esta cantidad variará según la edad: recién nacidos (de 0-3 meses) 14-17 h; lactantes (4-11 meses), 12-15 h; niños pequeños (1-2 años), 11-14 h; niños en edad preescolar (3-5 años), 10-13 h; niños en edad escolar (6-13 años), 9-11 h; adolescentes, 8-10 h; adultos (18-64 años), 7-9 h; y adultez tardía (> 65 años), 7-8 h. </p>
                        </div>
                        <div class="imagen">
                            <a href="https://survey.zohopublic.eu/zs/fbB8dr">
                                <img src="<?php echo $ruta_inicio; ?>img/club-ysana-picto-sueño-2.png" alt="">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="consejo consejo-3">
                    <div class="consejo-responsive">
                        <div class="texto">
                            <h1>3</h1>
                            <h2>Regularidad de sueño</h2>
                            <p>Buscar una regularidad en los horarios, intentando que la diferencia entre la hora de acostarse y la hora de despertarse, entre los días laborables y los días festivos, no exceda las dos horas de diferencia.</p>
                        </div>
                        <div class="imagen">
                            <a href="https://survey.zohopublic.eu/zs/fbB8dr">
                                <img src="<?php echo $ruta_inicio; ?>img/club-ysana-picto-sueño-3.png" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="botones">
                <button id="btn1" class="btnSlider bg-rosa"></button>
                <button id="btn2" class="btnSlider"></button>
                <button id="btn3" class="btnSlider"></button>
            </div>
            <script>
                $(document).ready(function(){
                    $('.btnSlider').click(function(){
                        $('button').removeClass("bg-rosa");
                        $(this).addClass("bg-rosa");
                    });
                    $("#btn1").click(function(){
                        $('.consejo').css("transform","translateX(0%)");
                    });
                    $("#btn2").click(function(){
                        $('.consejo').css("transform","translateX(-100%)");
                    });
                    $("#btn3").click(function(){
                        $('.consejo').css("transform","translateX(-200%)");
                    });
                });
            </script>
        </div>
        <h1 class="titulo-consejo">Recomendaciones sobre hábitos de sueño saludables</h1>
        <div class="texto-general">
            <p class="blq">El sueño es un proceso biológico de gran complejidad que contribuye a un funcionamiento adecuado de nuestro sistema inmunológico, vascular y endocrino, entre otros, fomentando el procesamiento de la información, la fijación de las memorias y la recuperación física.<br><br>Los patrones de sueño pueden variar en función de los ritmos y necesidades fisiológicas de cada persona, modificándose la cantidad necesaria de sueño según la edad de la persona, desde las 14-17 horas necesarias para un recién nacido, a las 8-10 horas necesarias para un adolescente. A partir de los 18 años, y durante toda la etapa adulta, la media de sueño necesaria sería de 7 a 9 horas, bajando a una media de 7-8 horas en personas mayores de 65 años, y considerándose perjudicial tanto medias inferiores como superiores a las indicadas.</p>
            <p class="blq">Cuando nuestro sueño es insuficiente, ya sea en cantidad o en calidad, esto puede tener repercusiones en la salud. Pueden darse alteraciones cognitivas que afecten a nuestro rendimiento mental, como una reducción en la velocidad de reacción y procesamiento de la información, en la consolidación de memorias, en tareas de atención complejas y en la capacidad para tomar decisiones; alteraciones del estado de ánimo, relacionadas con sintomatología ansiosa y depresiva, mayor irritabilidad y mayores dificultades en las relaciones personales; alteraciones de tipo vascular, como aumento de la presión arterial, fomento de enfermedades del corazón u ocurrencia de accidentes cerebrovasculares; o puede fomentar otras condiciones médicas relacionadas con la función hepática, obesidad o diabetes tipo 2. Es por ello que resulta de gran importancia el adoptar unos hábitos de sueño saludables que nos permitan conseguir una adecuada cantidad y calidad del sueño.</p>
        </div>
    </div>
    <?php include_once('../inc/footer.inc.php'); ?>
</body>

</html>