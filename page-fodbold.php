<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package OceanWP WordPress theme
 */

get_header(); ?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">


	<template>
<article>
		
	
		
		
    <div class="grid">

	<!-- Knap på fodbold side -->

<!-- Fodbold side -->
	

	
<h2 class="holdtype"></h2>	
<div class="tilmeld">

	<button>TILMELD</button>
</div>

		
	
		<h3 class="h3_1"></h3>

		<div class="gruppe1">
		<img class="logo1" src="" alt="">
		<p class="tekst1"></p>
		</div>

		
		<h3 class="h3_2"></h3>

		<div class="gruppe2">
			<img class="logo2" src="" alt="">
		<p class="tekst2"></p>
		</div>	

		
		<h3 class="h3_3"></h3>

		<div class="gruppe3">
		<img class="logo3" src="" alt="">
		<p class="tekst3"></p>
		<!--  -->
		
</div>



    </div>
</article>
</template>
<div class="tilmeld_boks"></div>



<main id="site-content">
	<h1 class="h1_fodbold">Fodbold</h1>
	<h2 class="h2_fodbold">Indmeldelse</h2>
<nav id="filtrering"><button class="filter valgt" data-fodbold="alle">Alle</button></nav>

	<section class="nbucontainer">
    </section>
	<script>

		let fodbold;
		let holdtype;
		let filterFodbold = "alle";

		const url = "https://dnygaard.dk/kea/09_CMS/nbu/wordpress/wp-json/wp/v2/fodboldhold?per_page=100";
		const catUrl = "https://dnygaard.dk/kea/09_CMS/nbu/wordpress/wp-json/wp/v2/holdtype";
		

		async function getJson() {	
			const response = await fetch(url);
			const catdata = await fetch(catUrl);
			fodbold = await response.json()
			holdtype = await catdata.json()
			console.log("Fodbold", fodbold);
			console.log("Holdtype", holdtype);
			visFodbold();
			opretknapper();
		}

			// Opret knapper
			function opretknapper () {
			holdtype.forEach(cat => {
			document.querySelector("#filtrering").innerHTML += `<button class="filter" data-fodbold="${cat.id}">${cat.name}</button>`
			})

			addEventListenersToButtons();
		
		}
		// click funktion på knapper 
		function addEventListenersToButtons() {
			document.querySelectorAll("#filtrering button").forEach(elm =>{
				elm.addEventListener("click", filtrering);
			})
		};


		function filtrering(){
			filterFodbold = this.dataset.fodbold;
			document.querySelectorAll("#filtrering button").forEach(elm =>{
				elm.classList.remove("valgt");
			})
        this.classList.add("valgt");
			console.log(filterFodbold);
			visFodbold();
		}

		function visFodbold() {
			console.log(Fodbold)
		}


		function visFodbold() {
			let temp = document.querySelector("template");
			let container = document.querySelector(".nbucontainer")
			container.innerHTML = "";
			fodbold.forEach(fodbold => {
				if ( filterFodbold == "alle" || fodbold.holdtype.includes(parseInt(filterFodbold))){
				let klon = temp.cloneNode(true).content;

				
				klon.querySelector(".holdtype").innerHTML = fodbold.holdtyper;

				klon.querySelector(".h3_1").innerHTML = fodbold.om_traening;
				klon.querySelector(".tekst1").innerHTML = fodbold.tekst1;
				klon.querySelector(".logo1").src = fodbold.logo1.guid;

				klon.querySelector(".h3_2").innerHTML = fodbold.kontigent;
				klon.querySelector(".tekst2").innerHTML = fodbold.tekst2;
				klon.querySelector(".logo2").src = fodbold.logo2.guid;
				
				
				klon.querySelector(".h3_3").innerHTML = fodbold.vigtig_info;
				klon.querySelector(".tekst3").innerHTML = fodbold.tekst3;
				klon.querySelector(".logo3").src = fodbold.logo3.guid;

				// const button = document.querySelector('.button');
				container.appendChild(klon);
				}
			})
		}

		getJson();

	</script>


			</div><!-- #content -->

			<?php do_action( 'ocean_after_content' ); ?>

		</div><!-- #primary -->

		<?php do_action( 'ocean_after_primary' ); ?>

	</div><!-- #content-wrap -->

	<?php do_action( 'ocean_after_content_wrap' ); ?>

<?php get_footer(); ?>
