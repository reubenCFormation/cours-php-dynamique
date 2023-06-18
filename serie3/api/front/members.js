// ici je vais interoger et recuperer les données qui sont contenu dans mon fichier members.php coté back

fetch("http://localhost:8080/introPHP/cours-php-dynamique/serie3/api/back/members.php").then((response)=>{
   
    // dans la fonction fetch, la reponse qui nous est retourné ne contient pas directement les données auxquelles nous souhaitons acceder.Neanmoins elle contient des fonctions pour pouvoir acceder aux données. L'une de ces fonctions est la fonction json qui va nous retourner les données sous format json
    response.json().then((data)=>{
        // ici je vais faire appel a la fonction showMemebers en lui precisant le data en argument pour afficher tous nos membres
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