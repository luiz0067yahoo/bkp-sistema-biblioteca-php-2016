SET NAMES 'utf8mb4' COLLATE 'utf8mb4_unicode_ci';

CREATE TABLE IF NOT EXISTS Escola (
	nome VARCHAR(50) NOT NULL,
    id_escola VARCHAR(2) NOT NULL,
    telefone VARCHAR(20),
    valor_multa_dia FLOAT DEFAULT 0,
    limite_emprestimos_aluno TINYINT DEFAULT 1 NOT NULL,
    permitir_emprestimo_aluno_com_multa BOOL DEFAULT 0,
    prazo_padrao TINYINT DEFAULT 7,
    imprimir_emprestimo BOOL DEFAULT 0,
    
    PRIMARY KEY (id_escola)

);



CREATE TABLE IF NOT EXISTS Turma (
	id_turma VARCHAR(5) NOT NULL,
    ano SMALLINT,
    serie ENUM('pre1', 'pre2', 'primeiro', 'segundo', 'terceiro', 'quarto', 'quinto'),
    letra_turma CHAR,
    id_escola VARCHAR(2),
    ativo BOOL DEFAULT TRUE,
    
    PRIMARY KEY (id_turma),
    FOREIGN KEY (id_escola) REFERENCES Escola(id_escola) ON UPDATE CASCADE ON DELETE CASCADE
);


CREATE TABLE IF NOT EXISTS Aluno (
	id_aluno VARCHAR(8) NOT NULL,
	nome VARCHAR(80) NOT NULL,
	id_escola VARCHAR(2) NOT NULL,
	id_turma VARCHAR(6),
    aniversario DATE,
    ativo BOOL DEFAULT TRUE,
    
	FULLTEXT (nome),
    
	PRIMARY KEY (id_aluno),
	FOREIGN KEY (id_escola) REFERENCES Escola(id_escola) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (id_turma) REFERENCES Turma(id_turma) ON UPDATE CASCADE
);


CREATE TABLE IF NOT EXISTS Professor(
	id_professor VARCHAR(6) NOT NULL,
	nome VARCHAR(80) NOT NULL,
	id_escola VARCHAR(2),
	id_turma VARCHAR(6),
    ativo BOOL DEFAULT TRUE,
    
    FULLTEXT(nome),
    
	
	PRIMARY KEY (id_professor),
	FOREIGN KEY (id_escola) REFERENCES Escola(id_escola) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (id_turma) REFERENCES Turma(id_turma) ON UPDATE CASCADE

);


CREATE TABLE IF NOT EXISTS Livro (
	id_livro VARCHAR(8) NOT NULL,
	titulo VARCHAR(50) NOT NULL,
	sub_titulo VARCHAR(60),
    autor VARCHAR(50) NOT NULL,
	tipo_obra ENUM('Livro', 'Revista', 'Gibi', 'CD', 'Dicionário', 'Enciclopédia') NOT NULL,
	area_conhecimento ENUM('Generalidade', 'Literatura Infantil', 'Almanaques e Enciclopédias', 'Filosofia','Educação', 'Folclore', 'Línguas', 'Matemática', 'Artes', 'Historias em Quadrinhos','Literatura Americana', 'Literatura Brasileira', 'História', 'Geografia') NOT NULL,
	origem ENUM('Compra', 'Doação', 'Convênio'),
	numero_edicao INT,
	isbn VARCHAR(13),
	serie VARCHAR(40),
	id_escola VARCHAR(2),
    ativo BOOL DEFAULT TRUE,
    
    FULLTEXT(titulo, sub_titulo),
    FULLTEXT(autor),
	
	PRIMARY KEY (id_livro),
	FOREIGN KEY (id_escola) REFERENCES Escola(id_escola) ON UPDATE CASCADE ON DELETE CASCADE

);


CREATE TABLE IF NOT EXISTS Emprestimo (
	id_emprestimo VARCHAR(11) NOT NULL,
    id_escola VARCHAR(2) NOT NULL,
	id_aluno VARCHAR(8) NULL,
    id_professor VARCHAR(6) NULL,
	id_livro VARCHAR(8) NOT NULL,
    multa_devendo FLOAT DEFAULT 0,
    multa_paga FLOAT DEFAULT 0,
    
	data_emprestimo DATE NOT NULL,
	data_devolucao DATE NOT NULL,
    concluido BOOL DEFAULT FALSE NOT NULL,
	
	PRIMARY KEY (id_emprestimo),
	FOREIGN KEY (id_livro) REFERENCES Livro (id_livro) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (id_escola) REFERENCES Escola(id_escola) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (id_aluno) REFERENCES Aluno(id_aluno) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (id_professor) REFERENCES Professor(id_professor) ON UPDATE CASCADE ON DELETE CASCADE


);

INSERT INTO Escola(nome, id_escola, telefone) VALUES ("Alberto Santos Dumont", "01", "3055-8757");
INSERT INTO Escola(nome, id_escola, telefone) VALUES ("Amélio Dal Bosco", "02", "3055-8763");
INSERT INTO Escola(nome, id_escola, telefone) VALUES ("André Zenere", "03", "3252-3781");
INSERT INTO Escola(nome, id_escola, telefone) VALUES ("Anita Garibaldi", "04", "3277-2182");
INSERT INTO Escola(nome, id_escola, telefone) VALUES ("Antonio Scain", "05", "3055-8760");
INSERT INTO Escola(nome, id_escola, telefone) VALUES ("Ari Arcássio Gossler", "06", "3055-8761");
INSERT INTO Escola(nome, id_escola, telefone) VALUES ("Arsênio Heiss", "07", "3055-8759");
INSERT INTO Escola(nome, id_escola, telefone) VALUES ("Borges de Medeiros", "08", "3055-8766");
INSERT INTO Escola(nome, id_escola, telefone) VALUES ("Carlos Friedrich", "09", "3055-8770");
INSERT INTO Escola(nome, id_escola, telefone) VALUES ("Carlos João Treis", "10", "3055-8782");
INSERT INTO Escola(nome, id_escola, telefone) VALUES ("Duque de Caxias", "11", "3376-1101");
INSERT INTO Escola(nome, id_escola, telefone) VALUES ("Egon Werner Bercht", "12", "3055-8768");
INSERT INTO Escola(nome, id_escola, telefone) VALUES ("Henrique Brod", "13", "3055-8775");
INSERT INTO Escola(nome, id_escola, telefone) VALUES ("Ivo Welter", "14", "3378-6034");
INSERT INTO Escola(nome, id_escola, telefone) VALUES ("Jardim Concórdia", "15", "3055-8776");
INSERT INTO Escola(nome, id_escola, telefone) VALUES ("José Pedro Brum", "16", "3055-8779");
INSERT INTO Escola(nome, id_escola, telefone) VALUES ("Miguel Dewes", "17", "3274-1102");
INSERT INTO Escola(nome, id_escola, telefone) VALUES ("Norma Demeneck Belotto", "18", "3055-8777");
INSERT INTO Escola(nome, id_escola, telefone) VALUES ("Nossa Senhora das Graças", "19", "3278-6335");
INSERT INTO Escola(nome, id_escola, telefone) VALUES ("Olivo Beal", "20", "3277-0800");
INSERT INTO Escola(nome, id_escola, telefone) VALUES ("Orlando Luiz Bazei", "21", "3273-1501");
INSERT INTO Escola(nome, id_escola, telefone) VALUES ("Osvaldo Cruz", "22", "3269-1417");
INSERT INTO Escola(nome, id_escola, telefone) VALUES ("Princesa Isabel", "23", "3375-1201");
INSERT INTO Escola(nome, id_escola, telefone) VALUES ("Reinaldo Arrosi", "24", "3055-8772");
INSERT INTO Escola(nome, id_escola, telefone) VALUES ("Santo Antonio", "25", "3278-7317");
INSERT INTO Escola(nome, id_escola, telefone) VALUES ("São Dimas", "26", "3312-1104");
INSERT INTO Escola(nome, id_escola, telefone) VALUES ("São Francisco", "27", "3055-8794");
INSERT INTO Escola(nome, id_escola, telefone) VALUES ("São Luiz", "28", "3280-1101");
INSERT INTO Escola(nome, id_escola, telefone) VALUES ("São Pedro", "29", "3278-8254");
INSERT INTO Escola(nome, id_escola, telefone) VALUES ("Shirley Lorandi", "30", "3055-8764");
INSERT INTO Escola(nome, id_escola, telefone) VALUES ("Tancredo Neves", "31", "3055-8773");
INSERT INTO Escola(nome, id_escola, telefone) VALUES ("Tomé de Souza", "32", "3375-1284");
INSERT INTO Escola(nome, id_escola, telefone) VALUES ("Waldyr Becker", "33", "3252-9099");
INSERT INTO Escola(nome, id_escola, telefone) VALUES ("Walter Fontana", "34", "3055-8774");
INSERT INTO Escola(nome, id_escola, telefone) VALUES ("Washington Luiz", "35", "3269-6026");
INSERT INTO Escola(nome, id_escola, telefone) VALUES ("Walmir Grande", "36", "3278-8047");


CREATE user 'biblio'@'localhost' IDENTIFIED BY 'professor';
GRANT ALL PRIVILEGES ON biblioteca.* TO 'biblio'@'localhost';