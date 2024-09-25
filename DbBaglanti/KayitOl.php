<?php 

include "../DbBaglanti/baglanti.php"; 
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

<link rel="stylesheet" href="../CSS/giris.css" type="text/css">
<link rel="shortcut icon" type="image/x-icon" href="KouLogo.png">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<head>
	<title>Kayit Ol</title>
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
						<img src="../KouLogo.png" class="brand_logo" alt="Logo"> <br><br> <a>Öğrenci</a>
					</div>
				</div>
				
				<div class="d-flex justify-content-center form_container">
					<form method="POST" action="#">
						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="text" name="name1" class="form-control input_user" value="" placeholder="İsim Soyisim">
						</div>
						<div class="input-group mb-2">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="text" name="sifre1" class="form-control input_pass" value="" placeholder="Şifreniz">
						</div>
						<div class="form-group">
							<div class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" id="customControlInline">
								<label class="custom-control-label" for="customControlInline">Kullanım Sözleşmesi</label>
							</div>
						</div>
						<div class="d-flex justify-content-center mt-3 login_container">
							<input type="submit" name="ekle1" valu="Ekle" class="btn login_btn">
						</div>
					</form>
				</div>
			</div>
			
			<div class="user_card">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container">
						<img src="../KouLogo.png" class="brand_logo" alt="Logo"> <br><br> <a>Öğretmen</a>
					</div>
				</div>
				<div class="d-flex justify-content-center form_container">
					
					<form method="POST" action="#">
						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="text" name="name2" class="form-control input_user" value="" placeholder="isim Soyisim">
						</div>
						<div class="input-group mb-2">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="text" name="sifre2" class="form-control input_pass" value="" placeholder="Şifreniz">
						</div>
						<div class="form-group">
							<div class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" id="customControlInline2">
								<label class="custom-control-label" for="customControlInline2">Kullanım Sözleşmesi</label>
							</div>
						</div>
						<div class="d-flex justify-content-center mt-3 login_container">
							<input type="submit" name="ekle2" value="Ekle" class="btn login_btn">
						</div>
					</form>
					
				</div>
			</div>
		</div>
	</div>
	
<?php 
	if(isset($_POST["ekle1"])){
		/* database'e ekleme işlemi yapılıyor execute alınan verileri database aktarıyor*/
		$ekle1 = $db->prepare("insert into ogrenci set
		adSoyad=:adSoyad1,
		sifre=:sifre1
		");
		/*kontrol ile alt kısımda bulunan ifin içerisine gönderdik ekleye execute işlemi yaptık
		"adSoyad"=>$_POST["name"],    sağ satırdaki name ekleme formundaki inputtan veriyi alıyor 
		"sifre"=>$_POST["sifre"]      sağ da adSoyad değişkenine atıyor buda üst de bulunan prepare içine gönderiliyor sağdaki adSoyad oluyor*/
		$kontrol1 = $ekle1->execute(array(
		"adSoyad1"=>$_POST["name1"],
		"sifre1"=>$_POST["sifre1"]
		));
		
		//işlem bittiğinde alt kısımda bulunan kontrol işlemi gerçeleşiyor bu işlem doğruysa if'in içerisine girerek header içerisindeki locasyona gönderme oluyor böylece sayfa otomatik güncelleniyor
		
		if($kontrol1){
			header("Location: ../index.php");
			exit;
		}
	}

?>

<?php 
	if(isset($_POST["ekle2"])){
		/* database'e ekleme işlemi yapılıyor execute alınan verileri database aktarıyor*/
		$ekle2 = $db->prepare("insert into ogretmen set
		adSoyad=:adSoyad2,
		sifre=:sifre2
		");
		/*kontrol ile alt kısımda bulunan ifin içerisine gönderdik ekleye execute işlemi yaptık
		"adSoyad"=>$_POST["name"],    sağ satırdaki name ekleme formundaki inputtan veriyi alıyor 
		"sifre"=>$_POST["sifre"]      sağ da adSoyad değişkenine atıyor buda üst de bulunan prepare içine gönderiliyor sağdaki adSoyad oluyor*/
		$kontrol2 = $ekle2->execute(array(
		"adSoyad2"=>$_POST["name2"],
		"sifre2"=>$_POST["sifre2"]
		));
		
		//işlem bittiğinde alt kısımda bulunan kontrol işlemi gerçeleşiyor bu işlem doğruysa if'in içerisine girerek header içerisindeki locasyona gönderme oluyor böylece sayfa otomatik güncelleniyor
		
		if($kontrol2){
			header("Location: ../index.php");
			exit;
		}
	}

?>
	
</body>
</html>
