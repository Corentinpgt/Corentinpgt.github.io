<?php
/*
    Dans ce fichier, on écrira des fonctions "outils" qui réaliseront chacune des
    opérations spécifiques sur la base de données.
    C'est depuis le fichier script.php qu'on appelera telle ou telle fonction "outil"
    en fonction de la requête HTTP à traiter. C'est pour cela que le fichier model.php
    est inclus dans le fichier script.php : pour pouvoir appeler les fonctions "outils".
*/
// Selectionne tous les films
function getMovies(){
    $cnx = new PDO("mysql:host=localhost;dbname=SAE203", "pouget35", "Mbrud5gyb_");
    $answer = $cnx->query("SELECT * from Movies"); 
    $res = $answer->fetchAll(PDO::FETCH_OBJ);
    return $res;
}

// Selectionne un film
function getMovie($id){
    $cnx = new PDO("mysql:host=localhost;dbname=SAE203", "pouget35", "Mbrud5gyb_");
    $answer = $cnx->query("SELECT * from Movies WHERE Movies.id_movies = $id "); 
    $res = $answer->fetchAll(PDO::FETCH_OBJ);
    return $res;
}

// Selectionne un film en fonction de la categorie
function getMovieByCat($id){
    $cnx = new PDO("mysql:host=localhost;dbname=SAE203", "pouget35", "Mbrud5gyb_");
    $answer = $cnx->query("SELECT *from Movies WHERE id_category = $id"); 
    $res = $answer->fetchAll(PDO::FETCH_OBJ);
    return $res;
}

// Selectionne toutes les categories
function getCategorys(){
    $cnx = new PDO("mysql:host=localhost;dbname=SAE203", "pouget35", "Mbrud5gyb_");
    $answer = $cnx->query("select * from Category"); 
    $res = $answer->fetchAll(PDO::FETCH_OBJ);
    return $res;
}

// Selectionne tous les profiles
function getProfiles(){
    $cnx = new PDO("mysql:host=localhost;dbname=SAE203", "pouget35", "Mbrud5gyb_");
    $answer = $cnx->query("select * from UserProfile"); 
    $res = $answer->fetchAll(PDO::FETCH_OBJ);
    return $res;
}

// Affiche la playlist d'un profil
function getPlaylist($p){
    $cnx = new PDO("mysql:host=localhost;dbname=SAE203", "pouget35", "Mbrud5gyb_");
    $answer = $cnx->query("SELECT *from Movies
    INNER JOIN Playlist ON Playlist.id_movies = Movies.id_movies
    INNER JOIN UserProfile ON UserProfile.id_profile = Playlist.id_profile WHERE Playlist.id_profile = $p
    "); 
    $res = $answer->fetchAll(PDO::FETCH_OBJ);
    return $res;
}

// Ajoute un film dans la playlist d'un profil
function addPlaylist($m,$u){
    $cnx = new PDO("mysql:host=localhost;dbname=SAE203", "pouget35", "Mbrud5gyb_");
    $answer = $cnx->query("INSERT INTO Playlist(id_profile,id_movies) VALUES($u,$m)");

}

// Supprime un film dans la playlist d'un profil
function removeFromPlaylist($m,$u){
    $cnx = new PDO("mysql:host=localhost;dbname=SAE203", "pouget35", "Mbrud5gyb_");
    $answer = $cnx->query("DELETE FROM Playlist WHERE id_profile = $u AND id_movies = $m");
}

// Affiche les films en avant
function getTopMovie(){
    $cnx = new PDO("mysql:host=localhost;dbname=SAE203", "pouget35", "Mbrud5gyb_");
    $answer = $cnx->query("SELECT * from Movies WHERE enavant=1"); 
    $res = $answer->fetchAll(PDO::FETCH_OBJ);
    return $res;
}

// Met un film en avant ou non
function updateMovie($m,$v) {
    $cnx = new PDO("mysql:host=localhost;dbname=SAE203", "pouget35", "Mbrud5gyb_");
    $answer = $cnx->query("UPDATE Movies set enavant = $v WHERE id_movies=$m"); 
    $res = $answer->fetchAll(PDO::FETCH_OBJ);
    return $res;
}

// Recherche un film
function searchMovie($t) {
    $cnx = new PDO("mysql:host=localhost;dbname=SAE203", "pouget35", "Mbrud5gyb_");
    $answer = $cnx->query("SELECT * from Movies WHERE titre LIKE '%$t%'"); 
    $res = $answer->fetchAll(PDO::FETCH_OBJ);
    return $res;
}

// Ajoute une note
function addNotes($m,$u,$n) {
    $cnx = new PDO("mysql:host=localhost;dbname=SAE203", "pouget35", "Mbrud5gyb_");
    $answer = $cnx->query("REPLACE INTO UserMovieNote (id_movie, id_profile, note) VALUES ($m,$u,$n)"); 
}

function updateNote() {
    $cnx = new PDO("mysql:host=localhost;dbname=SAE203", "pouget35", "Mbrud5gyb_");
    $answer = $cnx->query("UPDATE Movies SET moyenne = (SELECT AVG(note) from UserMovieNote WHERE id_movie = Movies.id_movies)"); 
}



// Ajoute un film
function addMovie($c,$t,$r,$y,$i,$ytb){
    $cnx = new PDO("mysql:host=localhost;dbname=SAE203", "pouget35", "Mbrud5gyb_");
    $answer = $cnx->query("INSERT INTO Movies (id_category,titre,realisateur,annee_sortie,img,intgr_ytb) VALUES ($c,'$t','$r',$y,'$i','$ytb')"); 
}
// Ajoute un profile
function addProfile($n){
    $cnx = new PDO("mysql:host=localhost;dbname=SAE203", "pouget35", "Mbrud5gyb_");
    $answer = $cnx->query("INSERT INTO UserProfile (nom) VALUES ('$n')"); 
}

// Supprime un profile
function rmvProfile($p){
    $cnx = new PDO("mysql:host=localhost;dbname=SAE203", "pouget35", "Mbrud5gyb_");
    $answer = $cnx->query("DELETE FROM UserMovieNote WHERE id_profile =$p;DELETE FROM Playlist WHERE id_profile =$p;DELETE FROM UserProfile WHERE id_profile =$p"); 
}


?>
