<header>
		<nav class="logo">
			<a href="index.php"><img src="images/logo-dare.png"></a>
			<a href="inscription.php" class="inscription"><input type="button" value="Inscription" ></a>
			<?php if($connected){ ?>
			<a href="libs/deconnexion.php" class="inscription"><input type="button" value="Déconnexion"></a>
			<?php } else{ ?>
			<a href="connexion.php" class="inscription"><input type="button" value="Connexion"></a>
			<?php }?>
		</nav>
		<nav class="nav-header">
			<ul>
				<li><a href="#">Programmation</a></li>
				<li><a href="#">Algorithme</a></li>
				<li><a href="#">Support de Cours</a></li>
				<li><a href="dashboard.php">Votre tableau de board</a></li>
			</ul>
		</nav>
</header>