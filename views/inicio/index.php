<!DOCTYPE html>

<html lang="en">

    <?php require "views/header.php" ?>
    
    <body>

        
        
        <div class="contenedor">

            <h1>Hola, este es el inicio uwu</h1>

            <script>

                const base = document.querySelector(".contenedor");
    
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


                    base.appendChild(img);
                }
                
                
            </script>

        </div>

        <?php require "views/footer.php" ?>
    </body>

</html>