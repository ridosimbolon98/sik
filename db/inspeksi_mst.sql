--
-- PostgreSQL database dump
--

-- Dumped from database version 9.5.2
-- Dumped by pg_dump version 13.4

-- Started on 2023-02-09 14:30:24

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

--
-- TOC entry 13 (class 2615 OID 62516)
-- Name: inspeksi_mst; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA inspeksi_mst;


ALTER SCHEMA inspeksi_mst OWNER TO postgres;

SET default_tablespace = '';

--
-- TOC entry 247 (class 1259 OID 62538)
-- Name: area; Type: TABLE; Schema: inspeksi_mst; Owner: postgres
--

CREATE TABLE inspeksi_mst.area (
    id character varying(20) NOT NULL,
    kode_bagian character varying(20),
    kode_area character varying(20) NOT NULL,
    desk_area character varying(50) NOT NULL,
    status boolean NOT NULL,
    created_at timestamp with time zone,
    updated_at timestamp with time zone,
    updated_by character varying(20)
);


ALTER TABLE inspeksi_mst.area OWNER TO postgres;

--
-- TOC entry 246 (class 1259 OID 62528)
-- Name: bagian; Type: TABLE; Schema: inspeksi_mst; Owner: postgres
--

CREATE TABLE inspeksi_mst.bagian (
    id character varying(20) NOT NULL,
    kode_bagian character varying(20) NOT NULL,
    deskripsi character varying(50) NOT NULL,
    idbu character varying(20) NOT NULL,
    status_bagian boolean NOT NULL,
    created_at timestamp with time zone NOT NULL,
    updated_at timestamp with time zone,
    updated_by character varying(20)
);


ALTER TABLE inspeksi_mst.bagian OWNER TO postgres;

--
-- TOC entry 248 (class 1259 OID 62544)
-- Name: item_temuan; Type: TABLE; Schema: inspeksi_mst; Owner: postgres
--

CREATE TABLE inspeksi_mst.item_temuan (
    id_tem character varying(20) NOT NULL,
    aspek_tem text NOT NULL,
    unsur_tem character varying(20) NOT NULL,
    kat_tem character varying(20) NOT NULL,
    poin_min character varying(10) NOT NULL,
    idbu character varying(10) NOT NULL,
    status boolean NOT NULL,
    created_by character varying(20),
    created_at time with time zone NOT NULL,
    updated_at timestamp with time zone
);


ALTER TABLE inspeksi_mst.item_temuan OWNER TO postgres;

--
-- TOC entry 245 (class 1259 OID 62520)
-- Name: user; Type: TABLE; Schema: inspeksi_mst; Owner: postgres
--

CREATE TABLE inspeksi_mst."user" (
    nik character varying(20) NOT NULL,
    nama character varying(50) NOT NULL,
    username character varying(50) NOT NULL,
    password text NOT NULL,
    level character varying(20) NOT NULL,
    bagian character varying(50) NOT NULL,
    status_user boolean NOT NULL,
    created_at timestamp with time zone NOT NULL,
    updated_at timestamp with time zone,
    input_by character varying(20)
);


ALTER TABLE inspeksi_mst."user" OWNER TO postgres;

--
-- TOC entry 2335 (class 0 OID 62538)
-- Dependencies: 247
-- Data for Name: area; Type: TABLE DATA; Schema: inspeksi_mst; Owner: postgres
--

COPY inspeksi_mst.area (id, kode_bagian, kode_area, desk_area, status, created_at, updated_at, updated_by) FROM stdin;
7	PRDFC	FS7	FS 7	t	2023-01-26 09:00:55+07	2023-02-01 13:02:21+07	33942109
8	PRDFC	FS8	FS 8	t	2023-01-26 09:00:55+07	2023-02-01 13:02:28+07	33942109
9	PRDAAC	AAC	AAC	t	2023-01-26 09:00:55+07	2023-02-01 13:02:34+07	33942109
10	PRDMTR	MORTAR	MORTAR	t	2023-01-26 09:00:55+07	2023-02-01 13:02:40+07	33942109
11	PRDFC	HYDRA	HYDRA	t	2023-01-26 09:00:55+07	2023-02-01 13:02:54+07	33942109
38	IT	RGSERV	RUANG SERVER	t	2023-01-26 09:00:55+07	2023-02-01 13:02:03+07	33942109
39	IT	GDGIT	GUDANG IT	t	2023-01-26 09:00:55+07	2023-02-01 13:02:27+07	33942109
40	IT	RKIT	RUANG KERJA IT	t	2023-01-26 09:00:55+07	2023-02-01 13:02:39+07	33942109
1	PRDFC	FS1	FS 1	t	2023-01-26 09:00:55+07	2023-02-01 13:02:52+07	33942109
2	PRDFC	FS2	FS 2	t	2023-01-26 09:00:55+07	2023-02-01 13:02:58+07	33942109
3	PRDFC	FS3	FS 3	t	2023-01-26 09:00:55+07	2023-02-01 13:02:06+07	33942109
4	PRDFC	FS4	FS 4	t	2023-01-26 09:00:55+07	2023-02-01 13:02:13+07	33942109
1675327972	IT	GDGIT2	GUDANG IT 3	t	2023-02-02 15:02:52+07	2023-02-02 15:02:13+07	33942109
12	PRDFC	BALLMILL	BALL MILL FC	t	2023-01-26 09:00:55+07	2023-02-01 13:02:07+07	33942109
5	PRDFC	FS5	FS 5	t	2023-01-26 09:00:55+07	2023-02-01 13:02:57+07	33942109
6	PRDFC	FS6	FS 6	t	2023-01-26 09:00:55+07	2023-02-01 13:02:15+07	33942109
13	PRDFC	ERMILL	ER MILL FC	t	2023-01-26 09:00:55+07	2023-02-01 13:02:22+07	33942109
14	PRDFC	DRYER	DRYER	t	2023-01-26 09:00:55+07	2023-02-01 13:02:31+07	33942109
15	PRDFC	BOILER1	BOILER 1	t	2023-01-26 09:00:55+07	2023-02-01 13:02:20+07	33942109
16	PRDFC	BOILER2	BOILER 2	t	2023-01-26 09:00:55+07	2023-02-01 13:02:26+07	33942109
17	PRDFC	BOILER3	BOILER 3	t	2023-01-26 09:00:55+07	2023-02-01 13:02:31+07	33942109
18	PRDFC	BOILER4	BOILER 4	t	2023-01-26 09:00:55+07	2023-02-01 13:02:41+07	33942109
19	PRDAAC	BOILER5	BOILER 5	t	2023-01-26 09:00:55+07	2023-02-01 13:02:01+07	33942109
2O	QCL	QCLFC	QC LAB FC	t	2023-01-26 09:00:55+07	2023-02-01 13:02:36+07	33942109
21	QCL	QCLAAC	QC LAB AAC	t	2023-01-26 09:00:55+07	2023-02-01 13:02:41+07	33942109
22	GBS	KGBSFC	KANTOR GBS FC	t	2023-01-26 09:00:55+07	2023-02-01 13:02:50+07	33942109
23	GBS	KGBSAAC	KANTOR GBS AAC	t	2023-01-26 09:00:55+07	2023-02-01 13:02:56+07	33942109
24	PMP	BKLELKT	BENGKEL ELEKTRIK	t	2023-01-26 09:00:55+07	2023-02-01 13:02:08+07	33942109
25	PMP	BKLMKNK	BENGKEL MEKANIK	t	2023-01-26 09:00:55+07	2023-02-01 13:02:14+07	33942109
27	PMP	BKLUTLY	BENGKEL UTILITY	t	2023-01-26 09:00:55+07	2023-02-01 13:02:20+07	33942109
28	GPJ	GDGB1	GUDANG B1	t	2023-01-26 09:00:55+07	2023-02-01 13:02:42+07	33942109
29	GPJ	GDGB2	GUDANG B2	t	2023-01-26 09:00:55+07	2023-02-01 13:02:50+07	33942109
30	GPJ	GDGC1	GUDANG C1	t	2023-01-26 09:00:55+07	2023-02-01 13:02:09+07	33942109
31	GPJ	GDGC2	GUDANG C2	t	2023-01-26 09:00:55+07	2023-02-01 13:02:16+07	33942109
32	GBS	GDGPARTFC	GUDANG PART FC	t	2023-01-26 09:00:55+07	2023-02-01 13:02:49+07	33942109
33	GBS	GDGPARTAAC	GUDANG PART AAC	t	2023-01-26 09:00:55+07	2023-02-01 13:02:03+07	33942109
34	GBS	GDGBTBR	GUDANG BATU BARA	t	2023-01-26 09:00:55+07	2023-02-01 13:02:11+07	33942109
35	PRDFC	GDGKRTS	GUDANG KERTAS	t	2023-01-26 09:00:55+07	2023-02-01 13:02:21+07	33942109
36	PRDAAC	GDGPSR	GUDANG PASIR	t	2023-01-26 09:00:55+07	2023-02-01 13:02:30+07	33942109
37	PRDFC	GDGKRST	GUDANG KRISOTIL	t	2023-01-26 09:00:55+07	2023-02-01 13:02:06+07	33942109
38	PRDFC	GDGALNM	GUDANG ALUMUNIUM	t	2023-01-26 09:00:55+07	2023-02-01 13:02:55+07	33942109
39	MKT	WRSMKT	WORKSHOP MARKETING	t	2023-01-26 09:00:55+07	2023-02-01 13:02:17+07	33942109
40	PMT	GDGPLT	GUDANG PALET	t	2023-01-26 09:00:55+07	2023-02-01 13:02:30+07	33942109
34	PMT	GDGCPR	GUDANG CARPENTER	t	2023-01-26 09:00:55+07	2023-02-01 13:02:36+07	33942109
35	PMT	GDGSTR	GUDANG SORTIR	t	2023-01-26 09:00:55+07	2023-02-01 13:02:42+07	33942109
36	PMT	GDGPKG	GUDANG PACKING	t	2023-01-26 09:00:55+07	2023-02-01 13:02:49+07	33942109
37	PMT	GDGRSZ	GUDANG RESIZE	t	2023-01-26 09:00:55+07	2023-02-01 13:02:54+07	33942109
\.


--
-- TOC entry 2334 (class 0 OID 62528)
-- Dependencies: 246
-- Data for Name: bagian; Type: TABLE DATA; Schema: inspeksi_mst; Owner: postgres
--

COPY inspeksi_mst.bagian (id, kode_bagian, deskripsi, idbu, status_bagian, created_at, updated_at, updated_by) FROM stdin;
3	PRDMTR	PRODUKSI MORTAR	NBI	t	2023-01-26 09:00:55+07	2023-01-26 09:00:55+07	ADMIN
4	PMT	PMT	NBI	t	2023-01-26 09:00:55+07	2023-01-26 09:00:55+07	ADMIN
5	QCL	QC LAB	NBI	t	2023-01-26 09:00:55+07	2023-01-26 09:00:55+07	ADMIN
6	HRD	HRD	NBI	t	2023-01-26 09:00:55+07	2023-01-26 09:00:55+07	ADMIN
7	PMP	PEMPER	NBI	t	2023-01-26 09:00:55+07	2023-01-26 09:00:55+07	ADMIN
8	GBS	GBS	NBI	t	2023-01-26 09:00:55+07	2023-01-26 09:00:55+07	ADMIN
9	GPJ	GPJ	NBI	t	2023-01-26 09:00:55+07	2023-01-26 09:00:55+07	ADMIN
10	UMM	UMUM	NBI	t	2023-01-26 09:00:55+07	2023-01-26 09:00:55+07	ADMIN
11	SATPAM	SATPAM	NBI	t	2023-01-26 09:00:55+07	2023-01-26 09:00:55+07	ADMIN
12	PBL	PEMBELIAN	NBI	t	2023-01-26 09:00:55+07	2023-01-26 09:00:55+07	ADMIN
13	EXIM	EXPORT & IMPORT	NBI	t	2023-01-26 09:00:55+07	2023-01-26 09:00:55+07	ADMIN
14	QMS	QMS	NBI	t	2023-01-26 09:00:55+07	2023-01-26 09:00:55+07	ADMIN
15	IT	INFORMATION TECHNOLOGY	NBI	t	2023-01-26 09:00:55+07	2023-01-26 09:00:55+07	ADMIN
16	K3L	K3L	NBI	t	2023-01-26 09:00:55+07	2023-01-26 09:00:55+07	ADMIN
17	MKT	MARKETING	NBI	t	2023-01-26 09:00:55+07	2023-01-26 09:00:55+07	ADMIN
1	PRDFC	PRODUKSI FC	NBI	t	2023-01-26 09:00:55+07	2023-01-26 09:00:55+07	ADMIN
2	PRDAAC	PRODUKSI AAC	NBI	t	2023-01-26 09:00:55+07	2023-01-26 09:00:55+07	ADMIN
\.


--
-- TOC entry 2336 (class 0 OID 62544)
-- Dependencies: 248
-- Data for Name: item_temuan; Type: TABLE DATA; Schema: inspeksi_mst; Owner: postgres
--

COPY inspeksi_mst.item_temuan (id_tem, aspek_tem, unsur_tem, kat_tem, poin_min, idbu, status, created_by, created_at, updated_at) FROM stdin;
TM1667284677	Tidur atau Tertidur saat atau di area kerja	HRD	KRITIKAL	20	NBI	t	ADMIN	09:00:55+07	2023-01-26 09:00:55+07
TM1667284611	Merokok saat atau di area kerja	HRD	KRITIKAL	20	NBI	t	ADMIN	09:00:55+07	2023-01-26 09:00:55+07
TM1667284633	Tidak melengkapi ijin kerja	K3L	KRITIKAL	20	NBI	t	ADMIN	09:00:55+07	2023-01-26 09:00:55+07
TM1667284644	Aktivitas berpotensi bahaya	K3L	KRITIKAL	20	NBI	t	ADMIN	09:00:55+07	2023-01-26 09:00:55+07
TM1667284655	APAR tidak sesuai	K3L	MAJOR	10	NBI	t	ADMIN	09:00:55+07	2023-01-26 09:00:55+07
TM1667284666	Lingkungan atau area kerja tidak aman	K3L	MAJOR	10	NBI	t	ADMIN	09:00:55+07	2023-01-26 09:00:55+07
TM1667284566	Membawa atau menggunakan HP	HRD	MAJOR	10	NBI	t	ADMIN	09:00:55+07	2023-01-26 09:00:55+07
TM1667284699	Melakukan tindakan asusila	HRD	MAJOR	10	NBI	t	ADMIN	09:00:55+07	2023-01-26 09:00:55+07
TM1667284600	Tidak mengenakan ID Card	HRD	MINOR	5	NBI	t	ADMIN	09:00:55+07	2023-01-26 09:00:55+07
TM1667284511	Kerapian pakaian atau rambut	HRD	MINOR	5	NBI	t	ADMIN	09:00:55+07	2023-01-26 09:00:55+07
TM1667284522	Membuat kegaduhan di area kerja (berkelahi)	HRD	MINOR	5	NBI	t	ADMIN	09:00:55+07	2023-01-26 09:00:55+07
TM1667284533	Menggunakan atribut partai atau orasi politik	HRD	MINOR	5	NBI	t	ADMIN	09:00:55+07	2023-01-26 09:00:55+07
TM1667284544	Kedapatan berjudi atau sejenisnya	HRD	MINOR	5	NBI	t	ADMIN	09:00:55+07	2023-01-26 09:00:55+07
TM1667284555	Kotak P3K tidak lengkap	K3L	MINOR	5	NBI	t	ADMIN	09:00:55+07	2023-01-26 09:00:55+07
TM1667284688	Membawa, mengkonsumsi / mengedarkan alkohol / narkoba	HRD	MAJOR	10	NBI	t	ADMIN	09:00:55+07	2023-01-26 09:00:55+07
TM1667284622	Tidak menggunakan APD sesuai ketentuan	K3L	KRITIKAL	20	NBI	t	ADMIN	09:00:55+07	2023-01-26 09:00:55+07
\.


--
-- TOC entry 2333 (class 0 OID 62520)
-- Dependencies: 245
-- Data for Name: user; Type: TABLE DATA; Schema: inspeksi_mst; Owner: postgres
--

COPY inspeksi_mst."user" (nik, nama, username, password, level, bagian, status_user, created_at, updated_at, input_by) FROM stdin;
20230206	ADMIN	20230206	$2y$10$uBYjoXcm3Q2Oy/tL8.k6uuhEbGSo/Ox/jbW9ju.Pa2gROXQJ9aFea	ADMIN	IT	t	2023-02-06 09:02:50+07	2023-02-06 09:02:50+07	33942111
04991510	INSPEKTOR1	04991510	$2y$10$uBYjoXcm3Q2Oy/tL8.k6uuhEbGSo/Ox/jbW9ju.Pa2gROXQJ9aFea	INSPEKTOR	HRD	t	2023-02-06 09:02:05+07	2023-02-06 09:02:05+07	33942111
\.


--
-- TOC entry 2216 (class 2606 OID 62542)
-- Name: area area_pkey; Type: CONSTRAINT; Schema: inspeksi_mst; Owner: postgres
--

ALTER TABLE ONLY inspeksi_mst.area
    ADD CONSTRAINT area_pkey PRIMARY KEY (id, kode_area);


--
-- TOC entry 2214 (class 2606 OID 62532)
-- Name: bagian bagian_pkey; Type: CONSTRAINT; Schema: inspeksi_mst; Owner: postgres
--

ALTER TABLE ONLY inspeksi_mst.bagian
    ADD CONSTRAINT bagian_pkey PRIMARY KEY (id);


--
-- TOC entry 2218 (class 2606 OID 62551)
-- Name: item_temuan item_temuan_pkey; Type: CONSTRAINT; Schema: inspeksi_mst; Owner: postgres
--

ALTER TABLE ONLY inspeksi_mst.item_temuan
    ADD CONSTRAINT item_temuan_pkey PRIMARY KEY (id_tem);


--
-- TOC entry 2212 (class 2606 OID 62527)
-- Name: user user_pkey; Type: CONSTRAINT; Schema: inspeksi_mst; Owner: postgres
--

ALTER TABLE ONLY inspeksi_mst."user"
    ADD CONSTRAINT user_pkey PRIMARY KEY (nik);


-- Completed on 2023-02-09 14:30:24

--
-- PostgreSQL database dump complete
--

