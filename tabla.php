<?php
    include 'config.php';

       
            

    function tr($contenido, $clase){
        if ($clase != null || $clase != ""){
            return "<tr class='$clase'> $contenido </tr>";
        } else{
            return "<tr> $contenido </tr>";           
        }
    }

    function th($contenido, $clase){
        if ($clase != null || $clase != ""){
            return "<th class='$clase'> $contenido </th>";
        } else{
            return "<th> $contenido </th>";           
        }
    }

    function td($contenido, $clase = ""){
        if ($clase != null || $clase != ""){
            return "<td class='$clase'> $contenido </td>";
        } else{
            return "<td> $contenido </td>";           
        }
    }

    function href($texto, $url, $clase){
        if($clase == "eliminar"){
            return "<a onclick=\"javascript: return confirm('¿Desea eliminar el registro?');\" href=$url class =$clase > $texto </a>";
        } else if($clase !=null){
            return "<a href=$url class=$clase > $texto </a>";
        } else{
            return "<a href=$url> $texto </a>";
        }
    }

    function img($imagen, $texto, $clase = "imagen"){
        return "<img src=$imagen alt=$texto class=$clase>";
    }

    function desplegarProductos($user, $xdb_connection){

        $db_tabla = "productos";

        $html = "<!DOCTYPE html>


        <html lang='en'>
                
            <head>
                
                <title>Trabajo practico especial web dos - Giaconia</title>
                <link rel = 'stylesheet' type = 'text/css' href = 'style.css'>
                <meta charset = 'UTF-8'>
                        
            </head>
                    
            <body>
            <div class='contenedor-productos'>        
            <table class = 'productos'>";
                    
        $html .= tr (th ("Nombre", null) . th ("Descripcion", null) . th ("Precio", null) . th("Categoria", null), null);
                
         

        $resultado = mysqli_query($xdb_connection, "SELECT nombre, descripcion, precio, (SELECT nombre
                                                                                                FROM categorias
                                                                                                WHERE id_categoria = categoria) AS categoria
                                                    FROM $db_tabla 
                                                    ORDER BY 'id'");

            
        if (mysqli_num_rows($resultado) > 0){
                    
            while ($row = mysqli_fetch_assoc($resultado)){
                $aFila = array();
                    
    

                $mostrarNombre = $row["nombre"];
                $aFila[] = td($mostrarNombre, null);

                $descripcion = $row["descripcion"];
                $aFila[] = td($descripcion, null);

                $precio = $row["precio"];
                $aFila[] = td($precio, null);

                $categoria = $row["categoria"];
                $aFila[] = td($categoria, null);
                    
                //$aFila[] = td(href(img("edit.png", "Editar"), 'editar.php?codigo=' . $row['id'], 'editar'), 'edicion');
                //$aFila[] = td(href(img("delete.png", "Eliminar"), 'eliminar.php?codigo=' . $row['id'], "eliminar"), 'delete');
                    
                $html .= tr(implode("", $aFila),null);
            }
                  
                   
        }
        $html .="</table></div></body></html>";

        return $html;
    }

         
    
                
                
?>

