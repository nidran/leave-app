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
-- Name: leave; Type: COMMENT; Schema: -; Owner: postgres
--

COMMENT ON DATABASE leave IS 'For leave application';


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
-- Name: department; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE department (
    deptid integer NOT NULL,
    name character varying,
    location character varying,
    hodid character varying,
    login_name character varying
);


ALTER TABLE public.department OWNER TO postgres;

--
-- Name: department_deptid_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE department_deptid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.department_deptid_seq OWNER TO postgres;

--
-- Name: department_deptid_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE department_deptid_seq OWNED BY department.deptid;


--
-- Name: employee; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE employee (
    employeeid character varying NOT NULL,
    name character varying NOT NULL,
    designation character varying NOT NULL,
    email character varying,
    mobileno character varying,
    deskno character varying,
    dob character varying,
    joindate character varying,
    presentadd character varying,
    permadd character varying,
    qualification character varying,
    deptid integer
);


ALTER TABLE public.employee OWNER TO postgres;

--
-- Name: leave; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE leave (
    leaveid integer NOT NULL,
    employeeid character varying NOT NULL,
    purpose character varying,
    nature character varying NOT NULL,
    noday integer NOT NULL,
    add character varying,
    fromdate character varying NOT NULL,
    todate character varying,
    attachments character varying,
    deptid integer NOT NULL,
    noleft integer NOT NULL,
    status character varying NOT NULL,
    currently character varying NOT NULL,
    reason character varying,
    year character varying,
    prefixsat character varying,
    prefixsun character varying,
    suffixsat character varying,
    suffixsun character varying,
    ltc character varying,
    hqfrom character varying,
    hqto character varying,
    flag character varying,
    adminstatus character varying
);


ALTER TABLE public.leave OWNER TO postgres;

--
-- Name: leave_leaveid_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE leave_leaveid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.leave_leaveid_seq OWNER TO postgres;

--
-- Name: leave_leaveid_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE leave_leaveid_seq OWNED BY leave.leaveid;


--
-- Name: room_reqid_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE room_reqid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 100000
    CACHE 1;


ALTER TABLE public.room_reqid_seq OWNER TO postgres;

--
-- Name: temp_reqid_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE temp_reqid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.temp_reqid_seq OWNER TO postgres;

--
-- Name: tracking; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tracking (
    username character varying,
    from_time character varying,
    to_time character varying,
    ip character varying,
    date character varying
);


ALTER TABLE public.tracking OWNER TO postgres;

--
-- Name: user_table; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE user_table (
    username character varying NOT NULL,
    password character varying NOT NULL,
    privelages character varying NOT NULL
);


ALTER TABLE public.user_table OWNER TO postgres;

--
-- Name: deptid; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY department ALTER COLUMN deptid SET DEFAULT nextval('department_deptid_seq'::regclass);


--
-- Name: leaveid; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY leave ALTER COLUMN leaveid SET DEFAULT nextval('leave_leaveid_seq'::regclass);


--
-- Data for Name: department; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY department (deptid, name, location, hodid, login_name) FROM stdin;
1	Administration		63	ao
2	Antarctic Science		43	antarctic
3	Biochemistry		71	biochemistry
5	Cryobiology		50	cryobiology
7	EEZ		46	eez
8	Estate		36	estate
9	Finance		10	ef
10	Ice Core		39	icecore
11	Information & Technology Communication Division		70	ictd
12	Library		47	library
13	Logistics		68	logistics
14	Marine Stable Isotope Lab		53	marinelab
16	Polar Biology 		45	pbiology
17	Polar Environment		51	penvironment
18	Polar Meteorology & Atmospheric Science		69	atmospheric
19	Polar Remote Sensing		49	prslab
20	Procurement		11	ep
6	Director Office		5	director
4	CLCS		40	clcs
22	Hydrothermal Studies		46	
15	OSSG		44	ossg
\.


--
-- Name: department_deptid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('department_deptid_seq', 22, true);


--
-- Data for Name: employee; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY employee (employeeid, name, designation, email, mobileno, deskno, dob, joindate, presentadd, permadd, qualification, deptid) FROM stdin;
T71	Gireesh Raghavan Nair	Research Sc B	gireesh@ncaor.org		2525569		18.04.07				4
T115	Laju Micheal	Research Sc. B	lajum@ncaor.org		2525569		16.10.09				4
T143	Anitha Goli	Research Sc. B					06.05.11				4
T78	Manoj M.C.	Sr. Research Fellow	manojmc@ncaor.org	9765728120	2525637		18.01.08				10
T99	Puja B. Gawas	Research Associate					07.09.09				16
T91	Almeida Celsa Margaret Nitya (CSIR)	Jr. Research Fellow					27.12.06				15
T101	Sruthi K. V.	Jr. Research Fellow	sruthi@ncaor.org	9637398695	2525567		11.09.09				7
T144	Kartik Thammisetti	Jr. Research Fellow					08.06.11				14
T135	Dipak S.  Naik	Engineer (Electrical)					19.11.10				8
T127	Bibin Abraham	Shipboard Assistant					24.05.10 (A/N)				15
71	Bhaskar Parli Vekateswaran	Scientist C	bhaskar@ncaor.gov.in		2525637		30.11.10				15
T98	Achuthanakutty  C. T.	Visting Scientist	achu@ncaor.gov.in		2525517		03.08.09				6
67	Ajeet Kumar	Scientist B	ajeet@ncaor.gov	+91 9970781187	2525569/690		13.10.10				4
42	Bhikaji Laxman Redkar	Scientific Asst.Gr. B	redkar@ncaor.gov.in		2525624/625		12.05.06				10
49	Alvarinho Luis	Scientist D	alvluis@ncaor.gov.in	9403177967	2525526		31.05.06				19
54	Pradeep Kumar Singh	Executive (P&S)		9545621600	2525574		04.08.09				20
68	Mirza Javed Beg	Scientist F	mjbeg@ncaor.gov.in	9823422526	2525520 / 2525521		13.10.10				13
44	Anil Kumar N	Scientist E	anil@ncaor.gov.in	9423889350	2525512 / 2525513		23.05.06				15
39	Thamban Meloth 	Scientist E	meloth@ncaor.org	9423889305	2525622 / 2525623		29.11.02				10
40	Dhananjai Kumar Pandey 	Scientist E	pandey@ncaor.gov.in		2525580		11.08.03				4
43	Rahul Mohan	Scientist D	rahulmohan@ncaor.gov.in	9422438263	2525531/532		23.05.06				2
45	Shiv Mohan Singh	Scientist D	smsingh@ncaor.gov.in	9420767319	2525629/632		23.05.06				16
46	John Kurian P.	Scientist D	john@ncaor.gov.in	9423889320	2525570		23.05.06				7
69	Satheesan K	Scientist D	satheesan@ncaor.gov.in		2525570		11.11.10				18
47	Laluraj C.M.	Scientist D	lalucm@ncaor.gov.in	9423889311	2525641		29.05.06				12
48	Lalit Kumar  Ahirwar	Scientist C	lalit@ncaor.gov.in	9823250411	2525567		29.05.06				11
50	Krishnan K. P. 	Scientist D	krishnan@ncaor.gov.in	9764268286	2525638		05.06.06				5
51	Anoop Kumar Tiwari	Scientist D	anooptiwari@ncaor.gov.in	9923372206	2525632		05.06.06				17
52	Shailesh Pednekar	Scientist C	shailesh@ncaor.gov.in	9421157588	2525540		08.06.06				19
53	Manish Tiwari	Scientist D	manish@ncaor.gov.in	9860269046	2525638		26.06.06				14
66	Shailendra Saini	Scientist C	shailendra@ncaor.gov.in	9823621224	2525568		05.10.10				13
60	Ravi Mishra	Scientist C	ravimishra@ncaor.gov.in	9890695042	2525640		12.01.10				4
10	Shripathi K. 	Joint Manager (F&A)	shri@ncaor.gov.in	9422970681	2525508 / 2525509		25.11.99				9
11	Venkateswarlu K	Joint manager (P&S)	warlu@ncaor.gov.in	9423057056	2525571 / 2525572		07.01.00				20
15	Subramaniam M.M	Scientist B	mmsubbu@ncaor.gov.in	9420688231	2525553		21.10.99				15
14	Ganesh Chandvale	Scientific Asst Gr.B	ganesh@ncaor.gov.in	9423971049	2525554		21.10.99				15
29	Kaushambi Prashad	Asst. Manager(F&A)	kaushambi@ncaor.gov.in		2525564		03.04.00				9
36	Manoj Jayant Oturkar	Asst. Manager (P&S)	manoj@ncaor.gov.in	9423057388	2525527		13.11.00				8
55	Anemi Lakshmana Rao	Sr. Executive (F&A)	lakshman@ncaor.gov.in	9423459239	2525562		10.08.01/ 11.08.09				9
31	Sarita Honavarkar	Sr. Executive (Admn.)	sarita@ncaor.gov.in	9423062291	2525558		22.06.00/ 27.08.10				1
72	Kaveri Kumbar	Executive (Lib.)	library@ncaor.gov.in		2525620		01.06.11				12
16	Reena R. Naik	Coordinator Gr. II	reena.log@ncaor.gov.in		2525523		10.12.99				13
56	Ganesh Chandra Das	Jr. Executive (Admn.)	gcdas@ncaor.gov.in	9637104399	2525557		14.08.09				1
57	Aman Kumar sharma	Jr. Executive(PR)	aksharma@ncaor.gov.in	9923236322	2525556		26.08.09				1
58	Pallavi R. Naik	Jr. Executive (Admn.)	pallavi@ncaor.gov.in	9822144165	2525558		27.08.09				1
62	Rupali A. Rane	Junior Asst. (Admn.)	rupali@ncaor.gov.in	9890467762	2525556		22.02.10				1
65	Sushama H. Chodankar	Junior Asst. (Admn.)	sushma@ncaor.gov.in		2525559		01.09.10				1
32	Santosh Naik	Jr.Asst. (Driver)			2525560		27.06.00				1
18	Tari P. Narayan	Multi Tasking Staff			2525557		26.02.97				1
19	Radhika Sawant	Multi Tasking Staff			2525523		21.03.97				13
20	Shyamala K.G. Nair	Multi Tasking Staff			2525510		21.03.97				6
21	Vir Uttam Navso	Multi Tasking Staff			2525564		29.05.97				9
22	Sita R. Bandekar	Multi Tasking Staff					29.05.97				4
24	Jadhav Kishore Kalgo.	Multi Tasking Staff			2525560		30.05.97				1
23	Tolu D. Velip	Multi Tasking Staff			2525576		03.06.97				20
25	Umesh Halarnkar 	Multi Tasking Staff			2525557		01.10.97				1
T128	Mahalinganathan K.  	Research Sc. B	maha@ncaor.gov.in	9403270288	2525636		20.07.10				10
T80	Racheal Chacko 	Research Sc B	racheal@ncaor.gov.in	9764480240	2525636		18.01.08				15
T119	Suhas Suresh Shetye 	Research Sc. B	suhas@ncaor.gov.in	9823207980	2525640		07.01.10				2
T22	Ramesh M.V.	Research Associate	mvramesh@ncaor.gov.in		2525636		08.03.04				6
T132	Jenson. V. George (CSIR)	SRF (CSIR)	jenson@ncaor.gov.in		2525636		01.06.10				15
T114	Roseline Mary Cutting	Sr. Research Fellow	roseline@ncaor.gov.in		2525636		17.08.09				10
T113	Neelu Singh	Sr. Research Fellow	neelu@ncaor.gov.in		2525636		17.08.09				4
T104	Jawak Shridhar Digambar	Jr. Research Fellow	shidhar.jawak@ncaor.gov.in		2525528		23.09.09				19
T129	Rupesh Sinha	Jr. Research Fellow	rupesh@ncaor.gov.in		2525637		30.08.10				5
63	Arun Kumar Singh	Administrative Officer	aksingh@ncaor.gov.in	9422412624	2525555 / 2525566		20.05.10				1
T137	Sarvesh Goral	Shipboard Assistant					01.12.10				15
T138	Amey Hajare	Project Technical Assistant					06.12.10				15
T139	Pawan Shirodkar	Project Technical Assistant					06.12.10				15
T142	Anamika Mohite	Engineer (Civil)					02.05.11				8
T141	Ashvini D. Shenvi	Engineer (Civil)					28.04.11				8
T140	Rupa Vinay Patil	Project Accountant					12.04.11				9
T72	Ashlesha  Saxena 	Research Sc B	ashlesha@ncaor.org	9923935882	2525548		20.04.07				4
T125	Deepti Gauns	Research Sc. B	diptidesai@ncaor.org		2525551		29.01.10				15
T130	Avinash Kumar	Research Sc. B	avinash@ncaor.org		2525567		14.09.10				7
T131	Vineesh T.C.	Research Sc. B	vineesh@ncaor.org		2525567		27.09.10				7
T136	Honey U.K.Pillai	Research Sc. B	honey.pillai@ncaor.org		2525551		01.12.10				15
76	Runa Antony 	Scientist B	runa@ncaor.org			2525635	21.01.08				10
78	Babula Jena	Scientist C	bjena@ncaor.org	9545785699	2525567		23.09.09				7
79	Abhishek Tyagi	Scientist B	abhishek@ncaor.org	9423319936	2525540		10.09.09				7
80	Denny P. Alappattu	Scientist B	denny@ncaor.org		2525551		24.09.09				15
77	Dr.Nuncio Murukesh 	Scientist B	nuncio@ncaor.org	9890357423	2525528		21.01.08				19
5	Rajan S	Scientist G	rajan@ncaor.org	9545509861	2525510 / 2525511		31.12.97				6
T151	Anish Kumar Warrier	Research Scientist B	anish@ncaor.org								6
89	Nexan Barreto	Technician Grade B	nixon@ncaor.gov.in		252567/691						11
70	Sakthivel Samy  V	Scientist D	vssamy@ncaor.gov.in	+91-9545644044	2525515		12.11.10			M.Tech in Computer Science	11
30	Kennedy C. Sequeira	Junior Executive (Admn.)	kennedy@ncaor.gov.in	9049507493	2525544		21.06.00				9
T74	Shramik M. Patil	Sr. Research Fellow	shramik@ncaor.gov.in	9764596405	2525633		20.09.07				2
T133	Siddhesh Satish Nagoji	Jr. Research Fellow	siddesh@ncaor.gov.in		2525646		18.10.10				14
\.


--
-- Data for Name: leave; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY leave (leaveid, employeeid, purpose, nature, noday, add, fromdate, todate, attachments, deptid, noleft, status, currently, reason, year, prefixsat, prefixsun, suffixsat, suffixsun, ltc, hqfrom, hqto, flag, adminstatus) FROM stdin;
37	70	BBbznbxnsbxn	RH	1	 bmcbsmcbmzb				11	2	approvedbyhod	70	\N	2014					2014-2015			NULL	verified
47	89	zmbmbcm	RH	1	bcnbcnbcn	01-01-2014	01-01-2014		11	2	open	70	\N	2014					2014-2015			NULL	NULL
\.


--
-- Name: leave_leaveid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('leave_leaveid_seq', 47, true);


--
-- Name: room_reqid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('room_reqid_seq', 717, true);


--
-- Name: temp_reqid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('temp_reqid_seq', 5, true);


--
-- Data for Name: tracking; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tracking (username, from_time, to_time, ip, date) FROM stdin;
		18:46:48	::1	30-06-2014
89	18:46:59	18:47:00	::1	30-06-2014
89	19:03:24	19:04:58	::1	30-06-2014
ao	19:24:05	19:26:26	::1	30-06-2014
31	19:26:30	19:27:08	::1	30-06-2014
63	19:27:27	19:27:47	::1	30-06-2014
director	19:28:00	19:28:02	::1	30-06-2014
ao	19:28:06	19:29:13	::1	30-06-2014
director	19:29:23	19:29:25	::1	30-06-2014
31		19:45:13	::1	30-06-2014
ao		19:45:43	::1	30-06-2014
director		19:46:30	::1	30-06-2014
31	19:48:30	19:48:34	::1	30-06-2014
director	19:49:08	19:49:10	::1	30-06-2014
ao	19:52:29	19:52:35	::1	30-06-2014
31	21:02:01	21:02:04	::1	30-06-2014
cadmin	21:02:13	21:17:33	::1	30-06-2014
31	03:05:02	03:05:39	::1	30-06-2014
31	03:05:56	03:09:51	::1	30-06-2014
cadmin	03:10:55	03:12:34	::1	30-06-2014
cadmin	14:32:23	14:37:25	::1	01-07-2014
31	18:42:18	18:45:08	::1	01-07-2014
31	18:45:12	18:49:53	::1	01-07-2014
31	18:49:58	18:53:16	::1	01-07-2014
63	18:53:23	18:53:26	::1	01-07-2014
31	18:53:31	18:53:44	::1	01-07-2014
63	18:57:29	18:58:12	::1	01-07-2014
71	18:58:25	18:58:28	::1	01-07-2014
31	19:24:51	19:25:20	::1	01-07-2014
31	19:27:02	19:27:56	::1	01-07-2014
31	19:28:02	19:36:15	::1	01-07-2014
31	19:36:34	19:38:50	::1	01-07-2014
63	19:38:57	19:42:12	::1	01-07-2014
ao	19:42:48	19:47:11	::1	01-07-2014
director	19:47:19	19:52:17	::1	01-07-2014
31	01:54:21	01:54:51	::1	01-07-2014
63	19:57:36	19:57:49	::1	02-07-2014
ao	19:57:53	19:58:01	::1	02-07-2014
89	20:00:09	20:01:32	::1	02-07-2014
70	20:01:51	20:02:12	::1	02-07-2014
ao	20:02:19	20:02:53	::1	02-07-2014
director	20:03:02	20:03:11	::1	02-07-2014
89	20:03:17	20:24:53	::1	02-07-2014
70	20:28:02	20:31:07	::1	02-07-2014
89	20:48:00	20:48:08	::1	02-07-2014
89	21:10:03	21:10:47	::1	02-07-2014
31	21:11:47	21:11:49	::1	02-07-2014
89	19:40:41	19:46:59	::1	03-07-2014
89	19:51:57	19:53:21	::1	03-07-2014
70	20:32:45	20:32:49	::1	03-07-2014
89	20:37:09	21:01:06	::1	03-07-2014
70	21:01:15	21:11:43	::1	03-07-2014
89	21:12:19	21:13:46	::1	03-07-2014
89	21:15:50	21:16:01	::1	03-07-2014
89	21:18:31	21:18:51	::1	03-07-2014
\.


--
-- Data for Name: user_table; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY user_table (username, password, privelages) FROM stdin;
T91	T91	4
T101	T101	4
T144	T144	4
T129	payslip	4
T133	T133	4
T114	polarpassion	4
T113	T113	4
T74	T74	4
T135	T135	4
T142	T142	4
T141	T141	4
T98	pat47achu	4
cengineer1	ncaor	11
cengineer2	ncaor	11
71	71	1
40	15071974	1
31016	31016	6
31018	31018	6
31020	31020	6
cadmin	ncaor	0
31022	31022	6
eengineer2	ncaor	3
30	KENNISIA	6
31001	8331	6
31	31	6
25	25	6
65	65	6
58	dipal	6
18	18	6
38	38	6
24	24	6
T121	T121	6
T119	T119	6
T122	T122	6
T71	T71	6
T143	T143	6
T115	T115	6
T72	T72	6
22	22	6
19	19	6
T67	T67	6
T70	T70	6
T22	T22	6
T105	T105	6
T130	T130	6
T131	T131	6
55	55	6
T156	T156	6
21	21	6
29	29	6
T158	T158	6
90	larina03	6
T83	T83	6
T78	T78	6
88	NCAORpayslip	6
320002	320002	6
320004	320004	6
320006	320006	6
20	20	6
320008	320008	6
320010	320010	6
T125	T125	6
320014	320014	6
320016	320016	6
320018	320018	6
57	2689	6
72	1981	6
16	2914	6
T140	home123	6
T109	rian248	6
42	bahrain	6
eengineer1	ncaor	3
66	lalit79	6
48	0411	6
T128	Nc@0r	6
T-160	T-160	6
T100	zimbra	6
32	san	6
60	Shu2710	6
T151	T151	6
62	62	6
73	om	6
T-162	T-162	6
76	76	6
97	97	6
320020	320020	6
T147	T147	6
75	sayeeD	6
84	spurious	6
99	99	6
T149	dinesh1	6
78	PINTU123	6
56	maa	6
86	86	6
80	946***	6
31003	31003	6
31005	31005	6
31007	31007	6
31009	31009	6
31011	31011	6
31013	31013	6
31015	31015	6
100	100	6
T165	T165	6
T169	T169	6
T168	T168	6
320012	mpgupta01	6
T173	T173	6
67	67	6
T166	T166	6
330001	330001	6
330005	330005	6
330007	330007	6
330009	330009	6
330011	330011	6
330013	330013	6
330015	330015	6
330017	330017	6
T180	T180	6
T174	T174	6
T179	T179	6
330019	330019	6
330021	330021	6
330023	330023	6
330025	330025	6
330027	330027	6
330029	330029	6
330031	330031	6
330033	330033	6
330003	330003	6
93	ny@31ALESUND	6
92	15071969	6
81	81	6
T163	T163	6
T186	T186	6
T184	T184	6
31017	31017	6
31019	31019	6
31021	31021	6
T145	T145	6
31002	221227	6
T154	T154	6
159	159	6
T155	T155	6
T159	T159	6
89	663	6
91	saroj91	6
79	zimbra	6
54	nishasingh	6
T136	T136	6
T81	T81	6
T132	T132	6
T139	T139	6
14	14	6
T127	T127	6
T137	T137	6
T138	T138	6
320001	320001	6
320005	320005	6
T85	T85	6
23	23	6
320007	320007	6
102	13	6
41	41	6
320013	320013	6
320015	320015	6
320017	320017	6
320019	320019	6
87	1982	6
T157	rajesh14	6
94	94	6
T-161	T-161	6
105	srvsxc@123	6
95	maltidevi	6
320009	292929	6
104	123	6
320011	1966	6
320003	320003	6
74	74	6
96	payslips	6
98	98	6
101	101	6
103	panchami123	6
eengineer3	ncaor	3
T164	T164	6
ao	ao	7
ictd	ictd	10
antarctic	antarctic	7
biochemistry	biochemistry	7
clcs	clcs	7
cryobiology	cryobiology	7
director	director	8
eez	eez	7
estate	estate	7
icecore	icecore	7
library	library	7
logistics	logistics	7
marinelab	marinelab	7
ossg	ossg	7
pbiology	pbiology	7
penvironment	penvironment	7
atmospheric	atmospheric	7
prslab	prslab	7
ep	ep	7
ef	ef	7
T176	krishna@1234	6
330002	330002	6
T80	chacko	6
330008	330008	6
15	chuchu2212	6
T107	946***	6
330010	330010	6
330012	330012	6
330014	330014	6
330016	330016	6
330018	330018	6
T99	achappam	6
52	25	6
T175	T175	6
83	83	6
77	77	6
T178	T178	6
T146	T146	6
T152	T152	6
T148	T148	6
T150	T150	6
82	lekshmi	6
85	ranaja81	6
T153	T153	6
31004	31004	6
31006	31006	6
31008	31008	6
31010	31010	6
31012	31012	6
31014	31014	6
T177	T177	6
T172	samncaor	6
330020	330020	6
330022	330022	6
330024	330024	6
330026	330026	6
330028	330028	6
330030	330030	6
330032	330032	6
T181	T181	6
330006	330006	6
330004	330004	6
T104	T104	4
cengineer3	ncaor	11
63	63	1
43	1969	1
50	cryo7890	1
36	361968	1
10	KAJAMANI	1
39	ncaor2002	1
46	MANCHAYIL	1
47	1978	1
68	omarali	1
53	hello	1
45	45	1
51	4152001	1
69	asg	1
49	papa1234	1
11	11	1
5	AISHU	1
70	mumdad123$	1
44	mahesh	1
eadmin	123	2
\.


--
-- Name: department_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY department
    ADD CONSTRAINT department_pkey PRIMARY KEY (deptid);


--
-- Name: employee_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY employee
    ADD CONSTRAINT employee_pkey PRIMARY KEY (employeeid);


--
-- Name: leave_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY leave
    ADD CONSTRAINT leave_pkey PRIMARY KEY (leaveid);


--
-- Name: user_table_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY user_table
    ADD CONSTRAINT user_table_pkey PRIMARY KEY (username);


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

