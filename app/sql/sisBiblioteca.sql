create database sisBiblioteca;

use sisBiblioteca;	

CREATE TABLE usuario_comum(
	userC_matricula varchar(15) NOT NULL,
    userC_nome varchar(100) NOT NULL,
    userC_email varchar(100) NOT NULL,
    userC_idUser varchar(50) NOT NULL,
    PRIMARY KEY(userC_matricula)	
);

CREATE TABLE usuario_bibliotecario(
	userB_matricula varchar(15) NOT NULL,
    userB_nome varchar(100) NOT NULL,
    userB_email varchar(100) NOT NULL,
    userB_idUser varchar(50) NOT NULL,
    PRIMARY KEY(userB_matricula)	
);

CREATE TABLE livro(
	lv_cod_barras int NOT NULL,
    lv_patrimonio int NOT NULL,
    lv_localizacao varchar(50) NOT NULL,
    lv_titulo varchar(200) NOT NULL,
    lv_autor varchar(100) NOT NULL,
    lv_edicao varchar(50) NOT NULL,
    lv_ano varchar(10) NOT NULL,
    lv_volume varchar(10) NOT NULL,
    lv_situacao enum('disponivel','emprestado','quarentena') NOT NULL,
    lv_data_quarentena date DEFAULT NULL,
    PRIMARY KEY(lv_cod_barras)	
);

CREATE TABLE agenda(
	agd_codigo int auto_increment NOT NULL,
    agd_data date,
    agd_hora_ini time NOT NULL,
    agd_hora_fin time NOT NULL,
    PRIMARY KEY(agd_codigo)	
);

CREATE TABLE reserva(
	rsv_codigo int auto_increment NOT NULL,
    rsv_tipo_reserva enum('retirada','devolucao') NOT NULL,
    rsv_data_reserva date NOT NULL,
    rsv_hora_reserva time NOT NULL,
    rsv_status_reserva enum('ativa','concluida') DEFAULT 'ativa' NOT NULL,
    rsv_matricula_userC varchar(15) NOT NULL,
    rsv_codigo_agenda int NOT NULL,
    PRIMARY KEY(rsv_codigo),
    FOREIGN KEY (rsv_matricula_userC)
	REFERENCES usuario_comum (userC_matricula),
    FOREIGN KEY (rsv_codigo_agenda)
	REFERENCES agenda (agd_codigo)
);

CREATE TABLE item_reserva(
	it_rsv_codigo int auto_increment NOT NULL,
    it_rsv_cod_reserva int NOT NULL,
    it_rsv_cod_barra_livro int NOT NULL,
    PRIMARY KEY(it_rsv_codigo),
    FOREIGN KEY (it_rsv_cod_reserva)
	REFERENCES reserva (rsv_codigo),
    FOREIGN KEY (it_rsv_cod_barra_livro)
	REFERENCES livro (lv_cod_barras)
);

/* Começo auditoria usuario_comum */

CREATE TABLE auditoria_usuario_comum (
    operacao VARCHAR(10) NOT NULL,
    data_ocorrencia TIMESTAMP NOT NULL,
    userC_matricula varchar(15) NOT NULL,
    userC_nome varchar(100) NOT NULL,
    userC_email varchar(100) NOT NULL,
    userC_idUser varchar(50) NOT NULL
);

CREATE TRIGGER insert_usuario_comum 
    AFTER INSERT ON usuario_comum
    FOR EACH ROW 
    INSERT INTO auditoria_usuario_comum
        SET operacao = 'INSERT',
         data_ocorrencia = NOW(),
         userC_matricula = NEW.userC_matricula,
         userC_nome = NEW.userC_nome,
         userC_email = NEW.userC_email,
         userC_idUser = NEW.userC_idUser;

CREATE TRIGGER update_usuario_comum 
    AFTER UPDATE ON usuario_comum
    FOR EACH ROW 
    INSERT INTO auditoria_usuario_comum
        SET operacao = 'UPDATE',
         data_ocorrencia = NOW(),
         userC_matricula = NEW.userC_matricula,
         userC_nome = NEW.userC_nome,
         userC_email = NEW.userC_email,
         userC_idUser = NEW.userC_idUser;

CREATE TRIGGER delete_usuario_comum 
    AFTER DELETE ON usuario_comum
    FOR EACH ROW 
    INSERT INTO auditoria_usuario_comum
        SET operacao = 'DELETE',
         data_ocorrencia = NOW(),
         userC_matricula = OLD.userC_matricula,
         userC_nome = OLD.userC_nome,
         userC_email = OLD.userC_email,
         userC_idUser = OLD.userC_idUser;

/* Fim auditoria usuario_comum */

/* Começo auditoria usuario_bibliotecario */

CREATE TABLE auditoria_usuario_bibliotecario (
    operacao VARCHAR(10) NOT NULL,
    data_ocorrencia TIMESTAMP NOT NULL,
    userB_matricula varchar(15) NOT NULL,
    userB_nome varchar(100) NOT NULL,
    userB_email varchar(100) NOT NULL,
    userB_idUser varchar(50) NOT NULL
);

CREATE TRIGGER insert_usuario_bibliotecario 
    AFTER INSERT ON usuario_bibliotecario
    FOR EACH ROW 
    INSERT INTO auditoria_usuario_bibliotecario
        SET operacao = 'INSERT',
         data_ocorrencia = NOW(),
         userB_matricula = NEW.userB_matricula,
         userB_nome = NEW.userB_nome,
         userB_email = NEW.userB_email,
         userB_idUser = NEW.userB_idUser;

CREATE TRIGGER update_usuario_bibliotecario
    AFTER UPDATE ON usuario_bibliotecario
    FOR EACH ROW 
    INSERT INTO auditoria_usuario_bibliotecario
        SET operacao = 'UPDATE',
         data_ocorrencia = NOW(),
         userB_matricula = NEW.userB_matricula,
         userB_nome = NEW.userB_nome,
         userB_email = NEW.userB_email,
         userB_idUser = NEW.userB_idUser;

CREATE TRIGGER delete_usuario_bibliotecario
    AFTER DELETE ON usuario_bibliotecario
    FOR EACH ROW 
    INSERT INTO auditoria_usuario_bibliotecario
        SET operacao = 'DELETE',
         data_ocorrencia = NOW(),
         userB_matricula = OLD.userB_matricula,
         userB_nome = OLD.userB_nome,
         userB_email = OLD.userB_email,
         userB_idUser = OLD.userB_idUser;

/* Fim auditoria usuario_bibliotecario */

/* Começo auditoria livro */

CREATE TABLE auditoria_livro (
    operacao VARCHAR(10) NOT NULL,
    data_ocorrencia TIMESTAMP NOT NULL,
    lv_cod_barras int NOT NULL,
    lv_patrimonio int NOT NULL,
    lv_localizacao varchar(50) NOT NULL,
    lv_titulo varchar(200) NOT NULL,
    lv_autor varchar(100) NOT NULL,
    lv_edicao varchar(50) NOT NULL,
    lv_ano varchar(10) NOT NULL,
    lv_volume varchar(10) NOT NULL,
    lv_situacao enum('disponivel','emprestado','quarentena') NOT NULL,
    lv_data_quarentena date DEFAULT NULL
);

CREATE TRIGGER insert_livro
    AFTER INSERT ON livro
    FOR EACH ROW 
    INSERT INTO auditoria_livro
        SET operacao = 'INSERT',
         data_ocorrencia = NOW(),
         lv_cod_barras = NEW.lv_cod_barras,
         lv_patrimonio = NEW.lv_patrimonio,
         lv_localizacao = NEW.lv_localizacao,
         lv_titulo = NEW.lv_titulo,
         lv_autor = NEW.lv_autor,
         lv_edicao = NEW.lv_edicao,
         lv_ano = NEW.lv_ano,
         lv_volume = NEW.lv_volume,
         lv_situacao = NEW.lv_situacao,
         lv_data_quarentena = NEW.lv_data_quarentena;

CREATE TRIGGER update_livro
    AFTER UPDATE ON livro
    FOR EACH ROW 
    INSERT INTO auditoria_livro
        SET operacao = 'UPDATE',
         data_ocorrencia = NOW(),
         lv_cod_barras = NEW.lv_cod_barras,
         lv_patrimonio = NEW.lv_patrimonio,
         lv_localizacao = NEW.lv_localizacao,
         lv_titulo = NEW.lv_titulo,
         lv_autor = NEW.lv_autor,
         lv_edicao = NEW.lv_edicao,
         lv_ano = NEW.lv_ano,
         lv_volume = NEW.lv_volume,
         lv_situacao = NEW.lv_situacao,
         lv_data_quarentena = NEW.lv_data_quarentena;

CREATE TRIGGER delete_livro
    AFTER DELETE ON livro
    FOR EACH ROW 
    INSERT INTO auditoria_livro
        SET operacao = 'DELETE',
         data_ocorrencia = NOW(),
         lv_cod_barras = OLD.lv_cod_barras,
         lv_patrimonio = OLD.lv_patrimonio,
         lv_localizacao = OLD.lv_localizacao,
         lv_titulo = OLD.lv_titulo,
         lv_autor = OLD.lv_autor,
         lv_edicao = OLD.lv_edicao,
         lv_ano = OLD.lv_ano,
         lv_volume = OLD.lv_volume,
         lv_situacao = OLD.lv_situacao,
         lv_data_quarentena = OLD.lv_data_quarentena;

/* Fim auditoria livro */

/* Começo auditoria agenda */

CREATE TABLE auditoria_agenda (
    operacao VARCHAR(10) NOT NULL,
    data_ocorrencia TIMESTAMP NOT NULL,
    agd_codigo int NOT NULL,
    agd_data date,
    agd_hora_ini time NOT NULL,
    agd_hora_fin time NOT NULL
);

CREATE TRIGGER insert_agenda
    AFTER INSERT ON agenda
    FOR EACH ROW 
    INSERT INTO auditoria_agenda
        SET operacao = 'INSERT',
         data_ocorrencia = NOW(),
         agd_codigo = NEW.agd_codigo,
         agd_data = NEW.agd_data,
         agd_hora_ini = NEW.agd_hora_ini,
         agd_hora_fin = NEW.agd_hora_fin;

CREATE TRIGGER update_agenda
    AFTER UPDATE ON agenda
    FOR EACH ROW 
    INSERT INTO auditoria_agenda
        SET operacao = 'UPDATE',
         data_ocorrencia = NOW(),
         agd_codigo = NEW.agd_codigo,
         agd_data = NEW.agd_data,
         agd_hora_ini = NEW.agd_hora_ini,
         agd_hora_fin = NEW.agd_hora_fin;

CREATE TRIGGER delete_agenda
    AFTER DELETE ON agenda
    FOR EACH ROW 
    INSERT INTO auditoria_agenda
        SET operacao = 'DELETE',
         data_ocorrencia = NOW(),
         agd_codigo = OLD.agd_codigo,
         agd_data = OLD.agd_data,
         agd_hora_ini = OLD.agd_hora_ini,
         agd_hora_fin = OLD.agd_hora_fin;

/* Fim auditoria agenda */

/* Começo auditoria reserva */

CREATE TABLE auditoria_reserva (
    operacao VARCHAR(10) NOT NULL,
    data_ocorrencia TIMESTAMP NOT NULL,
    rsv_codigo int NOT NULL,
    rsv_tipo_reserva enum('retirada','devolucao') NOT NULL,
    rsv_data_reserva date NOT NULL,
    rsv_hora_reserva time NOT NULL,
    rsv_status_reserva enum('ativa','concluida') DEFAULT 'ativa' NOT NULL,
    rsv_matricula_userC varchar(15) NOT NULL,
    rsv_codigo_agenda int NOT NULL
);

CREATE TRIGGER insert_reserva
    AFTER INSERT ON reserva
    FOR EACH ROW 
    INSERT INTO auditoria_reserva
        SET operacao = 'INSERT',
         data_ocorrencia = NOW(),
         rsv_codigo = NEW.rsv_codigo,
         rsv_tipo_reserva = NEW.rsv_tipo_reserva,
         rsv_data_reserva = NEW.rsv_data_reserva,
         rsv_hora_reserva = NEW.rsv_hora_reserva,
         rsv_status_reserva = NEW.rsv_status_reserva,
         rsv_matricula_userC = NEW.rsv_matricula_userC,
         rsv_codigo_agenda = NEW.rsv_codigo_agenda;

CREATE TRIGGER update_reserva
    AFTER UPDATE ON reserva
    FOR EACH ROW 
    INSERT INTO auditoria_reserva
        SET operacao = 'UPDATE',
         data_ocorrencia = NOW(),
         rsv_codigo = NEW.rsv_codigo,
         rsv_tipo_reserva = NEW.rsv_tipo_reserva,
         rsv_data_reserva = NEW.rsv_data_reserva,
         rsv_hora_reserva = NEW.rsv_hora_reserva,
         rsv_status_reserva = NEW.rsv_status_reserva,
         rsv_matricula_userC = NEW.rsv_matricula_userC,
         rsv_codigo_agenda = NEW.rsv_codigo_agenda;

CREATE TRIGGER delete_reserva
    AFTER DELETE ON reserva
    FOR EACH ROW 
    INSERT INTO auditoria_reserva
        SET operacao = 'DELETE',
         data_ocorrencia = NOW(),
         rsv_codigo = OLD.rsv_codigo,
         rsv_tipo_reserva = OLD.rsv_tipo_reserva,
         rsv_data_reserva = OLD.rsv_data_reserva,
         rsv_hora_reserva = OLD.rsv_hora_reserva,
         rsv_status_reserva = OLD.rsv_status_reserva,
         rsv_matricula_userC = OLD.rsv_matricula_userC,
         rsv_codigo_agenda = OLD.rsv_codigo_agenda;

/* Fim auditoria reserva */

/* Começo auditoria item_reserva */

CREATE TABLE auditoria_item_reserva (
    operacao VARCHAR(10) NOT NULL,
    data_ocorrencia TIMESTAMP NOT NULL,
    it_rsv_codigo int NOT NULL,
    it_rsv_cod_reserva int NOT NULL,
    it_rsv_cod_barra_livro int NOT NULL
);

CREATE TRIGGER insert_item_reserva
    AFTER INSERT ON item_reserva
    FOR EACH ROW 
    INSERT INTO auditoria_item_reserva
        SET operacao = 'INSERT',
         data_ocorrencia = NOW(),
         it_rsv_codigo = NEW.it_rsv_codigo,
         it_rsv_cod_reserva = NEW.it_rsv_cod_reserva,
         it_rsv_cod_barra_livro = NEW.it_rsv_cod_barra_livro;

CREATE TRIGGER update_item_reserva
    AFTER UPDATE ON item_reserva
    FOR EACH ROW 
    INSERT INTO auditoria_item_reserva
        SET operacao = 'UPDATE',
         data_ocorrencia = NOW(),
         it_rsv_codigo = NEW.it_rsv_codigo,
         it_rsv_cod_reserva = NEW.it_rsv_cod_reserva,
         it_rsv_cod_barra_livro = NEW.it_rsv_cod_barra_livro;

CREATE TRIGGER delete_item_reserva
    AFTER DELETE ON item_reserva
    FOR EACH ROW 
    INSERT INTO auditoria_item_reserva
        SET operacao = 'DELETE',
         data_ocorrencia = NOW(),
         it_rsv_codigo = OLD.it_rsv_codigo,
         it_rsv_cod_reserva = OLD.it_rsv_cod_reserva,
         it_rsv_cod_barra_livro = OLD.it_rsv_cod_barra_livro;

/* Fim auditoria item_reserva */

INSERT INTO agenda (agd_data, agd_hora_ini, agd_hora_fin) 
	VALUES ('2020-11-29', '09:30', '10:30');

INSERT INTO livro (lv_cod_barras, lv_patrimonio, lv_localizacao, lv_titulo, lv_autor, lv_edicao, lv_ano, lv_volume, lv_situacao, lv_data_quarentena) 
	VALUES (215252, 385305, '001.1 A474f', 'Filosofia da ciência : introdução ao jogo e a suas regras', 'Alves, Rubem', '19. ed.', '2015', '', 'disponivel', NULL);

INSERT INTO livro (lv_cod_barras, lv_patrimonio, lv_localizacao, lv_titulo, lv_autor, lv_edicao, lv_ano, lv_volume, lv_situacao, lv_data_quarentena) 
	VALUES (201533, 371378, '001.8 B277f', 'Fundamentos de metodologia científica', 'Barros, Aidil Jesus da Silveira', '3. ed.', 'c2008', '', 'disponivel', NULL);

INSERT INTO livro (lv_cod_barras, lv_patrimonio, lv_localizacao, lv_titulo, lv_autor, lv_edicao, lv_ano, lv_volume, lv_situacao, lv_data_quarentena) 
	VALUES (237502, 407522, '001.8 G463c', 'Como elaborar projetos de pesquisa', 'Gil, Antonio Carlos', '6. ed.', '2017', '', 'disponivel', NULL);

INSERT INTO livro (lv_cod_barras, lv_patrimonio, lv_localizacao, lv_titulo, lv_autor, lv_edicao, lv_ano, lv_volume, lv_situacao, lv_data_quarentena) 
	VALUES (200721, 368853, '001.8 L412c', 'A construção do saber : manual de metodologia da pesquisa em ciências humanas', 'Laville, Christian', '', '1999', '', 'disponivel', NULL);
    
INSERT INTO usuario_bibliotecario (userB_matricula, userB_nome, userB_email, userB_idUser) 
	VALUES ('20200101', 'Denilson Felisberto', 'denilsonfelisberto.19.digi@gmail.com', '116669301135508743222');

INSERT INTO usuario_comum (userC_matricula, userC_nome, userC_email, userC_idUser) 
	VALUES ('20171134040027', 'Denilson Felisberto de Medeiros', 'f.denilson@escolar.ifrn.edu.br', '107763917627751515047');
    
