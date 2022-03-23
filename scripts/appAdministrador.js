function dibujarPaginador(paginas, cant_x_pag, viejoVolver = 0){

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

            if (i > 1){
                getData(cant_x_pag*i-cant_x_pag, false);
            } else{
                getData(0, false);
            }
        });
       
        cuerpo_paginador.appendChild(btnPagina);
    } 

    document.querySelector(".contenedor").appendChild(cuerpo_paginador);

}

function dibujarTabla(json, cant_x_pag, aRoles){

    const base = document.querySelector(".contenedor");
    var tabla;

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
        thead.appendChild(crearCelda("Usuario", "", false, true));
        thead.appendChild(crearCelda("Email", "", false, true));
        thead.appendChild(crearCelda("Rol", "", false, true));
        thead.appendChild(crearCelda("Eliminar", "", false, true));

        tabla.appendChild(thead);

        var numSelect = 1;

        json.forEach(element => {

            //Por cada vuelta, genero una nueva fila para insertar a la tabla
            let fila = document.createElement("tr");         
            fila.appendChild(crearCelda(element.usuario));
            fila.appendChild(crearCelda(element.email));
            fila.appendChild(crearCelda(crearSelect(aRoles, element.user_rol, element.rid, numSelect, element.user_id), "", true));

            let btnEliminar = document.createElement("button");
            btnEliminar.appendChild(document.createTextNode("Eliminar"));
            btnEliminar.className = "eliminar-user";
            btnEliminar.addEventListener("click", function () {

                deleteData(element.user_id, cant_x_pag);
                
            });

            fila.appendChild(crearCelda(btnEliminar, "", true));

            tbody.appendChild(fila);

            numSelect++;
        });

        tbody.setAttribute("id", "tbody");

        tabla.appendChild(tbody);

        base.appendChild(tabla);

        if (document.getElementById("btneditar")){

            document.getElementById("btneditar").remove();
        }

        let btnConfirmarEdit = document.createElement("button");
            btnConfirmarEdit.appendChild(document.createTextNode("Editar"));
            btnConfirmarEdit.className = "editar-user";
            btnConfirmarEdit.setAttribute("id", "btneditar");
            btnConfirmarEdit.addEventListener("click", function () {

                let aIds = [];

                for (let i=1; i<=cant_x_pag; i++){

                    if (document.getElementById("tipoUser"+i)){
                        aIds.push(document.getElementById("tipoUser"+i).value);
                    }
                    

                }

                editData(aIds, cant_x_pag);
                
            });

            base.appendChild(btnConfirmarEdit)

        

    } else{
        console.log("tabla inexistente");
    }

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

function crearSelect(aRoles, rolActual, ridActual, nameSelect, idUser){

    let select = document.createElement("select");
    select.setAttribute("name", "tipoUser"+nameSelect);
    select.setAttribute("id", "tipoUser"+nameSelect);

    let option = document.createElement("option");
    option.appendChild(document.createTextNode(rolActual));
    option.setAttribute("value", ridActual + "." + idUser);

    select.appendChild(option);
    

    for (let i = 0; i<aRoles.length; i++){

        if (aRoles[i].rol_id != ridActual){

            option = document.createElement("option");
            option.appendChild(document.createTextNode(aRoles[i].rol));
            option.setAttribute("value", aRoles[i].rol_id + "." + idUser);
            
            select.appendChild(option);

        }
        
    }

    return select
}

async function getData(xinicio = 0, dibujar = true, xvactual = 0) {

    try {
        let res = await fetch("http://localhost/tpeWebDos/administrar/usuarios/" + xinicio, {
                                method : 'GET',
                                body: JSON.stringify()

        }),
        json = await res.json();

        console.log(json);
    
        if (!res.ok) throw { status: res.status, statusText: res.statusText } //si el resultado no es ok, se tira un status con el valor mandado en status
        // y una propiedad de texto con el valor mandado en statusText

       if (dibujar){

            //Cantidad seria la cantidad de paginas que va a tener el paginador y cantxpag es el numero de elemntos que se mostraran por pagina

            dibujarPaginador(json["cantidad"], json["cantxpag"], xvactual);
        }
   
        dibujarTabla(json["resultado"], json["cantxpag"], json['roles']);
        
    } catch (err) {
        console.log("Get: " + err);
    } 
    
}

async function editData(xaIds, aCantXPag) {

    try {

        let elementos = 0;

        let res = await fetch("http://localhost/tpeWebDos/administrar/modificarUser/" + xaIds, {
                                method : 'PUT'
        });
      
    
        if (!res.ok) throw { status: res.status, statusText: res.statusText }
         //si el resultado no es ok, se tira un status con el valor mandado en status
        // y una propiedad de texto con el valor mandado en statusText

        if (document.querySelector(".actual").innerHTML > 1){
            elementos = aCantXPag * document.querySelector(".actual").innerHTML - aCantXPag;
        }

        getData(elementos, false);
        
    } catch (err) {
        console.log("Get: " + err);
    } 
}

async function deleteData(xid, cant_x_pag){

    try {

        const pagina = document.querySelector(".actual");
        var numPag = pagina.innerHTML;
        var inicio = 0;

        let eliminar = confirm("Seguro que quiere eliminar este elemento?");
        

        if (eliminar){

            let res = await fetch("http://localhost/tpeWebDos/administrar/eliminarUser/" + xid, {
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

async function traerComentarios(xidprod, xcampo = "fecha", xorden = "ASC"){

    try {

        let elementos = 0;

        let res = await fetch("http://localhost/tpeWebDos/administrar/getComentarios/" + xidprod + "/" + xcampo + "/" + xorden,{
                                method : 'GET',
                                body: JSON.stringify()

                        }),
        json = await res.json();
       
        
    
        if (!res.ok) throw { status: res.status, statusText: res.statusText }
         //si el resultado no es ok, se tira un status con el valor mandado en status
        // y una propiedad de texto con el valor mandado en statusText

        if (document.querySelector(".actual").innerHTML > 1){
            elementos = aCantXPag * document.querySelector(".actual").innerHTML - aCantXPag;
        }

        dibujarComentarios(json);
        
    } catch (err) {
        console.log("Get: " + err);
    } 
}

getData();