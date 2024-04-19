async function listaProdutos(){
    try{

        let response = await fetch("buscaMeusAnuncios.php")
        if (!response.ok) throw new Error(response.statusText);
        var products = await response.json();
  
    }catch (e) {
        console.error(e); //trata possiveis erros
        return;
    }

    renderProducts(products)
}

async function renderProducts(products){
    for (let product of products) {
        const novoCard = document.createElement('div')
        novoCard.classList.add('card')
        novoCard.id = (product.Codigo) //o id do card é o id do anuncio
        novoCard.onclick = redirPaginaProduto //qnd clicado vai para a pagina do produto

        const tituloImgDesc = document.createElement('div')
        tituloImgDesc.classList.add('titulo_img_desc')
        
        const imagem = document.createElement('img')
        imagem.src = `images/produtos/${product.Codigo}.jpg`
        imagem.alt = `${product.Titulo}`
        
        const titulo = document.createElement('h2')
        titulo.textContent = `${product.Titulo}`

        const descricao = document.createElement('p')
        product.Descricao = product.Descricao.slice(0,147) + "..."
        descricao.textContent = `${product.Descricao}`

        const preco = document.createElement('p')
        preco.classList.add('preco')
        preco.textContent = `${product.Preco}`

        tituloImgDesc.appendChild(imagem)
        tituloImgDesc.appendChild(titulo)
        tituloImgDesc.appendChild(descricao)

        novoCard.appendChild(tituloImgDesc)
        novoCard.appendChild(preco)

        const areaResults = document.querySelector('#area_resultados')
        areaResults.appendChild(novoCard)
    }
}

function redirPaginaProduto(e){
    const codigo = e.currentTarget.id
    window.location.href = `paginaProdutoAnunciante.php?codigo=${codigo}`
}

window.onload = listaProdutos