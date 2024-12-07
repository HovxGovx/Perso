--
-- PostgreSQL database dump
--

-- Dumped from database version 15.6
-- Dumped by pg_dump version 15.6

-- Started on 2024-12-06 09:58:57

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
-- TOC entry 214 (class 1259 OID 17063)
-- Name: dossier_id_dossier_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.dossier_id_dossier_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.dossier_id_dossier_seq OWNER TO postgres;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 215 (class 1259 OID 17064)
-- Name: avis; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.avis (
    id_avis integer DEFAULT nextval('public.dossier_id_dossier_seq'::regclass) NOT NULL,
    avis character varying(250),
    "Mod_Attr" character varying(250),
    prix character varying(128),
    id_dossier integer,
    auteur character varying(128),
    obs character varying(256)
);


ALTER TABLE public.avis OWNER TO postgres;

--
-- TOC entry 216 (class 1259 OID 17070)
-- Name: cel; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cel (
    id_cel integer NOT NULL,
    id_dossier integer,
    resume_pv character varying(255),
    consistance character varying(255),
    auteur character varying(255),
    date_mise_valeur date,
    date_descente date
);


ALTER TABLE public.cel OWNER TO postgres;

--
-- TOC entry 217 (class 1259 OID 17075)
-- Name: cel_idcel_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.cel_idcel_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cel_idcel_seq OWNER TO postgres;

--
-- TOC entry 3470 (class 0 OID 0)
-- Dependencies: 217
-- Name: cel_idcel_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.cel_idcel_seq OWNED BY public.cel.id_cel;


--
-- TOC entry 218 (class 1259 OID 17076)
-- Name: circonscription; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.circonscription (
    idcirconscription integer NOT NULL,
    libelle character varying(128),
    indice character(32),
    idregion integer
);


ALTER TABLE public.circonscription OWNER TO postgres;

--
-- TOC entry 219 (class 1259 OID 17079)
-- Name: circonscription_idcirconscription_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.circonscription_idcirconscription_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.circonscription_idcirconscription_seq OWNER TO postgres;

--
-- TOC entry 3471 (class 0 OID 0)
-- Dependencies: 219
-- Name: circonscription_idcirconscription_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.circonscription_idcirconscription_seq OWNED BY public.circonscription.idcirconscription;


--
-- TOC entry 220 (class 1259 OID 17080)
-- Name: demandeur_id_demandeur_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.demandeur_id_demandeur_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.demandeur_id_demandeur_seq OWNER TO postgres;

--
-- TOC entry 221 (class 1259 OID 17081)
-- Name: demandeur; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.demandeur (
    id_demandeur integer DEFAULT nextval('public.demandeur_id_demandeur_seq'::regclass) NOT NULL,
    type_demandeur integer,
    nom_demandeur character(32),
    prenom_demandeur character(32),
    cin_demandeur character varying(128),
    telephone integer,
    adresse_demandeur character varying(256),
    date_naissance date,
    lieu_naissance character varying(128),
    situation_familiale character varying(32),
    pere_demandeur character varying(128),
    mere_demandeur character varying(128),
    representant character varying(128)
);


ALTER TABLE public.demandeur OWNER TO postgres;

--
-- TOC entry 222 (class 1259 OID 17087)
-- Name: demandeur_dossier; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.demandeur_dossier (
    id_dossier integer NOT NULL,
    id_demandeur integer NOT NULL
);


ALTER TABLE public.demandeur_dossier OWNER TO postgres;

--
-- TOC entry 223 (class 1259 OID 17090)
-- Name: dossier; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.dossier (
    id_dossier integer DEFAULT nextval('public.dossier_id_dossier_seq'::regclass) NOT NULL,
    id_terrain integer NOT NULL,
    objetfiche character(255),
    date_demande date,
    nature_demande character(32),
    description text,
    type_affaire character varying(16),
    num_affaire character varying(128),
    "Etat" character varying(128),
    id_responsable integer,
    id_circonscription integer,
    id_region integer,
    date_convocation date,
    empietement boolean
);


ALTER TABLE public.dossier OWNER TO postgres;

--
-- TOC entry 224 (class 1259 OID 17096)
-- Name: effectuer; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.effectuer (
    id_demandeur integer NOT NULL,
    id_payement integer NOT NULL
);


ALTER TABLE public.effectuer OWNER TO postgres;

--
-- TOC entry 225 (class 1259 OID 17099)
-- Name: payement_id_payement_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.payement_id_payement_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.payement_id_payement_seq OWNER TO postgres;

--
-- TOC entry 226 (class 1259 OID 17100)
-- Name: payement; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.payement (
    id_payement integer DEFAULT nextval('public.payement_id_payement_seq'::regclass) NOT NULL,
    prix integer,
    objet_payement character varying(255),
    date_payement date
);


ALTER TABLE public.payement OWNER TO postgres;

--
-- TOC entry 227 (class 1259 OID 17104)
-- Name: piecejointe_id_piecejointe_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.piecejointe_id_piecejointe_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.piecejointe_id_piecejointe_seq OWNER TO postgres;

--
-- TOC entry 228 (class 1259 OID 17105)
-- Name: piecejointe; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.piecejointe (
    id_piecejointe integer DEFAULT nextval('public.piecejointe_id_piecejointe_seq'::regclass) NOT NULL,
    id_dossier integer NOT NULL,
    path_plan character(1550) NOT NULL
);


ALTER TABLE public.piecejointe OWNER TO postgres;

--
-- TOC entry 229 (class 1259 OID 17111)
-- Name: responsable_id_responsable_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.responsable_id_responsable_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.responsable_id_responsable_seq OWNER TO postgres;

--
-- TOC entry 230 (class 1259 OID 17112)
-- Name: responsable; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.responsable (
    id_responsable integer DEFAULT nextval('public.responsable_id_responsable_seq'::regclass) NOT NULL,
    id_role integer NOT NULL,
    email character varying(128),
    telephone integer,
    login character varying(128),
    mdp character varying(128),
    nom character(128),
    prenom character(128),
    fonction character varying(128),
    id_circonscription integer,
    id_region integer
);


ALTER TABLE public.responsable OWNER TO postgres;

--
-- TOC entry 231 (class 1259 OID 17118)
-- Name: role_id_role_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.role_id_role_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.role_id_role_seq OWNER TO postgres;

--
-- TOC entry 232 (class 1259 OID 17119)
-- Name: role; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.role (
    id_role integer DEFAULT nextval('public.role_id_role_seq'::regclass) NOT NULL,
    libelle character varying(255),
    lieu character varying(255)
);


ALTER TABLE public.role OWNER TO postgres;

--
-- TOC entry 233 (class 1259 OID 17125)
-- Name: service_regional; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.service_regional (
    idregion integer NOT NULL,
    nomregion character(32)
);


ALTER TABLE public.service_regional OWNER TO postgres;

--
-- TOC entry 234 (class 1259 OID 17128)
-- Name: terrain_id_terrain_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.terrain_id_terrain_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.terrain_id_terrain_seq OWNER TO postgres;

--
-- TOC entry 235 (class 1259 OID 17129)
-- Name: terrain; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.terrain (
    id_terrain integer DEFAULT nextval('public.terrain_id_terrain_seq'::regclass) NOT NULL,
    superficie character varying(255),
    num_titre character(32),
    num_parcelle character varying(128),
    section character varying(32),
    type_terrain character varying(128),
    nom_propriete character varying(128),
    canton character varying(128),
    localisation character varying(256) NOT NULL,
    id_region integer,
    empiettement boolean
);


ALTER TABLE public.terrain OWNER TO postgres;

--
-- TOC entry 236 (class 1259 OID 17135)
-- Name: transF; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."transF" (
    id_trans integer DEFAULT nextval('public.dossier_id_dossier_seq'::regclass) NOT NULL,
    id_dossier integer,
    auteur character varying(200),
    destinataire character varying(200),
    date_trans date,
    id_avis integer,
    path_plan character varying,
    bordereau character varying(250),
    prix integer
);


ALTER TABLE public."transF" OWNER TO postgres;

--
-- TOC entry 237 (class 1259 OID 17141)
-- Name: transferer_id_dossier_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.transferer_id_dossier_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.transferer_id_dossier_seq OWNER TO postgres;

--
-- TOC entry 238 (class 1259 OID 17142)
-- Name: transferer_id_responsable_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.transferer_id_responsable_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.transferer_id_responsable_seq OWNER TO postgres;

--
-- TOC entry 239 (class 1259 OID 17143)
-- Name: transferer; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.transferer (
    id_dossier integer DEFAULT nextval('public.transferer_id_dossier_seq'::regclass) NOT NULL,
    id_responsable integer DEFAULT nextval('public.transferer_id_responsable_seq'::regclass) NOT NULL,
    avis character varying(255),
    date_avis date,
    auteur character varying(128),
    date_descente date,
    observation character varying(255),
    propostion character varying(255),
    destinataire character varying(255),
    fonction character(32),
    date_transfert date,
    date_reception date
);


ALTER TABLE public.transferer OWNER TO postgres;

--
-- TOC entry 3240 (class 2604 OID 17150)
-- Name: cel id_cel; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cel ALTER COLUMN id_cel SET DEFAULT nextval('public.cel_idcel_seq'::regclass);


--
-- TOC entry 3241 (class 2604 OID 17151)
-- Name: circonscription idcirconscription; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.circonscription ALTER COLUMN idcirconscription SET DEFAULT nextval('public.circonscription_idcirconscription_seq'::regclass);


--
-- TOC entry 3439 (class 0 OID 17064)
-- Dependencies: 215
-- Data for Name: avis; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.avis (id_avis, avis, "Mod_Attr", prix, id_dossier, auteur, obs) VALUES (428, 'qwerty', 'Vente à l''amiable', '700', 308, 'CCDF', NULL);
INSERT INTO public.avis (id_avis, avis, "Mod_Attr", prix, id_dossier, auteur, obs) VALUES (429, 'qwertyuiop', '', '', 308, 'president', NULL);
INSERT INTO public.avis (id_avis, avis, "Mod_Attr", prix, id_dossier, auteur, obs) VALUES (430, 'azazazaz', 'Vente definitive', '800', 319, 'CCDF', NULL);
INSERT INTO public.avis (id_avis, avis, "Mod_Attr", prix, id_dossier, auteur, obs) VALUES (431, 'azazaz', '', '', 319, 'president', NULL);
INSERT INTO public.avis (id_avis, avis, "Mod_Attr", prix, id_dossier, auteur, obs) VALUES (432, 'Pour avis ', 'Vente definitive', '800', NULL, 'rindra', 'Observation');
INSERT INTO public.avis (id_avis, avis, "Mod_Attr", prix, id_dossier, auteur, obs) VALUES (434, 'Pour avis', 'Vente à l''amiable', '700', NULL, 'rindra', 'Observationnn sur le dossier ');
INSERT INTO public.avis (id_avis, avis, "Mod_Attr", prix, id_dossier, auteur, obs) VALUES (436, 'qwertyuiop', 'Vente à l''amiable', '159', 303, 'CCDF', NULL);
INSERT INTO public.avis (id_avis, avis, "Mod_Attr", prix, id_dossier, auteur, obs) VALUES (437, 'azerty', '', '', 303, 'president', NULL);
INSERT INTO public.avis (id_avis, avis, "Mod_Attr", prix, id_dossier, auteur, obs) VALUES (438, 'Pour avis', 'Vente à l''amiable', '159', NULL, 'rindra', 'observation');
INSERT INTO public.avis (id_avis, avis, "Mod_Attr", prix, id_dossier, auteur, obs) VALUES (440, 'Avis', 'Vente definitive', '700', 306, 'CCDF', NULL);
INSERT INTO public.avis (id_avis, avis, "Mod_Attr", prix, id_dossier, auteur, obs) VALUES (441, 'avisss', '', '', 306, 'president', NULL);
INSERT INTO public.avis (id_avis, avis, "Mod_Attr", prix, id_dossier, auteur, obs) VALUES (442, 'Pour avis', 'Vente definitive', '', NULL, 'rindra', 'observation');
INSERT INTO public.avis (id_avis, avis, "Mod_Attr", prix, id_dossier, auteur, obs) VALUES (443, 'Pour avis', 'Vente definitive', '700', NULL, 'rindra', 'observation');
INSERT INTO public.avis (id_avis, avis, "Mod_Attr", prix, id_dossier, auteur, obs) VALUES (445, 'Avis', 'Vente definitive', '150', 304, 'CCDF', NULL);
INSERT INTO public.avis (id_avis, avis, "Mod_Attr", prix, id_dossier, auteur, obs) VALUES (446, 'Qwertyyyy', '', '', 304, 'president', NULL);
INSERT INTO public.avis (id_avis, avis, "Mod_Attr", prix, id_dossier, auteur, obs) VALUES (447, 'qwe', 'Vente definitive', '457', 305, 'CCDF', NULL);
INSERT INTO public.avis (id_avis, avis, "Mod_Attr", prix, id_dossier, auteur, obs) VALUES (448, 'aserty', '', '', 305, 'president', NULL);
INSERT INTO public.avis (id_avis, avis, "Mod_Attr", prix, id_dossier, auteur, obs) VALUES (449, 'Pour avis', 'Vente definitive', '150', NULL, 'rindra', 'observation');
INSERT INTO public.avis (id_avis, avis, "Mod_Attr", prix, id_dossier, auteur, obs) VALUES (451, 'Pour avis', 'Vente definitive', '457', NULL, 'rindra', 'obs');
INSERT INTO public.avis (id_avis, avis, "Mod_Attr", prix, id_dossier, auteur, obs) VALUES (453, 'aces', 'Vente à l''amiable', '455', 307, 'CCDF', NULL);
INSERT INTO public.avis (id_avis, avis, "Mod_Attr", prix, id_dossier, auteur, obs) VALUES (454, 'qwas', '', '', 307, 'president', NULL);
INSERT INTO public.avis (id_avis, avis, "Mod_Attr", prix, id_dossier, auteur, obs) VALUES (455, 'Pour avis', 'Vente à l''amiable', '455', NULL, 'rindra', 'observation');
INSERT INTO public.avis (id_avis, avis, "Mod_Attr", prix, id_dossier, auteur, obs) VALUES (457, '123', 'Vente de gré à gré', '123', 309, 'CCDF', NULL);
INSERT INTO public.avis (id_avis, avis, "Mod_Attr", prix, id_dossier, auteur, obs) VALUES (458, 'qwertyuiop', '', '', 309, 'president', NULL);
INSERT INTO public.avis (id_avis, avis, "Mod_Attr", prix, id_dossier, auteur, obs) VALUES (459, 'Pour avis', 'Vente de gré à gré', '123', NULL, 'rindra', 'observation');
INSERT INTO public.avis (id_avis, avis, "Mod_Attr", prix, id_dossier, auteur, obs) VALUES (461, 'sdfh', 'Vente definitive', '356', 310, 'CCDF', NULL);
INSERT INTO public.avis (id_avis, avis, "Mod_Attr", prix, id_dossier, auteur, obs) VALUES (462, '1346', '', '', 310, 'president', NULL);
INSERT INTO public.avis (id_avis, avis, "Mod_Attr", prix, id_dossier, auteur, obs) VALUES (463, 'Pour avis', 'Vente definitive', '356', NULL, 'rindra', 'observation');
INSERT INTO public.avis (id_avis, avis, "Mod_Attr", prix, id_dossier, auteur, obs) VALUES (465, 'azazaz', 'Vente à l''amiable', '145', 311, 'CCDF', NULL);
INSERT INTO public.avis (id_avis, avis, "Mod_Attr", prix, id_dossier, auteur, obs) VALUES (466, 'qwertyuiop', '', '', 311, 'president', NULL);
INSERT INTO public.avis (id_avis, avis, "Mod_Attr", prix, id_dossier, auteur, obs) VALUES (467, 'Pour avis', 'Vente à l''amiable', '145', NULL, 'rindra', 'observation');
INSERT INTO public.avis (id_avis, avis, "Mod_Attr", prix, id_dossier, auteur, obs) VALUES (469, 'avis', 'Vente definitive', '500', 313, 'CCDF', NULL);
INSERT INTO public.avis (id_avis, avis, "Mod_Attr", prix, id_dossier, auteur, obs) VALUES (470, 'asdqwe', '', '', 313, 'president', NULL);
INSERT INTO public.avis (id_avis, avis, "Mod_Attr", prix, id_dossier, auteur, obs) VALUES (471, 'Pour avis', 'Vente definitive', '', NULL, 'rindra', 'observation
');
INSERT INTO public.avis (id_avis, avis, "Mod_Attr", prix, id_dossier, auteur, obs) VALUES (472, 'Pour avis', 'Vente definitive', '500', NULL, 'rindra', 'obs');
INSERT INTO public.avis (id_avis, avis, "Mod_Attr", prix, id_dossier, auteur, obs) VALUES (474, 'qwe', 'Vente definitive', '158', 318, 'CCDF', NULL);
INSERT INTO public.avis (id_avis, avis, "Mod_Attr", prix, id_dossier, auteur, obs) VALUES (475, 'asd', '', '', 318, 'president', NULL);
INSERT INTO public.avis (id_avis, avis, "Mod_Attr", prix, id_dossier, auteur, obs) VALUES (476, 'Pour avis', 'Vente à l''amiable', '700', NULL, 'rindra', 'observation');
INSERT INTO public.avis (id_avis, avis, "Mod_Attr", prix, id_dossier, auteur, obs) VALUES (478, 'Pour avis', 'Vente à l''amiable', '159', NULL, 'rindra', 'observation');
INSERT INTO public.avis (id_avis, avis, "Mod_Attr", prix, id_dossier, auteur, obs) VALUES (480, 'Pour avis', 'Vente definitive', '800', NULL, 'rindra', 'observation');
INSERT INTO public.avis (id_avis, avis, "Mod_Attr", prix, id_dossier, auteur, obs) VALUES (482, 'Pour avis', 'Vente definitive', '800', NULL, 'rindra', 'observation');
INSERT INTO public.avis (id_avis, avis, "Mod_Attr", prix, id_dossier, auteur, obs) VALUES (483, 'Pour avis', 'Vente definitive', '800', NULL, 'rindra', 'observation');
INSERT INTO public.avis (id_avis, avis, "Mod_Attr", prix, id_dossier, auteur, obs) VALUES (485, 'Pour avis', 'Vente definitive', '800', NULL, 'rindra', 'observation');
INSERT INTO public.avis (id_avis, avis, "Mod_Attr", prix, id_dossier, auteur, obs) VALUES (487, 'Pour avis', 'Vente definitive', '800', 319, 'rindra', 'observation');
INSERT INTO public.avis (id_avis, avis, "Mod_Attr", prix, id_dossier, auteur, obs) VALUES (489, 'Pour avis', 'Vente definitive', '800', 319, 'rindra', 'observation');
INSERT INTO public.avis (id_avis, avis, "Mod_Attr", prix, id_dossier, auteur, obs) VALUES (491, 'Pour avis', 'Vente definitive', '800', 319, 'rindra', 'observation');
INSERT INTO public.avis (id_avis, avis, "Mod_Attr", prix, id_dossier, auteur, obs) VALUES (493, 'Pour avis', 'Vente definitive', '150', 304, 'rindra', 'Oservation');
INSERT INTO public.avis (id_avis, avis, "Mod_Attr", prix, id_dossier, auteur, obs) VALUES (495, 'Pour avis', 'Vente definitive', '150', 304, 'rindra', 'observation');
INSERT INTO public.avis (id_avis, avis, "Mod_Attr", prix, id_dossier, auteur, obs) VALUES (497, 'Pour avis', 'Vente definitive', '800', 319, 'rindra', 'observation');
INSERT INTO public.avis (id_avis, avis, "Mod_Attr", prix, id_dossier, auteur, obs) VALUES (499, 'Pour avis', 'Vente definitive', '457', 305, 'rindra', 'observation');
INSERT INTO public.avis (id_avis, avis, "Mod_Attr", prix, id_dossier, auteur, obs) VALUES (501, 'Pour second reperage', 'Vente definitive', '700', 304, 'rindra', 'observation');
INSERT INTO public.avis (id_avis, avis, "Mod_Attr", prix, id_dossier, auteur, obs) VALUES (503, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO public.avis (id_avis, avis, "Mod_Attr", prix, id_dossier, auteur, obs) VALUES (505, 'Pour avis', 'Vente à l''amiable', '455', 307, 'rindra', 'obsevation  sur le dossier');
INSERT INTO public.avis (id_avis, avis, "Mod_Attr", prix, id_dossier, auteur, obs) VALUES (507, 'Pour avis', 'Vente definitive', '800', 319, 'zo', 'OBSERVATION');
INSERT INTO public.avis (id_avis, avis, "Mod_Attr", prix, id_dossier, auteur, obs) VALUES (510, 'pour avis et decision CCDF', 'Vente definitive', '500', 312, 'CCDF', NULL);
INSERT INTO public.avis (id_avis, avis, "Mod_Attr", prix, id_dossier, auteur, obs) VALUES (511, 'Tout vas bien', '', '', 312, 'president', NULL);
INSERT INTO public.avis (id_avis, avis, "Mod_Attr", prix, id_dossier, auteur, obs) VALUES (512, 'Pour second reperage', 'Vente à l''amiable', '455', 307, 'zo', 'Second repérage.');


--
-- TOC entry 3440 (class 0 OID 17070)
-- Dependencies: 216
-- Data for Name: cel; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.cel (id_cel, id_dossier, resume_pv, consistance, auteur, date_mise_valeur, date_descente) VALUES (25, 308, 'assets/uploads/cel/Test_cde_pieces_jointes_etraite22.pdf', 'aze', 'rojo', '2024-11-25', '2024-11-25');
INSERT INTO public.cel (id_cel, id_dossier, resume_pv, consistance, auteur, date_mise_valeur, date_descente) VALUES (26, 319, 'assets/uploads/cel/Test_cde_pieces_jointes_etraite23.pdf', 'Consistance', 'rojo', '2024-11-25', '2024-11-25');
INSERT INTO public.cel (id_cel, id_dossier, resume_pv, consistance, auteur, date_mise_valeur, date_descente) VALUES (27, 303, 'assets/uploads/cel/Test_cde_pieces_jointes_etraite24.pdf', 'Consistance', 'rojo', '2024-11-26', '2024-11-25');
INSERT INTO public.cel (id_cel, id_dossier, resume_pv, consistance, auteur, date_mise_valeur, date_descente) VALUES (28, 305, 'assets/uploads/cel/Test_cde_pieces_jointes_etraite25.pdf', 'Agricole', 'rojo', '2024-11-19', '2024-11-12');
INSERT INTO public.cel (id_cel, id_dossier, resume_pv, consistance, auteur, date_mise_valeur, date_descente) VALUES (29, 307, 'assets/uploads/cel/Test_cde_pieces_jointes_etraite26.pdf', 'Rien dessus', 'rojo', '2024-11-13', '2024-11-26');
INSERT INTO public.cel (id_cel, id_dossier, resume_pv, consistance, auteur, date_mise_valeur, date_descente) VALUES (30, 304, 'assets/uploads/cel/Test_cde_pieces_jointes_etraite27.pdf', 'qwe', 'rojo', '2024-11-19', '2024-11-05');
INSERT INTO public.cel (id_cel, id_dossier, resume_pv, consistance, auteur, date_mise_valeur, date_descente) VALUES (31, 306, 'assets/uploads/cel/Test_cde_pieces_jointes_etraite28.pdf', 'qwe', 'rojo', '2024-11-26', '2024-11-26');
INSERT INTO public.cel (id_cel, id_dossier, resume_pv, consistance, auteur, date_mise_valeur, date_descente) VALUES (32, 309, 'assets/uploads/cel/Test_cde_pieces_jointes_etraite29.pdf', 'aze', 'rojo', '2024-11-26', '2024-11-26');
INSERT INTO public.cel (id_cel, id_dossier, resume_pv, consistance, auteur, date_mise_valeur, date_descente) VALUES (33, 311, 'assets/uploads/cel/Test_cde_pieces_jointes_etraite30.pdf', 'Consistance du terrain', 'rojo', '2024-11-19', '2024-11-19');
INSERT INTO public.cel (id_cel, id_dossier, resume_pv, consistance, auteur, date_mise_valeur, date_descente) VALUES (34, 310, 'assets/uploads/cel/Test_cde_pieces_jointes_etraite31.pdf', 'Consistance du terrain', 'rojo', '2024-11-26', '2024-11-19');
INSERT INTO public.cel (id_cel, id_dossier, resume_pv, consistance, auteur, date_mise_valeur, date_descente) VALUES (35, 313, 'assets/uploads/cel/Test_cde_pieces_jointes_etraite32.pdf', 'Consistance', 'rojo', '2024-11-26', '2024-11-19');
INSERT INTO public.cel (id_cel, id_dossier, resume_pv, consistance, auteur, date_mise_valeur, date_descente) VALUES (36, 318, 'assets/uploads/cel/Test_cde_pieces_jointes_etraite33.pdf', 'Consistance', 'rojo', '2024-11-27', '2024-11-13');
INSERT INTO public.cel (id_cel, id_dossier, resume_pv, consistance, auteur, date_mise_valeur, date_descente) VALUES (37, 308, 'assets/uploads/cel/Test_cde_pieces_jointes_etraite34.pdf', 'asd', 'rojo', '2024-11-27', '2024-11-26');
INSERT INTO public.cel (id_cel, id_dossier, resume_pv, consistance, auteur, date_mise_valeur, date_descente) VALUES (38, 319, 'assets/uploads/cel/Test_cde_pieces_jointes_etraite35.pdf', 'asd', 'rojo', '2024-11-25', '2024-11-26');
INSERT INTO public.cel (id_cel, id_dossier, resume_pv, consistance, auteur, date_mise_valeur, date_descente) VALUES (39, 303, 'assets/uploads/cel/Test_cde_pieces_jointes_etraite36.pdf', 'Consistance du terrain', 'rojo', '2024-11-20', '2024-11-26');
INSERT INTO public.cel (id_cel, id_dossier, resume_pv, consistance, auteur, date_mise_valeur, date_descente) VALUES (40, 306, 'assets/uploads/cel/Test_cde_pieces_jointes_etraite37.pdf', 'Consistance  du terrain', 'rojo', '2024-11-26', '2024-11-27');
INSERT INTO public.cel (id_cel, id_dossier, resume_pv, consistance, auteur, date_mise_valeur, date_descente) VALUES (41, 304, 'assets/uploads/cel/Test_cde_pieces_jointes_etraite38.pdf', 'Consistance du terrain', 'rojo', '2024-11-19', '2024-11-20');
INSERT INTO public.cel (id_cel, id_dossier, resume_pv, consistance, auteur, date_mise_valeur, date_descente) VALUES (42, 305, 'assets/uploads/cel/Test_cde_pieces_jointes_etraite39.pdf', 'Consisatnace du terrain', 'rojo', '2024-11-19', '2024-11-19');
INSERT INTO public.cel (id_cel, id_dossier, resume_pv, consistance, auteur, date_mise_valeur, date_descente) VALUES (43, 307, 'assets/uploads/cel/Test_cde_pieces_jointes_etraite40.pdf', 'Consistance', 'rojo', '2024-11-27', '2024-11-27');
INSERT INTO public.cel (id_cel, id_dossier, resume_pv, consistance, auteur, date_mise_valeur, date_descente) VALUES (44, 309, 'assets/uploads/cel/Test_cde_pieces_jointes_etraite41.pdf', 'Consistance', 'rojo', '2024-11-27', '2024-11-26');
INSERT INTO public.cel (id_cel, id_dossier, resume_pv, consistance, auteur, date_mise_valeur, date_descente) VALUES (45, 310, 'assets/uploads/cel/Test_cde_pieces_jointes_etraite42.pdf', 'agtjescv', 'rojo', '2024-11-20', '2024-11-26');
INSERT INTO public.cel (id_cel, id_dossier, resume_pv, consistance, auteur, date_mise_valeur, date_descente) VALUES (46, 311, 'assets/uploads/cel/Test_cde_pieces_jointes_etraite43.pdf', 'Consistance', 'rojo', '2024-11-26', '2024-11-27');
INSERT INTO public.cel (id_cel, id_dossier, resume_pv, consistance, auteur, date_mise_valeur, date_descente) VALUES (47, 313, 'assets/uploads/cel/Test_cde_pieces_jointes_etraite44.pdf', 'consistance', 'rojo', '2024-11-27', '2024-11-27');
INSERT INTO public.cel (id_cel, id_dossier, resume_pv, consistance, auteur, date_mise_valeur, date_descente) VALUES (48, 318, 'assets/uploads/cel/Test_cde_pieces_jointes_etraite45.pdf', 'consistnce', 'rojo', '2024-11-26', '2024-11-27');
INSERT INTO public.cel (id_cel, id_dossier, resume_pv, consistance, auteur, date_mise_valeur, date_descente) VALUES (49, 312, 'assets/uploads/cel/Test_cde_pieces_jointes_etraite47.pdf', 'Consistance', 'rojo', '2024-12-10', '2024-12-05');


--
-- TOC entry 3442 (class 0 OID 17076)
-- Dependencies: 218
-- Data for Name: circonscription; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.circonscription (idcirconscription, libelle, indice, idregion) VALUES (2, 'ATSIMONDRANO', 'B                               ', 1);
INSERT INTO public.circonscription (idcirconscription, libelle, indice, idregion) VALUES (3, 'ARIVONIMAMO', 'G                               ', 2);
INSERT INTO public.circonscription (idcirconscription, libelle, indice, idregion) VALUES (4, 'AVARADRANO', 'BAV                             ', 1);
INSERT INTO public.circonscription (idcirconscription, libelle, indice, idregion) VALUES (5, 'AMBOHIDRATRIMO', 'H                               ', 1);
INSERT INTO public.circonscription (idcirconscription, libelle, indice, idregion) VALUES (6, 'ANTANANARIVO VILLE', 'A                               ', 1);
INSERT INTO public.circonscription (idcirconscription, libelle, indice, idregion) VALUES (7, 'test', '123                             ', 2);
INSERT INTO public.circonscription (idcirconscription, libelle, indice, idregion) VALUES (8, 'test', '123                             ', 2);
INSERT INTO public.circonscription (idcirconscription, libelle, indice, idregion) VALUES (9, '', '123                             ', 2);
INSERT INTO public.circonscription (idcirconscription, libelle, indice, idregion) VALUES (10, 'Testing', '321A                            ', 1);
INSERT INTO public.circonscription (idcirconscription, libelle, indice, idregion) VALUES (11, 'manandrna', 'qwe                             ', 1);
INSERT INTO public.circonscription (idcirconscription, libelle, indice, idregion) VALUES (1, 'Antananarivo-Ville', 'A                               ', 1);


--
-- TOC entry 3445 (class 0 OID 17081)
-- Dependencies: 221
-- Data for Name: demandeur; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.demandeur (id_demandeur, type_demandeur, nom_demandeur, prenom_demandeur, cin_demandeur, telephone, adresse_demandeur, date_naissance, lieu_naissance, situation_familiale, pere_demandeur, mere_demandeur, representant) VALUES (111, 1, 'Hovanirina                      ', 'Prenom                          ', '12', 123, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO public.demandeur (id_demandeur, type_demandeur, nom_demandeur, prenom_demandeur, cin_demandeur, telephone, adresse_demandeur, date_naissance, lieu_naissance, situation_familiale, pere_demandeur, mere_demandeur, representant) VALUES (112, 1, 'Hovanirina                      ', 'Prenom                          ', '12', 123, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO public.demandeur (id_demandeur, type_demandeur, nom_demandeur, prenom_demandeur, cin_demandeur, telephone, adresse_demandeur, date_naissance, lieu_naissance, situation_familiale, pere_demandeur, mere_demandeur, representant) VALUES (113, 1, 'Nom                             ', 'Prenom                          ', '1234', 1234, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO public.demandeur (id_demandeur, type_demandeur, nom_demandeur, prenom_demandeur, cin_demandeur, telephone, adresse_demandeur, date_naissance, lieu_naissance, situation_familiale, pere_demandeur, mere_demandeur, representant) VALUES (115, 2, 'Nom                             ', 'Prenom                          ', '1234567890', 123456789, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO public.demandeur (id_demandeur, type_demandeur, nom_demandeur, prenom_demandeur, cin_demandeur, telephone, adresse_demandeur, date_naissance, lieu_naissance, situation_familiale, pere_demandeur, mere_demandeur, representant) VALUES (116, 1, 'Test                            ', 'test                            ', '1234', 34124567, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO public.demandeur (id_demandeur, type_demandeur, nom_demandeur, prenom_demandeur, cin_demandeur, telephone, adresse_demandeur, date_naissance, lieu_naissance, situation_familiale, pere_demandeur, mere_demandeur, representant) VALUES (117, 1, 'test-2                          ', 'test-2                          ', '123', 1234, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO public.demandeur (id_demandeur, type_demandeur, nom_demandeur, prenom_demandeur, cin_demandeur, telephone, adresse_demandeur, date_naissance, lieu_naissance, situation_familiale, pere_demandeur, mere_demandeur, representant) VALUES (118, 1, 'Nom                             ', 'Prenom                          ', '12345689', 12345, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO public.demandeur (id_demandeur, type_demandeur, nom_demandeur, prenom_demandeur, cin_demandeur, telephone, adresse_demandeur, date_naissance, lieu_naissance, situation_familiale, pere_demandeur, mere_demandeur, representant) VALUES (121, 1, 'Harenasoa                       ', 'Michella                        ', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO public.demandeur (id_demandeur, type_demandeur, nom_demandeur, prenom_demandeur, cin_demandeur, telephone, adresse_demandeur, date_naissance, lieu_naissance, situation_familiale, pere_demandeur, mere_demandeur, representant) VALUES (122, 1, 'RANDRIA                         ', 'Malala                          ', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO public.demandeur (id_demandeur, type_demandeur, nom_demandeur, prenom_demandeur, cin_demandeur, telephone, adresse_demandeur, date_naissance, lieu_naissance, situation_familiale, pere_demandeur, mere_demandeur, representant) VALUES (123, 2, 'BOA                             ', '                                ', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO public.demandeur (id_demandeur, type_demandeur, nom_demandeur, prenom_demandeur, cin_demandeur, telephone, adresse_demandeur, date_naissance, lieu_naissance, situation_familiale, pere_demandeur, mere_demandeur, representant) VALUES (124, 1, 'rasoa                           ', '                                ', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO public.demandeur (id_demandeur, type_demandeur, nom_demandeur, prenom_demandeur, cin_demandeur, telephone, adresse_demandeur, date_naissance, lieu_naissance, situation_familiale, pere_demandeur, mere_demandeur, representant) VALUES (125, 2, 'SOCIETE MALAGASY                ', '                                ', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO public.demandeur (id_demandeur, type_demandeur, nom_demandeur, prenom_demandeur, cin_demandeur, telephone, adresse_demandeur, date_naissance, lieu_naissance, situation_familiale, pere_demandeur, mere_demandeur, representant) VALUES (126, 2, 'SOCIETE MALAGASY                ', '                                ', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO public.demandeur (id_demandeur, type_demandeur, nom_demandeur, prenom_demandeur, cin_demandeur, telephone, adresse_demandeur, date_naissance, lieu_naissance, situation_familiale, pere_demandeur, mere_demandeur, representant) VALUES (127, 1, 'RASOANIRINA                     ', '                                ', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO public.demandeur (id_demandeur, type_demandeur, nom_demandeur, prenom_demandeur, cin_demandeur, telephone, adresse_demandeur, date_naissance, lieu_naissance, situation_familiale, pere_demandeur, mere_demandeur, representant) VALUES (128, 2, 'BFV                             ', '                                ', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO public.demandeur (id_demandeur, type_demandeur, nom_demandeur, prenom_demandeur, cin_demandeur, telephone, adresse_demandeur, date_naissance, lieu_naissance, situation_familiale, pere_demandeur, mere_demandeur, representant) VALUES (129, 1, 'SENDRASOA                       ', '                                ', '', 35555555, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO public.demandeur (id_demandeur, type_demandeur, nom_demandeur, prenom_demandeur, cin_demandeur, telephone, adresse_demandeur, date_naissance, lieu_naissance, situation_familiale, pere_demandeur, mere_demandeur, representant) VALUES (131, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO public.demandeur (id_demandeur, type_demandeur, nom_demandeur, prenom_demandeur, cin_demandeur, telephone, adresse_demandeur, date_naissance, lieu_naissance, situation_familiale, pere_demandeur, mere_demandeur, representant) VALUES (134, 2, 'Acces                           ', '                                ', '', 2022524, 'LotAccess Tana II', '2000-03-24', 'Tana', 'Marié', '', '', 'Acocat');
INSERT INTO public.demandeur (id_demandeur, type_demandeur, nom_demandeur, prenom_demandeur, cin_demandeur, telephone, adresse_demandeur, date_naissance, lieu_naissance, situation_familiale, pere_demandeur, mere_demandeur, representant) VALUES (157, 2, 'RANDRIAMIRAHONA                 ', '                                ', '10234567832', 348958354, 'Lot II N 19 B Ter A', '2006-11-07', 'Naissance', NULL, '', '', 'RANDRIAMIRAHONA');
INSERT INTO public.demandeur (id_demandeur, type_demandeur, nom_demandeur, prenom_demandeur, cin_demandeur, telephone, adresse_demandeur, date_naissance, lieu_naissance, situation_familiale, pere_demandeur, mere_demandeur, representant) VALUES (130, 1, 'RABETOKOTANY                    ', 'Lalaina                         ', '20301256010', 340552433, 'Lot 156', '1988-03-12', 'Antananarivo', 'Marié', 'RAKOTONIRINA', 'RATSIMBAHARISOA', 'undefined');
INSERT INTO public.demandeur (id_demandeur, type_demandeur, nom_demandeur, prenom_demandeur, cin_demandeur, telephone, adresse_demandeur, date_naissance, lieu_naissance, situation_familiale, pere_demandeur, mere_demandeur, representant) VALUES (160, 2, 'RANDRIAMIRAHONA                 ', '                                ', '111111111111', 348958354, 'Lot II N 19 B Ter A', '2006-11-22', 'Naissance', NULL, '', '', 'BNI');
INSERT INTO public.demandeur (id_demandeur, type_demandeur, nom_demandeur, prenom_demandeur, cin_demandeur, telephone, adresse_demandeur, date_naissance, lieu_naissance, situation_familiale, pere_demandeur, mere_demandeur, representant) VALUES (159, 2, 'RANDRIAMIRAHONA                 ', '                                ', '12332112332', 348958354, 'Lot II N 19 B Ter A', '2006-11-08', 'Lieu', NULL, '', '', '');
INSERT INTO public.demandeur (id_demandeur, type_demandeur, nom_demandeur, prenom_demandeur, cin_demandeur, telephone, adresse_demandeur, date_naissance, lieu_naissance, situation_familiale, pere_demandeur, mere_demandeur, representant) VALUES (143, 2, 'Access                          ', '                                ', '', 348958354, 'Lot II N 19 B Ter A', '2006-10-04', 'Lieu', NULL, '', '', 'RANDRIAMIRAHONA');
INSERT INTO public.demandeur (id_demandeur, type_demandeur, nom_demandeur, prenom_demandeur, cin_demandeur, telephone, adresse_demandeur, date_naissance, lieu_naissance, situation_familiale, pere_demandeur, mere_demandeur, representant) VALUES (136, 1, 'RAKOTONIRINA                    ', 'Alex                            ', '204012008413', 340552433, 'Lot 690', '1983-05-25', 'Antananarivo', 'Marié', 'RAKOTO', 'RASOA', 'undefined');
INSERT INTO public.demandeur (id_demandeur, type_demandeur, nom_demandeur, prenom_demandeur, cin_demandeur, telephone, adresse_demandeur, date_naissance, lieu_naissance, situation_familiale, pere_demandeur, mere_demandeur, representant) VALUES (156, 1, 'RABETOKOTANY                    ', 'Lalaina                         ', '203012560101', 340552433, 'Lot 156', '1988-03-12', 'Antananarivo', 'Marié', 'RAKOTONIRINA', 'RATSIMBAHARISOA', 'undefined');
INSERT INTO public.demandeur (id_demandeur, type_demandeur, nom_demandeur, prenom_demandeur, cin_demandeur, telephone, adresse_demandeur, date_naissance, lieu_naissance, situation_familiale, pere_demandeur, mere_demandeur, representant) VALUES (140, 2, 'QWERTY.CO                       ', '                                ', '', 34568902, 'Lot II Tana', '2006-09-26', 'Toamasina', NULL, '', '', 'THIERRY');
INSERT INTO public.demandeur (id_demandeur, type_demandeur, nom_demandeur, prenom_demandeur, cin_demandeur, telephone, adresse_demandeur, date_naissance, lieu_naissance, situation_familiale, pere_demandeur, mere_demandeur, representant) VALUES (141, 2, 'QWERTY.CO                       ', '                                ', '', 34568902, 'Lot II Tana', '2006-09-26', 'Toamasina', NULL, '', '', 'THIERRY');
INSERT INTO public.demandeur (id_demandeur, type_demandeur, nom_demandeur, prenom_demandeur, cin_demandeur, telephone, adresse_demandeur, date_naissance, lieu_naissance, situation_familiale, pere_demandeur, mere_demandeur, representant) VALUES (149, 2, 'TWF                             ', '                                ', '', 348958354, 'Addresse', '2006-10-24', 'Lieu', NULL, '', '', 'RANDRIAMIRAHONA');
INSERT INTO public.demandeur (id_demandeur, type_demandeur, nom_demandeur, prenom_demandeur, cin_demandeur, telephone, adresse_demandeur, date_naissance, lieu_naissance, situation_familiale, pere_demandeur, mere_demandeur, representant) VALUES (150, 2, 'TWF                             ', '                                ', '', 348958354, 'Lot Addrresse', '2006-10-11', 'Lieu', NULL, '', '', 'RANDRIAMIRAHONA');
INSERT INTO public.demandeur (id_demandeur, type_demandeur, nom_demandeur, prenom_demandeur, cin_demandeur, telephone, adresse_demandeur, date_naissance, lieu_naissance, situation_familiale, pere_demandeur, mere_demandeur, representant) VALUES (139, 1, 'RAKOTONIRINA                    ', 'Alex                            ', '204012008412', 340552433, 'Lot 690', '1983-05-25', 'Antananarivo', 'Célibataire', 'RAKOTO', 'RASOA', 'undefined');
INSERT INTO public.demandeur (id_demandeur, type_demandeur, nom_demandeur, prenom_demandeur, cin_demandeur, telephone, adresse_demandeur, date_naissance, lieu_naissance, situation_familiale, pere_demandeur, mere_demandeur, representant) VALUES (144, 2, 'CCI                             ', '                                ', '', 345678907, 'Addresse', '2006-10-04', 'Lieu de naissance', NULL, '', '', 'Gova');
INSERT INTO public.demandeur (id_demandeur, type_demandeur, nom_demandeur, prenom_demandeur, cin_demandeur, telephone, adresse_demandeur, date_naissance, lieu_naissance, situation_familiale, pere_demandeur, mere_demandeur, representant) VALUES (145, 2, 'CCI                             ', '                                ', '', 12049134, 'asf', '2006-10-13', 'Lieu de nais', NULL, '', '', 'Repre');
INSERT INTO public.demandeur (id_demandeur, type_demandeur, nom_demandeur, prenom_demandeur, cin_demandeur, telephone, adresse_demandeur, date_naissance, lieu_naissance, situation_familiale, pere_demandeur, mere_demandeur, representant) VALUES (151, 2, 'Qwerty                          ', '                                ', '', 123456790, 'Addresse', '2006-10-24', 'Lieu', NULL, '', '', 'azerty');
INSERT INTO public.demandeur (id_demandeur, type_demandeur, nom_demandeur, prenom_demandeur, cin_demandeur, telephone, adresse_demandeur, date_naissance, lieu_naissance, situation_familiale, pere_demandeur, mere_demandeur, representant) VALUES (110, 1, 'Demandeur-1                     ', 'Prenom-1                        ', '12345689012', 1234568789, 'Lot II Ter A qwerty', '2006-11-01', 'Tanana', 'Célibataire', 'Papa', 'Madre', 'undefined');
INSERT INTO public.demandeur (id_demandeur, type_demandeur, nom_demandeur, prenom_demandeur, cin_demandeur, telephone, adresse_demandeur, date_naissance, lieu_naissance, situation_familiale, pere_demandeur, mere_demandeur, representant) VALUES (138, 1, 'RANDRIA                         ', 'Mirahona                        ', '101251844512', 347889345, 'Lot Antsir', '1998-10-15', 'Antsirabe', 'Célibataire', 'Dada Randria', 'Neny Randria', 'undefined');
INSERT INTO public.demandeur (id_demandeur, type_demandeur, nom_demandeur, prenom_demandeur, cin_demandeur, telephone, adresse_demandeur, date_naissance, lieu_naissance, situation_familiale, pere_demandeur, mere_demandeur, representant) VALUES (146, 2, 'CCI                             ', '                                ', '', 12345643, 'add RE SSE', '2006-10-17', 'Lieu', NULL, '', '', 'representant');
INSERT INTO public.demandeur (id_demandeur, type_demandeur, nom_demandeur, prenom_demandeur, cin_demandeur, telephone, adresse_demandeur, date_naissance, lieu_naissance, situation_familiale, pere_demandeur, mere_demandeur, representant) VALUES (119, 1, 'RAKOTONIRINA                    ', 'Alex                            ', '204012008418', 340552433, 'Lot 690', '1983-05-25', 'Antananarivo', 'Marié', 'RAKOTO', 'RASOA', 'undefined');
INSERT INTO public.demandeur (id_demandeur, type_demandeur, nom_demandeur, prenom_demandeur, cin_demandeur, telephone, adresse_demandeur, date_naissance, lieu_naissance, situation_familiale, pere_demandeur, mere_demandeur, representant) VALUES (142, 2, 'BNI                             ', '                                ', '', 345678901, 'Addr', '2006-10-02', 'Lieu de naissance', NULL, '', '', 'RAKOTONIRINA');
INSERT INTO public.demandeur (id_demandeur, type_demandeur, nom_demandeur, prenom_demandeur, cin_demandeur, telephone, adresse_demandeur, date_naissance, lieu_naissance, situation_familiale, pere_demandeur, mere_demandeur, representant) VALUES (152, 2, 'azerty                          ', '                                ', '', 345678903, 'Addresse', '2006-10-24', 'Naissance', NULL, '', '', 'qwerty');
INSERT INTO public.demandeur (id_demandeur, type_demandeur, nom_demandeur, prenom_demandeur, cin_demandeur, telephone, adresse_demandeur, date_naissance, lieu_naissance, situation_familiale, pere_demandeur, mere_demandeur, representant) VALUES (153, 2, 'CCD                             ', '                                ', '', 348958354, 'Lot II N 19 B Ter A', '2006-10-24', 'Lieu', NULL, '', '', 'REPR');
INSERT INTO public.demandeur (id_demandeur, type_demandeur, nom_demandeur, prenom_demandeur, cin_demandeur, telephone, adresse_demandeur, date_naissance, lieu_naissance, situation_familiale, pere_demandeur, mere_demandeur, representant) VALUES (154, 2, 'RANDRIAMIRAHONA                 ', '                                ', '', 348958354, 'Lot II N 19 B Ter A', '2006-10-11', 'Naissance', NULL, '', '', 'rep');
INSERT INTO public.demandeur (id_demandeur, type_demandeur, nom_demandeur, prenom_demandeur, cin_demandeur, telephone, adresse_demandeur, date_naissance, lieu_naissance, situation_familiale, pere_demandeur, mere_demandeur, representant) VALUES (147, 2, 'WaterFront                      ', '                                ', '', 348958354, 'Lot II N 19 B Ter A', '2006-10-24', 'Lieu', NULL, '', '', 'Representant');
INSERT INTO public.demandeur (id_demandeur, type_demandeur, nom_demandeur, prenom_demandeur, cin_demandeur, telephone, adresse_demandeur, date_naissance, lieu_naissance, situation_familiale, pere_demandeur, mere_demandeur, representant) VALUES (148, 2, 'TWF                             ', '                                ', '', 348958354, 'Addresse', '2006-10-12', 'Lieu', NULL, '', '', 'Un representant');
INSERT INTO public.demandeur (id_demandeur, type_demandeur, nom_demandeur, prenom_demandeur, cin_demandeur, telephone, adresse_demandeur, date_naissance, lieu_naissance, situation_familiale, pere_demandeur, mere_demandeur, representant) VALUES (132, 1, 'Lalaina                         ', 'Arisoa                          ', '106012008418', 340552434, 'Lot 690', '1984-05-25', 'Antananarivo', 'Marié', 'RAKOTO', 'RASOA', 'undefined');
INSERT INTO public.demandeur (id_demandeur, type_demandeur, nom_demandeur, prenom_demandeur, cin_demandeur, telephone, adresse_demandeur, date_naissance, lieu_naissance, situation_familiale, pere_demandeur, mere_demandeur, representant) VALUES (155, 2, 'RANDRIAMIRAHONA                 ', '                                ', '', 348958354, 'Lot II N 19 B Ter A', '2006-10-24', 'ldn', NULL, '', '', 'tres');
INSERT INTO public.demandeur (id_demandeur, type_demandeur, nom_demandeur, prenom_demandeur, cin_demandeur, telephone, adresse_demandeur, date_naissance, lieu_naissance, situation_familiale, pere_demandeur, mere_demandeur, representant) VALUES (114, 1, 'RANDRIAMIRAHONA                 ', 'Hovanirina Toussaint Angelot    ', '12435678945', 348958354, 'Lot II N 19 B Ter A', '2006-11-08', 'Naissance', 'Célibataire', 'PAPA', 'MAMA', 'undefined');
INSERT INTO public.demandeur (id_demandeur, type_demandeur, nom_demandeur, prenom_demandeur, cin_demandeur, telephone, adresse_demandeur, date_naissance, lieu_naissance, situation_familiale, pere_demandeur, mere_demandeur, representant) VALUES (158, 2, 'Nouveau                         ', '                                ', '10923467890', 348958354, 'Lot II N 19 B Ter A', '2006-11-01', 'ldn', NULL, '', '', 'DDPF');
INSERT INTO public.demandeur (id_demandeur, type_demandeur, nom_demandeur, prenom_demandeur, cin_demandeur, telephone, adresse_demandeur, date_naissance, lieu_naissance, situation_familiale, pere_demandeur, mere_demandeur, representant) VALUES (135, 1, 'Demandeur-1                     ', 'Prenom-1                        ', '123456890123', 123456878, 'Lot Tnana III', '2006-10-11', 'Tana III', 'Célibataire', 'Test', 'Test', 'undefined');
INSERT INTO public.demandeur (id_demandeur, type_demandeur, nom_demandeur, prenom_demandeur, cin_demandeur, telephone, adresse_demandeur, date_naissance, lieu_naissance, situation_familiale, pere_demandeur, mere_demandeur, representant) VALUES (137, 1, 'RANDRIA                         ', 'Mirahona                        ', '101251844543', 347889345, 'Lot Antsir', '1998-10-15', 'Antsirabe', 'Célibataire', 'Dada Randria', 'Neny Randria', 'undefined');
INSERT INTO public.demandeur (id_demandeur, type_demandeur, nom_demandeur, prenom_demandeur, cin_demandeur, telephone, adresse_demandeur, date_naissance, lieu_naissance, situation_familiale, pere_demandeur, mere_demandeur, representant) VALUES (133, 1, 'RANDRIA                         ', 'Mirahona                        ', '101251844532', 347889345, 'Lot Antsir', '1998-10-15', 'Antsirabe', 'Célibataire', 'Dada Randria', 'Neny Randria', 'undefined');
INSERT INTO public.demandeur (id_demandeur, type_demandeur, nom_demandeur, prenom_demandeur, cin_demandeur, telephone, adresse_demandeur, date_naissance, lieu_naissance, situation_familiale, pere_demandeur, mere_demandeur, representant) VALUES (120, 1, 'RAKOTONIRINA                    ', 'Alex                            ', '204012008418', 340552433, 'Lot 690', '1983-05-25', 'Antananarivo', 'Marié', 'RAKOTO', 'RASOA', 'undefined');


--
-- TOC entry 3446 (class 0 OID 17087)
-- Dependencies: 222
-- Data for Name: demandeur_dossier; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.demandeur_dossier (id_dossier, id_demandeur) VALUES (228, 132);
INSERT INTO public.demandeur_dossier (id_dossier, id_demandeur) VALUES (229, 119);
INSERT INTO public.demandeur_dossier (id_dossier, id_demandeur) VALUES (229, 132);
INSERT INTO public.demandeur_dossier (id_dossier, id_demandeur) VALUES (230, 119);
INSERT INTO public.demandeur_dossier (id_dossier, id_demandeur) VALUES (231, 132);
INSERT INTO public.demandeur_dossier (id_dossier, id_demandeur) VALUES (233, 119);
INSERT INTO public.demandeur_dossier (id_dossier, id_demandeur) VALUES (234, 133);
INSERT INTO public.demandeur_dossier (id_dossier, id_demandeur) VALUES (235, 133);
INSERT INTO public.demandeur_dossier (id_dossier, id_demandeur) VALUES (236, 119);
INSERT INTO public.demandeur_dossier (id_dossier, id_demandeur) VALUES (300, 119);
INSERT INTO public.demandeur_dossier (id_dossier, id_demandeur) VALUES (302, 119);
INSERT INTO public.demandeur_dossier (id_dossier, id_demandeur) VALUES (303, 119);
INSERT INTO public.demandeur_dossier (id_dossier, id_demandeur) VALUES (304, 132);
INSERT INTO public.demandeur_dossier (id_dossier, id_demandeur) VALUES (304, 119);
INSERT INTO public.demandeur_dossier (id_dossier, id_demandeur) VALUES (305, 136);
INSERT INTO public.demandeur_dossier (id_dossier, id_demandeur) VALUES (306, 139);
INSERT INTO public.demandeur_dossier (id_dossier, id_demandeur) VALUES (306, 137);
INSERT INTO public.demandeur_dossier (id_dossier, id_demandeur) VALUES (307, 137);
INSERT INTO public.demandeur_dossier (id_dossier, id_demandeur) VALUES (308, 137);
INSERT INTO public.demandeur_dossier (id_dossier, id_demandeur) VALUES (309, 151);
INSERT INTO public.demandeur_dossier (id_dossier, id_demandeur) VALUES (309, 137);
INSERT INTO public.demandeur_dossier (id_dossier, id_demandeur) VALUES (310, 137);
INSERT INTO public.demandeur_dossier (id_dossier, id_demandeur) VALUES (311, 137);
INSERT INTO public.demandeur_dossier (id_dossier, id_demandeur) VALUES (312, 133);
INSERT INTO public.demandeur_dossier (id_dossier, id_demandeur) VALUES (313, 137);
INSERT INTO public.demandeur_dossier (id_dossier, id_demandeur) VALUES (318, 138);
INSERT INTO public.demandeur_dossier (id_dossier, id_demandeur) VALUES (318, 119);
INSERT INTO public.demandeur_dossier (id_dossier, id_demandeur) VALUES (319, 160);
INSERT INTO public.demandeur_dossier (id_dossier, id_demandeur) VALUES (319, 136);
INSERT INTO public.demandeur_dossier (id_dossier, id_demandeur) VALUES (509, 138);
INSERT INTO public.demandeur_dossier (id_dossier, id_demandeur) VALUES (514, 119);
INSERT INTO public.demandeur_dossier (id_dossier, id_demandeur) VALUES (514, 133);


--
-- TOC entry 3447 (class 0 OID 17090)
-- Dependencies: 223
-- Data for Name: dossier; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.dossier (id_dossier, id_terrain, objetfiche, date_demande, nature_demande, description, type_affaire, num_affaire, "Etat", id_responsable, id_circonscription, id_region, date_convocation, empietement) VALUES (308, 159, 'Affectation                                                                                                                                                                                                                                                    ', '2024-10-22', 'Morcellement                    ', 'description type II', 'FG', 'FG-0001-10/24', 'Pour Avis SRD', 12, 6, 1, '2024-11-06', false);
INSERT INTO public.dossier (id_dossier, id_terrain, objetfiche, date_demande, nature_demande, description, type_affaire, num_affaire, "Etat", id_responsable, id_circonscription, id_region, date_convocation, empietement) VALUES (306, 157, 'Affectation                                                                                                                                                                                                                                                    ', '2024-10-10', 'Morcellement                    ', 'dasdf;jb aosdbf a;sdofb a;sdlfkn
', 'FN', 'FN-0001-10/24', 'Pour Avis CCDF', 12, 6, 1, '2024-11-06', false);
INSERT INTO public.dossier (id_dossier, id_terrain, objetfiche, date_demande, nature_demande, description, type_affaire, num_affaire, "Etat", id_responsable, id_circonscription, id_region, date_convocation, empietement) VALUES (303, 154, 'Affectation                                                                                                                                                                                                                                                    ', '2024-10-23', 'Morcellement                    ', 'deascsvd', 'FN', 'FN-0001-10/24', 'Pour Avis SRD', 12, 6, 1, '2024-11-05', false);
INSERT INTO public.dossier (id_dossier, id_terrain, objetfiche, date_demande, nature_demande, description, type_affaire, num_affaire, "Etat", id_responsable, id_circonscription, id_region, date_convocation, empietement) VALUES (305, 156, 'Grande superficie                                                                                                                                                                                                                                              ', '2024-10-22', 'Morcellement                    ', 'description', 'FN', 'FN-0001-10/24', 'A-CCDF-SRD', 12, 6, 1, '2024-11-06', false);
INSERT INTO public.dossier (id_dossier, id_terrain, objetfiche, date_demande, nature_demande, description, type_affaire, num_affaire, "Etat", id_responsable, id_circonscription, id_region, date_convocation, empietement) VALUES (304, 155, 'Dotation                                                                                                                                                                                                                                                       ', '2024-10-30', 'Morcellement                    ', 'Description du terrain', 'FN', 'FN-0001-10/24', 'A-CCDF-SRD', 12, 6, 1, '2024-11-01', false);
INSERT INTO public.dossier (id_dossier, id_terrain, objetfiche, date_demande, nature_demande, description, type_affaire, num_affaire, "Etat", id_responsable, id_circonscription, id_region, date_convocation, empietement) VALUES (309, 160, 'Affectation                                                                                                                                                                                                                                                    ', '2024-10-23', 'Morcellement                    ', 'description', 'FN', 'FN-0003-10/24', 'Pour Avis CCDF', 12, 6, 1, '2024-11-07', false);
INSERT INTO public.dossier (id_dossier, id_terrain, objetfiche, date_demande, nature_demande, description, type_affaire, num_affaire, "Etat", id_responsable, id_circonscription, id_region, date_convocation, empietement) VALUES (307, 158, 'Affectation                                                                                                                                                                                                                                                    ', '2024-10-30', 'Morcellement                    ', 'description', 'FN', 'FN-0002-10/24', 'A-SRD-CCDF', 12, 6, 1, '2024-11-15', false);
INSERT INTO public.dossier (id_dossier, id_terrain, objetfiche, date_demande, nature_demande, description, type_affaire, num_affaire, "Etat", id_responsable, id_circonscription, id_region, date_convocation, empietement) VALUES (310, 161, 'Affectation                                                                                                                                                                                                                                                    ', '2024-11-01', 'Morcellement                    ', 'asdasdasdasd', 'FN', 'FN-0004-11/24', 'Pour Avis CCDF', 12, 6, 1, '2024-11-02', false);
INSERT INTO public.dossier (id_dossier, id_terrain, objetfiche, date_demande, nature_demande, description, type_affaire, num_affaire, "Etat", id_responsable, id_circonscription, id_region, date_convocation, empietement) VALUES (311, 162, 'Affectation                                                                                                                                                                                                                                                    ', '2024-11-01', 'Morcellement                    ', 'asdasdasdasd', 'FN', 'FN-0004-11/24', 'Pour Avis CCDF', 12, 6, 1, '2024-11-01', false);
INSERT INTO public.dossier (id_dossier, id_terrain, objetfiche, date_demande, nature_demande, description, type_affaire, num_affaire, "Etat", id_responsable, id_circonscription, id_region, date_convocation, empietement) VALUES (509, 172, 'Grande superficie                                                                                                                                                                                                                                              ', '2024-12-05', 'Morcellement                    ', 'DESCRIPTION DE LA DEMANDE', 'FG', 'FG-0004-12/24', 'Nouvelle Demande', 12, 6, 1, NULL, false);
INSERT INTO public.dossier (id_dossier, id_terrain, objetfiche, date_demande, nature_demande, description, type_affaire, num_affaire, "Etat", id_responsable, id_circonscription, id_region, date_convocation, empietement) VALUES (312, 163, 'Affectation                                                                                                                                                                                                                                                    ', '2024-11-05', 'Morcellement                    ', 'qwerty', 'FG', 'FG-0002-11/24', 'Pour Avis CCDF', 12, 6, 1, '2024-11-19', false);
INSERT INTO public.dossier (id_dossier, id_terrain, objetfiche, date_demande, nature_demande, description, type_affaire, num_affaire, "Etat", id_responsable, id_circonscription, id_region, date_convocation, empietement) VALUES (318, 170, 'Location                                                                                                                                                                                                                                                       ', '2024-11-16', 'Morcellement                    ', 'description', 'FN', 'FN-0007-11/24', 'Pour Avis CCDF', 12, 6, 1, '2024-11-01', false);
INSERT INTO public.dossier (id_dossier, id_terrain, objetfiche, date_demande, nature_demande, description, type_affaire, num_affaire, "Etat", id_responsable, id_circonscription, id_region, date_convocation, empietement) VALUES (313, 165, 'Grande superficie                                                                                                                                                                                                                                              ', '2024-11-14', 'Autre Chose                     ', 'description', 'FN', 'FN-0005-11/24', 'Pour Avis CCDF', 12, 6, 1, '2024-11-02', false);
INSERT INTO public.dossier (id_dossier, id_terrain, objetfiche, date_demande, nature_demande, description, type_affaire, num_affaire, "Etat", id_responsable, id_circonscription, id_region, date_convocation, empietement) VALUES (514, 173, 'Grande superficie                                                                                                                                                                                                                                              ', '2024-12-06', 'Morcellement                    ', 'description de la demande d''une grande superficie', 'FG', 'FG-0005-12/24', 'En attente de C.E.L', 12, 6, 1, '2024-11-26', false);
INSERT INTO public.dossier (id_dossier, id_terrain, objetfiche, date_demande, nature_demande, description, type_affaire, num_affaire, "Etat", id_responsable, id_circonscription, id_region, date_convocation, empietement) VALUES (319, 171, 'test d''autre chose                                                                                                                                                                                                                                             ', '2024-11-12', 'autre nature                    ', 'Description de la demande', 'FG', 'FG-0003-11/24', 'A-SRD-CCDF', 12, 6, 1, '2024-11-01', false);


--
-- TOC entry 3448 (class 0 OID 17096)
-- Dependencies: 224
-- Data for Name: effectuer; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3450 (class 0 OID 17100)
-- Dependencies: 226
-- Data for Name: payement; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.payement (id_payement, prix, objet_payement, date_payement) VALUES (1, 5000, 'Frais de permis', '2023-11-01');
INSERT INTO public.payement (id_payement, prix, objet_payement, date_payement) VALUES (2, 8000, 'Frais d''aménagement', '2023-11-05');
INSERT INTO public.payement (id_payement, prix, objet_payement, date_payement) VALUES (3, 10000, 'Frais d''extension', '2023-11-10');


--
-- TOC entry 3452 (class 0 OID 17105)
-- Dependencies: 228
-- Data for Name: piecejointe; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (103, 303, 'Test_cde_pieces_jointes_etraite_-_Copie_(2)7.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (104, 303, 'Test_cde_pieces_jointes_etraite_-_Copie_(3)7.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (105, 303, 'Test_cde_pieces_jointes_etraite_-_Copie7.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (106, 303, 'Test_cde_pieces_jointes_etraite7.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (107, 304, 'Test_cde_pieces_jointes_etraite8.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (108, 304, 'Test_cde_pieces_jointes_etraite_-_Copie8.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (109, 304, 'Test_cde_pieces_jointes_etraite_-_Copie_(3)8.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (110, 304, 'Test_cde_pieces_jointes_etraite_-_Copie_(2)8.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (156, 304, 'Test_cde_pieces_jointes_etraite21.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (158, 319, 'Test_cde_pieces_jointes_etraite23.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (111, 305, 'Test_cde_pieces_jointes_etraite9.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (112, 305, 'Test_cde_pieces_jointes_etraite_-_Copie9.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (113, 305, 'Test_cde_pieces_jointes_etraite_-_Copie_(3)9.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (114, 305, 'Test_cde_pieces_jointes_etraite_-_Copie_(2)9.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (143, 313, 'Test_cde_pieces_jointes_etraite_-_Copie_(2)17.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (115, 306, 'Test_cde_pieces_jointes_etraite10.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (116, 306, 'Test_cde_pieces_jointes_etraite_-_Copie10.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (117, 306, 'Test_cde_pieces_jointes_etraite_-_Copie_(3)10.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (118, 306, 'Test_cde_pieces_jointes_etraite_-_Copie_(2)10.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (144, 313, 'Test_cde_pieces_jointes_etraite_-_Copie_(3)17.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (119, 307, 'Test_cde_pieces_jointes_etraite11.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (120, 307, 'Test_cde_pieces_jointes_etraite_-_Copie11.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (121, 307, 'Test_cde_pieces_jointes_etraite_-_Copie_(3)11.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (122, 307, 'Test_cde_pieces_jointes_etraite_-_Copie_(2)11.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (145, 313, 'Test_cde_pieces_jointes_etraite_-_Copie17.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (123, 308, 'Test_cde_pieces_jointes_etraite_-_Copie_(2)12.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (124, 308, 'Test_cde_pieces_jointes_etraite_-_Copie_(3)12.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (125, 308, 'Test_cde_pieces_jointes_etraite_-_Copie12.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (126, 308, 'Test_cde_pieces_jointes_etraite12.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (146, 313, 'Test_cde_pieces_jointes_etraite17.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (127, 309, 'Test_cde_pieces_jointes_etraite13.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (128, 309, 'Test_cde_pieces_jointes_etraite_-_Copie13.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (129, 309, 'Test_cde_pieces_jointes_etraite_-_Copie_(3)13.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (130, 309, 'Test_cde_pieces_jointes_etraite_-_Copie_(2)13.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (147, 318, 'Test_cde_pieces_jointes_etraite18.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (131, 310, 'Test_cde_pieces_jointes_etraite_-_Copie_(2)14.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (132, 310, 'Test_cde_pieces_jointes_etraite_-_Copie_(3)14.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (133, 310, 'Test_cde_pieces_jointes_etraite_-_Copie14.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (134, 310, 'Test_cde_pieces_jointes_etraite14.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (148, 318, 'Test_cde_pieces_jointes_etraite_-_Copie18.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (135, 311, 'Test_cde_pieces_jointes_etraite_-_Copie_(2)15.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (136, 311, 'Test_cde_pieces_jointes_etraite_-_Copie_(3)15.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (137, 311, 'Test_cde_pieces_jointes_etraite_-_Copie15.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (138, 311, 'Test_cde_pieces_jointes_etraite15.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (149, 318, 'Test_cde_pieces_jointes_etraite_-_Copie_(3)18.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (139, 312, 'Test_cde_pieces_jointes_etraite_-_Copie_(2)16.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (140, 312, 'Test_cde_pieces_jointes_etraite_-_Copie_(3)16.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (141, 312, 'Test_cde_pieces_jointes_etraite_-_Copie16.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (142, 312, 'Test_cde_pieces_jointes_etraite16.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (150, 318, 'Test_cde_pieces_jointes_etraite_-_Copie_(2)18.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (151, 319, 'Test_cde_pieces_jointes_etraite19.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (152, 319, 'Test_cde_pieces_jointes_etraite_-_Copie19.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (153, 319, 'Test_cde_pieces_jointes_etraite_-_Copie_(3)19.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (154, 319, 'Test_cde_pieces_jointes_etraite_-_Copie_(2)19.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (157, 308, 'Test_cde_pieces_jointes_etraite22.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (159, 303, 'Test_cde_pieces_jointes_etraite24.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (160, 305, 'Test_cde_pieces_jointes_etraite25.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (161, 307, 'Test_cde_pieces_jointes_etraite26.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (162, 304, 'Test_cde_pieces_jointes_etraite27.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (163, 306, 'Test_cde_pieces_jointes_etraite28.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (164, 309, 'Test_cde_pieces_jointes_etraite29.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (165, 311, 'Test_cde_pieces_jointes_etraite30.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (166, 310, 'Test_cde_pieces_jointes_etraite31.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (167, 313, 'Test_cde_pieces_jointes_etraite32.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (168, 318, 'Test_cde_pieces_jointes_etraite33.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (169, 308, 'Test_cde_pieces_jointes_etraite34.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (170, 319, 'Test_cde_pieces_jointes_etraite35.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (171, 303, 'Test_cde_pieces_jointes_etraite36.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (172, 306, 'Test_cde_pieces_jointes_etraite37.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (173, 304, 'Test_cde_pieces_jointes_etraite38.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (174, 305, 'Test_cde_pieces_jointes_etraite39.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (175, 307, 'Test_cde_pieces_jointes_etraite40.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (176, 309, 'Test_cde_pieces_jointes_etraite41.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (177, 310, 'Test_cde_pieces_jointes_etraite42.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (178, 311, 'Test_cde_pieces_jointes_etraite43.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (179, 313, 'Test_cde_pieces_jointes_etraite44.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (180, 318, 'Test_cde_pieces_jointes_etraite45.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (181, 509, 'Test_cde_pieces_jointes_etraite_-_Copie_(2)20.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (182, 509, 'Test_cde_pieces_jointes_etraite_-_Copie_(3)20.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (183, 509, 'Test_cde_pieces_jointes_etraite_-_Copie20.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (184, 509, 'Test_cde_pieces_jointes_etraite46.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (185, 312, 'Test_cde_pieces_jointes_etraite47.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (186, 514, 'Test_cde_pieces_jointes_etraite_-_Copie_(2)21.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (187, 514, 'Test_cde_pieces_jointes_etraite_-_Copie_(3)21.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (188, 514, 'Test_cde_pieces_jointes_etraite_-_Copie21.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 ');
INSERT INTO public.piecejointe (id_piecejointe, id_dossier, path_plan) VALUES (189, 514, 'Test_cde_pieces_jointes_etraite48.pdf                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         ');


--
-- TOC entry 3454 (class 0 OID 17112)
-- Dependencies: 230
-- Data for Name: responsable; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.responsable (id_responsable, id_role, email, telephone, login, mdp, nom, prenom, fonction, id_circonscription, id_region) VALUES (12, 5, '', 340552433, 'rojo', 'rojo', 'rojovola                                                                                                                        ', '                                                                                                                                ', '', 6, 1);
INSERT INTO public.responsable (id_responsable, id_role, email, telephone, login, mdp, nom, prenom, fonction, id_circonscription, id_region) VALUES (13, 4, '', 340552433, 'rindra', 'rindra', 'Chef Rindra                                                                                                                     ', '                                                                                                                                ', '', 6, 1);
INSERT INTO public.responsable (id_responsable, id_role, email, telephone, login, mdp, nom, prenom, fonction, id_circonscription, id_region) VALUES (3, 3, 'responsable_sdc@email.com', 333333333, 'resp_sdc', 'mdp_sdc', 'Lefevre                                                                                                                         ', 'Paul                                                                                                                            ', 'Responsable SDC', NULL, NULL);
INSERT INTO public.responsable (id_responsable, id_role, email, telephone, login, mdp, nom, prenom, fonction, id_circonscription, id_region) VALUES (4, 4, 'responsable_ccdf@email.com', 444444444, 'resp_ccdf', 'mdp_ccdf', 'Durand                                                                                                                          ', 'Marie                                                                                                                           ', 'Responsable CCDF', NULL, NULL);
INSERT INTO public.responsable (id_responsable, id_role, email, telephone, login, mdp, nom, prenom, fonction, id_circonscription, id_region) VALUES (5, 5, 'responsable_guichet@email.com', 555555555, 'resp_guichet', 'mdp_guichet', 'Leclerc                                                                                                                         ', 'Philippe                                                                                                                        ', 'Responsable Guichet', NULL, NULL);
INSERT INTO public.responsable (id_responsable, id_role, email, telephone, login, mdp, nom, prenom, fonction, id_circonscription, id_region) VALUES (6, 6, 'admin@email.com', 666666666, 'admin', 'admin_password', 'Admin                                                                                                                           ', 'System                                                                                                                          ', 'Administrateur', NULL, NULL);
INSERT INTO public.responsable (id_responsable, id_role, email, telephone, login, mdp, nom, prenom, fonction, id_circonscription, id_region) VALUES (9, 5, 'email@gmail.com', 1234567, 'Test', 'mot de passe', 'TEST                                                                                                                            ', 'Test                                                                                                                            ', 'Guichet-3', NULL, NULL);
INSERT INTO public.responsable (id_responsable, id_role, email, telephone, login, mdp, nom, prenom, fonction, id_circonscription, id_region) VALUES (10, 6, 'vonnonna@yahoo.fr', 340552433, 'admin1', 'admin1', 'Vonona                                                                                                                          ', 'Harilala                                                                                                                        ', 'Informaticien', 6, 1);
INSERT INTO public.responsable (id_responsable, id_role, email, telephone, login, mdp, nom, prenom, fonction, id_circonscription, id_region) VALUES (11, 2, '', 340550000, 'zo', 'zo', 'Zo                                                                                                                              ', '                                                                                                                                ', 'Chef de service', NULL, 1);


--
-- TOC entry 3456 (class 0 OID 17119)
-- Dependencies: 232
-- Data for Name: role; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.role (id_role, libelle, lieu) VALUES (1, 'DDPF', 'Central');
INSERT INTO public.role (id_role, libelle, lieu) VALUES (3, 'SDC', 'Central');
INSERT INTO public.role (id_role, libelle, lieu) VALUES (6, 'Administrateur', 'Central');
INSERT INTO public.role (id_role, libelle, lieu) VALUES (4, 'CCDF', 'CIR');
INSERT INTO public.role (id_role, libelle, lieu) VALUES (5, 'Guichet', 'CIR');
INSERT INTO public.role (id_role, libelle, lieu) VALUES (2, 'SRD', 'REG');


--
-- TOC entry 3457 (class 0 OID 17125)
-- Dependencies: 233
-- Data for Name: service_regional; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.service_regional (idregion, nomregion) VALUES (1, 'ANALAMANGA                      ');
INSERT INTO public.service_regional (idregion, nomregion) VALUES (2, 'ITASY                           ');
INSERT INTO public.service_regional (idregion, nomregion) VALUES (3, 'VAKINANKARATRA                  ');


--
-- TOC entry 3459 (class 0 OID 17129)
-- Dependencies: 235
-- Data for Name: terrain; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.terrain (id_terrain, superficie, num_titre, num_parcelle, section, type_terrain, nom_propriete, canton, localisation, id_region, empiettement) VALUES (164, '123', '                                ', '', 'A', '3', '', '', '-qw-qw-qw', 1, false);
INSERT INTO public.terrain (id_terrain, superficie, num_titre, num_parcelle, section, type_terrain, nom_propriete, canton, localisation, id_region, empiettement) VALUES (165, '123', '                                ', '', 'A', '3', '', '', '-des-com-foko', 1, false);
INSERT INTO public.terrain (id_terrain, superficie, num_titre, num_parcelle, section, type_terrain, nom_propriete, canton, localisation, id_region, empiettement) VALUES (166, '123', '                                ', '', 'A', '3', '', '', '-123-123-123', 1, false);
INSERT INTO public.terrain (id_terrain, superficie, num_titre, num_parcelle, section, type_terrain, nom_propriete, canton, localisation, id_region, empiettement) VALUES (167, '1', '                                ', '', 'A', '3', '', '', '-1-1-1', 1, false);
INSERT INTO public.terrain (id_terrain, superficie, num_titre, num_parcelle, section, type_terrain, nom_propriete, canton, localisation, id_region, empiettement) VALUES (168, '1', '                                ', '', 'A', '3', '', '', '-1-1-1', 1, false);
INSERT INTO public.terrain (id_terrain, superficie, num_titre, num_parcelle, section, type_terrain, nom_propriete, canton, localisation, id_region, empiettement) VALUES (169, '', '                                ', '', 'A', '1', '', '', '---', 1, false);
INSERT INTO public.terrain (id_terrain, superficie, num_titre, num_parcelle, section, type_terrain, nom_propriete, canton, localisation, id_region, empiettement) VALUES (170, '123', '                                ', '123', 'B', '2', '', '123', '-123-123-123', 1, false);
INSERT INTO public.terrain (id_terrain, superficie, num_titre, num_parcelle, section, type_terrain, nom_propriete, canton, localisation, id_region, empiettement) VALUES (171, '350', '                                ', '', 'A', '3', '', '', '-123-123-Fokontany', 1, false);
INSERT INTO public.terrain (id_terrain, superficie, num_titre, num_parcelle, section, type_terrain, nom_propriete, canton, localisation, id_region, empiettement) VALUES (172, '123', '                                ', '', 'A', '3', '', '', '-DES-COM-FOKO', 1, false);
INSERT INTO public.terrain (id_terrain, superficie, num_titre, num_parcelle, section, type_terrain, nom_propriete, canton, localisation, id_region, empiettement) VALUES (173, '300', '                                ', 'AB', 'B', '2', '', 'Antsir', '-dis-comm-foko', 1, false);
INSERT INTO public.terrain (id_terrain, superficie, num_titre, num_parcelle, section, type_terrain, nom_propriete, canton, localisation, id_region, empiettement) VALUES (153, '123', '                                ', '', 'A', '3', '', '', '-District-Commune-Canton', 1, false);
INSERT INTO public.terrain (id_terrain, superficie, num_titre, num_parcelle, section, type_terrain, nom_propriete, canton, localisation, id_region, empiettement) VALUES (154, '123', '                                ', '', 'A', '3', '', '', '-adsds-asdas-asdasd', 1, false);
INSERT INTO public.terrain (id_terrain, superficie, num_titre, num_parcelle, section, type_terrain, nom_propriete, canton, localisation, id_region, empiettement) VALUES (155, '400', '0001                            ', '', 'A', '1', 'Bella Vida', '', '-District-Commune-Fokontany', 1, false);
INSERT INTO public.terrain (id_terrain, superficie, num_titre, num_parcelle, section, type_terrain, nom_propriete, canton, localisation, id_region, empiettement) VALUES (156, '100', '                                ', '', 'A', '3', '', '', '-afqt4-qwer-qwefqw', 1, false);
INSERT INTO public.terrain (id_terrain, superficie, num_titre, num_parcelle, section, type_terrain, nom_propriete, canton, localisation, id_region, empiettement) VALUES (157, '320', '                                ', '', 'A', '3', '', '', '-awerqewr-qwer-qw', 1, false);
INSERT INTO public.terrain (id_terrain, superficie, num_titre, num_parcelle, section, type_terrain, nom_propriete, canton, localisation, id_region, empiettement) VALUES (158, '', '                                ', '', 'A', '3', '', '', '-sadgf-asdf-asdf', 1, false);
INSERT INTO public.terrain (id_terrain, superficie, num_titre, num_parcelle, section, type_terrain, nom_propriete, canton, localisation, id_region, empiettement) VALUES (159, '45', '                                ', '', 'A', '3', '', '', '-dis-coco-foko', 1, false);
INSERT INTO public.terrain (id_terrain, superficie, num_titre, num_parcelle, section, type_terrain, nom_propriete, canton, localisation, id_region, empiettement) VALUES (160, '57', '                                ', '', 'A', '3', '', '', '-dis-Commune-Fokontany', 1, false);
INSERT INTO public.terrain (id_terrain, superficie, num_titre, num_parcelle, section, type_terrain, nom_propriete, canton, localisation, id_region, empiettement) VALUES (161, '100', '                                ', '', 'A', '3', '', '', '-asd-asd-asd', 1, false);
INSERT INTO public.terrain (id_terrain, superficie, num_titre, num_parcelle, section, type_terrain, nom_propriete, canton, localisation, id_region, empiettement) VALUES (162, '100', '                                ', '', 'A', '3', '', '', '-asd-asd-asd', 1, false);
INSERT INTO public.terrain (id_terrain, superficie, num_titre, num_parcelle, section, type_terrain, nom_propriete, canton, localisation, id_region, empiettement) VALUES (163, '123', '                                ', 'qw', 'A', '2', '', 'qw', '-qwe-qwe-qwe', 1, false);


--
-- TOC entry 3460 (class 0 OID 17135)
-- Dependencies: 236
-- Data for Name: transF; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (189, 185, 'resp_srd', 'SDC', '2023-12-17', 188, ' Bordereau N 188 resp_srd-SDC.pdf', 'N 188/23-MAHTP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', 400);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (192, 190, 'resp_ccdf', 'SRD', '2023-12-18', 191, ' Bordereau N 191 resp_ccdf-SRD.pdf', 'N 191/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', 0);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (194, 190, 'resp_srd', 'SDC', '2023-12-18', 193, ' Bordereau N 193 resp_srd-SDC.pdf', 'N 193/23-MAHTP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', 500);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (197, 195, 'resp_ccdf', 'SRD', '2023-12-20', 196, ' Bordereau N 196 resp_ccdf-SRD.pdf', 'N 196/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', 0);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (202, 199, 'resp_ccdf', 'SRD', '2023-12-20', 201, ' Bordereau N 201 resp_ccdf-SRD.pdf', 'N 201/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', 0);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (182, 178, 'resp_ccdf', 'SRD', '2023-12-17', 181, ' Bordereau N 181 resp_ccdf-SRD.pdf', 'N 181/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', 0);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (187, 185, 'resp_ccdf', 'SRD', '2023-12-17', 186, ' Bordereau N 186 resp_ccdf-SRD.pdf', 'N 186/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', 0);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (209, NULL, NULL, NULL, NULL, 208, '-', '208/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (211, 205, 'rojo', 'SRD', '2024-08-23', 210, 'rojo-SRD', '210/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (213, 205, 'rojo', 'SRD', '2024-08-23', 212, 'rojo-SRD', 'BE N°212/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (215, 206, 'rindra', '11', '2024-08-23', 214, 'rindra-11', 'BE N°214/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (223, 221, 'rindra', '11', '2024-08-27', 222, 'rindra-11', 'BE N°222/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (225, 216, 'rindra', '11', '2024-08-27', 224, 'rindra-11', 'BE N°224/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (240, 234, 'rindra', '1', '2024-10-18', 239, 'BE N°239/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', 'BE N°239/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (242, 231, 'rindra', '1', '2024-10-18', 241, 'BE N°241/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', 'BE N°241/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (244, 220, 'rindra', '2', '2024-10-18', 243, 'BE N°243/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', 'BE N°243/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (246, 220, 'rindra', '2', '2024-10-18', 245, 'BE N°245/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', 'BE N°245/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (248, 220, 'rindra', '2', '2024-10-18', 247, 'BE N°247/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', 'BE N°247/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (250, 220, 'rindra', '2', '2024-10-18', 249, 'BE N°249/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', 'BE N°249/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (252, 220, 'rindra', '2', '2024-10-18', 251, 'BE N°251/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', 'BE N°251/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (256, 220, 'rindra', '2', '2024-10-18', 255, 'BE N°255/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', 'BE N°255/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (258, 233, 'admin1', '1', '2024-10-18', 257, 'BE N°257/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', 'BE N°257/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (260, 233, 'admin1', '1', '2024-10-18', 259, 'BE N°259/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', 'BE N°259/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (262, 232, 'admin1', '1', '2024-10-18', 261, 'BE N°261/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', 'BE N°261/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (264, 232, 'admin1', '1', '2024-10-18', 263, 'BE N°263/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', 'BE N°263/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (266, 232, 'admin1', '1', '2024-10-18', 265, 'BE N°265/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', 'BE N°265/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (268, 232, 'admin1', '1', '2024-10-18', 267, 'BE N°267/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', 'BE N°267/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (270, 232, 'admin1', '1', '2024-10-18', 269, 'BE N°269/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', 'BE N°269/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (272, 232, 'admin1', '1', '2024-10-18', 271, 'BE N°271/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', 'BE N°271/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (274, 232, 'admin1', '1', '2024-10-18', 273, 'BE N°273/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', 'BE N°273/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (276, 232, 'admin1', '1', '2024-10-18', 275, 'BE N°275/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', 'BE N°275/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (278, 232, 'admin1', '1', '2024-10-18', 277, 'BE N°277/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', 'BE N°277/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (280, 232, 'admin1', '1', '2024-10-18', 279, 'BE N°279/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', 'BE N°279/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (283, 232, 'admin1', '1', '2024-10-18', 282, 'BE N°282/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', 'BE N°282/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (285, 232, 'admin1', '1', '2024-10-18', 284, 'BE N°284/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', 'BE N°284/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (287, 232, 'admin1', '1', '2024-10-18', 286, 'BE N°286/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', 'BE N°286/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (290, 230, 'admin1', '1', '2024-10-18', 289, 'BE N°289/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', 'BE N°289/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (293, 230, 'admin1', '1', '2024-10-18', 292, 'BE N°292/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', 'BE N°292/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (297, 229, 'admin1', '1', '2024-10-18', 296, 'BE N°296/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', 'BE N°296/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (362, 308, 'rindra', 'SRD', '2024-11-25', 361, 'BE N°361/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', 'BE N°361/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (369, 303, 'rindra', 'SRD', '2024-11-25', 368, 'BE N°368/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', 'BE N°368/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (371, 303, 'rindra', 'SRD', '2024-11-25', 370, 'BE N°370/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', 'BE N°370/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (374, 319, 'rindra', 'SRD', '2024-11-25', 373, 'BE N°373/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', 'BE N°373/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (378, 305, 'rindra', 'SRD', '2024-11-26', 377, 'N°377/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', 'N°377/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (380, 305, 'rindra', 'SRD', '2024-11-26', 379, 'N°379/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', 'N°379/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (385, 307, 'rindra', 'SRD', '2024-11-26', 384, 'N°384/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', 'N°384/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (387, 307, 'rindra', 'SRD', '2024-11-26', 386, 'N°386/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', 'N°386/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (389, 307, 'rindra', 'SRD', '2024-11-26', 388, 'N°388/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', 'N°388/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (391, 307, 'rindra', 'SRD', '2024-11-26', 390, 'N°390/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', 'N°390/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (393, 307, 'rindra', 'SRD', '2024-11-26', 392, 'N°392/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', 'N°392/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (400, 306, 'rindra', 'SRD', '2024-11-26', 399, 'N°399/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', 'N°399/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (402, 306, 'rindra', 'SRD', '2024-11-26', 401, 'N°401/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', 'N°401/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (404, 306, 'rindra', 'SRD', '2024-11-26', 403, 'N°403/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', 'N°403/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (407, 304, 'rindra', 'SRD', '2024-11-26', 406, 'N°406/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', 'N°406/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (411, 309, 'rindra', 'SRD', '2024-11-26', 410, 'N°410/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', 'N°410/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (415, 311, 'rindra', 'SRD', '2024-11-26', 414, 'N°414/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', 'N°414/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (419, 310, 'rindra', 'SRD', '2024-11-26', 418, 'N°418/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', 'N°418/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (423, 313, 'rindra', 'SRD', '2024-11-26', 422, 'N°422/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', 'N°422/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (427, 318, 'rindra', 'SRD', '2024-11-26', 426, 'N°426/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', 'N°426/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (433, 319, 'rindra', 'SRD', '2024-11-26', 432, 'N°432/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', 'N°432/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (435, 308, 'rindra', 'SRD', '2024-11-26', 434, 'N°434/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', 'N°434/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (439, 303, 'rindra', 'SRD', '2024-11-27', 438, 'N°438/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', 'N°438/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (444, 306, 'rindra', 'SRD', '2024-11-27', 443, 'N°443/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', 'N°443/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (450, 304, 'rindra', 'SRD', '2024-11-27', 449, 'N°449/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', 'N°449/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (452, 305, 'rindra', 'SRD', '2024-11-27', 451, 'N°451/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', 'N°451/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (456, 307, 'rindra', 'SRD', '2024-11-27', 455, 'N°455/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', 'N°455/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (460, 309, 'rindra', 'SRD', '2024-11-27', 459, 'N°459/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', 'N°459/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (464, 310, 'rindra', 'SRD', '2024-11-27', 463, 'N°463/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', 'N°463/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (468, 311, 'rindra', 'SRD', '2024-11-27', 467, 'N°467/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', 'N°467/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (473, 313, 'rindra', 'SRD', '2024-11-27', 472, 'N°472/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', 'N°472/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (477, 308, 'rindra', 'SRD', '2024-11-27', 476, 'N°476/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', 'N°476/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (479, 303, 'rindra', 'SRD', '2024-11-27', 478, 'N°478/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', 'N°478/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (481, 319, 'rindra', 'SRD', '2024-11-27', 480, 'N°480/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', 'N°480/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (484, 319, 'rindra', 'SRD', '2024-11-27', 483, 'N°483/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', 'N°483/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (486, 319, 'rindra', 'SRD', '2024-11-27', 485, 'N°485/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', 'N°485/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-VILLE', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (488, 319, 'rindra', 'SRD', NULL, 487, 'N°487/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-CCDF', 'N°487/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-CCDF', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (490, 319, 'rindra', 'SRD', NULL, 489, 'N°489/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-CCDF', 'N°489/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-CCDF', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (492, 319, 'rindra', 'SRD', NULL, 491, 'N°491/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-CCDF', 'N°491/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-CCDF', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (494, 304, 'rindra', 'SRD', '2024-11-28', 493, 'N°493/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-CCDF', 'N°493/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-CCDF', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (496, 304, 'rindra', 'SRD', '2024-11-28', 495, 'N°495/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-CCDF', 'N°495/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-CCDF', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (498, 319, 'rindra', 'SRD', '2024-11-28', 497, 'N°497/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-CCDF', 'N°497/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-CCDF', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (500, 305, 'rindra', 'SRD', '2024-11-29', 499, 'N°499/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-CCDF', 'N°499/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-CCDF', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (502, 304, 'rindra', 'SRD', '2024-12-03', 501, 'N°501/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-CCDF', 'N°501/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-CCDF', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (504, NULL, NULL, NULL, '2024-12-03', 503, 'N°503/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-CCDF', 'N°503/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-CCDF', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (506, 307, 'rindra', 'SRD', '2024-12-03', 505, 'N°505/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-CCDF', 'N°505/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-CCDF', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (508, 319, 'zo', 'CCDF', '2024-12-03', 507, 'N°507/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-SRD', 'N°507/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-SRD', NULL);
INSERT INTO public."transF" (id_trans, id_dossier, auteur, destinataire, date_trans, id_avis, path_plan, bordereau, prix) VALUES (513, 307, 'zo', 'CCDF', '2024-12-05', 512, 'N°512/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-SRD', 'N°512/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-SRD', NULL);


--
-- TOC entry 3463 (class 0 OID 17143)
-- Dependencies: 239
-- Data for Name: transferer; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3472 (class 0 OID 0)
-- Dependencies: 217
-- Name: cel_idcel_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.cel_idcel_seq', 49, true);


--
-- TOC entry 3473 (class 0 OID 0)
-- Dependencies: 219
-- Name: circonscription_idcirconscription_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.circonscription_idcirconscription_seq', 11, true);


--
-- TOC entry 3474 (class 0 OID 0)
-- Dependencies: 220
-- Name: demandeur_id_demandeur_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.demandeur_id_demandeur_seq', 160, true);


--
-- TOC entry 3475 (class 0 OID 0)
-- Dependencies: 214
-- Name: dossier_id_dossier_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.dossier_id_dossier_seq', 514, true);


--
-- TOC entry 3476 (class 0 OID 0)
-- Dependencies: 225
-- Name: payement_id_payement_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.payement_id_payement_seq', 1, false);


--
-- TOC entry 3477 (class 0 OID 0)
-- Dependencies: 227
-- Name: piecejointe_id_piecejointe_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.piecejointe_id_piecejointe_seq', 189, true);


--
-- TOC entry 3478 (class 0 OID 0)
-- Dependencies: 229
-- Name: responsable_id_responsable_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.responsable_id_responsable_seq', 13, true);


--
-- TOC entry 3479 (class 0 OID 0)
-- Dependencies: 231
-- Name: role_id_role_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.role_id_role_seq', 1, false);


--
-- TOC entry 3480 (class 0 OID 0)
-- Dependencies: 234
-- Name: terrain_id_terrain_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.terrain_id_terrain_seq', 173, true);


--
-- TOC entry 3481 (class 0 OID 0)
-- Dependencies: 237
-- Name: transferer_id_dossier_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.transferer_id_dossier_seq', 1, false);


--
-- TOC entry 3482 (class 0 OID 0)
-- Dependencies: 238
-- Name: transferer_id_responsable_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.transferer_id_responsable_seq', 1, false);


--
-- TOC entry 3253 (class 2606 OID 17153)
-- Name: avis avis_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.avis
    ADD CONSTRAINT avis_pkey PRIMARY KEY (id_avis);


--
-- TOC entry 3255 (class 2606 OID 17155)
-- Name: cel cel_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cel
    ADD CONSTRAINT cel_pkey PRIMARY KEY (id_cel);


--
-- TOC entry 3257 (class 2606 OID 17157)
-- Name: circonscription pk_circonscription; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.circonscription
    ADD CONSTRAINT pk_circonscription PRIMARY KEY (idcirconscription);


--
-- TOC entry 3259 (class 2606 OID 17159)
-- Name: demandeur pk_demandeur; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.demandeur
    ADD CONSTRAINT pk_demandeur PRIMARY KEY (id_demandeur);


--
-- TOC entry 3262 (class 2606 OID 17161)
-- Name: dossier pk_dossier; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.dossier
    ADD CONSTRAINT pk_dossier PRIMARY KEY (id_dossier);


--
-- TOC entry 3266 (class 2606 OID 17163)
-- Name: effectuer pk_effectuer; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.effectuer
    ADD CONSTRAINT pk_effectuer PRIMARY KEY (id_demandeur, id_payement);


--
-- TOC entry 3268 (class 2606 OID 17165)
-- Name: payement pk_payement; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.payement
    ADD CONSTRAINT pk_payement PRIMARY KEY (id_payement);


--
-- TOC entry 3271 (class 2606 OID 17167)
-- Name: piecejointe pk_piecejointe; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.piecejointe
    ADD CONSTRAINT pk_piecejointe PRIMARY KEY (id_piecejointe);


--
-- TOC entry 3274 (class 2606 OID 17169)
-- Name: responsable pk_responsable; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.responsable
    ADD CONSTRAINT pk_responsable PRIMARY KEY (id_responsable);


--
-- TOC entry 3276 (class 2606 OID 17171)
-- Name: role pk_role; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.role
    ADD CONSTRAINT pk_role PRIMARY KEY (id_role);


--
-- TOC entry 3278 (class 2606 OID 17173)
-- Name: service_regional pk_service_regional; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.service_regional
    ADD CONSTRAINT pk_service_regional PRIMARY KEY (idregion);


--
-- TOC entry 3280 (class 2606 OID 17175)
-- Name: terrain pk_terrain; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.terrain
    ADD CONSTRAINT pk_terrain PRIMARY KEY (id_terrain);


--
-- TOC entry 3286 (class 2606 OID 17177)
-- Name: transferer pk_transferer; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.transferer
    ADD CONSTRAINT pk_transferer PRIMARY KEY (id_dossier, id_responsable);


--
-- TOC entry 3282 (class 2606 OID 17179)
-- Name: transF transF_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."transF"
    ADD CONSTRAINT "transF_pkey" PRIMARY KEY (id_trans);


--
-- TOC entry 3260 (class 1259 OID 17180)
-- Name: i_fk_dossier_terrain; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX i_fk_dossier_terrain ON public.dossier USING btree (id_terrain);


--
-- TOC entry 3263 (class 1259 OID 17181)
-- Name: i_fk_effectuer_demandeur; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX i_fk_effectuer_demandeur ON public.effectuer USING btree (id_demandeur);


--
-- TOC entry 3264 (class 1259 OID 17182)
-- Name: i_fk_effectuer_payement; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX i_fk_effectuer_payement ON public.effectuer USING btree (id_payement);


--
-- TOC entry 3269 (class 1259 OID 17183)
-- Name: i_fk_piecejointe_dossier; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX i_fk_piecejointe_dossier ON public.piecejointe USING btree (id_dossier);


--
-- TOC entry 3272 (class 1259 OID 17184)
-- Name: i_fk_responsable_role; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX i_fk_responsable_role ON public.responsable USING btree (id_role);


--
-- TOC entry 3283 (class 1259 OID 17185)
-- Name: i_fk_transferer_dossier; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX i_fk_transferer_dossier ON public.transferer USING btree (id_dossier);


--
-- TOC entry 3284 (class 1259 OID 17186)
-- Name: i_fk_transferer_responsable; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX i_fk_transferer_responsable ON public.transferer USING btree (id_responsable);


--
-- TOC entry 3288 (class 2606 OID 17187)
-- Name: cel cel_id_dossier_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cel
    ADD CONSTRAINT cel_id_dossier_fkey FOREIGN KEY (id_dossier) REFERENCES public.dossier(id_dossier);


--
-- TOC entry 3289 (class 2606 OID 17192)
-- Name: dossier fk_dossier_terrain; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.dossier
    ADD CONSTRAINT fk_dossier_terrain FOREIGN KEY (id_terrain) REFERENCES public.terrain(id_terrain);


--
-- TOC entry 3290 (class 2606 OID 17197)
-- Name: effectuer fk_effectuer_demandeur; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.effectuer
    ADD CONSTRAINT fk_effectuer_demandeur FOREIGN KEY (id_demandeur) REFERENCES public.demandeur(id_demandeur);


--
-- TOC entry 3291 (class 2606 OID 17202)
-- Name: effectuer fk_effectuer_payement; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.effectuer
    ADD CONSTRAINT fk_effectuer_payement FOREIGN KEY (id_payement) REFERENCES public.payement(id_payement);


--
-- TOC entry 3287 (class 2606 OID 17403)
-- Name: avis fk_id_dossier; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.avis
    ADD CONSTRAINT fk_id_dossier FOREIGN KEY (id_dossier) REFERENCES public.dossier(id_dossier) NOT VALID;


--
-- TOC entry 3292 (class 2606 OID 17207)
-- Name: piecejointe fk_piecejointe_dossier; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.piecejointe
    ADD CONSTRAINT fk_piecejointe_dossier FOREIGN KEY (id_dossier) REFERENCES public.dossier(id_dossier);


--
-- TOC entry 3293 (class 2606 OID 17212)
-- Name: responsable fk_responsable_role; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.responsable
    ADD CONSTRAINT fk_responsable_role FOREIGN KEY (id_role) REFERENCES public.role(id_role);


--
-- TOC entry 3294 (class 2606 OID 17217)
-- Name: transferer fk_transferer_dossier; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.transferer
    ADD CONSTRAINT fk_transferer_dossier FOREIGN KEY (id_dossier) REFERENCES public.dossier(id_dossier);


--
-- TOC entry 3295 (class 2606 OID 17222)
-- Name: transferer fk_transferer_responsable; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.transferer
    ADD CONSTRAINT fk_transferer_responsable FOREIGN KEY (id_responsable) REFERENCES public.responsable(id_responsable);


--
-- TOC entry 3469 (class 0 OID 0)
-- Dependencies: 5
-- Name: SCHEMA public; Type: ACL; Schema: -; Owner: pg_database_owner
--

REVOKE USAGE ON SCHEMA public FROM PUBLIC;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


-- Completed on 2024-12-06 09:58:58

--
-- PostgreSQL database dump complete
--

