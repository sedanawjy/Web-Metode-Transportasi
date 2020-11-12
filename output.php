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
<?php
error_reporting(0);
ini_set('display_errors', 0);
	session_start();
	if(isset($_POST['submit2']))
	{
		$x = $_SESSION['distributor'];
		$y = $_SESSION['toko'];
		$permintaan = $_SESSION['permintaan'];
		$penawaran = $_SESSION['penawaran'];
		$tawar = array();
		$minta = array();
		$nilai = array();
		$tawar = $_POST['tawar'];
		$minta = $_POST['minta'];
		$nilai = $_POST['nilai'];
		$nilai = array_map(function($value)
		{
			return intval($value);
		}, $nilai);
		$z = 0;
		for($i=0;$i<$x;$i++)
		{
			for($j=0;$j<$y;$j++)
			{
				$newnilai[$i][$j] = $nilai[$z];
				$z = $z + 1;
			}
		}
		echo"<div align='center'>";
		echo"<h1 align='center'>Tabel Solusi Awal menggunakan <br> metode NWC (North West Corner) :</h1>";
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
		$a = 0;
		for($i=0; $i<$x; $i++)
		{
			$z += 1;
			echo "<tr align='center'>";
				echo "<td>Distributor $z</td>";
			for($j=0; $j<$y; $j++)
			{
				echo "<td>",$nilai[$a],"</td>";
				$a += 1;
			}
			$v = $tawar[$i];
				echo "<td>$z : $v</td>";
			echo"</tr>";
		}
		echo "<tr align='center'>";
		echo "<td>Permintaan ke-</td>";
		$z=0;
		for($i=0; $i<$y; $i++)
		{
			$z += 1;
			$v = $minta[$i];
			echo "<td>$z : $v</td>";
		}
		if($permintaan>$penawaran){
			echo "<td>Total: $permintaan</td>";
		}else{
			echo "<td>Total: $penawaran</td>";
		}
		echo"</tr>";
		echo"</table>";
		echo"</div>";

// NORTH WEST CORNER
		$kotak = array();
		$save = 0;
		for($i=0; $i<$x; $i++)
		{
			for($j=0; $j<$y; $j++)
			{
				$kotak[$i][$j]=0;
			}
		}
		for($i=0; $i<$x; $i++)
		{
			$j = $save;
			while($j < $y){
				if($tawar[$i] <= $minta[$j])
				{
					$kotak[$i][$j] = $tawar[$i];
					$minta[$j] = $minta[$j] - $kotak[$i][$j];
					$tawar[$i] = 0;
					break;
				}
				else
				{
					$kotak[$i][$j] = $minta[$j];
					$tawar[$i] = $tawar[$i] - $kotak[$i][$j];
					$minta[$j] = 0;
					$j = $j + 1;
					$save = $j;
				}
			}
		}
		echo"<div align='center'>";
		echo"<h1 align='center'>Tabel Solusi Awal menggunakan <br> metode NWC (North West Corner) :</h1>";
		echo"<table cellpadding='5' border='5'>";
		echo"<tr align='center'>";
			echo "<td>Keterangan</td>";
			$z=0;
			for($i=0; $i<$y; $i++){
				$z += 1;
				echo "<td>Toko $z</td>";				
			}
		echo"</tr>";
		$z = 0;
		for($i=0; $i<$x; $i++)
		{
			$z += 1;
			echo "<tr align='center'>";
				echo "<td>Distributor $z</td>";
			for($j=0; $j<$y; $j++)
			{
				echo "<td>",$kotak[$i][$j],"</td>";
			}
			echo"</tr>";
		}
		echo "<tr align='center'>";
		$z=0;
		for($i=0; $i<$y; $i++)
		{
			$z += 1;
		}
		echo"</tr>";
		echo"</table>";
		echo"</div>";
		$kotakbaru = [];
		foreach($kotak as $key)
		{
			foreach($key as $value)
			{
				$kotakbaru[] = intval($value);
			}
		}
		$newkotak = array();
		$z = 0;
		for($i=0;$i<$x;$i++)
		{
			for($j=0;$j<$y;$j++)
			{
				$newkotak[$i][$j] = $kotakbaru[$z];
				$z = $z + 1;
			}
		}
		echo"<br>";
		$totalbiaya = 0;
		$totaltransport = 0;
		for($i=0; $i<$x; $i++)
		{
			for($j=0; $j<$y; $j++)
			{
				if($newkotak[$i][$j] != 0)
				{
					$biaya = $newkotak[$i][$j]*$newnilai[$i][$j];
					$totalbiaya = $totalbiaya + ($newkotak[$i][$j]*$newnilai[$i][$j]);
					$totaltransport = $totaltransport + $newkotak[$i][$j];
				}
			}
		}
		echo"<h3>Total solusi awal biaya transportasi : Rp. ",$totalbiaya,"K</h3>";
		echo"<h3>Total solusi awal transportasi: ",$totaltransport, " mobil</h3><br><br>";



//METODE MODI
		$r = array();
		$k = array();
		$kotakp = array();
		$tanda = 0;
		while($tanda == 0)
		{
			$r[0]=0;
			for($i=0; $i<$x; $i++)
			{
				$r[$i] = 0;
			}
			for($i=0; $i<$y; $i++)
			{
				$k[$i] = 0;
			}
			for($i=0; $i<$x; $i++)
			{
				for($j=0; $j<$y; $j++)
				{
					if($newkotak[$i][$j]!=0)
					{
						if($k[$j] == 0)
						{
							$k[$j] = $newnilai[$i][$j] - $r[$i];
						}
						else if($r[$i] == 0)
						{
							$r[$i] = $newnilai[$i][$j] - $k[$j];
						}
					}
				}
			}//end for K dan J
			for($i=0; $i<$x; $i++)
			{
				for($j=0; $j<$y; $j++)
				{
					$kotakp[$i][$j]=0;
				}
			}//end for inisiasi kotak peluang
			$banding = 0;
			for($i=0; $i<$x; $i++)
			{
				for($j=0; $j<$y; $j++)
				{
					if($newkotak[$i][$j]==0)
					{
						$kotakp[$i][$j] = $newnilai[$i][$j] - $r[$i] - $k[$j];
						if($kotakp[$i][$j] < $banding)
						{
							$banding = $newkotak[$i][$j];
							$savei = $i;
							$savej = $j;
						}
					}
				}
			}//end for cari kotak peluang
			if($savej-1>=0 && $newkotak[$savei][$savej-1]!=0 && $newkotak[$savei+1][$savej]!=0)
			{
				if($newkotak[$savei][$savej-1] < $newkotak[$savei+1][$savej])
				{
					$banding = $newkotak[$savei][$savej-1];
				}
				else
				{
					$banding = $newkotak[$savei+1][$savej];
				}
			} //end if cari nilai dsekitar kotak peluang terkecil
			else if($savej-1 < 0 && $newkotak[$savei-1][$savej] != 0 && $newkotak[$savei][$savej+1]!=0)
			{
				if($newkotak[$savei-1][$savej] < $newkotak[$savei][$savej+1])
				{
					$banding = $newkotak[$savei-1][$savej];
				}
				else{
					$banding = $newkotak[$savei][$savej+1];
				}
			} //end if cari nilai dsekitar kotak peluang terkecil
			if($savej-1 >=0){
				for($i=$savei; $i<=$savei; $i++)
				{
					for($j=$savej-1; $j<=$savej; $j++)
					{
						if($j==$savej-1)
						{
							$newkotak[$i][$j] = $newkotak[$i][$j] - $banding;
						}
						else
						{
							$newkotak[$i][$j] = $newkotak[$i][$j] + $banding;
						}
					}
				}
				for($i=$savei+1; $i<=$savei+1; $i++)
				{
					for($j=$savej-1; $j<=$savej; $j++)
					{
						if($j==$savej-1)
						{
							$newkotak[$i][$j] = $newkotak[$i][$j] + $banding;
						}
						else
						{
							$newkotak[$i][$j] = $newkotak[$i][$j] - $banding;
						}
					}
				}		
			}//end if ubah nilai sekitar kotak peluang
			else if($savej-1 < 0)
			{
				for($i=$savei-1; $i<=$savei-1; $i++)
				{
					for($j=$savej; $j<=$savej+1; $j++)
					{
						if($j==$savej)
						{
							$newkotak[$i][$j] = $newkotak[$i][$j] - $banding;
						}
						else
						{
							$newkotak[$i][$j] = $newkotak[$i][$j] + $banding;
						}
					}
				}
				for($i=$savei; $i<=$savei; $i++)
				{
					for($j=$savej; $j<=$savej+1; $j++)
					{
						if($j==$savej)
						{
								$newkotak[$i][$j] = $newkotak[$i][$j] + $banding;
						}
						else
						{
							$newkotak[$i][$j] = $newkotak[$i][$j] - $banding;
						}
					}
				}		
			}//end if ubah nilai sekitar kotak peluang
			if ($banding == 0)
			{
				break;
			}
		}//end while proses modi


		// OUTPUT
		echo"<div align='center'>";
		echo"<h1 align='center'>Tabel Solusi Optimum menggunakan <br> Metode MODI (Modified Distribution) :</h1>";
		echo"<table cellpadding='5' border='5'>";
		echo"<tr align='center'>";
			echo "<td>Keterangan</td>";
			$z=0;
			for($i=0; $i<$y; $i++){
				$z += 1;
				echo "<td>Toko $z</td>";				
			}
		echo"</tr>";
		$z = 0;
		for($i=0; $i<$x; $i++)
		{
			$z += 1;
			echo "<tr align='center'>";
				echo "<td>Distributor $z</td>";
			for($j=0; $j<$y; $j++)
			{
				echo "<td>",$newkotak[$i][$j],"</td>";
			}
			echo"</tr>";
		}	
		echo"</table>";
		echo"</div>";		
		$totalbiaya = 0;
		$totaltransport = 0;
		for($i=0; $i<$x; $i++)
		{
			for($j=0; $j<$y; $j++)
			{
				if($newkotak[$i][$j] != 0)
				{
					$biaya = $newkotak[$i][$j]*$newnilai[$i][$j];
					$totalbiaya = $totalbiaya + ($newkotak[$i][$j]*$newnilai[$i][$j]);
					$totaltransport = $totaltransport + $newkotak[$i][$j];
				}
			}
		}
		echo"<h2>Total solusi optimum biaya transportasi: <b>Rp. ",$totalbiaya,"K</b></h2><br>";
		echo"<h2>Total transportasi setelah solusi optimum: <b>",$totaltransport, " mobil</b></h2><br>";
	}//end if isset
	else{
		echo"<h2><b>Anda Belum Menginputkan Sesuatu !!!<br>Kembali ke =>";
		?>
		<a href="index.html">Home</a></h1>
		<?php
		echo "</b></h2>";
	}
?>




      </div>
    </div>

    <div id="footer">
      <p><a href="index.html">Home</a> | <a href="start.html">Hitung</a>
    </div>
  </div>
</body>
</html>
