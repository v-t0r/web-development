async function listaInteresses(){
    const codigo = document.querySelector("#codigo")
    try{
        let response = await fetch(`buscaInteresse.php?codigo=${codigo.value}`)
        if (!response.ok) throw new Error(response.statusText);
        var interesses = await response.json();
  
    }catch (e) {
        console.error(e); //trata possiveis erros
        return;
    }

    for(let interesse of interesses){
        const novoCard = document.createElement('div')
        novoCard.classList.add('card')
        novoCard.id = (interesse.Codigo) //o id do card é o id do interesse

        const mensagem = document.createElement('p')
        mensagem.textContent = `Mensagem: ${interesse.Mensagem}`

        const contato = document.createElement('p')
        contato.textContent = `Contato: ${interesse.Contato}`

        const botao = document.createElement('button')
        botao.textContent = "Apagar"
        botao.onclick = apagarMensagem

        novoCard.appendChild(mensagem)
        novoCard.appendChild(contato)
        novoCard.appendChild(botao)

        const areaResults = document.querySelector('.registro_interesses')
        areaResults.appendChild(novoCard)
    }
}

async function apagarMensagem(e){
    var div = e.target.parentNode
    var codigo = div.id

    let dados = {
        codigo : codigo
    }

    const options = {
        method: "POST",
        body: JSON.stringify(dados),
        headers: {'Content-Type': 'application/json'}
    }
    
    try {
        let response = await fetch(`apagaInteresse.php`, options)
        if (!response.ok) throw new Error(response.statusText)

    } catch (e) {
        console.error(e)
        alert("Houve uma falha ao tentar apagar a mesagem. Tente novamente mais tarde.")
        return
    }

    div.remove()
}

window.onload = listaInteresses