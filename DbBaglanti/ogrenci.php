<?php 

include "baglanti.php"; 
//baglanti.php içinde yazılan veriler buraya çekiyor
//amaç baglanti.php de database e bağlandık bu bağlantıyı buraya aktarıyoruz ki her seferinde tekrar tekrar yazmak zorunda kalmayalım

//veri adresini alıyoruz
$sorguOg = $db->prepare("select * from ogrenci"); 
$sorguOg->execute();

$sorguHo = $db->prepare("select * from ogretmen"); 
$sorguHo->execute();

?>
<?php 
if(isset($_POST["gonder"])){
	
	
$maxBoyut = 50000000;
$dosyaUzantisi = substr($_FILES["dosya"]["name"],-4,4);
$dosyaAdi = $_POST["kulgirno"].$dosyaUzantisi;
$dosyaYolu = "../resimler/".$dosyaAdi;

	
	$tarihYI = $_POST["tarih1"];
	$tarihYS = $_POST["tarih2"];
	
	$tarih1 = strtotime($_POST["tarih1"]);
	$tarih2 = strtotime($_POST["tarih2"]);
	$fark = $tarih2 - $tarih1;
	$gun = floor($fark / (60 * 60 * 24)) + 1;
	
	$tarihTatil = array("2022-10-28","2022-11-10","2023-04-20","2023-04-21","2023-05-01","2023-05-19","2023-06-27","2023-06-28","2023-06-29","2023-06-30","2023-11-10");
	$tatil = 0;
					
	while($satir = $sorguOg->fetch(PDO::FETCH_ASSOC)) {
	
		if($_POST["kulgirno"] == $satir["ogrenciNo"]){
			while($tarihYI != $tarihYS){
				for ($i = 0; $i <= 10; $i++){
					if($tarihYI == $tarihTatil[$i]){
						$tatil = $tatil + 1;
					}
				}
				$tarihYI = date("Y-m-d", strtotime("+1 day", strtotime("$tarihYI")));
			}
			$gun = $gun-((intval($gun/7))*2);
			$gun = $gun - $tatil;
			
			if(30 <= $gun){
				if($_FILES["dosya"]["size"] > $maxBoyut){ //boyut kontrol ettik
					$msg="Dosya Boyutu en fazla <b>500kb</b> olabilir";
					echo "<script type='text/javascript'>alert('$msg');</script>";
				}else{
					$d=$_FILES["dosya"]["type"];
					if($d == "image/jpeg" || $d == "image/png" || $d == "image/gif"){ //türünün doğrumu onu kontrol ettik
				
						if(is_uploaded_file($_FILES["dosya"]["tmp_name"])){
			
							$tasi = move_uploaded_file($_FILES["dosya"]["tmp_name"],$dosyaYolu);
							if($tasi){
								$msg="adlı dosya başarı ile yüklendi";
								echo "<script type='text/javascript'>alert('$msg');</script>";
								
								
								
								$ekle = $db->prepare("insert into staj set
									stajNo=:stajNo,
									konu=:konu,
									sTarih=:sTarih,
									fTarih=:fTarih
								");
								
								$kontrol = $ekle->execute(array(
									"stajNo"=>$_POST["kulgirno"],
									"konu"=>$_POST["mesaj"],
									"sTarih"=>$_POST["tarih1"],
									"fTarih" => $_POST["tarih2"]
								));
								
								if($kontrol){
									header("Location:../ogrenci.php");
									exit;
								}
								
								
								
								
								/* mesajları ekliyecekmisin 
								$ekle = $db->prepare("insert into mesajlar set
									mesaj=:mesaj,
									alan=:alan,
									gonderen=:gonderen
								");
								
								$kontrol = $ekle->execute(array(
									"mesaj"=>$_POST["mesaj"],
									"gonderen"=>$_POST["kulgirno"],
								));
								
								if($kontrol){
									header("Location:index.php");
									exit;
								}*/
								
							}else{
								$msg="dosya taşınırken bir sorun oluştu";
								echo "<script type='text/javascript'>alert('$msg');</script>";
							}
						}else{
							$msg="Dosya Yüklenirken bir sorun oluştu";
							echo "<script type='text/javascript'>alert('$msg');</script>";
						}
					}else {
						$msg="dosya formatı <b>Gif, PNG, Jpeg </b> olmalı";
						echo "<script type='text/javascript'>alert('$msg');</script>";
					}
				}
			}
			else{
				$msg="çalışma gün sayınız 30 günden az bulunmakta";
				echo "<script type='text/javascript'>alert('$msg');</script>";
			}
		}
	}
}




if(isset($_POST["Hesapla"])){
	$tarihYI = $_POST["tarih1"];
	$tarihYS = $_POST["tarih2"];
	
	$tarih1 = strtotime($_POST["tarih1"]);
	$tarih2 = strtotime($_POST["tarih2"]);
	$fark = $tarih2 - $tarih1;
	$gun = floor($fark / (60 * 60 * 24)) + 1;
	
	$tarihTatil = array("2022-10-28","2022-11-10","2023-04-20","2023-04-21","2023-05-01","2023-05-19","2023-06-27","2023-06-28","2023-06-29","2023-06-30","2023-11-10");
	$tatil = 0;
	
	echo "$tarihYI <br> $tarihYS <br><br>"; 
	
	while($tarihYI != $tarihYS){
		for ($i = 0; $i <= 10; $i++){
			if($tarihYI == $tarihTatil[$i]){
				echo $tarihYI . " tarihi özel gün";
				$tatil = $tatil + 1;
			}
		}
		$tarihYI = date("Y-m-d", strtotime("+1 day", strtotime("$tarihYI")));
	}
	
	echo "<br><br><br>";
	echo "$gun Toplam gün <br>"; 
	
	$gun = $gun-((intval($gun/7))*2);
	$gun = $gun - $tatil;
	
	echo "$gun   gün çalışacak<br>";
	
	echo "<br><br><br>";
	
}
?>