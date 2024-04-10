/*
  Placez dans ce fichier le code Javascript nécessaire au fonctionnement de l'application vitrine
*/

/* Fonction renderTemplate (c'est cadeau)

   Sous certaines conditions, cette fonction est capable de formater n'importe quel
   template avec n'importe quelles données. Une sorte de rendu de template "universelle".
   A condition que :
    - les données sont structurées dans des objets avec des propriétés qui sont des chaines ou des nombres
      Si vous avez des propriétés qui sont des tableaux ou des sous-objets ça ne marchera pas.
    - les tags dans le template à formater sont les noms des propriétés des objets encadrées de {{ et }}

    Rôle des paramètre : 
    tpl : le selecteur CSS du template à utiliser
    data : un tableau d'objets (chaque objet sera rendu avec le template tpl)
    where : le selecteur CSS de l'élément "conteneur" ou les templates formatés doivent apparaître dans la page

    Note : data est forcément un tableau d'objets. Si vous n'avez qu'un seul objet pour formater, data 
    devra quand même être un tableau avec ce seul objet dedans.

*/

let renderTemplate = function (tpl, data, where) {
  let template = document.querySelector(tpl);
  let res = "";
  for (let elem of data) {
    let html = template.innerHTML;
    for (let prop in elem) {
      
      html = html.replaceAll("{{img}}", elem.img);
      html = html.replaceAll("{{title}}", elem.titre);
      html = html.replaceAll("{{year}}", elem.annee_sortie);
      html = html.replaceAll("{{realisator}}", elem.realisateur);
      html = html.replaceAll("{{id}}", elem.id_movies);
      html = html.replaceAll("{{ytb}}", elem.intgr_ytb);
      html = html.replaceAll("{{category}}", elem.nom);
      html = html.replaceAll("{{idcat}}", elem.id_category);
      html = html.replaceAll("{{profiles}}", elem.nom);
      html = html.replaceAll("{{idprof}}", elem.id_profile);
      html = html.replaceAll("{{note}}", elem.moyenne);

    }
    res += html;
  }
  document.querySelector(where).innerHTML = res;
}

// affiche toutes les catégories 
let requestCategorys = async function() {
  let response = await fetch("../server/script.php?action=getcat");
  let data = await response.json();
  renderTemplate("#template_category", data, ".category_container");
}

// Affiche une catégorie
let requestCategory = async function(id) {
  let response = await fetch("../server/script.php?action=getmovies&category=" + id);
  let data = await response.json();
  for (let elt of data) {
    if (elt.moyenne == null) {   
      elt.moyenne = "Non noté";
    }
  }
  renderTemplate("#template", data, ".template");
}

// Affiche les films
let requestGetMovies = async function () {
  let response = await fetch("../server/script.php?action=getmovies");
  let data = await response.json();
  for (let elt of data) {
    if (elt.moyenne == null) {   
      elt.moyenne = "Non noté";
    }
  }
  renderTemplate("#template", data, ".template");
}

// affiche un filme
let requestOneMovie = async function (id) {
  let response = await fetch("../server/script.php?action=getmovie&idmovie=" + id);
  let data = await response.json();
  for (let elt of data) {
    if (elt.moyenne == null) {   
      elt.moyenne = "Non noté";
    }
  }
  renderTemplate("#template_iframe", data, ".template");
}

// Affiche les profils
let requestProfiles = async function() {
  let response = await fetch("../server/script.php?action=getprofiles");
  let data = await response.json();
  renderTemplate("#template_profile", data, ".profiles_container");
}

// Affiche la playlist de l'utilisateur actif
let requestPlaylist = async function(){
  let user = document.querySelector(".profiles_container");
  let response = await fetch("../server/script.php?action=getplaylist&idprofile=" + user.value);
  let data = await response.json();
  for (let elt of data) {
    if (elt.moyenne == null) {   
      elt.moyenne = "Non noté";
    }
  }
  renderTemplate("#template2", data, ".template");

}


// affiche les films en avant
let requestTopMovie = async function () {
  let response = await fetch("../server/script.php?action=gettopmovie");
  let data = await response.json();
  for (let elt of data) {
    if (elt.moyenne == null) {   
      elt.moyenne = "Non noté";
    }
  }
  renderTemplate("#template3", data, ".template_enavant");
}

// recherche les noms des films 
let requestSearch = async function () {
  let text = document.querySelector(".search-bar_input");
  let response = await fetch("../server/script.php?action=searchmovie&text="+text.value);
  let data = await response.json();
  for (let elt of data) {
    if (elt.moyenne == null) {   
      elt.moyenne = "Non noté";
    }
  }
  renderTemplate("#template", data, ".template");
}

// Ajoute une note à un film
let addNote = async function (id) {
  let prof = document.querySelector(".profiles_container");
  let review = document.querySelector(".review_input");
  await fetch("../server/script.php?action=addnote&idmovie=" + id + "&idprofile=" + prof.value + "&note=" + review.value);
  upNote();
}


let upNote = async function () {
  await fetch("../server/script.php?action=updatenote");
}


// Ajoute un film à une playlist
let addPlaylist = async function(mov) {
  let prof = document.querySelector(".profiles_container");
  fetch("../server/script.php?action=addtoplaylist&idmovie=" + mov + "&idprofile=" + prof.value);
}

// Supprime un film d'une playlist
let removeFromPlaylist = async function(mov){
  let prof = document.querySelector(".profiles_container");
  fetch("../server/script.php?action=removefromplaylist&idmovie=" + mov + "&idprofile=" + prof.value);
  requestPlaylist();
}


let headnav = document.querySelector(".main_header");

let openClose = function () {
  headnav.classList.toggle("isopen");
}


requestCategorys();
requestProfiles();
requestTopMovie();
