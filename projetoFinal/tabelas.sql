CREATE TABLE Anunciante(
    Codigo int PRIMARY KEY auto_increment,
    Nome varchar(50),
    CPF char(14) UNIQUE,
    Email varchar(50),
    SenhaHash varchar(128),
    Telefone varchar(30)
) ENGINE=InnoDB;

CREATE TABLE Categoria(
    Codigo int PRIMARY KEY auto_increment,
    Nome varchar(50),
    Descricao varchar(100)
) ENGINE=InnoDB;

CREATE TABLE Anuncio(
    Codigo int PRIMARY KEY auto_increment,
    Titulo varchar(50),
    Descricao text,
    Preco decimal(15,2),
    DataHora datetime,
    CEP char(10),
    Bairro varchar(30),
    Cidade varchar(30),
    Estado varchar(30),
    CodCategoria int not null,
    CodAnunciante int not null,
    FOREIGN KEY (CodCategoria) REFERENCES Categoria(Codigo),
    FOREIGN KEY (CodAnunciante) REFERENCES Anunciante(Codigo) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE Foto(
    CodAnuncio int,
    NomeArqFoto varchar(100),
    FOREIGN KEY (CodAnuncio) REFERENCES Anuncio(Codigo)
) ENGINE=InnoDB;

CREATE TABLE BaseEnderecosAjax(
    CEP char(10) PRIMARY KEY,
    Bairro varchar(30),
    Cidade varchar(30),
    Estado varchar(30)
) ENGINE=InnoDB;

CREATE TABLE Interesse(
    Codigo int PRIMARY KEY auto_increment
    Mensagem text,
    DataHora DATETIME,
    Contato varchar(255)
    CodAnuncio int,
    FOREIGN KEY (CodAnuncio) REFERENCES Anuncio(Codigo) ON DELETE CASCADE
)

INSERT INTO Anunciante VALUES (1, 'Altrano', '111.111.111-11', 'altrano@mail.com', '$2y$10$uJMQPr3dXwuMib1gjYFazOUbHl8vJ926PZGQquNoe7P5vbrlaZmL6', '34-9999-9991');
INSERT INTO Anunciante VALUES (2, 'Beltrano', '222.222.222-22', 'beltrano@mail.com', '$2y$10$uJMQPr3dXwuMib1gjYFazOUbHl8vJ926PZGQquNoe7P5vbrlaZmL6', '34-9999-9992');
INSERT INTO Anunciante VALUES (3, 'Ciclano', '333.333.333-33', 'ciclano@mail.com', '$2y$10$uJMQPr3dXwuMib1gjYFazOUbHl8vJ926PZGQquNoe7P5vbrlaZmL6', '34-9999-9993');
INSERT INTO Anunciante VALUES (4, 'Deltrano', '444.444.444-44', 'deltrano@mail.com', '$2y$10$uJMQPr3dXwuMib1gjYFazOUbHl8vJ926PZGQquNoe7P5vbrlaZmL6', '34-9999-9994');
INSERT INTO Anunciante VALUES (5, 'Fulano', '555.555.555-55', 'fulano@mail.com', '$2y$10$uJMQPr3dXwuMib1gjYFazOUbHl8vJ926PZGQquNoe7P5vbrlaZmL6', '34-9999-9995');

INSERT INTO Categoria VALUES (1, "Veículo", "Veículos em geral");
INSERT INTO Categoria VALUES (2, "Eletroeletrônico", "Eletrodomésticos e eletrônicos em geral");
INSERT INTO Categoria VALUES (3, "Imóvel", "Imóveis em geral");
INSERT INTO Categoria VALUES (4, "Vestuário", "Roupas em geral");
INSERT INTO Categoria VALUES (5, "Outro", "Qualquer outro produto que não se enquadra nas demais categorias");

INSERT INTO Anuncio (Titulo, Descricao, Preco, DataHora, CEP, Bairro, Cidade, Estado, CodCategoria, CodAnunciante) VALUES ("Monitor de 22 Full HD","Vendo um monitor Full HD de 22 polegadas, black piano, com 6 meses de uso, marca X, sem detalhes.", "650", now(), "38703-170", "Jardim Floresta", "Patos de Minas", "MG", 2, 1);
INSERT INTO Anuncio (Titulo, Descricao, Preco, DataHora, CEP, Bairro, Cidade, Estado, CodCategoria, CodAnunciante) VALUES ("Notebook de 14 em alumínio","Notebook super leve com bateria de longa duração e 3 anos de uso. Processador de 5 Ghz, 32 GB de memória RAM e 2 TB de SSD", "3550", now(), "38703-170", "Jardim Floresta", "Patos de Minas", "MG", 2, 2);
INSERT INTO Anuncio (Titulo, Descricao, Preco, DataHora, CEP, Bairro, Cidade, Estado, CodCategoria, CodAnunciante) VALUES ("Teclado mecânico","Teclado mecânico com fio e teclas RED, padrão ABNT2 da marca Y. Aceito trocas em teclado sem fio. Produto em perfeito funcionamento.", "160", now(), "38703-170", "Jardim Floresta", "Patos de Minas", "MG", 2, 3);
INSERT INTO Anuncio (Titulo, Descricao, Preco, DataHora, CEP, Bairro, Cidade, Estado, CodCategoria, CodAnunciante) VALUES ("VW Gol G5 2009","VW Gol 1.6 geração 5 com 80.000 km rodados, cor prata, muito conservado. Troco por carro de menor valor.", "32500", now(), "38400-100", "Santa Mônica", "Uberlândia", "MG", 1, 4);
INSERT INTO Anuncio (Titulo, Descricao, Preco, DataHora, CEP, Bairro, Cidade, Estado, CodCategoria, CodAnunciante) VALUES ("Chevrolet Ônix 2016","Vendo um Chevrolet Ônix super conservado, cor branca. Carro de único dono, pouco rodado. Não aceito trocas.", "45900", now(), "38400-100", "Santa Mônica", "Uberlândia", "MG", 1, 5);
INSERT INTO Anuncio (Titulo, Descricao, Preco, DataHora, CEP, Bairro, Cidade, Estado, CodCategoria, CodAnunciante) VALUES ("Máquina de Lavar 11 Kg","Vendo uma lavadora automática de 11 kg, marca X, com super centrifugação tabajaras de 5000 RPM. Secagem super rápida, em 90 segundos.", "1800", now(), "38400-100", "Santa Mônica", "Uberlândia", "MG", 2, 1);
INSERT INTO Anuncio (Titulo, Descricao, Preco, DataHora, CEP, Bairro, Cidade, Estado, CodCategoria, CodAnunciante) VALUES ("Apartamento 2 quartos","Vendo apartamento de 2 quartos, sendo 1 suíte, com 2 vagas na garagem, porcelanato, churrasqueira e área gourmet. Área total: 85 m2. Apartamento de 3 anos. Não troco.", "450000", now(), "38400-100", "Santa Mônica", "Uberlândia", "MG", 3, 2);
INSERT INTO Anuncio (Titulo, Descricao, Preco, DataHora, CEP, Bairro, Cidade, Estado, CodCategoria, CodAnunciante) VALUES ("Apartamento 3 quartos","Vendo apartamento de 3 quartos, na rua Jasquerlberto XYZ próximo à UFU. Imóvel muito bom com sala em 3 ambientes, 2 suítes, garagem para 3 carros. Área total de 120 m2.", "790000", now(), "38400-100", "Santa Mônica", "Uberlândia", "MG", 3, 3);
INSERT INTO Anuncio (Titulo, Descricao, Preco, DataHora, CEP, Bairro, Cidade, Estado, CodCategoria, CodAnunciante) VALUES ("Casa no Santa Mônica","Vendo casa de 4 quartos no Santa Mônica, na rua Edelbrinda ABC. Imóvel com terreno de 400 m2, piscina, academia e sauna. Garagem para 5 carros. Aceito imóvel de menor valor no negócio.", "1200000", now(), "38400-100", "Santa Mônica", "Uberlândia", "MG", 3, 4);
INSERT INTO Anuncio (Titulo, Descricao, Preco, DataHora, CEP, Bairro, Cidade, Estado, CodCategoria, CodAnunciante) VALUES ("Sobrado com 3 quartos","Vendo um sobrado com área total de 209 m2, sendo 2 quartos no térreo e 1 quarto no piso superior. Possui sala ampla, cozinha gourmet e banheira de hidromassagem.", "875000", now(), "38400-100", "Santa Mônica", "Uberlândia", "MG", 3, 5);
INSERT INTO Anuncio (Titulo, Descricao, Preco, DataHora, CEP, Bairro, Cidade, Estado, CodCategoria, CodAnunciante) VALUES ("Fogão de Indução","Vendo fogão de indução de 4 bocas da marca XYZ, com tampo de vidro e potência de 10000 watts. Produto impecável. Aceito troca por cooktop.", "1680", now(), "38400-100", "Santa Mônica", "Uberlândia", "MG", 2, 1);
INSERT INTO Anuncio (Titulo, Descricao, Preco, DataHora, CEP, Bairro, Cidade, Estado, CodCategoria, CodAnunciante) VALUES ("Liquidificador de 6 velocidades","Vendo liquidificador 220v com 6 velocidades e copo de vidro. Produto em perfeito funcionamento. Aceito ofertas.", "120", now(), "38400-100", "Santa Mônica", "Uberlândia", "MG", 2, 2);
INSERT INTO Anuncio (Titulo, Descricao, Preco, DataHora, CEP, Bairro, Cidade, Estado, CodCategoria, CodAnunciante) VALUES ("Geladeira Frost Free","Geladeira Frost Free de 350L da marca ABC, 220v, com pouco tempo de uso. Produto em aço inoxidável, com dispenser de água. Não entrego. Não aceito trocas.", "750", now(), "38400-100", "Santa Mônica", "Uberlândia", "MG", 2, 3);
INSERT INTO Anuncio (Titulo, Descricao, Preco, DataHora, CEP, Bairro, Cidade, Estado, CodCategoria, CodAnunciante) VALUES ("Jaqueta de Couro","Jaqueta de couro preta tamanho GG, pouco utilizada", "450", now(), "38400-100", "Santa Mônica", "Uberlândia", "MG", 4, 4);
INSERT INTO Anuncio (Titulo, Descricao, Preco, DataHora, CEP, Bairro, Cidade, Estado, CodCategoria, CodAnunciante) VALUES ("Colchão de espuma tamanho King","Vendo colchão de espuma tamanho king, densidade 40 e altura de 25cm. Impecável", "1600", now(), "38400-100", "Santa Mônica", "Uberlândia", "MG", 5, 5);

INSERT INTO BaseEnderecosAjax VALUES ("38400-100", "Santa Mônica", "Uberlândia", "MG");
INSERT INTO BaseEnderecosAjax VALUES ("38703-170", "Jardim Floresta", "Patos de Minas", "MG");