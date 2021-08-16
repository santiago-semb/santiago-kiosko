function cambiarModoOscuro() { 
    var cuerpoweb = document.body; 
    cuerpoweb.classList.toggle("black-body");
    var headerweb = document.getElementById("id-header");
    headerweb.classList.toggle("black-header");
    var headerweb = document.getElementById("id-menu");
    headerweb.classList.toggle("black-menu");
    var div = document.getElementById("div-ventas");
    div.classList.toggle("black-div");
    

    localStorage.setItem("modo", "oscuro");
}

function cambiarModoClaro() {
    var cuerpoweb = document.body; 
    cuerpoweb.classList.toggle("white-body");
    var headerweb = document.getElementById("id-header");
    headerweb.classList.toggle("white-header");
    var headerweb = document.getElementById("id-menu");
    headerweb.classList.toggle("white-menu");
    var div = document.getElementById("div-ventas");
    div.classList.toggle("white-div");
    

    localStorage.setItem("modo", "claro");
}

function cambiarAmodoEstablecido() {
    switch(localStorage.getItem("modo")){
        case "oscuro": 
            cambiarModoOscuro();
            break;
        case "claro": 
            cambiarModoClaro();
            break;
    }
    console.log(localStorage.getItem("modo"));
}