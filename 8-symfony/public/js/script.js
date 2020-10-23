console.log("test : fichier js bien chargé");

// requête ajax / xml httprequest
// envoyer une requête http sans recharger la page

var formPost = document.querySelector('form[name=post]');
formPost.addEventListener('submit', function(event) {
    // on bloque l'envoi du formulaire pour ne pas recharger la page
    event.preventDefault();

    // c'est à nous de faire cet envoi mais en ajax

    // on récupère l'url vers laquelle il faut les données de formulaire
    let url = formPost.getAttribute('action');
    // on récupère la méthod (GET ou POST)
    let method = formPost.getAttribute('method');
    // on récupère les données qu'il faut envoyer
    let data = new FormData(formPost);

    // on a besoin d'un objet xmlhttprequet pour envoyer une requête
    var xhttp = new XMLHttpRequest();

    // callback : fonction appelée quand la requête est terminée
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // this.responseText est la réponse du serveur
            // qu'est-ce qqu'on fait quand le serveur a répondu positivement ?
            let response = JSON.parse(this.responseText);

            if (response.code == 0) {
               let listePosts = document.querySelector('#list-posts');

               if (listePosts) {
                   // on insère le nouveau dans le html
                   listePosts.innerHTML = response.template + listePosts.innerHTML;

                   // on réinitialise le formulaire pour enlever le post
                   // qui vient d'être créé
                   formPost.reset();
               }
               // on est pas sur la page timeline
               else {
                   alert('Le post a bien été ajouté mais il faudrait rafraichir l\'interface de cette page');
                  // par exemple : rediriger vers la page d'accueil avec la liste des posts
                   document.location = "/";
               }

            }
            else {
                alert('Erreur dans le formulaire');
                let newFormPost = document.createElement('form');
                newFormPost.innerHTML = response.template;
                formPost.replaceWith(newFormPost);
            }
        }
    };

    // on envoie la requête ajax
    xhttp.open(method, url, true);
    xhttp.send(data);
});