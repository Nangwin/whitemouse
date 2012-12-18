<?php
//listVol.php
	$listVolcan=array(

	'Italy0101'=>array("CampiFlegrei", "Vesuvius", "Stromboli", "Lipari"),

	'Greece0102'=>array("Santorini", "Nisyros"),

	'Turkey0103'=>array("Kula","Karapinar-Field","Hasan Dagi","Gollu Dag","Acigol-Nevsehir",
	"Erciyes Dagi","Karacalidag","nemrud Dagi","Suphan Dagi","Girekol","Tenduruk Dagi",
	"Ararat", "Kars-Plateau"),

	'Caucasus0104'=>array("Elbrus","Kasbek","Kabargin Oth","Unnamed0104-04-","Unnamed0104-05-","Aragats",
	"Agmagan-Karadag","Dar-alages"),

	'RedSeaEthiopia0201'=>array("Teyr-Djebel","Zubayr-Djebel","Jalua","Alid","Dallol","Gada Ale","Catherine",
	"Alu","Dalaffilla","Borale Ale","Erata Ale","Ale Bagu","Hayli Gubbi","Dubbi",
	"Nabro","Mallahle","Sorkale","Asavyo","Mat Ala","Tat Ali","Borawli","Afdera",
	"Ma Alalta","Alayta","Dabbahu","Dabbayra","Hararo Manda","Groppo","Kurub","Borawli Complex",
	"Manda-Inakir","Mousa Ali","Gufa","Assab Field","Ardoukoba","Tiho","Garbes","Boina",
	"Dama Ali","Asmara","Gabillema","Yangudi","Ayelu","Adwa","Hertali","Liado Hayk",
	"Dofen","Fentale","Beru","Kone","Unnamed0201-201","Boset-Bericha","Bishoftu","Unnamed0201-221",
	"Sodore","Gedamsa","Bora-Bericcio","Tullu Moje","Unnamed0201-251","Unnamed0201-252","Butajiri Silti",
	"Alutu","Shala","Corbetti","Bilate River Field","Tepi","Hobicha","Tosa sucha",
	"unnamed0201-311","Korath","Mega Basalt Field "),

	'Africa_E0202'=>array("North Island","Central Island","South Island","Marsabit","Barrier",
	"Namarunu","Segererua Plateau","Emuruangogolak","Silali","Paka","Korosi","Ol Kokwe",
	"Nyambeni","Menengai","Homa","Elmentita Badland","Eburru Ol Doinyo","Olkaira","Longonot",
	"Suswa","Lengai Ol Doinyo","Chyulu","Kilimanjaro","Meru","Igwisi","Unnamed0202-162",
	"SW Usangu Basin","Ngozi","Izumbwe-Mpoli","Rungwe","Kieyo"),

	'Africa_C0203'=>array("Rusekere","Fort Portal Field",
	"Kyatwa Field","Katwe Kikorongo","Banyaruguru","Katunga","May-ya-Moto","Nyamuragira",
	"Nyiragongo","Karisimbi","Visoke","Muhavura","Bufumbira","Tshibinda"),

	'Africa_W0204'=>array("Biu Plateau","Ngaoundere","Oku","Manengouba","Cameroon","Santa Isabel",
	"San Joaquin","San Carlos","Sao Tome","Haruj","Toh Tarso","Tousside Tarso","Voon Tarso",
	"Koussi Emi","Marra Jebel","Kutum Field","Meidob Field","bayuda Field","Umm Marafieb Jebel"),

	'Syria0300'=>array("Sharat Kovakab","Unnamed0300-02-","Unnamed0300-03-","Unnamed0300-04-","Es Safa","Unnamed0300-06-"),

	'Arabia0301'=>array("Raha Harrat","Uwayrid Harrat","Lunayyir Harrat","Ithnayn Harrat",
	"Khaybar Harrat","Rahat Harrat","Kishb Harrat","Yar Jabal","Arhab Harra Of",
	"Marha Jabal","Haylan Jabal","Dhamar Harras","Hamman Demt Jabal","Nar Jabal",
	"Unnamed0301-15-","Sawad Harra","Bal Haf Harra","Bir Borhut","Ormus Island"),

	'Iran-Afgan0302'=>array("Damavand","Qa'leh Hassan Ali","Bazman","Unnamed0302-04-","Taftan","Dact Inafar",
	"Vakak"),

	'IndianO_0303-0304'=>array("Grille","Karthala","Piton de la Fournaise","Ambre Bobaomby","Nosy Be",
	"Ankaizina Field","Itasy Field","Ankaratra Field","Heard","Kerguelen Island","St Paul",
	"Amsterdam Island","Ile de la Possesion","Ile Aux Cochon","Prince Edward Island",
	"Marion Island","Unnamed0305-01="),

	'NewZealand0401'=>array("Kaikohe-Bay","Whangarai","Auckland-Field","Mayor Island",
	"Egmont/Taranaki","White-Island","Whale-Island","Rotorua","Okataina","Reporoa","Maroa",
	"Taupo","Tongariro/Ngauruhoe","Ruapehu","Rumble-I","Rumble-II","Rumble-III","Rumble-IV",
	"Rummble-V"),

	'Kermadec0402'=>array("Curtis Island","Brimstone Island","Macauley Island","Raoul Island",
	"Unnamed0402-04=","Monowai Seamont"),

	'Tonga0403'=>array("Unnamed0403-01=","Unnamed0403-02=","Unnamed0403-03=","Hunga Tonga-Hunga Ha'pai",
"Falcon Island","Tofua","Metis Shoal","Home Reef","Late","Fonualei","Curacoa","Niuafo'ou"),

	'Samoa0404'=>array("Unnamed0404-00-","Ta'u","Ofu-Olosega","Tutuila","Upolu","Sava'i","Wallis Islands"),

	'Fiji0405'=>array("Taveuni","Koro"),

	'NewGuinea0500'=>array("St.Andrew Strait","Baluan","Unnamed0500-03-","Blup Blup","Kadovar",
	"Bam","Boisa","Manam","Karkar","Unnamed0501-04=","Yomba","Long Island","Umboi","Ritter Island","Sakar",
	"Unnamed0502-001","Langila","Narage","Mundua","Garove","Dakataua","Bola","Garua Harbour",
	"Garbuna Group","Lolo","Pago","Walo","Hargy","Bamus","Ulawun","Lolobau","Unnamed0502-131",
	"Rabaul","Doma Peaks","Crater Mountain","Yelia","Koranga","Madilogo","Lamington",
	"Hydrographer Range","Musa River","Managlase Plateau","Victory","Sessagara","Waiowa",
	"Goodenough","Iamelele","Dawson Strait Group","Lihir","Ambitle","Tore","Balbi",
	"Billy Michel","Bagana","Takuan Group","Loloru"),

	'Solomon0505'=>array("Nonda","Simbo","Cook","Kana Keoki","Coleman Seamont","Kavachi",
	"Unnamed0505-061","Galleo","Savo","Tinakula"),

	'Vanuatu0507'=>array("Motlav","Soretimeat","Gaua","Mere Lava","Aoba","Ambrym","Lopevi",
	"East Epi","Kutali-Tavani","Tavai Ruro","Kuwae","Unnamed0507-08-","North Vate","Traitor's Head",
	"Yasur","Aneityum","Matthew Island","Hunter Island","Unnamed0508-03-"),

	'Australia0509'=>array("Newer Volcanic Prov"),

	'Sumatra0600-0602'=>array("Narcondum","Barren Island","Pulau Weh","Seulawah Agam","Peuet Sague",
	"Geureudong Burni","Telong Burni","Gayolesten","Sibayak","Sinabung","Toba","Helatoba-Tarutung",
	"Bual Buali","SorikMarapi","Talakmau","Marapi","Tandikat","Talang","Kerinci","Hutapanjang",
	"Sumbing","Kunyit","Pendan","Belirang-Beriti","LumutDaun Bukit","Kaba","Dempo","Patah",
	"Lumut Balai Bukit","GunungBesar","Ranau","Sekincau Belirang","Suoh","Hulubelu","Rajabas",
	"Krakatau"),

	'Java0603'=>array("Krakatau","Karang","Kiaraberes","Perbakti","Salak","Gede","Patuha",
	"Wayang-Windu","TangkubanPerahu","papandayan","Kawah Manuk","Kawah Kamojang",
	"Guntur","Tampomas","Galunggung","Talagabodas","Kawah Karaha","Cireme","Slamet",
	"Dieng","Sundoro","Sumbing","Ungaran","Telomoyo","Merbabu","Merapi","Lawu",
	"Wilis","Kelut","Kawi","Arjuno-Welirang","Penanggungan","Malang Plain","Semeru",
	"Tengger","Lamongan","Lurus","Iyang-Aragapura","Raung","Ijen","Baluran"),

	'LesserSunda0604'=>array("BuyanBratan","Batur","Agung","Rinjani","Tambora","Sangeang Api",
	"Gilibanta","Wae Sano","Poco Leok","Ranakah","Inierie","Inielika","Ebulobo","Iya",
	"Sukaria Caldera","Ndete Napu","Kelimutu","Paluweh","Egon","Ilimuda","Lewotobi",
	"Lereboleng","Riang Kotang","Iliboleng","Lewotolo","Ililabalaken","Iliwerung","Batutara",
	"Sirung","Yersey"),

	'Banda0605'=>array("Emperor of China","Nieuwerkerk","GunungapiWetar","Wurlali",
	"Teon","Nila","Serua","Manuk","Banda Api"),

	'SulawesiHalmahr0606'=>array("Colo/Una-Una","Ambang","Soputan","Sempu","Tondano",
	"Lokon-Empung","Mahawu","Klabat","Tangkoko","Ruang","Karangetang/ Api-Siau","Banua Wuhu",
	"Awu","Unnamed0607-05=","Dukono","Ibu","Gamkonora","Todoko","Jailolo","Gamalama","Motir",
	"Makian/Kie-Besi","Umsini"),

	'Borneo0610'=>array("Bombalai"),

	'Philippines0700'=>array("Bud-Dajo/Parkat","Balut","Matutum","Apo","Leonard Range",
	"Unnamed0701-032","Makaturing","Latukan","Ragang","Kalatungan","Calayo","Malindang","Balatocan",
	"Hibok Hibok","Paco","Magaso","Canlaon","Mandalagan","Silay","Cabalian","Mahagnoa",
	"Biliran","Bulusan","Pocdol","Mayon","Masaraga","Malinao","Iriga","Isarog","Labo",
	"Malindig","Dagit-Dagitan","Panay","Banahaw","Laguna Field","Maquiling","Taal","Jalajala",
	"Mariveles","Natib","Pinatubo","Arayat","Amorong","Santo Tomas","Patoc","Binuluan",
	"Ambalatungan","Cagua","Camiguin de Babuyanes","Didicas","Babuyan Claro","Smith Volcano",
	"Unnamed0704-05=","Iraya"),

	'SouthEastAsia0705'=>array("Leizhou Bandao","Cu-lao Re","Toroeng Prong","Haut Dong Nai",
	"Bas Dong Nai","Cendres Ile Des","Veteran","Popa","Lower Chindwin","Singu Plateau","Tengchong"),

	'Taiwan0801'=>array("Unnamed0801-01=","Unnamed0801-011","Unnamed0801-02=","Unnamed0801-03=","Kuei-Shan Tao",
	"Datun Group","Unnamed0801-04=","Peng-Chia-Hsu","Zengyu"),

	'Japan-Kyushu0802'=>array("Iriomote-Jima","Okinawa-Torishima","Akuseki-Jima","Suwanose-Jima",
	"Nakano-Shima","Kuchin-Shima","Kuchinoerabu-Jima","Kikai","Ibusuki Field","Sakurajima",
	"Sumiyoshe-Ike","Kirishima","Unzen","Aso","Kuju group","Tsurumi"),

	'Japan-Honshu0803'=>array("Abu","Sanbe","Oki-Dogo",
	"Daisen","Kannabe","Izu-Tobu","Hakone","Fuji","Tateshina","On-Take","Hakusan","Nurikura",
	"Yake-dake","Tate-yama","Niigata-yake-yama","Myoko","Kurohime","Iizuna","Asama",
	"Kusatsu-Shirane","Shiga","Haruna","Akagi","Hiuchi","Nikko-Shirane","Nantai","Omanago",
	"Takahara","Nasu","Numazawa","Bandai","Adatara","Azuma","Zao","Hijiori","Narugo",
	"Kurikoma","Chokai","Akita-Komagatake","Iwate","Hachimantai","Akita-Yakeyama","Kanpu",
	"Megata","Iwaki","Towada","Hakkoda","Osoreyama","Mitsu-Hiuchidake"),

	'Japan-Izu0804'=>array("Izu-Oshima","To-shima","Nii-jima","Kozushima","Miyake-jima",
	"Kurose-hole","hachijo-jima","Aoga-shima","Bayonnaise rocks","Smith-rocks","Torishima",
	"Omachi-Seamont","Nishino-Shima","Unnamed0804-093","Kaitoku Seamont","Kita-Iwojima","Iwojima",
	"Shin-Iwojima","Minami-Hiyoshi","Nikko","Fukujin","Kasuga Seamont"),

	'Mariana0804'=>array("Unnamed0804-135","Unnamed0804-136","Farallon de Pajaros","Ahyi","Supply Reef",
	"Asuncion","Agrigan","Pagan","Alamagan","Guguan","Sarigan","Anatahan","Ruby","Esmeralda Bank"),

	'Japan-Hokaido0805'=>array("Oshima-Oshima","E-san","Komagatake","Nigorigawa",
	"Usu","Iwaonupuri","Yotei","Shiribetsu","Shikotsu","Rishiri","Tokachi","Daisetsu",
	"Nipesotsu-Upepesanke","Shikaribetsu","Akan","Kutcharo","Mashu","Rausu","Shiretoko-Iwozan"),

	'Kuril0900'=>array("Golovnin","Mendeleev","Smirnov","Tiatia","Berutarube","Lvinaya",
"Atsnonupuri","Bogatyr Ridge","Unnamed0900-061","Grozny Group","Baransky","Chirip","Golets-Tornyi Group",
"Medvezhia","Demon","Ivao Group","Rudkov","Tri Setry","Kolokol Group","Unnamed0900-13-","Chirpoi",
"Unnamed0900-161","Milne","Goriaschaia","Zavaritski Caldera","Prevo Peak","Urataman",
"Ketoi","Ushishur","Srednii","Rasshua","Unnamed0900-23=","Sarychev Peak","Raikoke",
"Chirinkotan","Ekarma","Kuntomintar","Sinarka"."Kharimkotan","Tao-Rusyr Caldera","Nemo Peak",
"Shirinki","Fuss Peak","Karpinsky Group","Lomonosov Group","Chikurachki","Vernadskii Ridge","Ebeko","Alaid" ),

	'Kamchatka1000'=>array("Mashkovtsev","kambalny","Koshelev","Unnamed1000-021","Diky Greben",
"Kurile Lake","Ilyinsky","Zheltovsky","Kell","Belenkaya","Ksudach","Ozernoy","Plosky","Khodutka",
"Piratkovsky","Olkoviy","Ostanets","Otdelniy","Unnamed1000-058","Tundroviy","Mutnovsky","Golaya",
"Asacha","Vosokiy","Gorely","Opala","Unnamed1000-081","Tolmachev Dol",
"Vilyuchik","Barkhatnaya","Unnamed1000-085","Unnamed1000-086","Bolshe-Bannaya","Koryaksky","Avachinsky",
"Unnamed1000-101","Veer","Dzenzursky","Zhupanovsky","Zavaritsky","Bakenin","Akademia Nauk","Karymsky",
"Maly Semiachik","Bolshoi Semiachik","Taunshits","Uzon","Kikhpinych","Krasheninnikov","Kronotsky",
"Gamchen","Komarov","Kolkhozhny","Kizimen","Iult","Unnamed1000-232","Tolbachik","Udina","Zimina",
"Bezymianny","Kamen","Kliuchevskoi","Ushkovsky","Zarechny","Unnamed1000-263","Shiveluch","Piip",
"Khangar","Ichinksy","Maly Payalpan","Bolshoi Payalpan","Plosky","Akhtang","Kozyrevsky",
"Romanovka","Uksichan","Bolshoi-Kekuknaysky","Kulkev","Geodesistoy","Anaun","Krainy","Kekurny",
"Eggella","Unnamed1000-43-","Verkhovoy","Aleny-Chashakondzha","Cherny","Pogranychny","Zaozerny",
"Bliznets","Kebeney","Fedotych","Sedankinsky","Gorny Institute","Leutongey","Tuzovsky",
"Titila","Mezhdusopochny","Shishel","Elovsky","Alngey","Uka","Kaileney","Plosky","Bely",
"Atlasova","Snezhniy","Iktunup","Ostry","Snegovoy","Severny","Iettunup","Voyampolsky"),

	'Rusia-NE1001'=>array("Aluchin Group","Anjuisky","Balagan-Tas"),

	'Rusia-SE1002'=>array("Southern Sikhote-Alin","NE-Udokan Plateau","Udokan Volcanic Field",
"Dgida Basin","Tunkin Depression","Oka Volcanic Field","Ulug-Arginksy"),

	'Mongolia1003'=>array("Taryatu-Chulutu","Khanuy","Bus-Obo","Dariganga","Middle Gobi"),

	'China-W1004'=>array("Turfan","Tianshan Volcanic Group","Kunlun Volcanic Group","Unnamed1004-04-"),

	'China-E1005'=>array("Honggeertu","Keluo Group","Wudalianchi","Jingpohu","Longgang Group",
"Baitoushan"),

	'Korea1006'=>array("Xianjindao","Ch'uga-ryong","Ulreung","Halla"),

	'Aleutian1101'=>array("Buldir","Kiska","Segula","Davidof","Little Sitkin","Semisopochnoi",
"Gareloi","Tanaga","Takawangha","Bobrof","Kanaga","Moffett","Adagdak","Great Sitkin","Kasatochi",
"Koniuji","Sergief","Atka","Unnamed1101-17-","Seguam","Amukta","Chagulak","Yunaska","Herbert","Carliste",
"Cleveland","Uliaga","Kagamil","Vsevidof","Recheschnoi","Okmok","Bogoslof","Makushin","Table Top-Wide Bay",
"Akutan","Westdahl","Fisher","Shishaldin","Isanotski","Roundtop","Amak"),

	'Alaska1102-1105'=>array("Frosty","Dutton","Emmons","Pavlof","Pavlof Sister","Dana","Unnamed1102-051",
"Kupreanof","Veniaminof","Black Peak","Aniakchak","Yantarni","Chiginagak","Kialagvik","Ugashik-Peulik",
"Ukinrek Maars","Unnamed1102-132","Martin","Mageik","Trident","Katmai","Novarupta","Griggs","Snowy",
"Denison","Steller","Kukak","Devil Desk","Kaguyak","Fourpeaked","Douglas","Agustine","Iliamna",
"Redoubt","Spurr","Hayes","Espenberg","Imuruk Lake","Kookooligit Mountains","St. Michael",
"Ingakslugwat Hills","Nunivak Island","St. Paul Island","Buzzard Creek","Sanford","Wrangell",
"Gordon","Bon-Churchill","Edgecumbe","Duncan Canal","Tlevak Strait-Suemez","Behn Canal-Rudyerd Bay"),

	'Canada1200'=>array("Fort Selkirk","Alligator Lake","Ruby Mountain","Heart Peak","Level Mountain",
"Edziza","Spectrum Range","Hoodoo Mountain","Iskut-Unuk River Cones","Crow Lagoon","Milbanke Sound Group",
"Satah Mountain","Nazko","Wells gray-Clearwater","Silverthrone","Bridge River Cones","Meager",
"Garibaldi Lake","Garibaldi Mt."),

	'USA1201-1210'=>array("Baker","Glacier Peak","Rainier","Adams","St.Helens","West Crater",
"Indian Heaven","Hood","Jefferson","Blue Lake Crater","Sand Mountain Field","Washington","Belknap",
"North Sister Field","South Sister","Bachelor","Davis Lake","Newbarry Volcano","Devils Garden",
"Squaw Ridge Field","Four Craters Lava Field","Cinnamon Butte","Crater Lake","Imagination Peak",
"Diamond Craters","Saddle Butte","Jordan Craters","Jackies Butte","Shasta","Medicine lake",
"Brushy Butte","Big Cave","Twin Buttes","Tumble Buttes","Potato Butte","Lassen Volcanic Crater",
"Eagle Lake Field","Clear Lake","Mono Lake Volcanic Field","Mono Craters","Inyo Crater",
"Long Valley","Red Cones","Ubehehe Craters","Golden Trout Creek","Coso Volcanic Field",
"Lavic Lake","Amboy","Shoshone Lava Field","Crater of the Moon","Wapi Lava Field","hell's Half Acre",
"Yellowstone","Steamboat Spring","Santa Clara","Kolob","Bald Knoll","Margakunt Plateau",
"Black Rock Desert","Dotsero","Uinkaret Field","Sunset Crater","Carrizozo","Zuni-Bandera",
"Valles Caldera"),

	'Hawaii1302'=>array("CoAxial Segment","Cleft Segment","North Gorda Ridge",
"Unnamed1301-03-","Loihi","Kilauea","Mauna Loa","Mauna Kea","Hualalai","Kahoolawe","Haleakala",
"Koolau","Unnamed1302-08-","Unnamed1302-09-"),

	'Pacific_C1303-1304'=>array("Unnamed1303-01-","Galapagos Rift","Teahitia","Rocard",
"Moua Pihaa","Mehetia","Unnamed1303-061-","Easter Island","MacDonald","Antipodes Island",
"Unnamed1304-02-","Unnamed1304-03-"),

	'Mexico1401'=>array("Prieto Cerro","Pinacate","San Quintin Volcanic Field","San Luiz Isla",
"Jaraguay Volcanic Field","Coronado","Guadalupe","San Borja Volcanic Field","Unnamed1401-008",
"Tres Virgenes","Tortuga Isla","Comondu-La Purisima","Barcena","Socorro","Durango Volcanic Field",
"Sanganguey","Ceboruco","Mascota Volcanic Field","Colima","Paricutin Volcanic Field",
"Michoacan-Guanajuato","Jocotitlan","Toluca Nevado de","Chichinautzin","Papayo","Iztaccihuatl",
"Popocatepetl","Malinche la","Serdan-Oriental","Humeros Los","Atlixcos Cerro Los","Naolinco volcanic Field","Cofre de Perote","Gloria La","Cumbres Las","Orizaba Pico de","San Martn",
"Chichon el","Tacana",),

	'Guatemala1402'=>array("Tajumulco","Santa Maria","Almolonga","Santo Tomas","Atitlan","Toliman",
"Acatenango","Fuego","Agua","Pacaya","Tecuamburro","Cuilapa-Barbarena","Moyuta","Flores",
"Chingo Volcanic Field","Santiago Cerro","Suchitan Volcanic Field","Ixtepeque",
"Ipala Volcanic Field","Chiquimula Volcanic Field","Quezaltepeque"),

'Honduras1403'=>array("San Diego","Singuil Cerro","Apaneca Range","Santa Ana","Izalco",
"San MArcelino","Coatepeque Caldera","San Salvador","Cinotepeque Cerro","Guazapa","Ilopango",
"San Vicente","Apastepeque","Taburete","Tecapa","Usulutan","Chinameca","San Miguel",
"Aramuaca Laguna","Conchagua","Conchaguita","Tigre Isla El","Zacate Grande Isla","Yojoa, Lake","Utila Island"),

	'Nicaragua1404'=>array("Cosiguina","San Cristobal","Telica","Rota","Negro Cerro","Pilas Las","Momotombo","Apoyeque","Nejapa-Miraflores","Masaya","Joya La","Mombacho","Zapatera","Concepcion",
"Maderas","Esteli","Ciguatepe","Lajas Las","Azul Volcan"),

	'PanamaCostarica1405'=>array("Orosi","Rincon dela Vieja","Miravalles","Tenorio",
"Tilaran Cerro","Arenal","Platanar","Poas","Barva","Irazu","Turrialba","Baru","Yeguada La"),

	'Colombia1501'=>array("Bravo Cerro","Ruiz","Santa Isable","Tolima","Machin Cerro","Huila",
"Purace","Sotara","Petacas","Dona Juana","Galeras","Azufral Volcan","Cumbal","Negro de Mayasquer Cerro"),

	'Equador1502'=>array("Soche","Cuicocha","Mojanda","Cayambe","Reventador","Pululagua",
"Guagua Pichincha","Atacazo","Chacana","Antisana","Pan de Azucar","Sumaco","Illiniza",
"Cotopaxi","Quilotoa","Tungurahua","Tulabug","Sangay","","","","","","","","","",""),

	'Galapagos1503'=>array("Fernandina","Ecuador Volcan","Wolf Volcan","Darwin Volcan",
"Alcedo Volcan","Negra Sierra","Azul Cerro","Pinta","Marchena","Genoveza","Santiago","Santa Cruz",
"Floreana","San Cristobal"),

	'Peru1504'=>array("Firura Nevados","Coropuna","Andahua Valley","Sabancaya","Quimsachata",
"Chachani Nevado","Misti El","Ubinas","Huaynaputina","Ticsani","Tutupaca","Yucamane","Casiri Nevados"),

	'BoliviaChileN1505'=>array("Tacora","Lexone","Patilla Pata","Anallajsi Nevado",
"Maciso de Larancagua","Maciso de Pacuni","Parinacota","Acotango","Guallatiri","Colluma Cerro",
"Sacabaya Volcan de","Arintica","Tata Sabaya","Isluga","Pichuldiza","Pina Cerro","Nuevo Mundo",
"Irruputuncu","Unnamed1505-041","Pampa Luxsar","Olca-Paruma","Aucanquilcha","San Agustin Cerro",
"Ollague","Yumia Cerro","Escala","Santa Isabel Cerro","Moiro Cerro","Azufre Cerro del","San Pedro",
"Chascon","Chao","Toconce Cerro","Quetena","Uturuncu","Tatio El","Tocorpuri Cerros de","Putana",
"Sairecabur","Licancabur","Guayaques","Purico Complex","Colachi","Acamarachi","Overo Cerro",
"Lascar","Chiliques","Cordon de Puntas Negras","Cordon Chalviri","Tujle Cerro","Pular",
"Negrillar El","Aracar","Socompa","Negrillar La","Llullaillaco Cerro","Tuzgle Cerro","Escorial Cerro",
"Lastarria","Cordon del Azufre","Bayo Cerro","Antofalla","Antofagasta de la Sierra","Nevada Sierra",
"Condor Cerro El","Peinado","Robledo","Falso Azufre","Ojos del Salado Nevados","Tipas","Cipiapo",
"San Felix","Robinson Crusoe","Unnamed1506-03=","Unnamed1506-04="),

	'ChileArgentina1507'=>array("Tupungatito","San Jose","Maipo","Palomo","Tinguiririca",
"Panchon-Peteroa","Mondaca","Calabozos","Descabezado Grande","Azul Cerro Quizapu","Maule Laguna del",
"San Pedro-Pellado","Longavi Nevado de","Blanca Loma","Resago Volcano","Payun Matru Cerro",
"Domuyo","Chillan Nevados de","Tromen","Puesto Cortaderas","Antuco","Copahue","Callaqui",
"Tolguaca","Lonquimay","Chapulul","Llaima","Sollipulli","Caburga","Redondo Cerro","Huelemolle",
"Villarrica","Quetrupillan","Lanin","Huanquihue Group","Mocho-Choshuenco","Carran-Los Venados","Cordon Caulle","Puyehue","Mencheca","Pantoja Cerro","Antillanca Group","Puntiagudo-Cordon Cenizo"),

	'Chile_S1508'=>array("Osorno","Calbuco","Cayute-La Viguera","Yate","Hornopiren",
"Volcanico Cerro","Huequi","Minchinmavida","Chaiten","Corcovado","Yanteles Cerro",
"Palena Volcanic Group","Melimoyu","Puyuhuapi","Mentolat","Maca","Hudson Cerro","Lauturo",
"Viedma Volcan","Aguilera","Reclus","Burney Monte","palei-Aike Volcanic Field","Cook Isla"),

	'WestIndies1600'=>array("Saba","Quill The","Liamuiga","Nevis Peak","Soufriere Hills",
"Soufriere Guadeloupe","Unnamed1600-07=","Diable Morne Au","Diablotins Morne","Micotrin",
"Patates Morne","Pelle","Qualibou","Soufriere St. Vincent","Kick-em-Jenny","St Catherine",
"Piparo"),

	'Iceland-Artic1700'=>array("Snaefellsjokull","Lysuholl","Ljosufjoll","Reykjaneshryggur","Reykjanes",
"Krisuvik","Brennisteinsfjoll","Hengill","Grimsnes","Prestahnukur","Langjokull","Hofsjokull",
"Kerlingarfjoll","Kristnitokugigar","Vestmannaeyjar","Eyjafjoll","Katla","Tindfjallajokull",
"Torfajokull","Vatnafjoll","Hekla","Mundafell","krakagiger","Lambafit","Lakagigar","Trollagigar",
"Thordarhyrna","Grimsvotn","Loki-Fogrufjoll","Bardarbunga","Tungnafellsjokull","Kverkfjoll",
"Askja","Freminamur","Krafla","Theistareykjarbunga","Tjornes Fracture Zone","Manareyjar",
"Oraefajokull","Esjufjoll","Kolbeinsey Ridge","Jan Mayen","Unnamed1707-01-"),

	'Atlantic_N1801'=>array("Unnamed1708-01=","Unnamed1708-02=","Unnamed1708-03=",
"Unnamed1708-04="),

	'Azores1802'=>array("Flores","Corvo","Fayal","Pico","San Jorge","Graciosa","Terceira",
"Don Joao de Castro Bank","Sete Cidades","Unnamed1802-181","Agua de Pau","Furnas","Moncao Bank"),

	'Canary1803'=>array("La Palma","Hierro","Tenerife","Gran Canaria","Fuerteventura","Lanzarote"),

	'CapeVerde1804'=>array("Fogo","Brava","Santo Antao","San Vicente"),

	'Atlantic_C1805'=>array("Unnamed1805-01=","Unnamed1805-02=","Unnamed1805-03=","Unnamed1805-04=",
"Tridade"),

	'Atlantic_S1806'=>array("Tristan dan Cunha","Bouvet","Thomson Island"),

	'Antartica-Sandwich1900'=>array("Buckle Island","Young Island","Sturge Island","Pleiades",
"Unnamed1900-014","Melbourne","Unnamed1900-016","Erebus","Royal Society Range","Berlin","Andrus",
"Waesche","Siple","Toney Mountain","Takahe","Hudson Mountains","Peter I Island","Deception Island",
"Penguin Island","Bridgeman Island","Paulet","Seal Nunataks Group","Unnamed1900-051","Lindenberg Island",
"Thule Islands","Bristol Island","Michael","Candlemas Island","Hodson","Leskov Island","Zavodovski",
"Protector Shoal")


	);
?>
