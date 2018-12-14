<?php

class carritoModel extends Model {
    
    function add_articulo_carrito($id_usuario, $id_articulo, $cantidad) {
        $q  = ' INSERT INTO '.$this->pre.'carrito_compra (id_usuario, id_articulo, cantidad) VALUES ';
        $q .= ' ("'.$id_usuario.'", "'.$id_articulo.'", "'.$cantidad.'")';
        return $this->execute_query($q);
    }

    function add_direccion_envio($id_usuario, $nombre, $apellidos, $direccion, $cp, $poblacion, $movil){
        $q  = ' INSERT INTO '.$this->pre.'carrito_datos (id_usuario, nombre, apellidos, direccion, codigo_postal, poblacion, movil) VALUES ';
        $q .= ' ("'.$id_usuario.'", "'.$nombre.'", "'.$apellidos.'", "'.$direccion.'", "'.$cp.'", "'.$poblacion.'", "'.$movil.'")';
        return $this->execute_query($q);
    }

    function reset_predeterminada_carrito($id_usuario){
        $q = ' UPDATE ' . $this->pre . 'carrito_datos SET ';
        $q .= ' predeterminada = 0 ';
        $q .= ' WHERE id_usuario = '.$id_usuario.' ';
        return $this->execute_query($q);
    }

    function update_predeterminada_carrito($id_usuario, $id_carrito){
        $q = ' UPDATE ' . $this->pre . 'carrito_datos SET ';
        $q .= ' predeterminada = 1 ';
        $q .= ' WHERE id_usuario = '.$id_usuario.' ';
        $q .= ' AND id_carrito = '.$id_carrito.' ';
        return $this->execute_query($q);
    }

    function get_direccion($id_usuario, $id_carrito){
        $q = ' SELECT * FROM ' . $this->pre . 'carrito_datos ';
        $q .= ' WHERE id_usuario = '.$id_usuario.' ';
        $q .= ' AND id_carrito = '.$id_carrito.' ';
        return $this->execute_query($q);
    }

    function get_direcciones($id_usuario, $pred=0){
        $q = ' SELECT * FROM ' . $this->pre . 'carrito_datos ';
        $q .= ' WHERE id_usuario = '.$id_usuario.' ';
        $q .= ' AND predeterminada = '.$pred.' ';
        return $this->execute_query($q);
    }

    function update_direccion_envio($id_usuario, $nombre, $apellidos, $direccion, $cp, $poblacion, $movil, $id_carrito){
        $q = ' UPDATE ' . $this->pre . 'carrito_datos SET ';
        $q .= ' nombre = "'.$nombre.'", ';
        $q .= ' apellidos = "'.$apellidos.'", ';
        $q .= ' direccion = "'.$direccion.'", ';
        $q .= ' codigo_postal = "'.$cp.'", ';
        $q .= ' poblacion = "'.$poblacion.'", ';
        $q .= ' movil = "'.$movil.'" ';
        $q .= ' WHERE id_usuario = '.$id_usuario.' ';
        $q .= ' AND id_carrito = '.$id_carrito.' ';
        return $this->execute_query($q);
    }

    function get_carrito($id_usuario, $lang) {
        $q  = ' SELECT cc.id_articulo,a.precio,a.stock,al.urlseo,al.nombre,cc.cantidad,al.img_portada,CONCAT(al.img,".png") as img FROM '.$this->pre.'carrito_compra as cc INNER JOIN ';
        $q .= ' '.$this->pre.'articulos_lang as al ON cc.id_articulo=al.id_articulo INNER JOIN ';
        $q .= ' '.$this->pre.'articulos as a ON al.id_articulo=a.id_articulo INNER JOIN ';
        $q .= ' '.$this->pre.'lang as l ON al.id_lang=l.id_lang ';
        $q .= ' WHERE al.visible=1 AND cc.id_usuario='.$id_usuario.' and l.code="'.$lang.'" ';
        return $this->execute_query($q);
    }

    function get_unidades_articulo_usuario($id_usuario, $id_articulo){
        $q = ' SELECT cantidad as total FROM ' . $this->pre . 'carrito_compra ';
        $q .= ' WHERE id_usuario = '.$id_usuario.' ';
        $q .= ' AND id_articulo = '.$id_articulo.' ';
        return $this->execute_query($q);
    }

    function restarArticulo($id_usuario, $id_articulo){
        $q = ' UPDATE ' . $this->pre . 'carrito_compra SET ';
        $q .= ' cantidad=cantidad-1 ';
        $q .= ' WHERE id_usuario = '.$id_usuario.' ';
        $q .= ' AND id_articulo = '.$id_articulo.' ';
        return $this->execute_query($q);
    }

    function sumarArticulo($id_usuario, $id_articulo){
        $q = ' UPDATE ' . $this->pre . 'carrito_compra SET ';
        $q .= ' cantidad=cantidad+1 ';
        $q .= ' WHERE id_usuario = '.$id_usuario.' ';
        $q .= ' AND id_articulo = '.$id_articulo.' ';
        return $this->execute_query($q);
    }

    function delete_articulo_usuario_carrito($id_usuario, $id_articulo){
        $q = ' DELETE FROM ' . $this->pre . 'carrito_compra ';
        $q .= ' WHERE id_usuario = '.$id_usuario.' ';
        $q .= ' AND id_articulo = '.$id_articulo.' ';
        return $this->execute_query($q);
    }

    function delete_direccion($id_usuario, $id_carrito){
        $q = ' DELETE FROM ' . $this->pre . 'carrito_datos ';
        $q .= ' WHERE id_usuario = '.$id_usuario.' ';
        $q .= ' AND id_carrito = '.$id_carrito.' ';
        return $this->execute_query($q);
    }
}

?>