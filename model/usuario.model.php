<?php

class usuarioModel extends Model {
    
    private $tipo_usuario = USER;
    private $tipo_admin = ADMIN;
    

    function __construct() {
    }

    function add_post_zoho($url, $params){
        //url-ify datos
        $params_string = '';
        foreach($params as $key=>$value){
            $params_string .= $key.'='.$value.'&';
        }
        rtrim($params_string, '&');
        //Abrir conexion
        $ch = curl_init();
        //Añadir url, numero post params, datos
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POST, count($params));
        //curl_setopt($ch,CURLOPT_POSTFIELDS, $params_string);
        //curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        //cerrar conexión
        curl_close($ch);
    }

    function verificarCaptcha($secret, $response){
        $xd = false;
        // abrimos la sesión cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"https://www.google.com/recaptcha/api/siteverify");
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "secret=".$secret."&response=".$response);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output1 = curl_exec ($ch);
        curl_close ($ch);
        $output = json_decode($output1, true);
        return ($output['success']) ? true : false;
    }

    function add_usuario($nombre_usuario, $apellidos_usuario, $email_usuario, $genero, $password_usuario) {
        $q = ' INSERT INTO '.$this->pre.'usuarios (nombre_usuario, apellidos_usuario, email_usuario, genero, password_usuario) ';
        $q .= ' VALUES ("'.$nombre_usuario.'","'.$apellidos_usuario.'","'.$email_usuario.'","'.$genero.'","'.$password_usuario.'")';
        return $this->execute_query($q);
    }

    function update_usuario($id_usuario, $nombre_usuario, $apellidos_usuario, $genero){
        $q = ' UPDATE '.$this->pre.'usuarios SET ';
        $q .= ' nombre_usuario="'.$nombre_usuario.'", ';
        $q .= ' apellidos_usuario="'.$apellidos_usuario.'", ';
        $q .= ' genero="'.$genero.'" ';
        $q .= ' WHERE id_usuario='.$id_usuario.'';
        return $this->execute_query($q);
    }

    function update_password($password_usuario, $id_usuario, $randomkey){
        $q  = ' UPDATE '.$this->pre.'usuarios SET ';
        $q .= ' password_usuario="'.$password_usuario.'", ';
        $q .= ' randomkey="'.$randomkey.'" ';
        $q .= ' WHERE id_usuario='.$id_usuario.'';
        return $this->execute_query($q);
    }

    function set_estado_pedido_by_factura($id_pedido, $estado){
        $q  = ' UPDATE '.$this->pre.'pedidos SET ';
        $q .= ' completado="'.$estado.'" ';
        $q .= ' WHERE id_pedido='.$id_pedido.'';
        return $this->execute_query($q);
    }

    function add_randomkey_usuario($email_usuario, $length){
        $characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $charsLength = strlen($characters) -1;
        $randomkey = "";
        for($i=0; $i<$length; $i++){
            $randNum = mt_rand(0, $charsLength);
            $randomkey .= $characters[$randNum];
        }
        /*------------------*/
        $q  = ' UPDATE '.$this->pre.'usuarios SET ';
        $q .=   ' randomkey="'.$randomkey.'" ';
        $q .= ' WHERE email_usuario="'.$email_usuario.'" ';
        if($this->execute_query($q)) return $randomkey;
        else return false;
       /*  return $this->execute_query($q); */
    }

    function get_existe_correo($email_usuario) {
        $q = ' SELECT u.* FROM '.$this->pre.'usuarios u ';
        $q .= ' WHERE u.email_usuario="'.$email_usuario.'"';
        $r = $this->execute_query($q);
        if ($r) return $r->num_rows;
            else return false;
    }

    function get_comprobar_randomkey($randomkey){
        $q = ' SELECT u.* FROM '.$this->pre.'usuarios u ';
        $q .= ' WHERE u.randomkey="'.$randomkey.'"';
        return $this->execute_query($q);
        /* $r = $this->execute_query($q);
        if ($r) return $r->num_rows;
            else return false; */
    }

    function get_usuarios($pag, $regs_x_pag, $arr_filtro_ps=false) {
        $q  = ' SELECT u.* FROM '.$this->pre.'usuarios u ';
        $q .= ' WHERE u.deleted = 0 and u.id_tipo_usuario=10 ';
        if($arr_filtro_ps=="si"){
            $q .= ' and ps_completo=1 ';
        }else if($arr_filtro_ps=="no"){
            $q .= ' and ps_completo=0 ';
        }
        $q .= ' LIMIT '.$pag*$regs_x_pag.','.$regs_x_pag.' ';
        return $this->execute_query($q);
    }

    function get_datos_usuario($id_usuario){
        $q  = ' SELECT u.* FROM '.$this->pre.'usuarios u ';
        $q .= ' WHERE u.id_usuario='.$id_usuario.'';
        return $this->execute_query($q);
    }

    function get_usuarios_total_regs($arr_filtro_ps=false) {
        $q  = ' SELECT u.* FROM '.$this->pre.'usuarios u ';
        $q .= ' WHERE u.deleted = 0 and u.id_tipo_usuario=10 ';
        if($arr_filtro_ps=="si"){
            $q .= ' and ps_completo=1 ';
        }else if($arr_filtro_ps=="no"){
            $q .= ' and ps_completo=0 ';
        }
        $r = $this->execute_query($q);
        if ($r) return $r->num_rows;
            else return false;
    }
    
    function get_user_login($nombre_usuario, $contrasenya_usuario) {
        $q  = ' SELECT u.* FROM '.$this->pre.'usuarios u ';
        $q .= ' WHERE u.email_usuario = "'.$nombre_usuario.'" ';
        $q .= ' AND u.password_usuario = "'.$contrasenya_usuario.'" ';
        $q .= ' AND u.deleted = 0 ';
        return $this->execute_query($q);
    }

    function get_input_array($arr,$id, $selected=false, $class=false, $onChange=false) {
        $o  = '';
        $o .= '<div>';
        foreach ($arr as $key => $val) $o .= '<input type="radio" '.(($selected == $key) ? ' checked="checked" ' : '').' value="'.$key.'" name="'.$id.'[]">'.$val.'</option>';
        $o .= '</div>';
        return $o;
    }

    function get_existe_articulo($id_articulo) {
        $q  = ' SELECT * FROM '.$this->pre.'img_articulos';
        $q .= ' WHERE id_articulo = '.$id_articulo;
        $r = $this->execute_query($q);
        if ($r) return $r->num_rows;
            else return false;
    }

    function get_combo_idioma($arr, $id, $selected=false, $class=false, $onChange=false) {
        $o  = '';
        $o .= '<select id="'.$id.'" name="'.$id.'" class="" ';
        if ($class) $o .= ' class ="'.$class.'" ';
        (!$onChange) ? $o .= '>' : $o .= 'onchange="this.form.submit()">';
        //$o .= '>';
        foreach ($arr as $key => $val) $o .= '<option '.(($selected == $key) ? ' selected="selected" ' : '').' value="'.$key.'">'.$val.'</option>';
        $o .= '</select>';
        return $o;
    }

    function get_combo_array($arr, $id, $selected=false, $class=false, $onChange=false) {
        $o  = '';
        $o .= '<select id="'.$id.'" name="'.$id.'" class="form-control" ';
        if ($class) $o .= ' class ="'.$class.'" ';
        (!$onChange) ? $o .= '>' : $o .= 'onchange="this.form.submit()">';
        //$o .= '>';
        foreach ($arr as $key => $val) $o .= '<option '.(($selected == $key) ? ' selected="selected" ' : '').' value="'.$key.'">'.$val.'</option>';
        $o .= '</select>';
        return $o;
    }
    
    function get_combo_tipo_estilo($id, $selected=false, $class=false, $default=false) {
        $arr_estilos = array(
            'Holgada' => 'Holgada',
            'Recta' => 'Recta',
            'Entallada' => 'Entallada'
        );
        return $this->get_combo_array($arr_estilos, $id, $selected, $class, $default);
    }

    function get_combo_hijos($id, $selected=false, $class=false, $default=false){
        $arr_pregunta = array(
            'Si' => 'Si',
            'No' => 'No'
        );
        return $this->get_combo_array($arr_pregunta, $id, $selected, $class, $default);
    }

    function get_combo_textura_estilo($id, $selected=false, $class=false, $default=false) {
        $arr_estilos = array(
            'Estampados' => 'Estampados',
            'Colores lisos' => 'Colores lisos'
        );
        return $this->get_combo_array($arr_estilos, $id, $selected, $class, $default);
    }

    
    function get_combo_usuarios($id, $selected=false, $class=false, $onChange=false, $default=false, $filtro_tiendavf=false) {
        $o = ''; //output
        $q  = ' SELECT u.*, tvf.nombre_tiendavf FROM '.$this->pre.'usuarios u ';
        $q .= ' LEFT JOIN '.$this->pre.'tiendasvf tvf ON u.id_tiendavf = tvf.id_tiendavf ';
        $q .= ' WHERE u.id_tipo_usuario = '.$this->tipo_usuario.' ';
        if ($filtro_tiendavf > 0) $q .= ' AND u.id_tiendavf = '.$filtro_tiendavf.' ';
        $q .= ' AND u.deleted = 0 ';
        $q .= ' ORDER BY u.nombrecompleto_usuario ASC ';
        $r = $this->execute_query($q);
        if ($r) {
            $o .= '<select id="'.$id.'" name="'.$id.'" ';
            if ($class) $o .= ' class ="'.$class.'" ';
            if ($onChange) $o .= ' onchange="'.$onChange.'" ';
            $o .= '>';
            if ($default) $o .= '<option value="-1">-- Todos los usuarios --</option>';
            while($f = $r->fetch_assoc()) {
                $o .= '<option '.(($selected == $f['id_usuario']) ? ' selected="selected" ' : '').' value="'.$f['id_usuario'].'">'.
                    $f['nombrecompleto_usuario'].' ('.$f['nombre_tiendavf'].')'.
                    '</option>';
            }
            $o .= '</select>';
        } else return 'ERROR: '.$q;
        return $o;
    }
    
    function get_combo_tipos_usuario($id, $selected=false, $class=false, $onChange=false) {
        
        $o = ''; //output

        $arr_i = array($this->tipo_usuario => 'Comercial', $this->tipo_teamleader => 'Team Leader');
        
        $o .= '<select id="'.$id.'" name="'.$id.'" ';
        if ($class) $o .= ' class ="'.$class.'" ';
        if ($onChange) $o .= ' onchange="'.$onChange.'" ';
        $o .= '>';
        foreach ($arr_i as $key => $val) $o .= '<option '.(($selected == $key) ? ' selected="selected" ' : '').' value="'.$key.'">'.$val.'</option>';
        $o .= '</select>';

        return $o;
    }
    
    function get_lbl_tipo_usuario_by_id($id_tipo_usuario) {
        if (isset($this->lbl_tipos_usuario[$id_tipo_usuario])) return $this->lbl_tipos_usuario[$id_tipo_usuario];
            else return false;
    }

    function reset_user($id_usuario, $userpass, $randomkey){
        $q  = ' UPDATE '.$this->pre.'usuarios SET ';
        $q .=   ' contrasenya_usuario="'.$userpass.'", ';
        $q .=   ' randomkey="'.$randomkey.'" ';
        $q .= ' WHERE id_usuario="'.$id_usuario.'" ';
        return $this->execute_query($q);
    }

    
    /* function update_usuario($id_usuario, $nombre_usuario, $fecha_nacimiento, $nombrecompleto_usuario, $email_usuario, $contrasenya_usuario, $telf_usuario, $nie_usuario) {
        
        $q  = ' UPDATE '.$this->pre.'usuarios SET ';
        $q .=   ' nombre_usuario = "'.$nombre_usuario.'", ';
        $q .=   ' nombrecompleto_usuario = "'.$nombrecompleto_usuario.'", ';
        $q .=   ' fecha_nacimiento = "'.$fecha_nacimiento.'", ';
        $q .=   ' email_usuario = "'.$email_usuario.'", ';
        $q .=   ' contrasenya_usuario = "'.$contrasenya_usuario.'", ';
        $q .=   ' telf_usuario = "'.$telf_usuario.'", ';
        $q .=   ' nie_usuario = "'.$nie_usuario.'"';
        $q .= ' WHERE id_usuario='.$id_usuario.' ';
        return $this->execute_query($q);
    } */

    function delete_usuario($id_usuario) {
        $q  = ' UPDATE '.$this->pre.'usuarios SET ';
        $q .=   ' deleted = 1 ';
        $q .= ' WHERE id_usuario='.$id_usuario.' ';
        return $this->execute_query($q);
    }

    function clear_categorias_usuario($id_usuario){
        $q  = ' DELETE FROM '.$this->pre.'usuario_categorias ';
        $q .= ' WHERE id_usuario='.$id_usuario.' ';
        return $this->execute_query($q);
    }
    
    function login_usuario($nombre_usuario, $contrasenya_usuario) {
        $return = true;
        
        $r = $this->get_user_login($nombre_usuario, $contrasenya_usuario); //verificar que el usuario existe en BD
        if ($r) { 
            $found = false;
            while ($f = $r->fetch_assoc()) {
                $found = true;
                $_SESSION['id_usuario'] = $f['id_usuario'];
                $_SESSION['nombre_usuario'] = $f['nombre_usuario'];
                $_SESSION['apellidos_usuario'] = $f['apellidos_usuario'];
                $_SESSION['email_usuario'] = $f['email_usuario'];
                $_SESSION['id_tipo_usuario'] = $f['id_tipo_usuario'];
            }
            if (!$found) $return = '<div class="error_alert">Usuario o contraseña incorrecto</div>';
        } else $return = '<div class="error_alert">Usuario o contraseña incorrecto</div>';
        
        return $return;
    }
    
    function unlogin_usuario() {
        /* unset($_SESSION['id_usuario']);
        unset($_SESSION['nombre_usuario']);
        unset($_SESSION['apellidos_usuario']);
        unset($_SESSION['email_usuario']); */
        session_destroy();
    }
    
    //solo sirve para redirigir
    function control_sesion($ruta_inicio, $nivel, $redirect=true) {
        //si existe session, y el nivel de id_tipo_usuario menor o igual a nivel
        if (isset($_SESSION['id_tipo_usuario']) && $_SESSION['id_tipo_usuario'] <= $nivel) {
            // de momento no se da el caso
            return true;
        } else {
            if ($redirect == true) {
                header('Location: '.$ruta_inicio.'index.php');
                exit();
            }
            return false;
        }
    }

    function user_forgotpass_mail($email, $randomkey, $ruta_inicio){
        $op = '<!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
        </head>
        <body>
            <div>
                <h3>Ysana</h3>
            </div>
            <a href="'.$ruta_inicio.'forgot-password/?randomkey='.$randomkey.'" target="_blank"><button>Cambiar contraseña</button></a>
        </body>
        </html>';

        $asunto = 'Ysana - Recuperar password';
        $mail_admin = 'info@ysana.es';

        $headers   = array();
        $headers[] = "MIME-Version: 1.0";
        $headers[] = "Content-type: text/html; charset=utf-8";
        //TODO
        $headers[] = "From: <no.reply@ysana.es> Ysana ";
        $headers[] = "Reply-To: <no.reply@ysana.es> Ysana ";
        $headers[] = "X-Mailer: PHP/" . phpversion();

        $cabeceras = implode("\r\n", $headers);

        $result_mail_send = TRUE;
        $result_mail_send = mail($email, $asunto, $op, $cabeceras); //produccion
        //$result_mail_send = getbagservice_mail($email, $asunto, $op, $headers);

        return $result_mail_send;
    }

    /* function generateRandomString($length){ 
        $characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $charsLength = strlen($characters) -1;
        $string = "";
        for($i=0; $i<$length; $i++){
            $randNum = mt_rand(0, $charsLength);
            $string .= $characters[$randNum];
        }
        return $string;
    } */

}
?>