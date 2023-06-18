const getForm=document.getElementById("form");

getForm.addEventListener("submit",insertUserDataToServer);


function insertUserDataToServer(event){
    event.preventDefault();
    // ici je recupere tous mes champs input
    const firstname=document.querySelector(".firstname");
    const lastname=document.querySelector(".lastname");
    const email=document.querySelector(".email");
    const description=document.querySelector(".description");
    const password=document.querySelector(".password");
    // ici je verifie que nous avons bien rempli tous nos champs. Nous accedons a la proprieté value
    if(firstname.value && lastname.value && email.value && description.value && password.value){
        // ici je vais construire un  object contenant les données que j'ai envoyés pour ensuite transmettre ces données au backend. Cette objet conteindra les valuers que j'ai saisi dans le formulaire
        const dataToSend={firstname:firstname.value,lastname:lastname.value,email:email.value,description:description.value,password:password.value};


        // ici je vais ecrire mes données dans le serveur. Je vais appel a la fonction fetch, et contrairement a lors que j'utilise la methode GET, ici je suis en POST et je vais donc devoir preciser des informations additionelles. En premier lieu, la methode utilisé (fetch est en GET par defaut) Ainsi que le corps de la requette et les en-tetes pour definir le type de contenu que je vais envoyer
        fetch('http://localhost:8080/introPHP/cours-php-dynamique/serie3/api/back/insert.php',{
            method:"POST",
            // ici je vais transformer mon objet en chaine de caracteres pour que il puisse etre lu par mon serveur php. Je vais ensuite appliquer un json_decode en PHP pour le transformer en tableau associatif
            body: JSON.stringify(dataToSend),
            //ici je defini le type de contenu de la requette. Ca sera une chaine de caracteres ecrit comme du json (si j'ai bien compris)
            headers:{"Content-type":"application/json"}

        }).then((response)=>{
            response.json().then((message)=>{
                console.log(message)
            }).catch((error)=>{
                console.log("get error");
                console.log(error);
            })
        });
    }
}