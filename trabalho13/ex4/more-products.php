<?php
/*
Possui uma classe chamada Product, que guarda os campos id, name, price e imagePath 
*/

class Product
{
  public $id;
  public $name;
  public $price;
  public $imagePath;

  function __construct($id, $name, $price, $imagePath)
  {
    $this->id = $id;
    $this->name = $name; 
    $this->price = $price;
    $this->imagePath = $imagePath;
  }
}

//instancia um array com sete possiveis produtos
$products = array(
  new Product(1, 'Smart TV LED 55', 2900, 'tv.webp'),
  new Product(2, 'Smartphone 6.5 ABC', 1590, 'smartphone.webp'),
  new Product(3, 'Notebook 17 Ultra Slim', 4299, 'notebook.webp'),
  new Product(4, 'Mouse Óptico XYZ', 149, 'mouse.webp'),
  new Product(5, 'Monitor 28 4k', 1460, 'monitor.webp'),
  new Product(6, 'Fone Headset ABC', 250, 'headset.webp'),
  new Product(7, 'Pen-drive de 64GB', 90, 'pen-drive.webp')
);
 
/*
Dos sete produtos instanciados, faz 5 sorteios e gera um novo array de produtos. 
Pode ser que o mesmo produto seja sorteado mais de uma vez.
*/
$randProds = [
  $products[rand(0, 6)],
  $products[rand(0, 6)],
  $products[rand(0, 6)],
  $products[rand(0, 6)],
  $products[rand(0, 6)]
];

//define o tipo do conteudo retornado como JSON, e retorna o array de produtos como JSON.
header('Content-type: application/json');
echo json_encode($randProds);
