<?php 
include "koneksi.php";
$lungo = (empty($_REQUEST['lungo']))? 'ListPegawai' : $_REQUEST['lungo'];
$lungo();

//ListPegawai();

function ListPegawai() {
  global $koneksi;
  PegawaiScript();
	echo"Master Pegawai";
	echo"<table border='1'>
  <tr>
    <td colspan='4'><input type=button name='Tambah' value='Tambah' onClick=\"javascript:PegawaiEdit(1, 0)\" /></td>
  </tr>
  <tr>
    <th>No</th>
    <th>Login</th>
    <th>Nama</th>
    <th>Aksi</th>
  </tr>";
    $s = "select * from pegawai";
    $r = mysqli_query($koneksi, $s);
    $n = 0;
    while($w=mysqli_fetch_array($r)){
    $n++;
    echo "<tr>
      <td>$n</td>
      <td>$w[Login]</td>
      <td>$w[Nama]</td>
      <td>
      <a href='#' onClick=\"javascript:PegawaiEdit(0, $w[Login])\"/> Edit </a> |
      <a href='?ndelox=pegawai&lungo=HapusPeg&id=$w[Login]' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\">Del</a>
      </td>
      </tr>";
  }
  echo "</table>";
}

function HapusPeg() {
	global $koneksi;
  $id = $_GET['id'];
  $s = "delete from pegawai where Login='$id'";
  $r = mysqli_query($koneksi, $s);
  ListPegawai();
}

function PegawaiScript() {
  //width=400, align='center' height=400, scrollbars, status
  //width=550,height=170,left=450,top=200,toolbar=0,status=0
  echo <<<SCR
  <script>
  function PegawaiEdit(md, id) {
    lnk = "pegawai_edit.php?md="+md+"&id="+id;
    win2 = window.open(lnk, "", "width=450,height=250,left=450,top=200,toolbar=0,status=0");
    if (win2.opener == null) childWindow.opener = self;
  }
  </script>
SCR;
}


?>