<!DOCTYPE html>
<html>
<head>
	<title>
		HOME
	</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="index.css">
	<style type="text/css">
		.mySlides {display: none;}
		img {vertical-align: middle;}

		/* Slideshow container */
		.slideshow-container {
		  max-width: 2000px;
		  position: relative;
		  margin: auto;
		}
		* {box-sizing: border-box;}
		.numbertext {
		  color: #f2f2f2;
		  font-size: 12px;
		  padding: 8px 12px;
		  position: absolute;
		  top: 0;
		}
		.dot {
			  height: 15px;
			  width: 15px;
			  margin: 0 2px;
			  background-color: #bbb;
			  border-radius: 30%;
			  display: inline-block;
			  transition: background-color 0.6s ease;
			}

			.active {
			  background-color: #717171;
			}

			/* Fading animation */
			.fade {
			  -webkit-animation-name: fade;
			  -webkit-animation-duration: 1.5s;
			  animation-name: fade;
			  animation-duration: 1.5s;
			}

			@-webkit-keyframes fade {
			  from {opacity: .4} 
			  to {opacity: 1}
			}

			@keyframes fade {
			  from {opacity: .4} 
			  to {opacity: 1}
			}
			.flex-container {
  display: flex;
  background-color: #009999;
  justify-content:space-around;
  flex-wrap:wrap;
}
.aaa{
font-weight:bolder;
color: #009999;
font-size:25px;
}

.bb{
font-weight:500;
color:#cc0000;
font-size:18px;
}

.cc{
font-weight:200;
}

.dd{
font-weight:800;
color:#0000ff;
font-size:22px;
}
.flex-container > div {
  background-color: #f1f1f1;
  margin: 20px;
  padding: 20px;
  height: 200px;
  width: 350px;
  
}
	</style>
</head>
<body>
	<?php
		include 'nav.php';
	?>

	<div class="slideshow-container">
		<div class="mySlides fade">
		  <div class="numbertext">1 / 3</div>
		  <img src="img44.jpg" style="width:100%">
		  <div class="text">WICKETS</div>
		</div>

		<div class="mySlides fade">
		  <div class="numbertext">2 / 3</div>
		  <img src="img22.jpg" style="width:100%">
		  <div class="text">VIRAT & ROHIT</div>
		</div>

		<div class="mySlides fade">
		  <div class="numbertext">3 / 3</div>
		  <img src="img33.jpg" style="width:100%">
		  <div class="text">BATTING</div>
		</div>
	</div>
	<br>
	<div style="text-align:center">
	  <span class="dot"></span> 
	  <span class="dot"></span> 
	  <span class="dot"></span> 
	</div>
	<br>
	<br>
<!--	<div class="flex-container">
  <div>
	  <div class="aaa">CSE vs ECE</div>
	  <div class="bb">CSE 156-7(20)</div>
	  <div class="bb">ECE 85-4(17)</div>
	  <div class="cc">CSE won the toss and choose to bat</div>
	  </div>
	  <div>
	  <div class="aaa">MECH vs CIVIL</div>
	  <div class="bb">MECH 116-5(20)</div>
	  <div class="bb">ECE 104-4(18)</div>
	  <div class="cc">MECH won the toss and choose to ball</div>
	  </div>
	  <div>
	  <div class="aaa">MME vs CHEM</div>
	  <div class="bb">CHEM 178-6(20)</div>
	  <div class="bb">MME 175-7(20)</div>
	  <div class="cc">CHEM won the toss and choose to bat</div>
	  <div class="dd">CHEM won by 3 runs </div>
	  </div>-->
	   
	</div>
	<center><button id="button"><a href="liveorschedule.php" class="create"> CREATE MATCH </a></button></center>

	<br>

	<script type="text/javascript">
		var slideIndex = 0;
		showSlides();

		function showSlides() {
		  var i;
		  var slides = document.getElementsByClassName("mySlides");
		  var dots = document.getElementsByClassName("dot");
		  for (i = 0; i < slides.length; i++) {
		    slides[i].style.display = "none";  
		  }
		  slideIndex++;
		  if (slideIndex > slides.length) {slideIndex = 1}    
		  for (i = 0; i < dots.length; i++) {
		    dots[i].className = dots[i].className.replace(" active", "");
		  }
		  slides[slideIndex-1].style.display = "block";  
		  dots[slideIndex-1].className += " active";
		  setTimeout(showSlides, 4000); // Change image every 4 seconds
		}
	</script>
</body>
</html>