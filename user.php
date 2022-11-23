<?php 
require "db.php";
$data = $_POST;

if($_GET['id'] == ''){
	header('Location: /user?id='.$_SESSION['logged_user']->id);
}

if($_GET['id'] == $_SESSION['logged_user']->id){
	$position = 'access' ; 
}
else{
	$position = 'view'; 
}

$user = R::findOne('users', 'id = ?', array($_GET['id'])); 
if(isset($data['send_post'])){
	$post = $data['post'];
	if($post){
		$db_post = R::dispense('posts');
		$db_post->id_user = $_SESSION['logged_user']->id;
		$db_post->post = $post;
		$db_post->ip = $_SERVER['REMOTE_ADDR'];
		$db_post->d_date_reg = date("d");
		$db_post->m_date_reg = date("m");
		$db_post->y_date_reg = date("y");
		$db_post->h_time_reg = date("h");
		$db_post->m_time_reg = date("i");
		R::store($db_post);
	}
}


$all_post = R::findAll('posts');
$user_posts = array();

foreach ($all_post as $row) {
	if ($row['id_user'] == $_GET['id']) {
		$user_posts[] = $row;
	}
}


?>




<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<link rel="stylesheet" type="text/css" href="assets/css/style1.css">
	<title>Profile</title>
</head>
<body>
	<div id="wrapper">
		<header class="header">
			<div class="container">
				
				<div class="header__inner">
					<div class="header__logo">
						NetFace <!-- Решил дать такое название социальной сети. Переводится вроде как сетевое лицо -->
					</div>


					<nav class="nav" id="menu">
						<div class="nav__close" id="close"></div>
						<a href="#" class="nav__link">profile</a>
						<a href="/logout.php" class="nav__link">log out</a>
					</nav>

					<div class="burger__menu" id="burger"></div>
				</div>


			</div>
		</header>

		<main class="main">
			<div class="profile">
				<div class="container">

					<div class="profile__inner">
						<div class="profile__photo">
							
						</div>
						<div class="profile__fio">
							<?php echo $user->firsname.' '.$user->lastname; ?>
							<?php if($position == 'view') : ?>
							<div class="profile__btn">
								<button type="submit" class="profile__button">Написать сообщение</button>
								<button type="submit" class="profile__button">Добавить в друзья</button>
							</div>
						<?php else : ?>
						<?php endif; ?>	
						</div>
					</div>

				</div>
			</div>

			 <div class="profile__input">
			 	<form action="/user?id= <?php echo $_GET['id?1'];?>" method="POST">
			 		<input type="text" name="post" placeholder="Введите сообщение">
			 		<button type="submit" name="send_post"> Отправить</button>
			 	</form>
			 </div>

			 <?php for ($i=0; $i < count($user_posts); $i++) : ?>

			 <div class="profile__information">
			 	<p><?php echo htmlspecialchars($user_posts[$i]['post']); ?></p>
			 </div>


			<?php endfor; ?>
		</main>


		<footer class="footer">
			<div class="container">
				Copyright 2022
			</div>
		</footer>
	</div>

	<script src="js/app1.js"></script>
</body>
</html>