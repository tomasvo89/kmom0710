Redovisning
====================================

Kmom01: PHP-baserade och MVC-inspirerade ramverk
------------------------------------

<b>Vilken utvecklingsmiljö använder du?</b>

Vid nuläget sitter jag med OS X Mavericks och Firefox webbläsare som testmiljön. Som texteditor använder jag mig av Sublime Text 2 som för min del funkar utmärkt. Som web server klient och FTP driftserver använder jag mig XAMPP resp. FileZilla och inte heller där finns det några konstigheter.

<b>Är du bekant med ramverk sedan tidigare?</b>

I förra kursen, OOPHP, fick jag bekanta mig med Anax-ramverket men utöver det har jag aldrig arbetat med ramverk innan.

<b>Är du sedan tidigare bekant med de lite mer avancerade begrepp som introduceras?</b>

Nej, det är jag inte utan det var först i denna kurs som dessa begrepp introducerades och jag kan finna dem
en aning avancerade då jag fick googla upp flera termer.

<b>Din uppfattning om Anax, och speciellt Anax-MVC?</b>

Likt Anax, känner jag att det kommer att ta tid att förstå uppbyggnaden och logiken bakom Anax-MVC som jag
kan tycka är någorlunda mer komplex jämfört med Anax. Den uppfattningen jag hittills har fått av Anax-MVC
är att det känns som att det är okej med att man kan ha lite mer koder på sidkontrollern jämfört när man arbetar
men Anax(?). Men på det hela känns Anax-MVC fortfarande lite rörigt om jag ska vara uppriktig men däremot råder det inget tvivel om att finns en struktur och ordning på koderna vilket känns lovande och får mig att förbli nyfiken att utforska vidare.

<b>Reflektion</b>

Handen på hjärtat har jag inte riktigt ännu hunnit smälta all teori, speciellt hur CDIFactoryDefault samspelar med
sidkontrollerna och theme.php, men jag känner mig hoppfull. Svårigheterna har för min del varit att förstå teorin, delen som tagit större delen av tiden. Utöver materialen som fanns att tillgå, googlade jag även en hel del på termer för att skapa en bättre förståelse om vad det var jag egentligen läste vilket var till stor hjälp. Mycket klarnade upp senare och det blev möjligt att utföra uppgifterna i guiden för att senare ta itu med själva uppgiften, inga konstigheter.
Gällande problem jag stött på, har jag tyvärr inte lyckats få till highlightning av ett aktivt val på navigeringsbaren och skulle därför behöva hjälp med detta. Jag har försökt att kolla upp om detta på nätet men hittade ingen lösning jag själv kunde tillämpa. Ett annat problem var att jag inte hittade var man kunde lägga in bilder. Jag fick nämligen för mig att md-filerna endast tog emot texter och inga koder tills jag fick tipset av en
vän att man kunde även lägga in koder där vilket löste problemet.

Kmom02: Kontroller och modeller
------------------------------------

<b>Hur känns det att jobba med Composer?</b>

Jag tyckte till en början att det var svårförståeligt och invecklat vilket fick mig att lägga ner mer tid än vanligt till att nöta in teorin. Jag gjorde övningen för composer och fick inte testsidan att funka och i brist på tid tog jag beslutet att göra uppgiften direkt. Jag följde guiden men istället för att göra det på en övningsmapp så gjorde jag allt direkt i kmom02-mappen. Det kändes mycket bättre när vissa saker klarnade till som t.ex funktionen för en dispatcher samt kopplingen mellan index.php och klassen commentcontroller.


<b>Vad tror du om de paket som finns i Packagist, är det något du kan tänka dig att använda och hittade du något spännande att inkludera i ditt ramverk?</b>

Jag tror att de kan komma till bra användning fast det förutsätter att man är någorlunda insatt i Composer vilket jag vid nuläget inte är p.g.a tidsbristen. Jag har av den anledningen inte utforskat så mycket i Packagist och har tyvärr inte inkluderat någonting mer utöver kraven som ställdes av uppgiften.

<b>Hur var begreppen att förstå med klasser som kontroller som tjänster som dispatchas, fick du ihop allt?</b>

Jag skulle nog inte påstå att jag fick ihop allt men en del efter att ha suttit med begreppen ett tag. 

<b>Hittade du svagheter i koden som följde med phpmvc/comment? Kunde du förbättra något?</b>

Jag har tyvärr inte granskat koderna ur säkerhetsaspekten om jag ska vara ärlig och därmed har jag inte förbättrat någonting, tyvärr.

<b>Reflektion</b>

Svårigheten i detta moment har för min del varit att förstå helheten, hur olika delar interagerar med varandra som t.ex hur klasser interagerar med en dispatcher, vad det innebär att skicka vidare hanteringen i en kontroller till en annan. Det har varit mycket information att ta in och jag har försökt att göra mitt "detektivarbete" där jag skrev och ritade ner vissa kodsnuttar på pappret samt använt mig av markeringspennor, lite pilar hit och dit, i hopp om att reda ut interaktionen, samspelet eller kopplingen mellan olika delar från såväl klasser som tpl.filer m.m. Lite klokare blev man men inte till den graden där jag kan säga "Jo, jag fick ihop allt" men det är tiden som för min del har kommit att bli en hindrande faktor. Vad gäller problem har ju under momentets gång stött på några enstaka. Jag fick inte till edit/remove funktionen där jag vid klick fick en error 404 page not found error. Jag kunde inte komma på vad det var som var fel, var det views jag hade glömt att lägga till? Jag kikade på mina med-studenters koder och fann inga sådana. Efter att ha läst guiden igen insåg jag att jag glömde lägga till metoder för ändra/ta bort enstaka kommentar i klassen commentController, en fil jag hade missat helt.
Allt som allt, har detta moment medfört en hel del kunskaper om hur views och klasser fungerar samt hur man kan tillämpa vissa "tiläggsprogram" som packagist genom att lägga till en kodsnutt i en viktig fil (composer.json), ett lärorikt moment.

Kmom03: Bygg ett eget tema
------------------------------------

<b>Vad tycker du om CSS-ramverk i allmänhet och vilka tidigare erfarenheter har du av dem?</b>

Jag har inte haft någon erfarenheter av CSS-ramverk sedan tidigare. CSS-ramverk tycker jag är ett bra sätt
att få ordning på sina CSS-koder, det finns en struktur i det vilket är tilltalande fast det förutsätter såklart
att man har kommit in i det vilket för min del var tidskrävande men definitivt mödan värt.

<b>Vad tycker du om LESS, lessphp och Semantic.gs?</b>

Nu i efterhand när man fått större inblick i vad dessa gör så blir det självfallet bra att tillämpa dessa.
Jag kan tycka att det är oerhört praktiskt att ha alla CSS-koder i en och samma fil, style.php, som användes i detta moment. Semantic.gs finner jag starkt tilltalande då den på ett fint sätt stylar regionerna såsom de ser ut på typiska webbsidor och detta utan större ändringar i CSS som kan medföra mycket jobb när det kommer till stylingen av regioner eller textrutor.

<b>Vad tycker du om gridbaserad layout, vertikalt och horisontellt?</b>

Ur ett styling-perspektiv finner jag det starkt tilltalande då tillämpning av gridlayout innebär en fina, jämna och strukturerade regioner och mellanrum. Jag kan tycka att det är ytterst praktiskt att man kan låna filer från ramverk såsom t.ex Lydia där en LESS-fil användes för att styla typografin. 

<b>Har du några kommentarer om Font Awesome, Bootstrap, Normalize?</b>

Font Awesome är en font som definitivt kan ge designen det lilla extra. Ur ett designperspektiv tycker jag att den är praktisk med motiveringen att man med CSS kan manipulera egenskaperna på fonten som t.ex storlek, färg, skuggor m.m.
Bootstrap är ett ramverk som starkt betonar responsivdesign, något som är bra om man vill utveckla webbsidor där elementen anpassas efter olika enheter som surfplattor, smartphones och latops. Själv hann jag inte titta djupingående på Bootstrap som jag hade velat göra men det är definitivt något jag kommer ha i baktankar.

<b>Beskriv ditt tema, hur tänkte du när du gjorde det, gjorde du några utsvävningar?</b>
Mitt tema är så basic det kan vara, jag tänkte inte speciellt mycket designmässigt utan strävade efter att få
det så likt som det i guiden som möjligt då jag hade tidspress och kreativiteten flödade mycket.

<b>Antog du utmaningen som extra uppgift?</b>

Nej, tyvärr inte.

<b>Reflektion</b>

Ett problem som jag i början stötte på och som tog störra delen av tiden var att CSS stylingen som var menad för temat applicerades på hela min webbsida. Det visade sig senare att jag hade glömt en ytterst viktig kodrad som laddar temat (theme-grid) och som dessutom skulle placeras under routern man ville att detta skulle appliceras till. Ett annat problem som också var tidskrävande var att jag till en början inte fick regionen "sidebar" att stå bredvid "main" såsom enligt bilden i guiden för kmom03. Jag fick rådet att åtgärda mina valideringsfel vilket inte hjälpte mitt problem mycket men som kunde vara bra då webbläsaren kan bygga upp sidan som den tycker borde se ut på ett visst sätt om felen inte åtgärdas. Jag läste guiden flera gånger och kom fram till slut att min möblering av regioner inte liknade som den på guiden. Jag ville nämligen ha "main" och "sidebar" längst upp av wrappern eftersom jag tyckte det var finare designmässigt men "sidebar" ville bara inte positioneras vid sidan av "main". Det jag helt enkelt gjorde för att lösa problemet var att jag möblerade om i css\theme\index.tpl.php så att regionerna positionerades på samma sätt som det i bilden på guiden kmom03. Detta moment är det som krävt mest tid hitills men i slutändan var det mödan värt fastän man i vissa stunder var riktigt frustrerad. Kort och koncist har lärdomen varit hur tillämpning av LESS och semantic.gs underlättar och effektiviserar stylingen avsevärt för att få en estestisk tilltalande design på ens sida.


Kmom04: Databasdrivna modeller
------------------------------------

<b>Vad tycker du om formulärhantering som visas i kursmomentet?</b>

Fastän det tog sin tid att förstå sig på logiken bakom CForm tycker jag nu i efterhand att den är praktisk att använda. Det krävs inte mycket kodrader för att få fram ett formulär tack vare CForm men detta förutsätter som sagt att man förstår hur den kan användas vilket för mig tyvärr tog tid.

<b>Vad tycker du om databashanteringen som visas, föredrar du kanske traditionell SQL?</b>

Jag tycker definitivt att databashanteringen är mycket praktisk då den tillåter en att skriva sql-koder utan användning av en databashanterare som mySqlWorkbench som jag använde i förra delkurs. Men om valet stod mellan dessa två hade jag nog ändå valt traditionell databashantering då den kompetensen även kommer till användning i andra språk som t.ex Java.

<b>Gjorde du några vägval, eller extra saker, när du utvecklade basklassen för modeller?</b>

Inga särskilda vägval gjordes utan jag försökte i första hand följa och förstå guiderna. Jag har fortfarande inte fått grepp om MVC helt vilket i många stunder ha försvårat uppgiften att helt själv designa och skriva koderna för en basklass. Detta ha inneburit att jag fått ropa efter hjälp samt låna koder av mina medstudenter för att sedan i min bästa förmåga förstå vad det är jag gjort och varför resultatet blev som det blev.

<b>Beskriv vilka vägval du gjorde och hur du valde att implementera kommentarer i databasen.</b>

Till en början var det inte helt självklar på hur och vad jag skulle göra, allt kändes rörigt fastän jag hade läst guiderna. Sedan slog det mig att det behövdes såklart en kontroller för att komma åt och manipulera datan (kommentarer och användare) i databasen vilket resulterade i att jag började göra en kontroller för hantering av kommentarer. 

<b>Gjorde du extrauppgiften? Beskriv i så fall hur du tänkte och vilket resultat du fick.</b>

Jag valde att inte göra den.

<b>Reflektion</b>

Svårigheten i detta moment har för mig varit att förstå sammankopplingen mellan vyer, kontroller och modeller. Man har tidigare läst teorin om MVC i första kursmomentet men det var först i detta moment som man verkligen fick testa på att använda dessa tre "lager" i praktiken vilket för min del inte var helt självklar till en början. Jag fick problem med att få kontrollers att manipulera och hantera datan och lösningen blev att jag läste guiderna flera gånger om samt tjuvkika på medstudenternas koder på hur de hade löst vissa problem såsom t.ex hur man implementerar separata kommentarsfunktioner för olika vyer som startsida och redovisning i detta fall. Felmeddelanden som jag stött på under momentets gång har även dem medfört att jag erhållit lärdomar om funktionerna av MVC, som när jag tryckte på en knapp för återställning av databasen som genererarade ett felmeddelande som sa att en viss service inte hade laddats in i en DI-behållare. Detta fick mig att inse att jag då saknade en funktion/metod för återställning av databasen som jag senare lade till i databasmodellen. Det var faktiskt först då som jag lärde mig vad en DI-behållare (container) hade för funktion och dess koppling till vyerna.


Kmom05: Bygg ut ramverket
------------------------------------

<b>Var hittade du inspiration till ditt val av modul och var hittade du kodbasen som du använde?</b>

Jag tog en titt på guiden <i>Bygg ut ditt Anax MVC med en egen modul och publicera via Packagist</i> och fann flashmeddelandemodulen mycket tilltalande då feedback på funktioner som utförs av användaren i en website kan vara ett intressant tillägg. Skapandet och förståelsen för kodbasen har jag fått dels från Phalcon guiden för flashmeddelanden och dels från andra medstudenter då jag inte själv lyckats skriva allt PHP-koder själv.


<b>Hur gick det att utveckla modulen och integrera i ditt ramverk?</b>

Jag tyckte att det kunde kännas svårt att tillämpa Phalcon guiden fullt ut för att utveckla en modul som kan integreras med Anax-MVC. Modulen som utvecklades lade jag till en början i mappen src för Anax för att direkt testa om modulen funkade med Anax-MVC-ramverket innan jag laddade upp den till GitHub och Packagist. Jag fick en början en tom sida på min flash-router som senare visade sig att jag hade helt glömt bort en content sida i vilken flashmeddelanden skulle printas ut. Det var inte heller självklar att metoderna för utskrift av flashmeddelanden skulle kräva två argument för att skriva ut en flash av en viss typ såsom info, varning o.s.v. Detta löstes efter att jag kollat koderna av en medstudent.

<b>Hur gick det att publicera paketet på Packagist?</b>

Det gick ganska smidigt, det var bara att följa instruktionerna som fanns på sidan efter att man hade skapat ett konto och länkat det. med GitHub. Hur som helst, fick jag ett problem om att min modul inte hade någon Auto-update, detta åtgärdades utan problem med en guide som fanns på Packagistsidan.

<b>Hur gick det att skriva dokumentationen och testa att modulen fungerade tillsammans med Anax MVC?</b>

Dokumentationen var inte helt självklar och visste inte hur jag skulle börja. Jag gjorde helt enkelt som så att jag lånade mallen av en medstudent för att sedan skriva ner instruktionerna för användning samt installation. Efter att modulen hade laddats upp till både GitHub och Packagist tog jag när den från Packagist via composer. Det största problemet var att min klass, <i>CFlashmsg</i> inte kunde hittas och felsökningen tog timmar innan jag slutligen löste det genom att ändra i filen <i>composer.json</i>, namnet för mappen som skulle laddas via autoloader samt namespace addressen i klassen <i>CFlashmsg</i>.

<b>Gjorde du extrauppgiften? Beskriv i så fall hur du tänkte och vilket resultat du fick.</b>

Nej.

<b>Reflektion</b>

Svårighetsgraden för detta moment kan jag tycka var lite lägre jämfört med de föregående momenten speciellt kmom03 och kmom04. Det var relativt lite kod att skriva för modulen och de var inte heller särskilt svåra att förstå med hjälp av Phalcon guiden. Främsta problemen för mig var uppladdningen till GitHub samt integreringen av modulen med Anax-MVC efter att ha laddat ner den via composer. Uppladdningen till GitHub funkade inte för mig till en början, jag hade av någon anledning fått för mig att man kunde pusha en mapp via GUI-programmet direkt till GitHubs hemsida men egentligen skulle man ha skapat ett repo på hemsidan först. Detta tips fick jag efter att ha frågat om support på IRC-chatten. Ett annat problem var också att min composer.json fil inte visades på GitHub men genom att ta bort en rad i .gitignore filen löstes detta problem och även lösningen här fick jag i IRC-chatten. Allt som allt var detta ett intressant moment för att man själv fick skapa moduler, ladda upp dem för att sedan testa dem.


Kmom06: Verktyg och CI
------------------------------------

<b>Var du bekant med några av dessa tekniker innan du började med kursmomentet?</b>

Nej, har aldrig varit i kontakt med dessa tekniker innan så detta var ett bra tillskott i min kunskapsbas.

<b>Hur gick det att göra testfall med PHPUnit?</b>

PHPUnit krånglade en hel del för mig och var också det som tog längst tid att färdigställa. Jag testade till en början PHPUnit lokalt med en modul, CForm, varvid jag fick ett fel som jag inte riktigt kunde lösa själv. CForm var Mos klass och av den anledningen var det därför inte lämpligt att ändra i den och dessutom skulle modulen enligt guiden funka utan vidare problem. Jag slutade med att köra PHPUnit lokalt och körde istället via BTHs server där modulen CForm funkade felfritt. Men när det var dags att testa modulen som jag hade skapat i kmom05 gick det inte lika smidigt. Jag fick först ett fel där DI-container för klassen saknades och detta försökte jag åtgärda genom att via composer installera Anax-MVC men felet kvarstod ännu och till slut tog jag bort DI beroendet helt vilket löste problemet. Ett annat fel som också var tidskrävande var ett felmeddelande som löd "No tests were executed!" där jag efter felsökning utan framgång frågade på IRC-chatten där vi kom fram till att det var en fråga om stor/liten bokstav i modulnamnet. Det skulle alltså vara "CFlashmsgTest.php" och inte "CFlashmsgtest.php" som jag använde först.

<b>Hur gick det att integrera med Travis?</b>

Det gick relativt smidigt om man bara följde guiden och det uppstod inga större problem vad gäller denna uppgift.

<b>Hur gick det att integrera med Scrutinizer?</b>

Samma lika här, integrationen gick bra och det fanns inga större konstigheter eller jobbiga fel som var tidskrävande som för PHPUnituppgiften.

<b>Hur känns det att jobba med dessa verktyg, krångligt, bekvämt, tryggt? Kan du tänka dig att fortsätta använda dem?</b>

Jag fann dessa verktyg användbara och jag tror definitivt att dessa kan underlätta arbetet för en utvecklare avsevärt då de är informativa och som dessutom integrerar med moduler som man jobbar med. Jag tror att om jag framöver håller på med webbutveckling, kommer att använda något av dessa verktygen.

<b>Gjorde du extrauppgiften? Beskriv i så fall hur du tänkte och vilket resultat du fick.</b>

Nej.

<b>Reflektion</b>

Fastän PHPUnit tog sin tid var detta ett moment som var relativt lätt och verktygen var användbara. Ovannämnda problem löstes via IRC-chatten, inga större konstigheter. Instruktionerna i guiden var bra, speciellt för Travis och Scrutinizer, som gick mycket smidigt och nästan felfritt vilket kändes bra. Lärdomen i detta moment bestod utav verktygen Travis, Scrutinizer och PHPUnit, att få bekanta sig med dessa. Överlag var detta ett bra och givande moment och verktygen kan komma att vara till stor nytta framöver när jag webbprogrammerar.


Kmom0710: Projekt
------------------------------------

<b>Allmänt om projektet</b>

Projektet har varit svårt men i slutändan var det mödan värt. Det var tidskrävande då jag valde att kolla tillbaka på kursmomenten för att fräscha upp kunskapen. Jag visste inte riktigt hur jag skulle börja men jag utgick hur som helst från sidorna som det var krav på vilka var en förstasida, taggar, frågor, användare och en om-sida. Jag kände att jag visste vad jag ville ha efter ha att skissat ner för resp. sida vad som skulle ingå i dem funktionsmässigt. Men själva kodskrivandet har, som jag förväntade mig, varit utmanande, speciellt för röstningsfunktionen, svara på frågor och kommentarer samt inloggningen, som för mig krånglade en del. Jag kollade tillbaka på gamla moment för att lösa problemen som uppstod, frågade om hjälp i chatten samt kollade på mina medstudenters koder för att ta mig frammåt i projektet. Jag fick i många stunder pausa kodandet för att se efter vad det var jag hade gjort och försöka ha koll på röda tråden vilket i sig kunde vara tidskrävande då jag inte riktigt kände för att gå vidare ibland förrän jag förstått koderna. Men det är också tack vare att jag kört fast så mycjet som jag nu känner i efterhand att jag lärt mig en hel del om ramverket MVC.

<b>Krav 1, 2, 3: Grunden</b>

Webbsidan har en första sida där frågor, populära taggar och aktiva användare visas och är klickbara. Klickar man på en fråga visas den med tillhörande svar. Taggarna används för att filtrera frågor av ett visst ämne, för en fråga kan det finnas flera relevanta taggar. Användare som visas på förstasidan har en profil med uppgifter om senaste inloggningen samt vilka frågor och svar som användaren bidragit med. Inloggad användare har möjlighet att ändra sin profil genom att trycka på "edit" på användarsidan. För hantering av frågor och svar tänkte jag mig en egen klass och kontroller där klassen skulle hämta datan från tabeller medan kontrollern skulle hantera logiken som t.ex resetmetoden för databas där metoden i klassen question.php anropas och parametrar i form av en array skickas med. Klassen och kontrollern för användare (User.php och UserController.php) som funnits tidigare ändrades om så att de skulle passa ihop med de nya klasserna och kontrollerna som skapades. I User.php klassen byggdes ut med t.ex metoder som hämtar mest aktiva användare medan kontrollern kunde ha metoder som inloggning där CFlashmsg-modulen som skapades i kmom05, kom till användning, som i detta fall visar ett felmeddelande om en inloggning misslyckas.
Klassen och kontrollern för svar på frågor tänkte jag i början kunde slås ihop med dem som hanterar frågor men detta visade sig för min del vara svårare än jag trodde programmeringsmässigt. Det slutade med att jag skapade klassen och kontrollern för hantering av frågor separat där svar var en variabel av typen array som hämtas och visas när användaren klickar på en fråga av intresse.

Även för taggarna tänkte jag att det kunde vara smidigt med en egen klass och kontroller. Här användes en sql-where sats i Tag.php för att alla frågor med vald tag ska kunna hämtas. Jobbet med taggarna var relativt lätt jämfört med klasserna och kontrollerna för svar och frågor som var lite jobbigare då man skulle implementera funktionalitet så att man kunde svara på ett redan existerande svar.

Loginfunktionen var lite problematisk då jag hade problem med sessionen. Jag tänkte i början att man måste kunna logga in för att ställa och svara på frågor men för att veta om användaren var inloggad krävdes att sessionen hade ett tilldelat värde vilket inte alls för självklart för mig. Efter hjälp kom jag fram till slut att man kunde bygga ut klassen User.php med en checkLogin metod samt tillägg av en metod som gör att sessionsnamnet hämtas i UsersController.php. 

<b>Krav 4: Frågor (optionell)</b>

Jag tänkte att för varje fråga eller svar kunde användaren ha möjlighet att rösta upp eller ner samt märka ett svar som accepterat som på stackoverflow. Jag tänkte att vid klick ska rösternumret som börjar på 0 ska antingen öka eller sjunka och att röstningen skulle gälla specifikt för en fråga eller svar. Jag började i Question.php för att testa skapa en metod för uppröstning där jag hämtade kommentaren för vilken röstningen skulle gälla m.h.a kommentarsID men efter detta körde fast då jag inte visste riktigt hur man skulle gå tillväga för att få numret att ändras beroende på röstningen. Efter hjälp av medstudenter fick jag till slut fram en lösning där man lägger in en egen variabel för röstningen, $vote, som tilldelas en nolla i början. Det var dock lite jobbigt att man fick skapa metoder för upp- och nedröstning för såväl frågor som svar vilket resulterade i ett flertal metoder i klassen Question.php.

<b>Tankar om kursen</b>

Jag tycker att kursen har varit mycket givande och har för min del inneburit större insikt vad gällde tillämpning av ramverk inom programmering. Jag kan nog tycka att materialens innehåll för denna kurs jämfört med oophp och html kurserna inte varit lika tydligt vilket kunde ha varit bra med tanke på komplexitetsnivån. Jag upplevde att det i nästan alla kursmoment förutom den första, ha förekommit otydligheter där man efter att ha löst problemet insett vad som skulle kunnat göras tydligare som t.ex hur man kör igång databasen för första gången m.h.a en route där setupmetoden anropas och anges direkt i webbläsarens adressfält, något som jag fick lära mig av medstudenterna. Annars är jag ganska nöjd med kursen då jag så här i efterhand känner att jag lärt mig mycket. Jag är nöjd med litteraturen som har bidragit till förståelsen för sakerna som görs under kursmomenten samt hjälpten man kan få av lärarna och medstudenterna. Det gör att man orkar fortsätta att slutföra momenterna vilket är kul. Jag skulle nog rekommendera kursen som av mig får betyget 7/10.

