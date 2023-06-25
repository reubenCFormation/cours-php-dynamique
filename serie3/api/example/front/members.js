// ici je vais interoger l'url ci dessous. J'utilise la methode fetch natif a javascript. La methode fetch prends l'url en argument et va retourner le contenu de cette url. Le contenu renvoyé par l'url se trouve dans le .then

// remarquer aussi, que je peux passer en argument dans la methode fetch, un objet avec une clé que j'apelle headers. Cette clé aura comme valeur un autre objet avec une clé Authorization suivi pas "Bearer {mon_jeton}. On verra juste apres comment creer des jetons mais l'idee est d'envoyer a notre backend des informations pour leur montrer que on est autorisé a acceder aux informations de l'url a la quelle on souhaite acceder"
fetch("http://localhost:8080/introPHP/cours-php-dynamique/serie3/api/example/back/members.php",{headers:{"Authorization":"Bearer my_token"}}).then((response)=>{

    console.log("GET RESPONSE");
    console.log(response);
    console.log(typeof response);
    // dans la fonction fetch, la reponse qui nous est retourné ne contient pas directement les données auxquelles nous souhaitons acceder.Neanmoins elle contient des fonctions pour pouvoir acceder aux données. L'une de ces fonctions est la fonction json qui va nous retourner les données sous format json et nous allons pouvoir ensuite acceder aux données comme nous le souhaitons. N'oubliez pas de mettre un .then apres l'appel a response.json pour acceder au données sous format json!
    response.json().then((data)=>{
        // ici je vais faire appel a la fonction showMemebers en lui precisant le data en argument pour afficher tous nos membres
        console.log("GET JSON DATA");
        console.log(data);

        showMembers(data);
    }).catch((error)=>{
        console.log("get error");
        console.log(error);
    })
    
    
})





  


function showMembers(data){
    const getTable=document.querySelector(".members-table");
    for(let i=0;i<data.length;i++){
        const tbody=document.createElement("tbody");
        const tr=document.createElement("tr");
        const firstNameTd=document.createElement("td");
        const lastNameTd=document.createElement("td");
        const emailTd=document.createElement("td");
        const descriptionTd=document.createElement("td");

        

        firstNameTd.textContent=data[i].firstname;
        lastNameTd.textContent=data[i].lastname;
        emailTd.textContent=data[i].email;
        descriptionTd.textContent=data[i].description;

        getTable.appendChild(tbody);
        getTable.appendChild(tr);

        tr.appendChild(firstNameTd);
        tr.appendChild(lastNameTd);
        tr.appendChild(emailTd);
        tr.appendChild(descriptionTd);

        
    }
}