async function buscaEndereco(cep) {   
    if (cep.length != 9) return;

    try {
      let response = await fetch("buscaEndereco.php?cep=" + cep);
      if (!response.ok) throw new Error(response.statusText);
      var endereco = await response.json();
    }
    catch (e) {
      console.error(e);
      return;
    }

    let form = document.querySelector("form");
    form.bairro.value = endereco.bairro;
    form.cidade.value = endereco.cidade;
    var indexEstado = 0
    if(endereco.estado == "MG")
      indexEstado = 1
    if(endereco.estado == "SP")
      indexEstado = 2
    if(endereco.estado == "RJ")
      indexEstado = 3
    
    form.estado.selectedIndex = indexEstado
  }

  window.onload = function () {
    const inputCep = document.querySelector("#cep");
    inputCep.onkeyup = () => buscaEndereco(inputCep.value);
  }