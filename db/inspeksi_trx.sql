--
-- PostgreSQL database dump
--

-- Dumped from database version 9.5.2
-- Dumped by pg_dump version 13.4

-- Started on 2023-02-09 14:31:27

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
-- TOC entry 14 (class 2615 OID 62517)
-- Name: inspeksi_trx; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA inspeksi_trx;


ALTER SCHEMA inspeksi_trx OWNER TO postgres;

SET default_tablespace = '';

--
-- TOC entry 257 (class 1259 OID 63089)
-- Name: inspeksi; Type: TABLE; Schema: inspeksi_trx; Owner: postgres
--

CREATE TABLE inspeksi_trx.inspeksi (
    id character varying(20) NOT NULL,
    user_inspektor character varying(20) NOT NULL,
    area text NOT NULL,
    tgl_inspeksi date NOT NULL,
    shift character varying(20) NOT NULL,
    evidence text NOT NULL,
    keterangan text NOT NULL,
    periode character varying(7) NOT NULL,
    input_by character varying(20) NOT NULL,
    inserted_at timestamp with time zone NOT NULL,
    updated_at timestamp with time zone
);


ALTER TABLE inspeksi_trx.inspeksi OWNER TO postgres;

--
-- TOC entry 252 (class 1259 OID 62904)
-- Name: jadwal; Type: TABLE; Schema: inspeksi_trx; Owner: postgres
--

CREATE TABLE inspeksi_trx.jadwal (
    id_jadwal character varying(20) NOT NULL,
    id_user character varying(20) NOT NULL,
    tgl_inspeksi date NOT NULL,
    periode character varying(7) NOT NULL,
    shift_inspeksi character varying(20) NOT NULL,
    status_inspeksi boolean NOT NULL,
    tgl_realisasi timestamp with time zone,
    keterangan character varying(150)
);


ALTER TABLE inspeksi_trx.jadwal OWNER TO postgres;

--
-- TOC entry 254 (class 1259 OID 62942)
-- Name: report; Type: TABLE; Schema: inspeksi_trx; Owner: postgres
--

CREATE TABLE inspeksi_trx.report (
    id character varying(20) NOT NULL,
    kode_area character varying(15) NOT NULL,
    periode character varying(7) NOT NULL,
    poin_min character varying(20) NOT NULL,
    inserted_at timestamp with time zone NOT NULL,
    eop_by character varying(20) NOT NULL
);


ALTER TABLE inspeksi_trx.report OWNER TO postgres;

--
-- TOC entry 251 (class 1259 OID 62882)
-- Name: temuan_inspeksi; Type: TABLE; Schema: inspeksi_trx; Owner: postgres
--

CREATE TABLE inspeksi_trx.temuan_inspeksi (
    id character varying(20) NOT NULL,
    user_inspektor character varying(20) NOT NULL,
    kd_bagian character varying(20) NOT NULL,
    kd_area character varying(20) NOT NULL,
    tgl_inspeksi date NOT NULL,
    kd_temuan character varying(20) NOT NULL,
    shift character varying(20) NOT NULL,
    unsur character varying(20) NOT NULL,
    poin_min character varying(20) NOT NULL,
    foto_temuan text,
    keterangan text,
    tanggapan text,
    status_tem boolean NOT NULL,
    created_at timestamp with time zone,
    updated_at timestamp with time zone,
    periode character varying(7)
);


ALTER TABLE inspeksi_trx.temuan_inspeksi OWNER TO postgres;

--
-- TOC entry 2336 (class 0 OID 63089)
-- Dependencies: 257
-- Data for Name: inspeksi; Type: TABLE DATA; Schema: inspeksi_trx; Owner: postgres
--

COPY inspeksi_trx.inspeksi (id, user_inspektor, area, tgl_inspeksi, shift, evidence, keterangan, periode, input_by, inserted_at, updated_at) FROM stdin;
\.


--
-- TOC entry 2334 (class 0 OID 62904)
-- Dependencies: 252
-- Data for Name: jadwal; Type: TABLE DATA; Schema: inspeksi_trx; Owner: postgres
--

COPY inspeksi_trx.jadwal (id_jadwal, id_user, tgl_inspeksi, periode, shift_inspeksi, status_inspeksi, tgl_realisasi, keterangan) FROM stdin;
JA1675669674	04991510	2023-02-06	2023-02	2	t	2023-02-06 15:02:39+07	MORTAR--PRDMTR--Karyawan NIK: 234243, memabwa HP ke lokasi pabrik
JA1675920152	04991510	2023-02-09	2023-02	1	t	2023-02-09 12:02:48+07	["RGSERV","GDGIT","RKIT","FS1","FS2","FS3"]--trial
\.


--
-- TOC entry 2335 (class 0 OID 62942)
-- Dependencies: 254
-- Data for Name: report; Type: TABLE DATA; Schema: inspeksi_trx; Owner: postgres
--

COPY inspeksi_trx.report (id, kode_area, periode, poin_min, inserted_at, eop_by) FROM stdin;
\.


--
-- TOC entry 2333 (class 0 OID 62882)
-- Dependencies: 251
-- Data for Name: temuan_inspeksi; Type: TABLE DATA; Schema: inspeksi_trx; Owner: postgres
--

COPY inspeksi_trx.temuan_inspeksi (id, user_inspektor, kd_bagian, kd_area, tgl_inspeksi, kd_temuan, shift, unsur, poin_min, foto_temuan, keterangan, tanggapan, status_tem, created_at, updated_at, periode) FROM stdin;
1675670678	04991510	PRDMTR	MORTAR	2023-02-06	TM1667284566	2	HRD	10	INSPEKSI_16756706783487.jpeg	Karyawan NIK: 234243, memabwa HP ke lokasi pabrik	\N	f	2023-02-06 15:02:39+07	2023-02-06 15:02:39+07	2023-02
1675836139	04991510	QCL	QCLFC	2023-02-08	TM1667284566	1	HRD	10	INSPEKSI_16758361392498.jpeg	Karyawan terkait kedapatan membawa HP ke lokasi pabrik	Sudah diproses	t	2023-02-08 13:02:19+07	2023-02-08 13:02:19+07	2023-02
\.


--
-- TOC entry 2218 (class 2606 OID 63096)
-- Name: inspeksi inspeksi_pkey; Type: CONSTRAINT; Schema: inspeksi_trx; Owner: postgres
--

ALTER TABLE ONLY inspeksi_trx.inspeksi
    ADD CONSTRAINT inspeksi_pkey PRIMARY KEY (id);


--
-- TOC entry 2214 (class 2606 OID 62908)
-- Name: jadwal jadwal_pkey; Type: CONSTRAINT; Schema: inspeksi_trx; Owner: postgres
--

ALTER TABLE ONLY inspeksi_trx.jadwal
    ADD CONSTRAINT jadwal_pkey PRIMARY KEY (id_jadwal);


--
-- TOC entry 2216 (class 2606 OID 62946)
-- Name: report report_pkey; Type: CONSTRAINT; Schema: inspeksi_trx; Owner: postgres
--

ALTER TABLE ONLY inspeksi_trx.report
    ADD CONSTRAINT report_pkey PRIMARY KEY (id);


--
-- TOC entry 2212 (class 2606 OID 62889)
-- Name: temuan_inspeksi temuan_inspeksi_pkey; Type: CONSTRAINT; Schema: inspeksi_trx; Owner: postgres
--

ALTER TABLE ONLY inspeksi_trx.temuan_inspeksi
    ADD CONSTRAINT temuan_inspeksi_pkey PRIMARY KEY (id);


-- Completed on 2023-02-09 14:31:28

--
-- PostgreSQL database dump complete
--

