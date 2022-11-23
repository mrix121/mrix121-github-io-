<html>

<head>

	<title>GymParty</title>
	<link rel="stylesheet" href="stylebut.css" type="text/css">
	<link rel="stylesheet" href="ach.css" type="text/css">
	
</head>


<body>
	<form action="" method="post">
		<ul class="push">
			<?php

			$login = $_POST['login'];
			$password = $_POST['password'];
			$email;

			if (!$login || !$password) {
				echo '<h2>Введите логин и пароль! </h2></br>';
				exit;
			}

			$mysql = mysqli_connect('localhost', 'root', 'root');
			mysqli_select_db($mysql, 'akatsuki');

			if (mysqli_errno($mysql)) {
				echo 'Ошибка: He удалось установить соединение с базой данных.';
				exit;
			}

			$result1 = mysqli_query($mysql, "select * from login_password where login = '$login' and password = '$password'");
			$row = mysqli_fetch_row($result1);
			$email = mysqli_query($mysql, "select email from customers where customerid = '$row[0]' ");
			$email = mysqli_fetch_row($email);

			if ($row[0] <= 0) {
				echo '<h2>Логин и пароль неверны!</h2>';
				exit;
			} else {
				if ($login == '111' && $password == 123) {
					echo "<h1 style=\"position: relative;text-align: center; color: #a6ccf5\">Страница администратора</h1></br></br>";

					if (isset($_POST['okey'])) {

						$result = mysqli_query($mysql, "select * from rpr");

						while ($spisok = mysqli_fetch_row($result)) {
							$param1 = $_POST['name' . $spisok[0] . ''];
							$param2 = $_POST['style' . $spisok[0] . ''];
							$param3 = $_POST['price' . $spisok[0] . ''];
							$param4 = $_POST['duration' . $spisok[0] . ''];
							mysqli_query($mysql, "update rpr set name='$param1',style='$param2',price='$param3',duration='$param4' where idr='$spisok[0]'");

							if ($_POST['opti' . $spisok[0] . ''] != '') {
								mysqli_query($mysql, "delete from rpr where idr='$spisok[0]'");
							}
						}
						if ($_POST['optima'] != '') {
							$snus = $_POST['nm'];
							$snus1 = $_POST['st'];
							$snus2 = $_POST['pr'];
							$snus3 = $_POST['dur'];
							mysqli_query($mysql, "insert into rpr values(null,'$snus','$snu1','$snus2','$snus3')");
						}
					}
					echo '<a href="Главная.html" class="double-border-button">На главную страницу</a></br>';

					$result = mysqli_query($mysql, "select * from rpr");
					$j = 0;
					$i = 0;
					$arr = array();

					while ($row1 = mysqli_fetch_row($result)) {
						$arr[] = 'delete.php?idord=' . ($row1[0]);

						echo "<li style='color: #a6ccf5'>
					Название мероприятия: 	 <br><input name='name" . $row1[0] . "' type='text' value='$row1[1]'><br>
				
					Цена:     	 <br><input name='price" . $row1[0] . "' type='text' value='$row1[3]'><br>
					Длительность:<br><input name='duration" . $row1[0] . "' type='text' value='$row1[4]'></li>";

						$j = $j + 1;
						echo "<p style='color: white;'><input type='checkbox' name='opti" . $row1[0] . "'>Удалить</p>";
					}


					echo "<hr><p style='color: white;'><input type='checkbox' name='optima'>Добавить новый номер</p>";

					echo "<p style='color: white'>Название</p>";
					echo "<input name='nm' type='text'>";

					echo "<p style='color: white'>Цена</p>";
					echo "<input name='pr' type='text'>";

					echo "<p style='color: white'>Длительность</p>";
					echo "<input name='dur' type='text'>";


					echo "<hr><br><input name=\"okey\" type=\"submit\" value=\"Подтвердить изменения\">";
				} 
				else if ($login == '777' && $password == 777) {
					?>
				
				


					
					<?
				} else {
					$jija = 'subs.php?email=' . ($email[0]);
					$feedb = 'feedback.php?email=' . ($email[0]);
					$pdf_us = 'pdf_gen.php?email=' . ($email[0]);
					$chart = 'diagrams.php?email=' . ($email[0]);
					setcookie('email', $email[0]);
					setcookie('login', $login);
					setcookie('password', $password);
					echo "<h1 style=\"position: relative;text-align: center; color: #a6ccf5\">Записи</h1></br></br>";
					echo '<a href="Главная.html" class="double-border-button">На главную страницу</a></br><br>';


					$result = mysqli_query($mysql, "select * from rpr");
					$j = 0;
					$i = 0;
					$arr = array();

					while ($row1 = mysqli_fetch_row($result)) {
						$arr[] = 'delete.php?idord=' . ($row1[0]);
						echo "<li style='color: #a6ccf5'>Номер заказа: $row1[0]<br>Название: $row1[1]<br>Фамилия и имя: $row1[2]<br>Почта: $row1[4]<br><br>
					</li>";
						
						$j = $j + 1;
					}
				}
			}
			echo "<input type=\"text\" style=\"display: none\" name=\"login\" value=\"$login\">
	<input type=\"text\" style=\"display: none\" name=\"password\" value=\"$password\">";

			?>
		</ul>
	</form>
</body>

</html>