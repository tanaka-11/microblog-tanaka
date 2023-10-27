// Capturando os campos com o id
const formBusca = document.querySelector("#form-busca");
const campoBusca = document.querySelector("#campo-busca");
const divResultados = document.querySelector("#resultados");

// Escondendo a div
divResultados.classList.add("visually-hidden");

// Monitorando evento de digitação do campo
campoBusca.addEventListener("input", async function(){
    if(campoBusca.value !== ""){
        const resposta = await fetch("resultados.php", {
            method: "POST",
            body: new FormData(formBusca)
        });

        const dados = await resposta.text();
        
        divResultados.classList.remove("visually-hidden");
        divResultados.innerHTML = dados;
    } else {
        divResultados.classList.add("visually-hidden");
        divResultados.innerHTML = "";
    }
});