<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!Doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>Login</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:whgt@300;400;500;600;700;800;900&display=swap">
	<style>
		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
			font-family: 'Poppins', sans-serif;
		}

		body {
			display: flex;
			justify-content: center;
			align-items: center;
			min-height: 100vh;
			background: grey;
		}

		.box {
			position: relative;
			width: 380px;
			height: 420px;
			background: blue;
			border-radius: 8px;
			overflow: hidden;

		}

		.box::after {
			content: '';
			position: absolute;
			top: -50%;
			left: -50%;
			width: 380px;
			height: 420px;
			background: linear-gradient(0deg, white, white, red, red, green);
			z-index: 1;
			transform-origin: bottom right;
			animation: animate 6s linear infinite;
			animation-delay: -3s;
		}


		.box form {
			position: absolute;
			inset: 4px;
			background: white;
			padding: 50px 40px;
			border-radius: 8px;
			z-index: 2;
			display: flex;
			flex-direction: column;
		}

		.box form h2 {
			color: black;
			font-weight: 500;
			text-align: center;
			letter-spacing: 0.1em;
		}

		.box form .inputBox {
			position: relative;
			width: 300px;
			margin-top: 35px;

		}

		.box form .inputBox input {
			position: relative;
			width: 100%;
			padding: 20px 10px 10px;
			background: transparent;
			outline: none;
			border: none;
			box-shadow: none;
			color: black;
			font-size: 1em;
			letter-spacing: 0.05em;
			transition: 0.5s;
			z-index: 10;

		}

		.box form .inputBox span {
			position: absolute;
			left: 0;
			padding: 20px 0px 10px;
			pointer-events: none;
			color: black;
			font-size: 1em;
			letter-spacing: 0.05em;
			transition: 0.5s;


		}

		.box form .inputBox input:valid~span,
		.box form .inputBox input:valid~span {
			color: #fff;
			font-size: 0.75em;
			transform: translateY(-34px);


		}

		.box form .inputBox i {
			position: absolute;
			left: 0;
			width: 100%;
			height: 2px;
			background: blue;
			overflow: hidden;
			transition: 0.5s;
			pointer-events: none;

		}

		.box form .inputBox input:valid~i,
		.box form .inputBox input:valid~i {
			height: 44px;

		}

		.box form.links {
			display: flex;
			justify-content: space-between;

		}

		.box form.links a {
			margin: 10px 0;
			font-size: 0.75em;
			color: #8f8f8f;
			text-decoration: none;

		}

		.box form.links a:hover,
		.box form.links a:nth-child(2) {
			color: #fff;

		}

		.box form input[type="submit"] {
			border: none;
			outline: none;
			padding: 9px 25px;
			background: #fff;
			cursor: pointer;
			font-size: 0.9em;
			border-radius: 4px;
			font-weight: 600;
			width: 100px;
			margin-top: 10px;

		}

		.box form input[type="submit"]:active {
			opacity: 0.8;

		}

		button {
			align-items: center;
			background-color: #0ea5e9;
			/* Couleur verte solide */
			border: 0;
			border-radius: 8px;
			box-shadow: rgba(0, 0, 0, 0.2) 0 15px 30px -5px;
			/* Ajuster pour correspondre à la couleur */
			box-sizing: border-box;
			color: #FFFFFF;
			display: flex;
			font-family: Phantomsans, sans-serif;
			font-size: 18px;
			justify-content: center;
			line-height: 1em;
			max-width: 100%;
			min-width: 140px;
			padding: 10px 20px;
			/* Ajusté pour plus de clicabilité */
			text-decoration: none;
			user-select: none;
			-webkit-user-select: none;
			touch-action: manipulation;
			white-space: nowrap;
			cursor: pointer;
			transition: background-color .3s, box-shadow .3s;
		}

		button:hover {
			background-color: #0ea5e9;
			/* Couleur verte plus foncée pour le survol */
			box-shadow: rgba(0, 0, 0, 0.3) 0 15px 30px -5px;
			/* Ombre plus prononcée au survol */
		}

		button:active {
			background-color: #1d4ed8;
			/* Couleur verte encore plus foncée lorsqu'on clique */
			transform: scale(0.98);
			/* Effet de compression au clic */
		}



		button span {
			background-color: rgb(5, 6, 45);
			padding: 16px 24px;
			border-radius: 6px;
			width: 100%;
			height: 100%;
			transition: 300ms;
		}

		button:hover span {
			background: none;
		}

		button:active {
			transform: scale(0.9);
		}

		/* style pour le message d'erreure */
		.error_string {
			color: red;
		}
	</style>
</head>

<body>
	<div class="box">

		<?php

		echo form_open('Main/login_action');
		?>
		<h2>E-trait FG</h2>

		<div class="inputBox">
			<input type="text" required="required" name="username">
			<span>Utilisateur</span>
			<i></i>
		</div>
		<div class="inputBox">
			<input type="password" required="required" name="password">
			<span>Mot de passe</span>
			<i></i>
		</div>
		<br>
		<button type="submit" value="Login" class="">
			Login
		</button>


		<?php
		echo validation_errors('<div class="error_string">', '</div>');
		echo form_close();
		?>
	</div>
</body>

</html>
