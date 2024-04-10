<?php

/*

  Dans ce fichier, on se charge de répondre aux requêtes HTTP émises par les applications
  front vitrine et back office.
  Le traitement de la requête, la réponse à retourner est fonction des valeurs paramètres présents
  dans la requête.

*/

require("model.php");

if (isset($_REQUEST['action']) && $_REQUEST['action']=='getmovies'){
  if (isset($_REQUEST['category'])) {
    $movie = getMovieByCat($_REQUEST['category']);
    echo json_encode($movie);
    exit;
  }
  else {
    $movie = getMovies();
    echo json_encode($movie);
    exit;
  }
  
  
}

if (isset($_REQUEST['action']) && $_REQUEST['action']=='getmovie'){
  $id = $_REQUEST["idmovie"];
  $movie = getMovie($id);
  echo json_encode($movie);
  exit;
  
}

if (isset($_REQUEST['action']) && $_REQUEST['action']=='getcat'){
  $cat = getCategorys();
  echo json_encode($cat);
  exit;
  
}


if (isset($_REQUEST['action']) && $_REQUEST['action']=='getprofiles'){
  $user = getProfiles();
  echo json_encode($user);
  exit;
  
}

if (isset($_REQUEST['action']) && $_REQUEST['action']=='getplaylist'){
  $idprof = $_REQUEST['idprofile'];
  $play = getPlaylist($idprof);
  echo json_encode($play);
  exit;
  
}

if (isset($_REQUEST['action']) && $_REQUEST['action']=='gettopmovie'){
  $top = getTopMovie();
  echo json_encode($top);
  exit;
  
}

if (isset($_REQUEST['action']) && $_REQUEST['action']=='updatefilms'){
  $movie = $_REQUEST['idmovie'];
  $value = $_REQUEST['value'];
  $up = updateMovie($movie,$value);
  echo json_encode($up);
  exit;
  
}

if (isset($_REQUEST['action']) && $_REQUEST['action']=='searchmovie'){
  $text = $_REQUEST['text'];
  $srch = searchMovie($text);
  echo json_encode($srch);
  exit;
  
}



if (isset($_REQUEST['action']) && $_REQUEST['action']=='addtoplaylist'){
  $movie = $_REQUEST['idmovie'];
  $user = $_REQUEST['idprofile'];
  $playlist = addPlaylist($movie,$user);
  echo json_encode($playlist);
  exit;
  
}


if (isset($_REQUEST['action']) && $_REQUEST['action']=='removefromplaylist'){
  $movie = $_REQUEST['idmovie'];
  $user = $_REQUEST['idprofile'];
  $playlist = removeFromPlaylist($movie,$user);
  echo json_encode($playlist);
  exit;
  
}


if (isset($_REQUEST['action']) && $_REQUEST['action']=='addnote'){
  $movie = $_REQUEST['idmovie'];
  $user = $_REQUEST['idprofile'];
  $n = $_REQUEST['note'];
  $note = addNotes($movie,$user,$n);
  echo json_encode($note);
  exit;
  
}

if (isset($_REQUEST['action']) && $_REQUEST['action']=='updatenote'){
  $note = updateNote();
  echo json_encode($note);
  exit;
  
}

// Backoffice

if (isset($_REQUEST['action']) && $_REQUEST['action']=='addmovie'){
  $category = $_REQUEST['category'];
  $title = $_REQUEST['title'];
  $realisator = $_REQUEST['realisator'];
  $year = $_REQUEST['year'];
  $img = $_REQUEST['img'];
  $ytb = $_REQUEST['ytb'];
  addMovie($category,$title,$realisator,$year,$img,$ytb);
  exit();
}


if (isset($_REQUEST['action']) && $_REQUEST['action']=='addprofile'){
  $name = $_REQUEST['name'];
  addProfile($name);
  exit;
}

if (isset($_REQUEST['action']) && $_REQUEST['action']=='deleteprofile'){
  $prof = $_REQUEST['idprofile'];
  rmvProfile($prof);
  exit;
}





/* 
    Si on atteint la fin du script sans avoir répondu à la requête, on
    répond un 404 (not found) par défaut
*/
http_response_code(404);

?>