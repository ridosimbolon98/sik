--
-- PostgreSQL database dump
--

-- Dumped from database version 9.5.2
-- Dumped by pg_dump version 13.4

-- Started on 2023-02-09 14:30:54

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
-- TOC entry 15 (class 2615 OID 62518)
-- Name: inspeksi_tmp; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA inspeksi_tmp;


ALTER SCHEMA inspeksi_tmp OWNER TO postgres;

SET default_tablespace = '';

--
-- TOC entry 256 (class 1259 OID 63044)
-- Name: ci_sessions; Type: TABLE; Schema: inspeksi_tmp; Owner: postgres
--

CREATE TABLE inspeksi_tmp.ci_sessions (
    id character varying(128) NOT NULL,
    ip_address character varying(45) NOT NULL,
    "timestamp" bigint DEFAULT 0 NOT NULL,
    data text DEFAULT ''::text NOT NULL
);


ALTER TABLE inspeksi_tmp.ci_sessions OWNER TO postgres;

--
-- TOC entry 258 (class 1259 OID 63107)
-- Name: inspeksi; Type: TABLE; Schema: inspeksi_tmp; Owner: postgres
--

CREATE TABLE inspeksi_tmp.inspeksi (
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


ALTER TABLE inspeksi_tmp.inspeksi OWNER TO postgres;

--
-- TOC entry 255 (class 1259 OID 62969)
-- Name: jadwal; Type: TABLE; Schema: inspeksi_tmp; Owner: postgres
--

CREATE TABLE inspeksi_tmp.jadwal (
    id_jadwal character varying(20) NOT NULL,
    id_user character varying(20) NOT NULL,
    tgl_inspeksi date NOT NULL,
    periode character varying(7) NOT NULL,
    shift_inspeksi character varying(20) NOT NULL,
    status_inspeksi boolean NOT NULL,
    tgl_realisasi timestamp with time zone,
    keterangan character varying(150)
);


ALTER TABLE inspeksi_tmp.jadwal OWNER TO postgres;

--
-- TOC entry 253 (class 1259 OID 62934)
-- Name: temuan_inspeksi; Type: TABLE; Schema: inspeksi_tmp; Owner: postgres
--

CREATE TABLE inspeksi_tmp.temuan_inspeksi (
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


ALTER TABLE inspeksi_tmp.temuan_inspeksi OWNER TO postgres;

--
-- TOC entry 2336 (class 0 OID 63044)
-- Dependencies: 256
-- Data for Name: ci_sessions; Type: TABLE DATA; Schema: inspeksi_tmp; Owner: postgres
--

COPY inspeksi_tmp.ci_sessions (id, ip_address, "timestamp", data) FROM stdin;
sm3n058rjf50q1tkal9t369cio3c9v7u	192.168.10.30	1675926178	X19jaV9sYXN0X3JlZ2VuZXJhdGV8aToxNjc1OTI1ODk2O3VzZXJuYW1lfHM6ODoiMDQ5OTE1MTAiO2xldmVsfHM6OToiSU5TUEVLVE9SIjtuaWt8czo4OiIwNDk5MTUxMCI7c3RhdHVzfHM6NjoibG9nZ2VkIjtiYWdpYW58czozOiJIUkQiO25hbWF8czoxMDoiSU5TUEVLVE9SMSI7
2tmnlp64i0ds67mqdph7793130mfo3p1	192.168.10.30	1675915380	X19jaV9sYXN0X3JlZ2VuZXJhdGV8aToxNjc1OTE1MzgwOw==
6m6demq0eebj5bs1sci0kbc3sftth9ed	192.168.10.30	1675926181	X19jaV9sYXN0X3JlZ2VuZXJhdGV8aToxNjc1OTI2MTczO3VzZXJuYW1lfHM6ODoiMDQ5OTE1MTAiO2xldmVsfHM6OToiSU5TUEVLVE9SIjtuaWt8czo4OiIwNDk5MTUxMCI7c3RhdHVzfHM6NjoibG9nZ2VkIjtiYWdpYW58czozOiJIUkQiO25hbWF8czoxMDoiSU5TUEVLVE9SMSI7
\.


--
-- TOC entry 2337 (class 0 OID 63107)
-- Dependencies: 258
-- Data for Name: inspeksi; Type: TABLE DATA; Schema: inspeksi_tmp; Owner: postgres
--

COPY inspeksi_tmp.inspeksi (id, user_inspektor, area, tgl_inspeksi, shift, evidence, keterangan, periode, input_by, inserted_at, updated_at) FROM stdin;
1675920408	04991510	["RGSERV","GDGIT","RKIT","FS1","FS2","FS3"]	2023-02-09	1	INSPEKSI_16759204084531.jpeg	trial	2023-02	04991510	2023-02-09 12:02:48+07	2023-02-09 12:02:48+07
\.


--
-- TOC entry 2335 (class 0 OID 62969)
-- Dependencies: 255
-- Data for Name: jadwal; Type: TABLE DATA; Schema: inspeksi_tmp; Owner: postgres
--

COPY inspeksi_tmp.jadwal (id_jadwal, id_user, tgl_inspeksi, periode, shift_inspeksi, status_inspeksi, tgl_realisasi, keterangan) FROM stdin;
JA1675656897	04991510	2023-02-16	2023-02	2	f	\N	\N
\.


--
-- TOC entry 2334 (class 0 OID 62934)
-- Dependencies: 253
-- Data for Name: temuan_inspeksi; Type: TABLE DATA; Schema: inspeksi_tmp; Owner: postgres
--

COPY inspeksi_tmp.temuan_inspeksi (id, user_inspektor, kd_bagian, kd_area, tgl_inspeksi, kd_temuan, shift, unsur, poin_min, foto_temuan, keterangan, tanggapan, status_tem, created_at, updated_at, periode) FROM stdin;
1675669745	04991510	PMP	BKLELKT	2023-02-06	TM1667284511	2	HRD	5	INSPEKSI_16756697458586.jpeg	Penampilan karyawan tidak sesuai dengan aturan	\N	f	2023-02-06 14:02:06+07	2023-02-06 14:02:06+07	2023-02
1675670477	04991510	PRDMTR	MORTAR	2023-02-06	TM1667284677	2	HRD	20	INSPEKSI_16756704771716.jpeg	Tertidur di atas mesin	\N	f	2023-02-06 15:02:17+07	2023-02-06 15:02:17+07	2023-02
1675669942	04991510	PMP	BKLELKT	2023-02-06	TM1667284611	2	HRD	20	INSPEKSI_16756699426194.jpeg	Merokok di area kerja	\N	f	2023-02-06 14:02:23+07	2023-02-06 14:02:23+07	2023-02
1675670269	04991510	GBS	GDGPSR	2023-02-06	TM1667284566	2	HRD	10	INSPEKSI_16756702698074.jpeg	Karyawan dengan NIK: 123344 kedapatan membawa HP	\N	f	2023-02-06 14:02:49+07	2023-02-06 14:02:49+07	2023-02
\.


--
-- TOC entry 2219 (class 2606 OID 63114)
-- Name: inspeksi inspeksi_pkey; Type: CONSTRAINT; Schema: inspeksi_tmp; Owner: postgres
--

ALTER TABLE ONLY inspeksi_tmp.inspeksi
    ADD CONSTRAINT inspeksi_pkey PRIMARY KEY (id);


--
-- TOC entry 2216 (class 2606 OID 62973)
-- Name: jadwal jadwal_pkey; Type: CONSTRAINT; Schema: inspeksi_tmp; Owner: postgres
--

ALTER TABLE ONLY inspeksi_tmp.jadwal
    ADD CONSTRAINT jadwal_pkey PRIMARY KEY (id_jadwal);


--
-- TOC entry 2214 (class 2606 OID 62941)
-- Name: temuan_inspeksi temuan_inspeksi_pkey; Type: CONSTRAINT; Schema: inspeksi_tmp; Owner: postgres
--

ALTER TABLE ONLY inspeksi_tmp.temuan_inspeksi
    ADD CONSTRAINT temuan_inspeksi_pkey PRIMARY KEY (id);


--
-- TOC entry 2217 (class 1259 OID 63052)
-- Name: ci_sessions_timestamp; Type: INDEX; Schema: inspeksi_tmp; Owner: postgres
--

CREATE INDEX ci_sessions_timestamp ON inspeksi_tmp.ci_sessions USING btree ("timestamp");


-- Completed on 2023-02-09 14:30:54

--
-- PostgreSQL database dump complete
--

