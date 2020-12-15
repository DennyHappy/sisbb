create database sisBiblioteca;

use sisBiblioteca;	

create table usuario_comum(
	userC_matricula varchar(15) not null,
    userC_nome varchar(100) not null,
    userC_email varchar(100) not null,
    userC_idUser varchar(50) not null,
    PRIMARY KEY(userC_matricula)	
);

create table usuario_bibliotecario(
	userB_matricula varchar(15) not null,
    userB_nome varchar(100) not null,
    userB_email varchar(100) not null,
    userB_idUser varchar(50) not null,
    PRIMARY KEY(userB_matricula)	
);

create table livro(
	lv_cod_barras int not null,
    lv_patrimonio int not null,
    lv_localizacao varchar(50) not null,
    lv_titulo varchar(200) not null,
    lv_autor varchar(100) not null,
    lv_edicao varchar(50) not null,
    lv_ano varchar(10) not null,
    lv_volume varchar(10) not null,
    lv_situacao enum('disponivel','emprestado','quarentena') not null,
    lv_data_quarentena date default null,
    PRIMARY KEY(lv_cod_barras)	
);

create table agenda(
	agd_codigo int auto_increment not null,
    agd_data date,
    agd_hora_ini time not null,
    agd_hora_fin time not null,
    PRIMARY KEY(agd_codigo)	
);

create table reserva(
	rsv_codigo int auto_increment not null,
    rsv_tipo_reserva enum('retirada','devolucao') not null,
    rsv_data_reserva date not null,
    rsv_hora_reserva time not null,
    rsv_status_reserva enum('ativa','concluida') default 'ativa' not null,
    rsv_matricula_userC varchar(15) not null,
    rsv_codigo_agenda int not null,
    PRIMARY KEY(rsv_codigo),
    FOREIGN KEY (rsv_matricula_userC)
	REFERENCES usuario_comum (userC_matricula),
    FOREIGN KEY (rsv_codigo_agenda)
	REFERENCES agenda (agd_codigo)
);

create table item_reserva(
	it_rsv_codigo int auto_increment not null,
    it_rsv_cod_reserva int not null,
    it_rsv_cod_barra_livro int not null,
    PRIMARY KEY(it_rsv_codigo),
    FOREIGN KEY (it_rsv_cod_reserva)
	REFERENCES reserva (rsv_codigo),
    FOREIGN KEY (it_rsv_cod_barra_livro)
	REFERENCES livro (lv_cod_barras)
);

INSERT INTO agenda (agd_data, agd_hora_ini, agd_hora_fin) 
	VALUES ('2020-11-29', '09:30', '10:30');

INSERT INTO livro (lv_cod_barras, lv_patrimonio, lv_localizacao, lv_titulo, lv_autor, lv_edicao, lv_ano, lv_volume, lv_situacao, lv_data_quarentena) 
	VALUES (215252, 385305, '001.1 A474f', 'Filosofia da ciência : introdução ao jogo e a suas regras', 'Alves, Rubem', '19. ed.', '2015', '', 'disponivel', NULL);

INSERT INTO livro (lv_cod_barras, lv_patrimonio, lv_localizacao, lv_titulo, lv_autor, lv_edicao, lv_ano, lv_volume, lv_situacao, lv_data_quarentena) 
	VALUES (201533, 371378, '001.8 B277f', 'Fundamentos de metodologia científica', 'Barros, Aidil Jesus da Silveira', '3. ed.', 'c2008', '', 'emprestado', NULL);

INSERT INTO livro (lv_cod_barras, lv_patrimonio, lv_localizacao, lv_titulo, lv_autor, lv_edicao, lv_ano, lv_volume, lv_situacao, lv_data_quarentena) 
	VALUES (237502, 407522, '001.8 G463c', 'Como elaborar projetos de pesquisa', 'Gil, Antonio Carlos', '6. ed.', '2017', '', 'emprestado', NULL);

INSERT INTO livro (lv_cod_barras, lv_patrimonio, lv_localizacao, lv_titulo, lv_autor, lv_edicao, lv_ano, lv_volume, lv_situacao, lv_data_quarentena) 
	VALUES (200721, 368853, '001.8 L412c', 'A construção do saber : manual de metodologia da pesquisa em ciências humanas', 'Laville, Christian', '', '1999', '', 'quarentena', NOW());

INSERT INTO usuario_comum (userC_matricula, userC_nome, userC_email, userC_idUser) 
	VALUES ('20171134040027', 'Denilson Felisberto', 'denilsonfelisberto.18.digi@gmail.com', '113293830749542802484');
    
INSERT INTO reserva (rsv_tipo_reserva, rsv_data_reserva, rsv_hora_reserva, rsv_matricula_userC, rsv_codigo_agenda) 
	VALUES ('retirada', '2020-11-29', '09:40', '20171134040027', 1);

INSERT INTO item_reserva (it_rsv_cod_reserva, it_rsv_cod_barra_livro) 
	VALUES (1, 201533);