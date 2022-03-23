//////////////////////// Funciones para dibujar-editar-eliminar en el DOM ///////////////////////////////

function dibujarPaginador(paginas, cant_x_pag, viejoVolver = 0, tabla = false, comentarios = false, xidprod = ""){

    if (document.getElementById("cuerpo-paginador")){
        document.getElementById("cuerpo-paginador").remove();
    }

    var cuerpo_paginador = document.createElement("div");

    cuerpo_paginador.setAttribute("id", "cuerpo-paginador");
    
    for (let i = 1; i<=paginas; i++){

        var btnPagina = document.createElement("button");

        btnPagina.setAttribute("id", "paginador"+i);
        btnPagina.appendChild(document.createTextNode(i));
        btnPagina.className = "paginador";

        if (i == 1 && viejoVolver == 0){
            btnPagina.className += " actual";
        } else if(i == viejoVolver){
            btnPagina.className += " actual";
        }

        

        btnPagina.addEventListener('click', function(e){

            const anterior = document.querySelector(".actual");

            if (anterior){
                anterior.classList.remove("actual");
            }

            e.target.classList.add("actual");

            var aOrden;

            if (tabla){

                aOrden = document.getElementById("select_tabla").value;
                aOrden = aOrden.split("/"); 

                if (i > 1){
                    getData(cant_x_pag*i-cant_x_pag, false, 0, aOrden[0], aOrden[1]);
                } else{
                    getData(0, false, 0, aOrden[0], aOrden[1]);
                }
            } else if (comentarios){

                aOrden = document.getElementById("select-orden").value;
                aOrden = aOrden.split("/"); 

                if (i > 1){
                    getComentarios(xidprod, cant_x_pag*i-cant_x_pag, false, aOrden[0], aOrden[1]);
                } else{
                    getComentarios(xidprod, 0, false, aOrden[0], aOrden[1]);
                }
            }
            
        });
       
        cuerpo_paginador.appendChild(btnPagina);
    } 

    document.querySelector(".contenedor").appendChild(cuerpo_paginador);

}

function dibujarTabla(json, cant_x_pag){

    const base = document.querySelector(".contenedor");
    var tabla;

    if (!document.getElementById("select_tabla")){
        
        let aOpciones = [{"texto" : "Mayor precio",
                    "campoOrden" : "precio/DESC"
                        },
                        {"texto" : "Menor precio",
                        "campoOrden" : "precio/ASC"}
                    ];
    

        let selectTabla = dibujarSelectOrden(aOpciones, "select_tabla");

        selectTabla.addEventListener("change", function(e){
            
            var aOrdenTabla = selectTabla.value;
            aOrdenTabla = aOrdenTabla.split("/");

            document.querySelector(".actual").classList.remove("actual");

            document.getElementById("paginador1").className += " actual";

            getData(0, false, 0, aOrdenTabla[0], aOrdenTabla[1]);

        });

        base.appendChild(selectTabla);
    }

    

    if (document.getElementById("catalogo")){
        tabla = document.getElementById("catalogo");
    } else{
        tabla = document.createElement("table");
    }

    var tbody = document.createElement("tbody");

    tabla.setAttribute("id", "catalogo");

    if (base){

        tabla.innerHTML = "";

        var thead = document.createElement("thead");
        thead.appendChild(crearCelda("Nombre", "", false, true));
        thead.appendChild(crearCelda("Descripcion", "", false, true));
        thead.appendChild(crearCelda("Precio", "", false, true));
        thead.appendChild(crearCelda("Categoria", "", false, true));

        tabla.appendChild(thead);

        json.forEach(element => {

            //Por cada vuelta, genero una nueva fila para insertar a la tabla
            let fila = document.createElement("tr");         
            fila.appendChild(crearCelda(element.nombre));
            fila.appendChild(crearCelda(element.descripcion));
            fila.appendChild(crearCelda(element.precio));
            fila.appendChild(crearCelda(element.namecat));

            let btnVer = document.createElement("button");
            btnVer.appendChild(document.createTextNode("Ver"));
            btnVer.className = "ver-producto";
            btnVer.addEventListener("click", function () {


                verData(element.id, document.querySelector(".actual").innerHTML, cant_x_pag);
            
            });

            fila.appendChild(crearCelda(btnVer, "", true));
    
            if (element.admini == 1){

                let btnEliminar = document.createElement("button");
                btnEliminar.appendChild(document.createTextNode("Eliminar"));
                btnEliminar.className = "eliminar-producto";
                btnEliminar.addEventListener("click", function () {

                    deleteData(element.id, cant_x_pag);
                
                });

                fila.appendChild(crearCelda(btnEliminar, "", true));

                let btnEditar = document.createElement("button");
                btnEditar.appendChild(document.createTextNode("Editar"));
                btnEditar.className = "editar-producto";
                btnEditar.addEventListener("click", function(){
                    editData(element.id);
                });

                fila.appendChild(crearCelda(btnEditar, "", true));

            }
            
    
            tbody.appendChild(fila);
            

        });

        tbody.setAttribute("id", "tbody");
        tabla.appendChild(tbody);

        console.log(tabla);

        base.appendChild(tabla);

    } else{
        console.log("tabla inexistente");
    }

}


//Funcion que recibe un producto especifico y lo muestra

function dibujarProducto(xprod, xpag, xcant, xactual, xidprodu){

    const base = document.querySelector(".contenedor");

    base.innerHTML = "";

    var cuerpo_producto = crearDiv("producto"+xprod[0].id, "cuerpo-producto");
    var titulo = document.createElement("h2");
    var descripcion = crearParrafo("Descripcion: " + xprod[0].descripcion);
    var precio = crearParrafo("Precio: " + xprod[0].precio);
    var categoria = crearParrafo("Categoria: " + xprod[0].namecat);
    var btnVolver = document.createElement("button");

    titulo.appendChild(document.createTextNode(xprod[0].nombre));

    var aEtiquetas = [titulo, descripcion, precio, categoria];

    for (let i = 0; i<aEtiquetas.length; i++){
        cuerpo_producto.appendChild(aEtiquetas[i]);
    }

    let arrayOrden = [{ "texto" : "Mas reciente",
                        "campoOrden" : "fecha/DESC"},

                        { "texto" : "Mas antiguo",
                        "campoOrden" : "fecha/ASC"},

                        { "texto" : "Mayor puntaje",
                        "campoOrden" : "puntaje/DESC"},

                        { "texto" : "Menor puntaje",
                        "campoOrden" : "puntaje/ASC"}
                    ];

                    
    let newSelect = dibujarSelectOrden(arrayOrden, "select-orden");

    newSelect.addEventListener("change", function(e){
        
        var aOrden = newSelect.value;
        aOrden = aOrden.split("/");

        document.querySelector(".actual").classList.remove("actual");

        document.getElementById("paginador1").className += " actual";

        getComentarios(xprod[0].id, 0, false, aOrden[0], aOrden[1]);

    });

    cuerpo_producto.appendChild(newSelect);
    cuerpo_producto.appendChild(crearDiv("cuerpo_comentarios", "cuerpo-comentarios"));
    getComentarios(xprod[0].id);

    btnVolver.appendChild(document.createTextNode("Volver!"));
    btnVolver.addEventListener("click", function (e){

        document.getElementById("producto"+xprod[0].id).remove();
        getData(xcant*xpag-xcant, true, xactual);

    });

    cuerpo_producto.appendChild(btnVolver);

    base.appendChild(cuerpo_producto);

    

}

function dibujarComentarios(xcomen, xuser, xidprod, xcantxpag){

    var cuerpo_comentarios;

    if (document.getElementById("cuerpo_comentarios")){
        cuerpo_comentarios = document.getElementById("cuerpo_comentarios");
        cuerpo_comentarios.innerHTML = "";
    } 

    if (xcomen.length > 0){


        for (let j = 0; j<xcomen.length; j++){

            var comentario = crearDiv("", "comentario");
            var eliminarCom = crearDiv("", "contenedor-eliminar");

            if (xuser["rol"] == 1){
                var btnEliminarCom = document.createElement("button");

                btnEliminarCom.appendChild(document.createTextNode("X"));
                btnEliminarCom.className = "eliminar-comentario";
                btnEliminarCom.addEventListener("click", function () {

                    deleteComentario(xcomen[j].id, xidprod, xcantxpag);
                    
                });
                eliminarCom.appendChild(btnEliminarCom);

                comentario.appendChild(eliminarCom);
            }
            

            
            comentario.appendChild(crearParrafo("Usuario: " + xcomen[j].nomuser));
            
            comentario.appendChild(crearParrafo("Fecha: " + xcomen[j].fecha));
            comentario.appendChild(dibujarPuntaje(xcomen[j].puntaje));
            comentario.appendChild(crearParrafo("Comentario: " + xcomen[j].comentario));

            cuerpo_comentarios.appendChild(comentario);
        }
        
    } else{

        cuerpo_comentarios.appendChild(crearParrafo("Este producto no contiene comentarios"));
    }

    var cuerpo_nuevocom = crearDiv("nuevoCommen", "cuerpo-nuevoComm");

    var cuerpo_puntuar = crearDiv("nuevoPuntaje", "cuerpo-puntaje");

    cuerpo_puntuar.appendChild(crearParrafo("Puntuar: "));

    for(let i=1; i<=5; i++){

        let img = document.createElement("img");
        img.setAttribute("value", i);
        img.setAttribute("id", "star"+i);
        img.src = "img/estrellaOff.png";
        img.className = "puntaje";
        img.addEventListener("mouseover", function(){

            this.src = "img/estrellaOn.png";
         
            if (i > 1){
                for (let j=1; j<i; j++){
                    
                    document.getElementById("star"+j).src = "img/estrellaOn.png";
                }
            }

        });

        img.addEventListener("mouseout", function(){

            for (let j=1; j<=5; j++){
              
                if (document.getElementById("star"+j).className != "puntaje clickeado"){
                    document.getElementById("star"+j).src = "img/estrellaOff.png";
                }
            
            }
        });

        img.addEventListener("click", function(){

        for (let n=1; n<=5; n++){

              document.getElementById("star"+n).src = "img/estrellaOff.png";
              document.getElementById("star"+n).classList.remove("clickeado");
              
          }

            for (let k=1; k<=i; k++){
            
                document.getElementById("star"+k).src = "img/estrellaOn.png";
                document.getElementById("star"+k).className += " clickeado";
     
            }

        });

        cuerpo_puntuar.appendChild(img);
    }

    cuerpo_nuevocom.appendChild(cuerpo_puntuar);

    cuerpo_nuevocom.appendChild(crearParrafo("Nuevo comentario: "));

    textArea = document.createElement("textarea");
    textArea.setAttribute("id", "comentarioEntrante");
    textArea.className = "areaNuevoCommen";
    textArea.addEventListener("keypress", function(){
        contarCaracteres(textArea.value, textArea)
    });

    cuerpo_nuevocom.appendChild(textArea);
    cuerpo_comentarios.appendChild(cuerpo_nuevocom);

    var btnPublicarComentario = document.createElement("button");
    btnPublicarComentario.appendChild(document.createTextNode("Comentar!"));
    btnPublicarComentario.addEventListener("click", function(){

        let aPuntaje = document.getElementsByClassName("clickeado");

        if (xuser["loggeado"]){

            let ncomentario = document.getElementById("comentarioEntrante").value
            let puntaje = aPuntaje.length;
            let aNComentario = [];

            if (puntaje > 0 && !vacio(ncomentario)){

                if (ncomentario.length < 50){

                    return;
                } else{

                    aNComentario = {
                        "comentario" : ncomentario,
                        "puntaje" : '' + puntaje + '',
                        "producto" : xidprod,
                        "user" : xuser['user_id']
                    };

                    publicarComentario(aNComentario);
                }

            } else if(aPuntaje.length <= 0){

                return;
            }

        } else{
            return;
        }
        
    });

    cuerpo_comentarios.appendChild(btnPublicarComentario);

}


function dibujarPuntaje(puntaje){

    const maxpun = 5;
    let cuerpo_puntaje = crearDiv("", "contenedor-puntaje");
    cuerpo_puntaje.appendChild(crearParrafo("Puntaje: "));

    if (puntaje > 0 ){

        for (let i = 0; i<puntaje; i++){
            let img = document.createElement("img");
            img.src = "img/estrellaOn.png";
            img.className = "puntaje";
            cuerpo_puntaje.appendChild(img);
        }
    }

    for (let j = 0; j<maxpun-puntaje; j++){
        let img = document.createElement("img");
        img.src = "img/estrellaOff.png";
        img.className = "puntaje";
        cuerpo_puntaje.appendChild(img);
    }

    return cuerpo_puntaje;
}


//Funciones async

async function getData(xinicio = 0, dibujar = true, xvactual = 0, xcampo = "precio", xorden = "DESC", xcategoria = "") {

    try {
        let res = await fetch("http://localhost/tpeWebDos/catalogo/mostrarCatalogo/" + xinicio + "/" + xcampo + "/" + xorden + "/" + xcategoria, {
                                method : 'GET',
                                body: JSON.stringify()

        }),
        json = await res.json();

    
        if (!res.ok) throw { status: res.status, statusText: res.statusText } //si el resultado no es ok, se tira un status con el valor mandado en status
        // y una propiedad de texto con el valor mandado en statusText

        if (dibujar){

            //Cantidad seria la cantidad de paginas que va a tener el paginador y cantxpag es el numero de elemntos que se mostraran por pagina

            dibujarPaginador(json["cantidad"], json["cantxpag"], xvactual, true);

            //dibujarBusquedaAvanzada();
        }
   
        dibujarTabla(json["resultado"], json["cantxpag"]);
        
    } catch (err) {
        console.log("Get tabla: " + err);
    } 
}

async function deleteData(xid, cant_x_pag){

    try {

        const pagina = document.querySelector(".actual");
        var numPag = pagina.innerHTML;
        var inicio = 0;

        let eliminar = confirm("Seguro que quiere eliminar este elemento?");
        

        if (eliminar){

            let res = await fetch("http://localhost/tpeWebDos/catalogo/eliminarProducto/" + xid, {
                method: "DELETE",
            });
    
            if (!res.ok) throw { status: res.status, statusText: res.statusText }

            const tbody = document.getElementById("tbody");

   

            if (tbody.rows.length == 1){
           
                numPag = numPag - 1;
                pagina.remove();
                let nuevoActual = document.getElementById("paginador" + numPag);
                nuevoActual.className += " actual";
            }

            if (numPag > 1){
                inicio = cant_x_pag*numPag-cant_x_pag;
            }

            getData(inicio, false);
        }
       

    } catch (err) {
        console.log("Delete: " + err);
    }
    
    
}

async function verData(xid, xpag, xcant){

    try{

        let res = await fetch("http://localhost/tpeWebDos/catalogo/verProducto/" + xid, {
                                method : 'GET',
                                body: JSON.stringify()
                            }),
            json = await res.json();

        if (!res.ok) throw { status: res.status, statusText: res.statusText } //si el resultado no es ok, se tira un status con el valor mandado en status
        // y una propiedad de texto con el valor mandado en statusText

        var actual = document.querySelector(".actual").innerHTML;

        dibujarProducto(json, xpag, xcant, actual, xid);

    } catch (err){
        console.log("ver producto: " + err);
    }
}

async function getComentarios(xidprod, xinicio = 0, dibujar = true, xcampo = "fecha", xorden = "DESC"){

    try{

        let res = await fetch("http://localhost/tpeWebDos/catalogo/traerComentarios/" + xidprod + "/" + xcampo + "/" + xorden + "/" + xinicio, {
                                method : 'GET',
                                body: JSON.stringify()
                            }),
            json = await res.json();


        if (!res.ok) throw { status: res.status, statusText: res.statusText } //si el resultado no es ok, se tira un status con el valor mandado en status
        // y una propiedad de texto con el valor mandado en statusText

        if (dibujar){
            dibujarPaginador(json["cantidad"], json["cant_x_pag"], 0, false, true, xidprod);
            
        }

        dibujarComentarios(json["comentarios"], json["user"], xidprod, json["cant_x_pag"]);

    } catch (err){
        console.log("Get comment: " + err);
    }

}

async function publicarComentario(xaComentario){

    try{
        let res = await fetch("http://localhost/tpeWebDos/catalogo/publicarComentario", {
                                method : 'POST',
                                body: JSON.stringify(xaComentario)
                            });
            
        if (!res.ok) throw { status: res.status, statusText: res.statusText } //si el resultado no es ok, se tira un status con el valor mandado en status
                                                                                    // y una propiedad de texto con el valor mandado en statusText         
                                                                                    
        getComentarios(xaComentario["producto"]);

    } catch (err){
        console.log("Publicar comment: " + err);
    }
    
}

async function deleteComentario(xid, xidproducto, xcantxpag){
    try{

        let res = await fetch("http://localhost/tpeWebDos/catalogo/eliminarComentario/" +xid, {
                                method : 'DELETE',
                               
                            });
            
        if (!res.ok) throw { status: res.status, statusText: res.statusText } //si el resultado no es ok, se tira un status con el valor mandado en status
                                                                                    // y una propiedad de texto con el valor mandado en statusText   
                                                                                    
        var aOrden = document.getElementById("select-orden").value;
        aOrden = aOrden.split("/");
        
        var pagActual = document.querySelector(".actual").innerHTML;

        if (!document.querySelector(".comentario")){
            pagActual--;
        }
                                                                                    
        getComentarios(xidproducto, xcantxpag*pagActual-xcantxpag, true, aOrden[0], aOrden[1]);

    } catch (err){
        console.log("Eliminar comment: " + err);
    }
}

getData();