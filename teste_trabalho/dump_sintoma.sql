--
-- PostgreSQL database dump
--

-- Dumped from database version 9.5.14
-- Dumped by pg_dump version 12.2 (Ubuntu 12.2-4)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

--
-- Name: sintoma; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.sintoma (
    cod_sintoma integer NOT NULL,
    cod_usuario integer,
    febre integer,
    coriza integer,
    nariz integer,
    cansaco integer,
    tosse integer,
    dorcabeca integer,
    dorescorpo integer,
    malestar integer,
    dorgarganta integer,
    respirar integer,
    paladar integer,
    olfato integer,
    locomocao integer,
    diarreia integer
);


ALTER TABLE public.sintoma OWNER TO postgres;

--
-- Name: sintoma_cod_sintoma_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.sintoma_cod_sintoma_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.sintoma_cod_sintoma_seq OWNER TO postgres;

--
-- Name: sintoma_cod_sintoma_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.sintoma_cod_sintoma_seq OWNED BY public.sintoma.cod_sintoma;


--
-- Name: sintoma cod_sintoma; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sintoma ALTER COLUMN cod_sintoma SET DEFAULT nextval('public.sintoma_cod_sintoma_seq'::regclass);


--
-- PostgreSQL database dump complete
--

