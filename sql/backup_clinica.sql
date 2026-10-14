--
-- PostgreSQL database dump
--

\restrict OalQOiBsTcbGxaWPI8nQyRj9IT93NszXpfwq49YfiYZrPMrCszPCUfrL40rt1pl

-- Dumped from database version 17.11
-- Dumped by pg_dump version 17.11

-- Started on 2026-10-14 00:09:09

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 224 (class 1259 OID 16423)
-- Name: consultas; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE public.consultas (
    id integer NOT NULL,
    id_paciente integer,
    dia date,
    hora time without time zone,
    status character varying(20) DEFAULT 'agendada'::character varying,
    id_usuario integer
);


ALTER TABLE public.consultas OWNER TO root;

--
-- TOC entry 223 (class 1259 OID 16422)
-- Name: consulta_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE public.consulta_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.consulta_id_seq OWNER TO root;

--
-- TOC entry 4946 (class 0 OID 0)
-- Dependencies: 223
-- Name: consulta_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE public.consulta_id_seq OWNED BY public.consultas.id;


--
-- TOC entry 226 (class 1259 OID 16435)
-- Name: entrada; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE public.entrada (
    id integer NOT NULL,
    valor_entrada numeric(15,2),
    dia date,
    id_usuario integer
);


ALTER TABLE public.entrada OWNER TO root;

--
-- TOC entry 225 (class 1259 OID 16434)
-- Name: entrada_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE public.entrada_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.entrada_id_seq OWNER TO root;

--
-- TOC entry 4947 (class 0 OID 0)
-- Dependencies: 225
-- Name: entrada_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE public.entrada_id_seq OWNED BY public.entrada.id;


--
-- TOC entry 220 (class 1259 OID 16404)
-- Name: paciente; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE public.paciente (
    id integer NOT NULL,
    nome character varying(90),
    cpf character varying(14),
    nasc date,
    idade integer,
    convenio character varying(30),
    sexo character varying(30),
    id_usuario integer
);


ALTER TABLE public.paciente OWNER TO root;

--
-- TOC entry 219 (class 1259 OID 16403)
-- Name: paciente_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE public.paciente_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.paciente_id_seq OWNER TO root;

--
-- TOC entry 4948 (class 0 OID 0)
-- Dependencies: 219
-- Name: paciente_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE public.paciente_id_seq OWNED BY public.paciente.id;


--
-- TOC entry 228 (class 1259 OID 16442)
-- Name: saida; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE public.saida (
    id integer NOT NULL,
    valor_saida numeric,
    dia date,
    id_usuario integer
);


ALTER TABLE public.saida OWNER TO root;

--
-- TOC entry 227 (class 1259 OID 16441)
-- Name: saida_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE public.saida_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.saida_id_seq OWNER TO root;

--
-- TOC entry 4949 (class 0 OID 0)
-- Dependencies: 227
-- Name: saida_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE public.saida_id_seq OWNED BY public.saida.id;


--
-- TOC entry 222 (class 1259 OID 16411)
-- Name: telefone; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE public.telefone (
    id integer NOT NULL,
    id_paciente integer,
    telefone character varying(13)
);


ALTER TABLE public.telefone OWNER TO root;

--
-- TOC entry 221 (class 1259 OID 16410)
-- Name: telefone_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE public.telefone_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.telefone_id_seq OWNER TO root;

--
-- TOC entry 4950 (class 0 OID 0)
-- Dependencies: 221
-- Name: telefone_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE public.telefone_id_seq OWNED BY public.telefone.id;


--
-- TOC entry 218 (class 1259 OID 16393)
-- Name: usuarios; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE public.usuarios (
    id integer NOT NULL,
    email character varying(255) NOT NULL,
    senha character varying(255) NOT NULL
);


ALTER TABLE public.usuarios OWNER TO root;

--
-- TOC entry 217 (class 1259 OID 16392)
-- Name: usuarios_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE public.usuarios_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.usuarios_id_seq OWNER TO root;

--
-- TOC entry 4951 (class 0 OID 0)
-- Dependencies: 217
-- Name: usuarios_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE public.usuarios_id_seq OWNED BY public.usuarios.id;


--
-- TOC entry 4770 (class 2604 OID 16426)
-- Name: consultas id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.consultas ALTER COLUMN id SET DEFAULT nextval('public.consulta_id_seq'::regclass);


--
-- TOC entry 4772 (class 2604 OID 16438)
-- Name: entrada id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.entrada ALTER COLUMN id SET DEFAULT nextval('public.entrada_id_seq'::regclass);


--
-- TOC entry 4768 (class 2604 OID 16407)
-- Name: paciente id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.paciente ALTER COLUMN id SET DEFAULT nextval('public.paciente_id_seq'::regclass);


--
-- TOC entry 4773 (class 2604 OID 16445)
-- Name: saida id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.saida ALTER COLUMN id SET DEFAULT nextval('public.saida_id_seq'::regclass);


--
-- TOC entry 4769 (class 2604 OID 16414)
-- Name: telefone id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.telefone ALTER COLUMN id SET DEFAULT nextval('public.telefone_id_seq'::regclass);


--
-- TOC entry 4767 (class 2604 OID 16396)
-- Name: usuarios id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.usuarios ALTER COLUMN id SET DEFAULT nextval('public.usuarios_id_seq'::regclass);


--
-- TOC entry 4783 (class 2606 OID 16428)
-- Name: consultas consulta_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.consultas
    ADD CONSTRAINT consulta_pkey PRIMARY KEY (id);


--
-- TOC entry 4785 (class 2606 OID 16440)
-- Name: entrada entrada_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.entrada
    ADD CONSTRAINT entrada_pkey PRIMARY KEY (id);


--
-- TOC entry 4779 (class 2606 OID 16409)
-- Name: paciente paciente_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.paciente
    ADD CONSTRAINT paciente_pkey PRIMARY KEY (id);


--
-- TOC entry 4787 (class 2606 OID 16449)
-- Name: saida saida_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.saida
    ADD CONSTRAINT saida_pkey PRIMARY KEY (id);


--
-- TOC entry 4781 (class 2606 OID 16416)
-- Name: telefone telefone_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.telefone
    ADD CONSTRAINT telefone_pkey PRIMARY KEY (id);


--
-- TOC entry 4775 (class 2606 OID 16402)
-- Name: usuarios usuarios_email_key; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_email_key UNIQUE (email);


--
-- TOC entry 4777 (class 2606 OID 16400)
-- Name: usuarios usuarios_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_pkey PRIMARY KEY (id);


--
-- TOC entry 4791 (class 2606 OID 16429)
-- Name: consultas consulta_id_paciente_fkey; Type: FK CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.consultas
    ADD CONSTRAINT consulta_id_paciente_fkey FOREIGN KEY (id_paciente) REFERENCES public.paciente(id);


--
-- TOC entry 4792 (class 2606 OID 16457)
-- Name: consultas consultas_id_usuario_fkey; Type: FK CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.consultas
    ADD CONSTRAINT consultas_id_usuario_fkey FOREIGN KEY (id_usuario) REFERENCES public.usuarios(id);


--
-- TOC entry 4793 (class 2606 OID 16462)
-- Name: entrada entrada_id_usuario_fkey; Type: FK CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.entrada
    ADD CONSTRAINT entrada_id_usuario_fkey FOREIGN KEY (id_usuario) REFERENCES public.usuarios(id);


--
-- TOC entry 4788 (class 2606 OID 16472)
-- Name: paciente fk_paciente_usuario; Type: FK CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.paciente
    ADD CONSTRAINT fk_paciente_usuario FOREIGN KEY (id_usuario) REFERENCES public.usuarios(id);


--
-- TOC entry 4789 (class 2606 OID 16452)
-- Name: paciente paciente_id_usuario_fkey; Type: FK CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.paciente
    ADD CONSTRAINT paciente_id_usuario_fkey FOREIGN KEY (id_usuario) REFERENCES public.usuarios(id);


--
-- TOC entry 4794 (class 2606 OID 16467)
-- Name: saida saida_id_usuario_fkey; Type: FK CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.saida
    ADD CONSTRAINT saida_id_usuario_fkey FOREIGN KEY (id_usuario) REFERENCES public.usuarios(id);


--
-- TOC entry 4790 (class 2606 OID 16417)
-- Name: telefone telefone_id_paciente_fkey; Type: FK CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.telefone
    ADD CONSTRAINT telefone_id_paciente_fkey FOREIGN KEY (id_paciente) REFERENCES public.paciente(id);


--
-- TOC entry 4945 (class 0 OID 0)
-- Dependencies: 5
-- Name: SCHEMA public; Type: ACL; Schema: -; Owner: pg_database_owner
--

GRANT ALL ON SCHEMA public TO root;


-- Completed on 2026-10-14 00:09:09

--
-- PostgreSQL database dump complete
--

\unrestrict OalQOiBsTcbGxaWPI8nQyRj9IT93NszXpfwq49YfiYZrPMrCszPCUfrL40rt1pl

