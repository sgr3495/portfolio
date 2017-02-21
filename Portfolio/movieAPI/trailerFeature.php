<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Trailer XML</title>
	
	<link href='https://fonts.googleapis.com/css?family=Asap' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="styles.css">
	
	<script>
	
	"use strict";
	//https://www.traileraddict.com/trailerapi
	//https://api.traileraddict.com/?featured=yes&count=8&width=720
	
	(function(){
		window.onload = init;
		
		function init(){
			//document.querySelector('#trailerButton').onclick = loadData;
			loadData();
		}
		
		function loadData(){			
            
            
            var oParser = new DOMParser();
            var xml = oParser.parseFromString('<?php
                 	$fileData = file_get_contents("http://api.traileraddict.com/?featured=yes&count=8&width=720");
                    
                    // send a content-type header for the response so that the client browser will understand what is coming back
                    //header("content-type: text/xml");
                    // echo the content from the file or url
                    $fileData = trim(preg_replace('/\s+/', ' ', $fileData));
                    
                    echo $fileData;
            ?>', "text/xml");
            
            console.dir(xml);
			//get an array of all the <trailer> elements
			var movieTrailer = xml.querySelectorAll('trailer');
			
            var bigString = "";
			//loop through the <trailer> elements
			for (var i=0; i<movieTrailer.length; i++){
				//grab the current <trailer>
				var trailer = movieTrailer[i];
				
				//get the <title> element of that <trailer>
				var title = trailer.querySelector('title').firstChild.nodeValue;
				
				//get the <link> element of that <trailer>
				var link = trailer.querySelector ('link').firstChild.nodeValue;
				
				// get the <embed> element of that <trailer>  This one is to get the video
				var embed = trailer.querySelector ('embed').firstChild.nodeValue;
				
				console.log(embed);
				var embedSplit = embed.split("iframe");
				console.log(embedSplit[1]);
				
				
				// 7) do some concatenation
				bigString += "<div class = 'trailer'>";
					bigString +="<hr />"
					bigString += "<h3>" + title + "</h3>";
					//bigString += "<p><a href=" + link + "</a></p>";
					bigString += "<iframe " +embedSplit[1]+ "iframe>";
				bigString += "</div>";
				
				// 8) Update the #contect div
				document.querySelector('#dynamicContent').innerHTML = bigString;
			}
		
		}
	
	}())
	</script>
</head>
<body>
	<div id="innerBody">
<div id="linkBar">
<a id = "leftLink" href="index.html">Search Movie</a>
<a id = "rightLink" href="trailerFeature.php">Movie Trailer</a>
</div>
	<h2 id="center">Trailers</h2>
	 <div id="dynamicContent">

	 </div>
 </div>

</body>
</html>
