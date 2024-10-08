<?php 

include "DbBaglanti/baglanti.php"; 
//baglanti.php içinde yazılan veriler buraya çekiyor
//amaç baglanti.php de database e bağlandık bu bağlantıyı buraya aktarıyoruz ki her seferinde tekrar tekrar yazmak zorunda kalmayalım

//veri adresini alıyoruz
$sorguOg = $db->prepare("select * from ogrenci"); 
$sorguOg->execute();

$sorguHo = $db->prepare("select * from ogretmen"); 
$sorguHo->execute();

?>

<!DOCTYPE html>
<html>

<link rel="stylesheet" href="CSS/giris.css" type="text/css">
<link rel="shortcut icon" type="image/x-icon" href="KouLogo.png">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<head>
	<title>Staj evrak Giriş paneli</title>
	<!-- inputların yanındaki minik anahtar vs. resmi-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous"> 
</head>
<!--Coded with love by Mutiullah Samim-->
<body>
	<div class="container h-100">
		<div class="d-flex justify-content-center h-100">
			<div class="user_card">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container">
						<img src="KouLogo.png" class="brand_logo" alt="Logo">
					</div>
				</div>
				
				<div class="d-flex justify-content-center form_container">
					<form method="POST" action="DbBaglanti/Giris.php">
						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="text" name="kulgirno" class="form-control input_user" value="" placeholder="Kullanıcı Numaranız">
						</div>
						<div class="input-group mb-2">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="password" name="kulgirsifre" class="form-control input_pass" value="" placeholder="Şifreniz">
						</div>
						<div class="form-group">
							<div class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" id="customControlInline">
								<label class="custom-control-label" for="customControlInline">Beni Hatırla</label>
							</div>
						</div>
						<div class="d-flex justify-content-center mt-3 login_container">
							<input type="submit" name="kulgir" valu="Ekle" class="btn login_btn">
						</div>
					</form>
				</div>
				
				
		
				<div class="mt-4">
					<div class="d-flex justify-content-center links">
						Hesabınız yok mu? <a href="DbBaglanti/KayitOl.php" class="ml-2">Kayıt ol</a>
					</div>
					<div class="d-flex justify-content-center links">
						<a href="#">Şifremi unuttum</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	
</body>
</html>
