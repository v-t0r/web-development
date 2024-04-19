function mostrarJanela(){
    const janela = document.querySelector("#centralized_window")
    janela.style.visibility = 'visible'
}

async function enviarInteresse(){
    const janela = document.querySelector("#centralized_window")
    janela.style.visibility = 'hidden'

    var mensagem = document.querySelector("#mensagem")
    var contato = document.querySelector("#contato")
    var codigo = document.querySelector("#codigo")

    let dados = {
        mensagem : mensagem.value,
        contato : contato.value,
        codigo : codigo.value
    }

    const options = {
        method: "POST",
        body: JSON.stringify(dados),
        headers: {'Content-Type': 'application/json'}
    }
    
    try {
        let response = await fetch(`cadastraInteresse.php`, options)
        if (!response.ok) throw new Error(response.statusText)

    } catch (e) {
        console.error(e)
        alert("Houve uma falha no envio de sua mensagem. Tente novamente mais tarde.");
        return
    }

    alert(`Mensagem enviada com sucesso!`);

}

const btn_interesse = document.querySelector("#interesse")
btn_interesse.onclick = mostrarJanela

const btn_enviar = document.querySelector("#enviar")
btn_enviar.onclick = enviarInteresse
