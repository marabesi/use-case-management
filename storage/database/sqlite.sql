CREATE TABLE ator (
    id_ator integer PRIMARY KEY AUTOINCREMENT,
    nome character varying(80) NOT NULL,
    descricao text NOT NULL
);

CREATE TABLE caso_de_uso (
    id_caso_de_uso integer PRIMARY KEY AUTOINCREMENT,
    id_sistema integer NOT NULL,
    descricao text NOT NULL,
    status integer NOT NULL,
    pre_condicao text,
    pos_condicao text
);

CREATE TABLE dados_revisao (
    id_dados_revisao integer PRIMARY KEY AUTOINCREMENT,
    descricao text NOT NULL,
    versao character varying(45) NOT NULL
);

CREATE TABLE fluxo (
    id_fluxo integer PRIMARY KEY AUTOINCREMENT,
    tipo smallint NOT NULL,
    id_revisao integer NOT NULL
);

CREATE TABLE informacao_complementar (
    id_informacao_complementar integer PRIMARY KEY AUTOINCREMENT,
    identificador character varying(45) NOT NULL,
    descricao text NOT NULL,
    id_sistema integer NOT NULL
);

CREATE TABLE passos (
    id_passos integer PRIMARY KEY AUTOINCREMENT,
    id_fluxo integer NOT NULL,
    identificador character varying(45) NOT NULL,
    descricao character varying(45) NOT NULL
);

CREATE TABLE referencia (
    id_referencia integer PRIMARY KEY AUTOINCREMENT,
    identificador character varying(45) NOT NULL,
    descricao text NOT NULL,
    id_sistema integer NOT NULL
);

CREATE TABLE regra_de_negocio (
    id_regra_de_negocio integer PRIMARY KEY AUTOINCREMENT,
    identificador character varying(45) NOT NULL,
    descricao text NOT NULL,
    id_sistema integer NOT NULL
);

CREATE TABLE relacionamento_dados_revisao (
    id_relacionamento_dados_revisao integer PRIMARY KEY AUTOINCREMENT,
    id_ator integer NOT NULL,
    id_dados_revisao integer NOT NULL,
    id_revisao integer NOT NULL
);

CREATE TABLE relacionamento_informacao_complementar (
    id_informacao_complementar integer NOT NULL,
    id_passos integer NOT NULL
);

CREATE TABLE relacionamento_referencia (
    id_referencia integer NOT NULL,
    id_passos integer NOT NULL
);

CREATE TABLE relacionamento_regra_de_negocio (
    id_regra_de_negocio integer NOT NULL,
    id_passos integer NOT NULL
);

CREATE TABLE revisao (
    id_revisao integer PRIMARY KEY AUTOINCREMENT,
    id_caso_de_uso integer NOT NULL,
    id_dados_revisao integer NOT NULL
);

CREATE TABLE sistema (
    id_sistema integer PRIMARY KEY AUTOINCREMENT,
    nome character varying(80) NOT NULL
);
