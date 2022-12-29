--
-- PostgreSQL database dump
--

-- Dumped from database version 15.1
-- Dumped by pg_dump version 15.1

-- Started on 2022-12-29 20:50:40

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

SET default_table_access_method = heap;

--
-- TOC entry 218 (class 1259 OID 16475)
-- Name: factures; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.factures (
    id bigint NOT NULL,
    kontrahent bigint,
    produkt bigint,
    produkt_cena bigint,
    produkt_liczba bigint,
    symbol character varying,
    data_wystawienia date
);


ALTER TABLE public.factures OWNER TO postgres;

--
-- TOC entry 219 (class 1259 OID 16498)
-- Name: factures_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public.factures ALTER COLUMN id ADD GENERATED BY DEFAULT AS IDENTITY (
    SEQUENCE NAME public.factures_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- TOC entry 215 (class 1259 OID 16410)
-- Name: partners; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.partners (
    id bigint NOT NULL,
    nazwa character varying,
    nip bigint,
    adres character varying,
    telefon integer,
    mail character varying
);


ALTER TABLE public.partners OWNER TO postgres;

--
-- TOC entry 214 (class 1259 OID 16409)
-- Name: partners_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.partners_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.partners_id_seq OWNER TO postgres;

--
-- TOC entry 3346 (class 0 OID 0)
-- Dependencies: 214
-- Name: partners_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.partners_id_seq OWNED BY public.partners.id;


--
-- TOC entry 217 (class 1259 OID 16438)
-- Name: products; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.products (
    id bigint NOT NULL,
    produkt_nazwa character varying,
    cena bigint,
    symbol character varying
);


ALTER TABLE public.products OWNER TO postgres;

--
-- TOC entry 216 (class 1259 OID 16437)
-- Name: products_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public.products ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.products_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- TOC entry 3183 (class 2604 OID 16413)
-- Name: partners id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.partners ALTER COLUMN id SET DEFAULT nextval('public.partners_id_seq'::regclass);


--
-- TOC entry 3339 (class 0 OID 16475)
-- Dependencies: 218
-- Data for Name: factures; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.factures (id, kontrahent, produkt, produkt_cena, produkt_liczba, symbol, data_wystawienia) FROM stdin;
1	1	1	1	2	FV/01/2022	2022-08-02
2	3	2	2	1	FV/02/2022	2022-10-08
4	4	3	3	4	FV/03/2022	2022-12-03
5	5	2	2	2	FV/04/2022	2022-12-02
8	3	112	112	3	FV/05/2022	2022-12-05
\.


--
-- TOC entry 3336 (class 0 OID 16410)
-- Dependencies: 215
-- Data for Name: partners; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.partners (id, nazwa, nip, adres, telefon, mail) FROM stdin;
1	HOTEL WYGODA	728106168	43-400 Cieszyn, Graniczna 46	846398526	wygoda@gmail.com
2	KJM INŻYNIERING	6922330418	43-400 Cieszyn, Stawowa 71	598824852	kjm@gmail.com
3	CEFANA	5482187837	43-400 Cieszyn, Liburnia 10	852456951	cefana@gmail.com
4	HR CENTRUM	5471943146	43-400 Cieszyn, Michejdy 18	753852963	hrcentrum@gmail.com
5	POLMORAVIA	5482348275	43-400 Cieszyn, 3 Maja 18	159487263	polmoravia@gmail.com
\.


--
-- TOC entry 3338 (class 0 OID 16438)
-- Dependencies: 217
-- Data for Name: products; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.products (id, produkt_nazwa, cena, symbol) FROM stdin;
1	La Sportiva Python	479	LSP1
2	La Sportiva Cobra	431	LSC2
3	Scarpa Mango	547	SM3
111	Black Diamond Method	461	BDM
112	Evolv Shaman	569	EVS
\.


--
-- TOC entry 3347 (class 0 OID 0)
-- Dependencies: 219
-- Name: factures_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.factures_id_seq', 8, true);


--
-- TOC entry 3348 (class 0 OID 0)
-- Dependencies: 214
-- Name: partners_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.partners_id_seq', 124, true);


--
-- TOC entry 3349 (class 0 OID 0)
-- Dependencies: 216
-- Name: products_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.products_id_seq', 112, true);


--
-- TOC entry 3189 (class 2606 OID 16481)
-- Name: factures factures_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.factures
    ADD CONSTRAINT factures_pkey PRIMARY KEY (id);


--
-- TOC entry 3185 (class 2606 OID 16417)
-- Name: partners partners_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.partners
    ADD CONSTRAINT partners_pkey PRIMARY KEY (id);


--
-- TOC entry 3187 (class 2606 OID 16444)
-- Name: products products_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.products
    ADD CONSTRAINT products_pkey PRIMARY KEY (id);


--
-- TOC entry 3190 (class 2606 OID 16482)
-- Name: factures kontrahent; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.factures
    ADD CONSTRAINT kontrahent FOREIGN KEY (kontrahent) REFERENCES public.partners(id) NOT VALID;


--
-- TOC entry 3191 (class 2606 OID 16487)
-- Name: factures produkt; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.factures
    ADD CONSTRAINT produkt FOREIGN KEY (produkt) REFERENCES public.products(id) NOT VALID;


--
-- TOC entry 3192 (class 2606 OID 16506)
-- Name: factures produkt_cena; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.factures
    ADD CONSTRAINT produkt_cena FOREIGN KEY (produkt_cena) REFERENCES public.products(id) NOT VALID;


-- Completed on 2022-12-29 20:50:41

--
-- PostgreSQL database dump complete
--

