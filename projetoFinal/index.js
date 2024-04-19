//Funções globais
var offset = 0
var ultimaChamada = 0
intervalo = 3000

function buscaProduto(){
    const areaResults = document.querySelector('#area_resultados')
    areaResults.remove()
    const novaAreaResults = document.createElement('div')
    novaAreaResults.classList.add('container')
    novaAreaResults.id = 'area_resultados'

    const areaAvan = document.querySelector(".area_avancada")
    areaAvan.style.visibility = "visible";

    const main = document.querySelector('main')
    main.appendChild(novaAreaResults)
    offset = 0
    listaProdutos()
}

async function listaProdutos(){
    const busca = document.querySelector('#busca')
    
    const onde_buscar = document.querySelector("#onde_buscar")
    const categoria = document.querySelector("#categoria")

    const preco_min =  document.querySelector("#preco_min")
    const preco_max =  document.querySelector("#preco_max")

    if(preco_min.value == "")
        preco_min.value = "0.00"
    if(preco_max.value =="")
        preco_max.value = "999999999.99"

    try{

        let response = await fetch(`buscaProdutos.php?busca=${busca.value}&offset=${offset}&categoria=${categoria.value}&ondeBuscar=${onde_buscar.value}&precoMin=${preco_min.value}&precoMax=${preco_max.value}`)
        if (!response.ok) throw new Error(response.statusText);
        var products = await response.json();
  
    }catch (e) {
        console.error(e); //trata possiveis erros
        return;
    }
    offset += 6
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

        /*
        try{
            let response = await fetch("buscaImgProduto.php?codigo=" + product.Codigo)
            if (!response.ok) throw new Error(response.statusText);
            var imageName = await response.json();
      
        }catch (e) {
            console.error(e); //trata possiveis erros
            return;
        }

        if(imageName.NomeArqFoto != ''){
            imagem.src = `images/produtos/${imageName.NomeArqFoto}`
            imagem.alt = `${product.Titulo}`
        }
        */

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

//função para a rolagem infinita
window.onscroll = function () {
    const agora = Date.now();
    if(agora - ultimaChamada >= intervalo){
        ultimaChamada = agora
        if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
        listaProdutos();
        }
    }
  };

//função para redirecionar para a página de uma produto quando clicado
function redirPaginaProduto(e){
    const codigo = e.currentTarget.id
    window.location.href = `paginaProduto.php?codigo=${codigo}`
}

let btn_buscar = document.querySelector("#buscar")
btn_buscar.onclick = buscaProduto