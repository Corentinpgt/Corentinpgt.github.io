let renderTemplate = function (tpl, data, where) {
  let template = document.querySelector(tpl);
  let res = "";
  for (let elem of data) {
    let html = template.innerHTML;
    for (let prop in elem) {

      html = html.replaceAll("{{profiles}}", elem.nom);
      html = html.replaceAll("{{idprof}}", elem.id_profile);
      html = html.replaceAll("{{idfilms}}", elem.id_movies);
      html = html.replaceAll("{{films}}", elem.titre);
    }
    res += html;
  }
  document.querySelector(where).innerHTML = res;
}


// Affiche les profils

let requestProfiles = async function() {
  let response = await fetch("../server/script.php?action=getprofiles");
  let data = await response.json();
  renderTemplate("#template_profile", data, ".profiles_container");
}


// Supprime les profils

let removeProfiles = async function() {
  let prof = document.querySelector(".profiles_container");
  fetch("../server/script.php?action=deleteprofile&idprofile="+prof.value);
  requestProfiles();
}

// Afficher les films

let requestMovies = async function() {
  let response = await fetch("../server/script.php?action=getmovies");
  let data = await response.json();
  renderTemplate("#template_films", data, ".films_container");
}

// Mettre en avant ou non les films

let updateFilms = async function() {
  let film = document.querySelector(".films_container");
  let valeur = document.querySelector(".enavant");
  console.log("idmovie" + film, "value" + valeur);
  fetch("../server/script.php?action=updatefilms&idmovie="+film.value+"&value="+valeur.value);
}


requestProfiles();
requestMovies();
