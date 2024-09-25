<?php 

include "baglanti.php"; 

$sorguOg = $db->prepare("select * from ogrenci"); 
$sorguOg->execute();

$sorguHo = $db->prepare("select * from ogretmen"); 
$sorguHo->execute();

$sorguKo = $db->prepare("select * from komisyon"); 
$sorguKo->execute();

?>
<?php 
				if(isset($_POST["kulgir"])){
					while($satir = $sorguOg->fetch(PDO::FETCH_ASSOC)) {
						if($_POST["kulgirno"] == $satir["ogrenciNo"]){
							if($_POST["kulgirsifre"] == $satir["sifre"]){
								header("Location: ../ogrenci.php");
								exit;
							}
						}
					}
					while($satir = $sorguHo->fetch(PDO::FETCH_ASSOC)) {
						if($_POST["kulgirno"] == $satir["ogretmenNo"]){
							if($_POST["kulgirsifre"] == $satir["sifre"]){
								header("Location: ../ogretmen.php");
								exit;
							}
						}
					}
					while($satir = $sorguKo->fetch(PDO::FETCH_ASSOC)) {
						if($_POST["kulgirno"] == $satir["komisyonNo"]){
							if($_POST["kulgirsifre"] == $satir["sifre"]){
								header("Location: ../komisyon.php");
								exit;
							}
						}
					}
					header ("Location: ../index.php");
					exit;
				}
				?>