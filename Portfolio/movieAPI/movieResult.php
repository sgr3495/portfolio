<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
 	<link href='https://fonts.googleapis.com/css?family=Asap' rel='stylesheet' type='text/css'>
 	<title>Moive Results</title>
 	
	<!-- Import jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <link rel="stylesheet" href="styles.css">
 
  <script>
  "use strict";
    
  var MOVIEDB_URL = "https://api.themoviedb.org/3/";
  var DISCOVER_URL = "discover/";
  var API_KEY = "api_key=b17e0751645f26636790e605d4141b72";
  
  var value;
  
  window.onload = init;
  
  function init(){
	//document.querySelector("#search").onclick = displayMovieData;
	displayMovieData();
  }
  
  //function
  function displayMovieData(){
	//make a url string
	var url = MOVIEDB_URL;
	url += "movie/";
    url += <?php echo "" . $_GET["movie"]; ?>;
	url += "?" + API_KEY;
	//url = "https://api.themoviedb.org/3/movie/150540?api_key=b17e0751645f26636790e605d4141b72";
	//URL complete
	
	// call the web service, and download the file
	console.log("loading " + url);
	$("#content").fadeOut(1000);
	$.ajax({
	  dataType: "jsonp",
	  url: url,
	  data: null,
	  success: jsonLoaded
	});
  }
  
  function jsonLoaded(obj){
	console.log("obj = " + obj);
	console.log("obj stringified = " + JSON.stringify(obj));
	// if there's an error, print a message and return
	if(obj.error){
		var status = obj.status;
		var description = obj.description;
		document.querySelector("#dynamicContent").innerHTML = "<h3><b>Error!</b></h3>" + "<p><i>" + status + "</i><p>" + "<p><i>" + description + "</i><p>";
		$("#dynamicContent").fadeIn(500);
		return; // Bail out
	}
		
	// if there are no results, print a message and return
	if(obj.total_items == 0){
		var status = "No results found";
		document.querySelector("#dynamicContent").innerHTML = "<p><i>" + status + "</i><p>" + "<p><i>";
		$("#dynamicContent").fadeIn(500);
		return; // Bail out
	}
	
	//loop the result of the search movie
	var movieResult = obj;
	
	//genres
	var movieGenres = obj.genres;
	var genres = "";
	for (var i = 0; i<movieGenres.length; i++)
	{
		genres += movieGenres[i].name + ", ";
	}
	console.log("movieResult.length = " + movieResult);
	
	//production companies
	var movieCompany = obj.production_companies;
	var companies = "";
	for (var i = 0; i<movieCompany.length; i++)
	{
		companies += movieCompany[i].name + ", ";
	}
	//bigString start here
	var bigString = "";
	//path for poster 
	var moviePosterPath = "https://image.tmdb.org/t/p/w342/" + movieResult.poster_path;
	bigString += "<div id = 'resultBody'>";
		bigString += "<div id = 'leftCol'>";
			bigString += (movieResult.poster_path != null ? "<img src=" +moviePosterPath+ ">" : "<p>No poster path found</p>");
			bigString += "<p><b>Movie Facts</b><p>";
			bigString += "<p>Runtime: $" +movieResult.runtime+ "</p>";
			bigString += "<p>Budget: $" +movieResult.budget+ "</p>";
			bigString += "<p>Revenue: $" +movieResult.revenue+ "</p>";
		bigString += "</div>";
		bigString += "<div class = 'mainCol'>";
			bigString += "<h1><b>" + movieResult.title +"</b> (" +movieResult.vote_average+ "/10)</h1>";
			bigString += "<p><b>Overview</b><p>";
			bigString += "<p>" +movieResult.overview+ "</p>";
			bigString += "<br />";
			bigString += "<p><b>Tagline</b><p>";
			bigString += "<p>" +movieResult.tagline+ "</p>";
			bigString += "<br />";
			bigString += "<p><b>Genres</b><p>";
			bigString += "<p>" +genres+ "</p>";
			bigString += "<br />";
			bigString += "<p><b>Production Companies</b><p>";
			bigString += "<p>" +companies+ "</p>";		
			
		bigString += "</div>";
	bigString += "</div>";

	document.querySelector("#dynamicContent").innerHTML = bigString;
	$("dynamicContent").fadeIn(500);
	
  }
  
  
  </script>
  
</head>
<body>

<div id="innerBody">
<div id="linkBar">
<a id = "leftLink" href="index.html">Search Movie</a>
<a id = "rightLink" href="trailerFeature.php">Movie Trailer</a>
</div>
	 <div id="dynamicContent">

	 </div>
 </div>
 
</body>
</html>
