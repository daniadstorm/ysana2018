<?php

class carritoModel extends Model {
    
    public $dir = 'imgart/';
    public $max_imagenes_articulo = 5;
    
    function add_articulo_carrito($id_usuario, $id_articulo) {
        $q  = ' INSERT INTO '.$this->pre.'carrito_compra (id_usuario, id_articulo) VALUES ';
        $q .= ' ("'.$id_usuario.'", "'.$id_articulo.'")';
        return $this->execute_query($q);
    }

    function get_carrito($id_usuario, $lang) {
        $q  = ' SELECT cc.id_usuario,cc.id_articulo,al.urlseo,al.nombre FROM '.$this->pre.'carrito_compra as cc INNER JOIN ';
        $q .= ' '.$this->pre.'articulos_lang as al ON cc.id_articulo=al.id_articulo INNER JOIN ';
        $q .= ' '.$this->pre.'lang as l ON al.id_lang=l.id_lang ';
        $q .= ' WHERE al.visible=1 AND cc.id_usuario='.$id_usuario.' and l.code="'.$lang.'" ';
        echo $q;
        //return $this->execute_query($q);
    }

    function delete_articulo_usuario_carrito($id_usuario) {
        $q  = ' SELECT a.* FROM '.$this->pre.'carrito_compra as cc INNER JOIN';
        return $this->execute_query($q);
    }

}

?>