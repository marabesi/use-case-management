--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner:
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner:
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: ator; Type: TABLE; Schema: public; Owner: postgres; Tablespace:
--

CREATE TABLE ator (
    id_ator integer NOT NULL,
    nome character varying(80) NOT NULL,
    descricao text NOT NULL
);


ALTER TABLE public.ator OWNER TO postgres;

--
-- Name: ator_id_ator_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE ator_id_ator_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.ator_id_ator_seq OWNER TO postgres;

--
-- Name: ator_id_ator_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE ator_id_ator_seq OWNED BY ator.id_ator;


--
-- Name: caso_de_uso; Type: TABLE; Schema: public; Owner: postgres; Tablespace:
--

CREATE TABLE caso_de_uso (
    id_caso_de_uso integer NOT NULL,
    id_sistema integer NOT NULL,
    descricao text NOT NULL,
    status integer NOT NULL,
    pre_condicao text,
    pos_condicao text
);


ALTER TABLE public.caso_de_uso OWNER TO postgres;

--
-- Name: caso_de_uso_id_caso_de_uso_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE caso_de_uso_id_caso_de_uso_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.caso_de_uso_id_caso_de_uso_seq OWNER TO postgres;

--
-- Name: caso_de_uso_id_caso_de_uso_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE caso_de_uso_id_caso_de_uso_seq OWNED BY caso_de_uso.id_caso_de_uso;


--
-- Name: dados_revisao; Type: TABLE; Schema: public; Owner: postgres; Tablespace:
--

CREATE TABLE dados_revisao (
    id_dados_revisao integer NOT NULL,
    descricao text NOT NULL,
    versao character varying(45) NOT NULL
);


ALTER TABLE public.dados_revisao OWNER TO postgres;

--
-- Name: dados_revisao_id_dados_revisao_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE dados_revisao_id_dados_revisao_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.dados_revisao_id_dados_revisao_seq OWNER TO postgres;

--
-- Name: dados_revisao_id_dados_revisao_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE dados_revisao_id_dados_revisao_seq OWNED BY dados_revisao.id_dados_revisao;


--
-- Name: fluxo; Type: TABLE; Schema: public; Owner: postgres; Tablespace:
--

CREATE TABLE fluxo (
    id_fluxo integer NOT NULL,
    tipo smallint NOT NULL,
    id_revisao integer NOT NULL
);


ALTER TABLE public.fluxo OWNER TO postgres;

--
-- Name: fluxo_id_fluxo_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE fluxo_id_fluxo_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.fluxo_id_fluxo_seq OWNER TO postgres;

--
-- Name: fluxo_id_fluxo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE fluxo_id_fluxo_seq OWNED BY fluxo.id_fluxo;


--
-- Name: informacao_complementar; Type: TABLE; Schema: public; Owner: postgres; Tablespace:
--

CREATE TABLE informacao_complementar (
    id_informacao_complementar integer NOT NULL,
    identificador character varying(45) NOT NULL,
    descricao text NOT NULL,
    id_sistema integer NOT NULL
);


ALTER TABLE public.informacao_complementar OWNER TO postgres;

--
-- Name: informacao_complementar_id_informacao_complementar_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE informacao_complementar_id_informacao_complementar_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.informacao_complementar_id_informacao_complementar_seq OWNER TO postgres;

--
-- Name: informacao_complementar_id_informacao_complementar_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE informacao_complementar_id_informacao_complementar_seq OWNED BY informacao_complementar.id_informacao_complementar;


--
-- Name: migrations; Type: TABLE; Schema: public; Owner: postgres; Tablespace:
--

CREATE TABLE migrations (
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


ALTER TABLE public.migrations OWNER TO postgres;

--
-- Name: passos; Type: TABLE; Schema: public; Owner: postgres; Tablespace:
--

CREATE TABLE passos (
    id_passos integer NOT NULL,
    id_fluxo integer NOT NULL,
    identificador character varying(45) NOT NULL,
    descricao character varying(45) NOT NULL
);


ALTER TABLE public.passos OWNER TO postgres;

--
-- Name: passos_id_passos_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE passos_id_passos_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.passos_id_passos_seq OWNER TO postgres;

--
-- Name: passos_id_passos_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE passos_id_passos_seq OWNED BY passos.id_passos;


--
-- Name: referencia; Type: TABLE; Schema: public; Owner: postgres; Tablespace:
--

CREATE TABLE referencia (
    id_referencia integer NOT NULL,
    identificador character varying(45) NOT NULL,
    descricao text NOT NULL,
    id_sistema integer NOT NULL
);


ALTER TABLE public.referencia OWNER TO postgres;

--
-- Name: referencia_id_referencia_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE referencia_id_referencia_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.referencia_id_referencia_seq OWNER TO postgres;

--
-- Name: referencia_id_referencia_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE referencia_id_referencia_seq OWNED BY referencia.id_referencia;


--
-- Name: regra_de_negocio; Type: TABLE; Schema: public; Owner: postgres; Tablespace:
--

CREATE TABLE regra_de_negocio (
    id_regra_de_negocio integer NOT NULL,
    identificador character varying(45) NOT NULL,
    descricao text NOT NULL,
    id_sistema integer NOT NULL
);


ALTER TABLE public.regra_de_negocio OWNER TO postgres;

--
-- Name: regra_de_negocio_id_regra_de_negocio_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE regra_de_negocio_id_regra_de_negocio_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.regra_de_negocio_id_regra_de_negocio_seq OWNER TO postgres;

--
-- Name: regra_de_negocio_id_regra_de_negocio_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE regra_de_negocio_id_regra_de_negocio_seq OWNED BY regra_de_negocio.id_regra_de_negocio;


--
-- Name: relacionamento_dados_revisao; Type: TABLE; Schema: public; Owner: postgres; Tablespace:
--

CREATE TABLE relacionamento_dados_revisao (
    id_relacionamento_dados_revisao integer NOT NULL,
    id_ator integer NOT NULL,
    id_dados_revisao integer NOT NULL,
    id_revisao integer NOT NULL
);


ALTER TABLE public.relacionamento_dados_revisao OWNER TO postgres;

--
-- Name: relacionamento_dados_revisao_id_relacionamento_dados_revisao_se; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE relacionamento_dados_revisao_id_relacionamento_dados_revisao_se
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.relacionamento_dados_revisao_id_relacionamento_dados_revisao_se OWNER TO postgres;

--
-- Name: relacionamento_dados_revisao_id_relacionamento_dados_revisao_se; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE relacionamento_dados_revisao_id_relacionamento_dados_revisao_se OWNED BY relacionamento_dados_revisao.id_relacionamento_dados_revisao;


--
-- Name: relacionamento_informacao_complementar; Type: TABLE; Schema: public; Owner: postgres; Tablespace:
--

CREATE TABLE relacionamento_informacao_complementar (
    id_informacao_complementar integer NOT NULL,
    id_passos integer NOT NULL
);


ALTER TABLE public.relacionamento_informacao_complementar OWNER TO postgres;

--
-- Name: relacionamento_referencia; Type: TABLE; Schema: public; Owner: postgres; Tablespace:
--

CREATE TABLE relacionamento_referencia (
    id_referencia integer NOT NULL,
    id_passos integer NOT NULL
);


ALTER TABLE public.relacionamento_referencia OWNER TO postgres;

--
-- Name: relacionamento_regra_de_negocio; Type: TABLE; Schema: public; Owner: postgres; Tablespace:
--

CREATE TABLE relacionamento_regra_de_negocio (
    id_regra_de_negocio integer NOT NULL,
    id_passos integer NOT NULL
);


ALTER TABLE public.relacionamento_regra_de_negocio OWNER TO postgres;

--
-- Name: revisao; Type: TABLE; Schema: public; Owner: postgres; Tablespace:
--

CREATE TABLE revisao (
    id_revisao integer NOT NULL,
    id_caso_de_uso integer NOT NULL,
    id_dados_revisao integer NOT NULL
);


ALTER TABLE public.revisao OWNER TO postgres;

--
-- Name: revisao_id_revisao_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE revisao_id_revisao_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.revisao_id_revisao_seq OWNER TO postgres;

--
-- Name: revisao_id_revisao_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE revisao_id_revisao_seq OWNED BY revisao.id_revisao;


--
-- Name: sistema; Type: TABLE; Schema: public; Owner: postgres; Tablespace:
--

CREATE TABLE sistema (
    id_sistema integer NOT NULL,
    nome character varying(80) NOT NULL
);


ALTER TABLE public.sistema OWNER TO postgres;

--
-- Name: sistema_id_sistema_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sistema_id_sistema_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.sistema_id_sistema_seq OWNER TO postgres;

--
-- Name: sistema_id_sistema_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE sistema_id_sistema_seq OWNED BY sistema.id_sistema;


--
-- Name: id_ator; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY ator ALTER COLUMN id_ator SET DEFAULT nextval('ator_id_ator_seq'::regclass);


--
-- Name: id_caso_de_uso; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY caso_de_uso ALTER COLUMN id_caso_de_uso SET DEFAULT nextval('caso_de_uso_id_caso_de_uso_seq'::regclass);


--
-- Name: id_dados_revisao; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY dados_revisao ALTER COLUMN id_dados_revisao SET DEFAULT nextval('dados_revisao_id_dados_revisao_seq'::regclass);


--
-- Name: id_fluxo; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY fluxo ALTER COLUMN id_fluxo SET DEFAULT nextval('fluxo_id_fluxo_seq'::regclass);


--
-- Name: id_informacao_complementar; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY informacao_complementar ALTER COLUMN id_informacao_complementar SET DEFAULT nextval('informacao_complementar_id_informacao_complementar_seq'::regclass);


--
-- Name: id_passos; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY passos ALTER COLUMN id_passos SET DEFAULT nextval('passos_id_passos_seq'::regclass);


--
-- Name: id_referencia; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY referencia ALTER COLUMN id_referencia SET DEFAULT nextval('referencia_id_referencia_seq'::regclass);


--
-- Name: id_regra_de_negocio; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY regra_de_negocio ALTER COLUMN id_regra_de_negocio SET DEFAULT nextval('regra_de_negocio_id_regra_de_negocio_seq'::regclass);


--
-- Name: id_relacionamento_dados_revisao; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY relacionamento_dados_revisao ALTER COLUMN id_relacionamento_dados_revisao SET DEFAULT nextval('relacionamento_dados_revisao_id_relacionamento_dados_revisao_se'::regclass);


--
-- Name: id_revisao; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY revisao ALTER COLUMN id_revisao SET DEFAULT nextval('revisao_id_revisao_seq'::regclass);


--
-- Name: id_sistema; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sistema ALTER COLUMN id_sistema SET DEFAULT nextval('sistema_id_sistema_seq'::regclass);


--
-- Data for Name: ator; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY ator (id_ator, nome, descricao) FROM stdin;
1	ATOR1	ATOR1
\.


--
-- Name: ator_id_ator_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('ator_id_ator_seq', 970, true);


--
-- Data for Name: caso_de_uso; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY caso_de_uso (id_caso_de_uso, id_sistema, descricao, status, pre_condicao, pos_condicao) FROM stdin;
1	1	TESTE	1	TESTE	TESTE
645	1	assasa	1	assa	asas
\.


--
-- Name: caso_de_uso_id_caso_de_uso_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('caso_de_uso_id_caso_de_uso_seq', 653, true);


--
-- Data for Name: dados_revisao; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY dados_revisao (id_dados_revisao, descricao, versao) FROM stdin;
1	V1	V1
\.


--
-- Name: dados_revisao_id_dados_revisao_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('dados_revisao_id_dados_revisao_seq', 859, true);


--
-- Data for Name: fluxo; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY fluxo (id_fluxo, tipo, id_revisao) FROM stdin;
381	1	1
11	1	1
\.


--
-- Name: fluxo_id_fluxo_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('fluxo_id_fluxo_seq', 396, true);


--
-- Data for Name: informacao_complementar; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY informacao_complementar (id_informacao_complementar, identificador, descricao, id_sistema) FROM stdin;
104	eita	eita	1
105	eita 2	eita 2	1
\.


--
-- Name: informacao_complementar_id_informacao_complementar_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('informacao_complementar_id_informacao_complementar_seq', 459, true);


--
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY migrations (migration, batch) FROM stdin;
\.


--
-- Data for Name: passos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY passos (id_passos, id_fluxo, identificador, descricao) FROM stdin;
381	381	RF2	TRETA
11	11	sasa	asassa
\.


--
-- Name: passos_id_passos_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('passos_id_passos_seq', 396, true);


--
-- Data for Name: referencia; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY referencia (id_referencia, identificador, descricao, id_sistema) FROM stdin;
49	eita 1	eita 1	1
\.


--
-- Name: referencia_id_referencia_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('referencia_id_referencia_seq', 339, true);


--
-- Data for Name: regra_de_negocio; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY regra_de_negocio (id_regra_de_negocio, identificador, descricao, id_sistema) FROM stdin;
49	eita 1	eita 1	1
50	eita 1	eita 1	1
51	eita 1	eita 1	1
52	eita 1	eita 1	1
\.


--
-- Name: regra_de_negocio_id_regra_de_negocio_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('regra_de_negocio_id_regra_de_negocio_seq', 342, true);


--
-- Data for Name: relacionamento_dados_revisao; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY relacionamento_dados_revisao (id_relacionamento_dados_revisao, id_ator, id_dados_revisao, id_revisao) FROM stdin;
1	1	1	1
645	1	1	645
\.


--
-- Name: relacionamento_dados_revisao_id_relacionamento_dados_revisao_se; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('relacionamento_dados_revisao_id_relacionamento_dados_revisao_se', 653, true);


--
-- Data for Name: relacionamento_informacao_complementar; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY relacionamento_informacao_complementar (id_informacao_complementar, id_passos) FROM stdin;
\.


--
-- Data for Name: relacionamento_referencia; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY relacionamento_referencia (id_referencia, id_passos) FROM stdin;
\.


--
-- Data for Name: relacionamento_regra_de_negocio; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY relacionamento_regra_de_negocio (id_regra_de_negocio, id_passos) FROM stdin;
\.


--
-- Data for Name: revisao; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY revisao (id_revisao, id_caso_de_uso, id_dados_revisao) FROM stdin;
1	1	1
645	645	1
\.


--
-- Name: revisao_id_revisao_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('revisao_id_revisao_seq', 653, true);


--
-- Data for Name: sistema; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sistema (id_sistema, nome) FROM stdin;
1	SISTEMA1
1384	SISTEMA MAROTÃO
\.


--
-- Name: sistema_id_sistema_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('sistema_id_sistema_seq', 1384, true);


--
-- Name: ator_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace:
--

ALTER TABLE ONLY ator
    ADD CONSTRAINT ator_pkey PRIMARY KEY (id_ator);


--
-- Name: caso_de_uso_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace:
--

ALTER TABLE ONLY caso_de_uso
    ADD CONSTRAINT caso_de_uso_pkey PRIMARY KEY (id_caso_de_uso);


--
-- Name: dados_revisao_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace:
--

ALTER TABLE ONLY dados_revisao
    ADD CONSTRAINT dados_revisao_pkey PRIMARY KEY (id_dados_revisao);


--
-- Name: fluxo_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace:
--

ALTER TABLE ONLY fluxo
    ADD CONSTRAINT fluxo_pkey PRIMARY KEY (id_fluxo);


--
-- Name: informacao_complementar_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace:
--

ALTER TABLE ONLY informacao_complementar
    ADD CONSTRAINT informacao_complementar_pkey PRIMARY KEY (id_informacao_complementar);


--
-- Name: passos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace:
--

ALTER TABLE ONLY passos
    ADD CONSTRAINT passos_pkey PRIMARY KEY (id_passos);


--
-- Name: referencia_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace:
--

ALTER TABLE ONLY referencia
    ADD CONSTRAINT referencia_pkey PRIMARY KEY (id_referencia);


--
-- Name: regra_de_negocio_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace:
--

ALTER TABLE ONLY regra_de_negocio
    ADD CONSTRAINT regra_de_negocio_pkey PRIMARY KEY (id_regra_de_negocio);


--
-- Name: relacionamento_dados_revisao_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace:
--

ALTER TABLE ONLY relacionamento_dados_revisao
    ADD CONSTRAINT relacionamento_dados_revisao_pkey PRIMARY KEY (id_relacionamento_dados_revisao);


--
-- Name: relacionamento_informacao_complementar_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace:
--

ALTER TABLE ONLY relacionamento_informacao_complementar
    ADD CONSTRAINT relacionamento_informacao_complementar_pkey PRIMARY KEY (id_informacao_complementar, id_passos);


--
-- Name: relacionamento_referencia_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace:
--

ALTER TABLE ONLY relacionamento_referencia
    ADD CONSTRAINT relacionamento_referencia_pkey PRIMARY KEY (id_referencia, id_passos);


--
-- Name: relacionamento_regra_de_negocio_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace:
--

ALTER TABLE ONLY relacionamento_regra_de_negocio
    ADD CONSTRAINT relacionamento_regra_de_negocio_pkey PRIMARY KEY (id_regra_de_negocio, id_passos);


--
-- Name: revisao_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace:
--

ALTER TABLE ONLY revisao
    ADD CONSTRAINT revisao_pkey PRIMARY KEY (id_revisao);


--
-- Name: sistema_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace:
--

ALTER TABLE ONLY sistema
    ADD CONSTRAINT sistema_pkey PRIMARY KEY (id_sistema);


--
-- Name: public_caso_de_uso_id_sistema1_idx; Type: INDEX; Schema: public; Owner: postgres; Tablespace:
--

CREATE INDEX public_caso_de_uso_id_sistema1_idx ON caso_de_uso USING btree (id_sistema);


--
-- Name: public_fluxo_id_revisao1_idx; Type: INDEX; Schema: public; Owner: postgres; Tablespace:
--

CREATE INDEX public_fluxo_id_revisao1_idx ON fluxo USING btree (id_revisao);


--
-- Name: public_informacao_complementar_id_sistema1_idx; Type: INDEX; Schema: public; Owner: postgres; Tablespace:
--

CREATE INDEX public_informacao_complementar_id_sistema1_idx ON informacao_complementar USING btree (id_sistema);


--
-- Name: public_passos_id_fluxo1_idx; Type: INDEX; Schema: public; Owner: postgres; Tablespace:
--

CREATE INDEX public_passos_id_fluxo1_idx ON passos USING btree (id_fluxo);


--
-- Name: public_referencia_id_sistema1_idx; Type: INDEX; Schema: public; Owner: postgres; Tablespace:
--

CREATE INDEX public_referencia_id_sistema1_idx ON referencia USING btree (id_sistema);


--
-- Name: public_regra_de_negocio_id_sistema1_idx; Type: INDEX; Schema: public; Owner: postgres; Tablespace:
--

CREATE INDEX public_regra_de_negocio_id_sistema1_idx ON regra_de_negocio USING btree (id_sistema);


--
-- Name: public_relacionamento_dados_revisao_id_ator1_idx; Type: INDEX; Schema: public; Owner: postgres; Tablespace:
--

CREATE INDEX public_relacionamento_dados_revisao_id_ator1_idx ON relacionamento_dados_revisao USING btree (id_ator);


--
-- Name: public_relacionamento_dados_revisao_id_dados_revisao2_idx; Type: INDEX; Schema: public; Owner: postgres; Tablespace:
--

CREATE INDEX public_relacionamento_dados_revisao_id_dados_revisao2_idx ON relacionamento_dados_revisao USING btree (id_dados_revisao);


--
-- Name: public_relacionamento_dados_revisao_id_revisao3_idx; Type: INDEX; Schema: public; Owner: postgres; Tablespace:
--

CREATE INDEX public_relacionamento_dados_revisao_id_revisao3_idx ON relacionamento_dados_revisao USING btree (id_revisao);


--
-- Name: public_relacionamento_informacao_complementar_id_informacao_com; Type: INDEX; Schema: public; Owner: postgres; Tablespace:
--

CREATE INDEX public_relacionamento_informacao_complementar_id_informacao_com ON relacionamento_informacao_complementar USING btree (id_informacao_complementar);


--
-- Name: public_relacionamento_informacao_complementar_id_passos1_idx; Type: INDEX; Schema: public; Owner: postgres; Tablespace:
--

CREATE INDEX public_relacionamento_informacao_complementar_id_passos1_idx ON relacionamento_informacao_complementar USING btree (id_passos);


--
-- Name: public_relacionamento_referencia_id_passos1_idx; Type: INDEX; Schema: public; Owner: postgres; Tablespace:
--

CREATE INDEX public_relacionamento_referencia_id_passos1_idx ON relacionamento_referencia USING btree (id_passos);


--
-- Name: public_relacionamento_referencia_id_referencia2_idx; Type: INDEX; Schema: public; Owner: postgres; Tablespace:
--

CREATE INDEX public_relacionamento_referencia_id_referencia2_idx ON relacionamento_referencia USING btree (id_referencia);


--
-- Name: public_relacionamento_regra_de_negocio_id_passos1_idx; Type: INDEX; Schema: public; Owner: postgres; Tablespace:
--

CREATE INDEX public_relacionamento_regra_de_negocio_id_passos1_idx ON relacionamento_regra_de_negocio USING btree (id_passos);


--
-- Name: public_relacionamento_regra_de_negocio_id_regra_de_negocio2_idx; Type: INDEX; Schema: public; Owner: postgres; Tablespace:
--

CREATE INDEX public_relacionamento_regra_de_negocio_id_regra_de_negocio2_idx ON relacionamento_regra_de_negocio USING btree (id_regra_de_negocio);


--
-- Name: public_revisao_id_caso_de_uso1_idx; Type: INDEX; Schema: public; Owner: postgres; Tablespace:
--

CREATE INDEX public_revisao_id_caso_de_uso1_idx ON revisao USING btree (id_caso_de_uso);


--
-- Name: public_revisao_id_dados_revisao2_idx; Type: INDEX; Schema: public; Owner: postgres; Tablespace:
--

CREATE INDEX public_revisao_id_dados_revisao2_idx ON revisao USING btree (id_dados_revisao);


--
-- Name: passos_id_fluxo_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY passos
    ADD CONSTRAINT passos_id_fluxo_fkey FOREIGN KEY (id_fluxo) REFERENCES fluxo(id_fluxo);


--
-- Name: relacionamento_dados_revisao_id_ator_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY relacionamento_dados_revisao
    ADD CONSTRAINT relacionamento_dados_revisao_id_ator_fkey FOREIGN KEY (id_ator) REFERENCES ator(id_ator);


--
-- Name: relacionamento_dados_revisao_id_dados_revisao_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY relacionamento_dados_revisao
    ADD CONSTRAINT relacionamento_dados_revisao_id_dados_revisao_fkey FOREIGN KEY (id_dados_revisao) REFERENCES dados_revisao(id_dados_revisao);


--
-- Name: relacionamento_informacao_compl_id_informacao_complementar_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY relacionamento_informacao_complementar
    ADD CONSTRAINT relacionamento_informacao_compl_id_informacao_complementar_fkey FOREIGN KEY (id_informacao_complementar) REFERENCES informacao_complementar(id_informacao_complementar);


--
-- Name: relacionamento_informacao_complementar_id_passos_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY relacionamento_informacao_complementar
    ADD CONSTRAINT relacionamento_informacao_complementar_id_passos_fkey FOREIGN KEY (id_passos) REFERENCES passos(id_passos);


--
-- Name: relacionamento_referencia_id_passos_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY relacionamento_referencia
    ADD CONSTRAINT relacionamento_referencia_id_passos_fkey FOREIGN KEY (id_passos) REFERENCES passos(id_passos);


--
-- Name: relacionamento_referencia_id_referencia_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY relacionamento_referencia
    ADD CONSTRAINT relacionamento_referencia_id_referencia_fkey FOREIGN KEY (id_referencia) REFERENCES referencia(id_referencia);


--
-- Name: relacionamento_regra_de_negocio_id_passos_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY relacionamento_regra_de_negocio
    ADD CONSTRAINT relacionamento_regra_de_negocio_id_passos_fkey FOREIGN KEY (id_passos) REFERENCES passos(id_passos);


--
-- Name: relacionamento_regra_de_negocio_id_regra_de_negocio_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY relacionamento_regra_de_negocio
    ADD CONSTRAINT relacionamento_regra_de_negocio_id_regra_de_negocio_fkey FOREIGN KEY (id_regra_de_negocio) REFERENCES regra_de_negocio(id_regra_de_negocio);


--
-- Name: revisao_id_caso_de_uso_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY revisao
    ADD CONSTRAINT revisao_id_caso_de_uso_fkey FOREIGN KEY (id_caso_de_uso) REFERENCES caso_de_uso(id_caso_de_uso);


--
-- Name: revisao_id_dados_revisao_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY revisao
    ADD CONSTRAINT revisao_id_dados_revisao_fkey FOREIGN KEY (id_dados_revisao) REFERENCES dados_revisao(id_dados_revisao);


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

