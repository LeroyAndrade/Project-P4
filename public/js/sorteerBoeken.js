// https://blanken5.home.xs4all.nl/bestelpaginaLocalStorage.html

// keuze voorsorteren opties
document.getElementById('kenmerk').addEventListener('change', (e) =>{
        sorteerBoekObj.kenmerk = e.target.value;
        sorteerBoekObj.sorteren();
        console.log("Change event gedetecteerd.");
        console.log(sorteerBoekObj.kenmerk);
    });

//oude code1: const url="boeken.json"; --> koppeling met regel #23
//nieuwe code:  één constante minder door source direct defineren in de request

let xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function(){

    //kijken wat voor onready state change je in bevind:
    if(this.readyState ===4 && this.status === 200){
        console.log("Ready state OK - verbinding OK"); 
        //Responses
       
        //index.HTML toont de inhoud van de resonseText welke is gedefinieerd in 
            sorteerBoekObj.data=JSON.parse(this.responseText);//en this.responseText is de inhoud van const url in xmlhttp.open[1]

            sorteerBoekObj.VoegJSDatumIn();

            // de data van object moeten ook een eigenschap hebben, waarbij de titels
            // in kapitalen staan, daarop, wordt dan gesorteerd
            sorteerBoekObj.data.forEach( boek =>{
                boek.titelUppercase = boek.titel.toUpperCase();
                //Pak achternaam van de eerste auteur als eigenschap, in data, toevoegen

                boek.sorteren = boek.auteur[0];
            });
           
            sorteerBoekObj.sorteren(); // roep het object.methode->sorteren aan die sorteerBoekObj.uitvoeren  afspeelt

            //volgende regel hoort bij nieuwe code
            //console.log("Alle data is uitgelezen, wanneer niet wordt getoond op het scherm, voer console in: sorteerBoekObj. Data kun je forceren met: oproepen object: sorteerBoekObj.uitvoeren");
    } else {
       // console.log("readyState" + this.readyState);
      //  console.log("readyStatus" + this.status);
    }
}
//wat wordt er geopend? het volgende:
//    xmlhttp.open('GET', "boeken.json", true);
    xmlhttp.open('GET', "boekenSelf.json", true);
//verzenden
xmlhttp.send();

//functie die tabel kop en rij maken in markup uitvoeren
 // Uitleebaar:sorteerBoekObj.data[0].titel

 //CSS: .boekSelectie__rij--accent
 const maakTabelKop = (arr) => {
    let kop = "<table class='boekSelectie'><tr>";
    arr.forEach((item) => {
     kop += "<th>" + item + "</th>";    
    });
    kop +="</tr>";
    return kop;
}



//Switch -> functie die een int maakt van de maand
let geefMaandNummer = (maand) =>{
    let nummer;
    switch (maand) {
        case "januari":     nummer=1;  break;
        case "februari":    nummer=2;  break;
        case "maart":       nummer=3;  break;
        case "april":       nummer=4;  break;
        case "mei":         nummer=5;  break;
        case "juni":        nummer=6;  break;
        case "juli":        nummer=7;  break;
        case "augustus":    nummer=8;  break;
        case "september":   nummer=9;  break;
        case "oktober":     nummer=10; break;
        case "november":    nummer=11; break;
        case "december":    nummer=12; break;
        default:            nummer=0;
    }
    return nummer;
}

//deze functie haalt de JSON auteur data op, met een opsomming
let maakOpsommingAuteurs = (array) =>{
    let string = "";
    for(let i=0; i< array.length; i++)
    {
        switch (i) {
            //zolang aantal auteurs < dan het aantal auteurs, dan voeg je er 1 bij toe
            case array.length -1: string += array[i];            break;
            case array.length -2: string += array[i] + " en ";   break;
            default: string += array[i]+ ", ";
        }
    }
    return string;
}


// functie die string van maand, jaar omzet in een dateObject
let maakJSdatum = (maandJaar) =>{
    //de splitsing zal gebeuren op basis van een spatie
        let maandJaarArr = maandJaar.split(" ");
        let datum = new Date(maandJaarArr[1], geefMaandNummer(maandJaarArr[0]));
        return datum;
    }

    //Hier is de bedoeling dat de JSON data wordt geladen, 


//maakt van een array den opsomming met ', ' en ' en'
let maakOpsomming = [];
let arr = [];
function arrOps(array){
    let string = "";
    for(let i=0; i<array.length;i++){
        switch (i) {
            case array.length-1: string+=array[i];            break;
            case array.length-2: string+=array[i] + " en ";   break;
            default: string += array[i] + ", ";
        }
        
    }
}

//functie die de de tekst achter de komma, 'de, het', vooraan plaatst
const keerTekstOm = (string) =>{
    if (string.indexOf(',') != -1) // niet -1 = geen komma aanwezig
    {
    let array = string.split(',');
    string = array[1] + ' ' + array[0]; 
    }

return string;
}





// winkelwagenObject
// Dit zorgt voor het toevoegen van items in winkelmandje

let winkelwagen = {
    items: [],
    haalItemsOp: function(){
        let bestelling;

        if (localStorage.getItem('besteldeItem') == null)
        {
             bestelling = [];
        } 
        else {
             bestelling = JSON.parse(localStorage.getItem('besteldeItem'));
//querySelector = gelijk aan de lengte van de bestelling, daar zit een array in welke je terugkrijgt.
             document.querySelector('.winkelwagen__aantal').innerHTML = bestelling.length;
        }
        return bestelling;
    },

    //toevoegen item aan winkelmand
   // items: [],
    toevoegen: function(el){
        this.items = this.haalItemsOp();
        this.items.push(el);
        ///na pushen, item toevoegen aan localStorage
        localStorage.setItem('besteldeItem', JSON.stringify(this.items));
        document.querySelector('.winkelwagen__aantal').innerHTML = this.items.length;
    }
    //
}
winkelwagen.haalItemsOp();















//Object dat boeken sorteert en de commando van dropdown menu uitvoert
let sorteerBoekObj ={
    //data is een methode

    //met de ',' worden object regels van elkaar onderschijden;
    data: "",  // afkomstig vanuit xmlhttp.onreadychange
    kenmerk: "titel",
    
    //af en oplopend radio button
    oplopend: 1,
    //een datumObject toevoegen aan de this.data, vanuit de JSON string: uitgave
    VoegJSDatumIn: function(){
       this.data.forEach((item) =>{
        //1 item uit de data
            item.jsDatum = maakJSdatum(item.uitgave);
       });
    },
    //data sorteren:
    //sorteren is een methode
    sorteren: function(){
        //omdat je nu binnen in het object zit, hoef je geen  sorteerBoekObj.uitvoeren(); meer te doen 
        // wat nu kan is simpwelweg gebruik maken van de 'this'
        //sorteren van data: ieder object boek wordt gezien als nieuw boek en wordt dus opnieuw gelezen vanaf 0. Je pakt twee boeken en vergelijkt ze met elkaar en op naar volgende.
       
        // this.data.sort( (a,b) => a[this.kenmerk] > b[this.kenmerk] ? 1:-1 );

    //met de radio button oplopend  de Waarde van de radio button ->  1 * 1 en anders -1*-1
       this.data.sort( (a,b) => a[this.kenmerk] > b[this.kenmerk] ? 1*this.oplopend : -1*this.oplopend);
        // of this.data.sort( (a,b) => a.titel[0] > b.titel[0] ? 1:-1 );
        this.uitvoeren(this.data);
    },
    
    //de data binnen tabel van .JSON document uitvoeren
    uitvoeren: function(data){
        //uitvoer leegmaken zodat het niet dubbel wordt weergeven
        document.getElementById("uitvoer").innerHTML = "";
        //creëer element met javascript 
        data.forEach( boek =>
        {
        let sectie = document.createElement("section");
            sectie.className = "boekSelectie";
 
        //main element met alle informatie van object behalve prijs en afbeelding
        let main = document.createElement("main");
            main.className = 'boekSelectie__main';

            
        //afbleeding cover afbeelding
        let afbeelding = document.createElement("img");
            afbeelding.className = "boekSelectie__cover";
            afbeelding.setAttribute("src", boek.cover);
            afbeelding.setAttribute("alt", keerTekstOm(boek.titel));
        
        //titel
        let titel = document.createElement("h3");
            titel.className = "boekSelectie__titel";
            titel.textContent = keerTekstOm(boek.titel); //haalt de titel uit de titel

        //auteurs=
        let auteurs = document.createElement("p");
            auteurs.className = "boekSelectie__auteurs";
            //de voor en achternaam van de eerste auteur omdraaien.
        
        boek.auteur[0] = keerTekstOm(boek.auteur[0]);
        // auteurs, staan in een array: deze omzetten naar Nederlandse string
        auteurs.textContent =maakOpsommingAuteurs(boek.auteur);

        // overige info toevoegen
        let overig = document.createElement("overig");
            overig.className = 'boekSelectie__overig';
            overig.textContent = 'datum: '+boek.uitgave+' | aantal pagina'+boek.paginas+' | '+boek.taal+' | ean'+boek.ean;
           
        // Knop toevoegen bij de prijs
        let knop = document.createElement("button");
            knop.className = 'boekSelectie__knop';
            knop.innerHTML = 'Voeg toe aan <br/> winkelwagen';
            knop.addEventListener('click', () =>{
                winkelwagen.toevoegen(boek);
            })

        //prijs toevoegen    
        let prijs = document.createElement("div");
            prijs.className ="boekSelectie__prijs";
            prijs.textContent = boek.prijs.toLocaleString('nl-NL', {currency: 'EUR', style: 'currency'});
    


        //samenvoegen 
        sectie.appendChild(afbeelding);
        sectie.appendChild(titel);
       // main.appendChild(auteurs);
      //  main.appendChild(overig);
        sectie.appendChild(main);
        prijs.appendChild(knop);
        sectie.appendChild(prijs);
        document.getElementById("uitvoer").appendChild(sectie);
        });
    }
}


// keuze voorsorteren opties
document.getElementById('kenmerk').addEventListener('change', (e) =>{
    sorteerBoekObj.kenmerk = e.target.value;
    sorteerBoekObj.sorteren();
    console.log("Change event gedetecteerd.");
    console.log(sorteerBoekObj.kenmerk);
})


document.getElementsByName('oplopend').forEach((item) =>{
    item.addEventListener('click', (e)=>{
        //.target is de item die je raakt, dus de item van de div in de index.html
        sorteerBoekObj.oplopend = parseInt(e.target.value);
        sorteerBoekObj.sorteren();
        })
    })
    