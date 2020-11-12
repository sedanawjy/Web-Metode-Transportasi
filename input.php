<!DOCTYPE HTML>
<html>

<head>
  <title>RO Metode Transportasi</title>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=windows-1252" />
  <link rel="stylesheet" type="text/css" href="style/style.css" />
</head>

<body>
  <div id="main">
    <div id="header">
      <div id="logo">
        <div id="logo_text">
          <!-- class="logo_colour", allows you to change the colour of the text -->
          <h1><a href="index.html">Sedana_Wi<span class="logo_colour">jaya</span></a></h1>
          <h2>Website hitung biaya optimal transportasi.</h2>
        </div>
      </div>
      <div id="menubar">
        <ul id="menu">
          <!-- put class="selected" in the li tag for the selected page - to highlight which page you're on -->
          <li class="selected"><a href="index.html">Home</a></li>
          <li ><a href="start.html">Ayo Mulai !</a></li>
        </ul>
      </div>
    </div>
    <div id="site_content">
      <div class="sidebar">
        <h1>Biodata Diri</h1>
        <h4 align="center">I Putu Sedana Wijaya</h4>
        <h4 align="center">Mahasiswa Informatika </h4>
        <h4 align="center">NIM 1808561034</h4>
        <h5>Belajar bersama!</h5>
        <p>Hai! Kenalin aku jaya salah satu mahasiswa Universitas Udayana. Website ini aku buat untuk memenuhi tugas final mata kuliah riset operasi..<br /><a href="#">Read more</a></p>


      </div>
      <div id="content">
        <form name="input" action="output.php" method="POST"> 
<?php
	if(isset($_POST['hitung'])){
		session_start();
		$permintaan = $_POST['permintaan'];
		$penawaran = $_POST['penawaran'];
		$x = $_POST['distributor'];
		$y = $_POST['toko'];
		$_SESSION['distributor'] = $x;
		$_SESSION['toko'] = $y;
		$_SESSION['permintaan'] = $permintaan;
		$_SESSION['penawaran'] = $penawaran;		
		echo"<div algin='center'>";
		echo"<h1>Tabel Data Transportasi:</h1>";
		echo"<table cellpadding='5' border='5'>";
		echo"<tr align='center'>";
			echo "<td>Keterangan</td>";
			$z=0;
			for($i=0; $i<$y; $i++){
				$z += 1;
				echo "<td>Toko $z</td>";				
			}
			echo "<td>Penawaran ke-</td>";
		echo"</tr>";
		$z = 0;
		for($i=0; $i<$x; $i++)
		{
			$z += 1;
			echo "<tr align='center'>";
				echo "<td>Distributor $z</td>";
			for($j=0; $j<$y; $j++)
			{
				echo "<td>","[",$i+1,"]","[",$j+1,"]","</td>";
			}
				echo "<td>$z</td>";
			echo"</tr>";
		}
		echo "<tr align='center'>";
		echo "<td>Permintaan ke-</td>";
		$z=0;
		for($i=0; $i<$y; $i++)
		{
			$z += 1;
			echo "<td>$z</td>";
		}
		if($permintaan>$penawaran){
			echo "<td>Total: $permintaan</td>";
		}else{
			echo "<td>Total: $penawaran</td>";
		}
		echo"</tr>";
		echo"</table>";
		echo"</div>";
		echo"<p>Isi form sesuai pada contoh tabel:</p>";

// PERMINTAAN > PENAWARAN
		if($permintaan > $penawaran){
			?><table border="0" align="center"><?php
			$x = $x + 1;
			$tawar[$x-1]=$permintaan - $penawaran;

			for($i=0; $i<$x-1; $i++){
			?>
            	<tr><td>Penawaran <?php echo $i+1; ?>:</td><td><input type="number" name="tawar[]" size="10"/></td></tr>
            <?php
            }
            for($i=0; $i<$y; $i++){
			?> 
           		<tr><td>Permintaan <?php echo $i+1; ?>:</td><td><input type="number" name="minta[]" size="10"/></td></tr>
           	<?php
			}
			for($i=0; $i<$x-1; $i++){
				for($j=0; $j<$y; $j++){
				?>
            	<tr><td>Biaya <?php echo "[",$i+1,"] ","[",$j+1,"]"; ?>:</td><td><input type="number" name="nilai[]" size="10"/></td></tr>
            <?php
				}
			}
			?></table><?php

//PERMINTAAN < PENAWARAN
		}else if($permintaan < $penawaran){
			?><table border="0" align="center"><?php
			$y = $y + 1;
			$tawar[$y-1]=$penawaran - $permintaan;
			for($i=0; $i<$x; $i++){
			?>
            	<tr><td>Penawaran <?php echo $i+1; ?>:</td><td><input type="number" name="tawar[]" size="10"/></td></tr>
            <?php
            }
            for($i=0; $i<$y-1; $i++){
			?> 
           		<tr><td>Permintaan <?php echo $i+1; ?>:</td><td><input type="number" name="minta[]" size="10"/></td></tr>
           	<?php
			}
			for($i=0; $i<$x; $i++){
				for($j=0; $j<$y-1; $j++){
				?>
            	<tr><td>Biaya <?php echo "[",$i+1,"] ","[",$j+1,"]"; ?>:</td><td><input type="number" name="nilai[]" size="10"/></td></tr>
            <?php
				}
			}
			?></table><?php

//PERMINTAAN == PENAWARAN
		}else{
			?><table border="0" align="center"><?php
			for($i=0; $i<$x; $i++){
			?>
            	<tr><td>Penawaran <?php echo $i+1; ?>:</td><td><input type="number" name="tawar[]" size="10"/></td></tr>
            <?php
            }
            for($i=0; $i<$y; $i++){
			?> 
           		<tr><td>Permintaan <?php echo $i+1; ?>:</td><td><input type="number" name="minta[]" size="10"/></td></tr>
           	<?php
			}
			for($i=0; $i<$x; $i++){
				for($j=0; $j<$y; $j++){
				?>
            	<tr><td>Biaya <?php echo "[",$i+1,"] ","[",$j+1,"]"; ?>:</td><td><input type="number" name="nilai[]" size="10"/></td></tr>
            <?php
				}
			}
			?></table>
			<tr><td></td><td><input type="submit" Value="Submit" align="right" name="submit2"><input type="reset" Value="Clear" ></td></tr><?php
		}
	}//end isset
	else{
		echo"<h2><b>Anda Belum Memulai Proses!!!<br>Klik disini untuk memulai =>";
		?>
		<a href="start.html">Ayo Mulai !</a></h1>
		<?php
		echo "</b></h2>";
	}
		?>

        </form>
      </div>
    </div>

    <div id="footer">
      <p><a href="index.html">Home</a> | <a href="start.html">Hitung</a>
    </div>
  </div>
</body>
</html>
