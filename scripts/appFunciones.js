function contarCaracteres(text, textarea){
    
    let numCaracteres = text.length;

    textarea.className = textarea.className.replace(" prohibido", "");

    if (numCaracteres == 255){

        textarea.value = text.slice(0, -1);
        prohibirTextArea(textarea);

    } else if (numCaracteres > 255){

        textarea.value = text.slice(0, 254);
        prohibirTextArea(textarea);
        
    } 

}

function prohibirTextArea(textarea){

    textarea.className = textarea.className + " prohibido";

}

function desplegarAviso($mensaje){


    let parrafo = document.createElement("p");
    parrafo.appendChild(document.createTextNode($mensaje));

    window.alert($mensaje);

}

function crearDiv(id = "", clase = ""){
    let div = document.createElement("div");

    if (id != ""){
        div.setAttribute("id", id);
    }
    
    if (clase != ""){
        div.className = clase;
    }
    

    return div;
}

function crearCelda(contenido, clase = "", boton = false, th = false){

    let celda;
    let texto = document.createTextNode(contenido);

    if (th){
        celda = document.createElement("th");
    } else{
        celda = document.createElement("td");
    }

    if (clase != "") {
        celda.className = clase;
    }

    if (boton) {
        celda.appendChild(contenido);
    } else {
        celda.appendChild(texto);
    }


    return celda;

}

function crearParrafo(contenido, clase = ""){

    let parrafo = document.createElement("p");

    if (clase != ""){
        parrafo.className = clase;
    }

    parrafo.appendChild(document.createTextNode(contenido));

    return parrafo;

}

function dibujarSelectOrden(xaOptions, xidSelect = ""){

    var select = document.createElement("select");

    if (xidSelect != ""){
        select.setAttribute("id", xidSelect);
    }
    
    for (let i = 0; i<xaOptions.length; i++){
        select.appendChild(dibujarOption(xaOptions[i].texto, xaOptions[i].campoOrden));
    }

    return select;
}

function dibujarOption(xtexto, xvalor){

    var option = document.createElement("option");
    option.appendChild(crearParrafo(xtexto));
    option.value = xvalor;

    return option;
}

function vacio(checkear){

    if (checkear == "" || checkear == null){
        return true;
    } else{
        return false;
    }
}

/*
let textarea = document.getElementById("areaConsulta");

if (textarea){
    textarea.addEventListener("keypress", function(){
        contarCaracteres(textarea.value, textarea)
    });
}*/
