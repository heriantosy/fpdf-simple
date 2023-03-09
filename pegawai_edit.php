<?php
include "koneksi.php";

$md = $_REQUEST['md']+0;
$id = $_REQUEST['id']+0;

$lungo = (empty($_REQUEST['lungo']))? 'EditData' : $_REQUEST['lungo'];
$lungo($md, $id);



function EditData($md, $id) {
    global $koneksi;
  if ($md == 0) {
    $jdl = "Edit Data Pegawai";
    //$w = AmbilFieldx('pejabat', 'PejabatID', $id, '*');
    $w = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * from pegawai where Login='$id'"));
  }
  elseif ($md == 1) {
    $jdl = "Tambah Pegawai";
    $w = array();
    $w['Login'] = '';
    $w['Nama'] = '';
  }
  else 
  {
    echo"OK";
  }
  echo "
  <table>
  <form action='pegawai_edit.php' method=POST onSubmit=\"return CheckForm(this)\">
  <input type=hidden name='lungo' value='Simpan' />
  <input type=hidden name='md' value='$md'/>
  <input type=hidden name='id' value='$id'/>
  <tr>
  <td>Login</td>
  <td><input type=text name='Login' value='$w[Login]'/></td>
  </tr>

  <tr>
  <td>Nama</td>
  <td><input type=text name='Nama' value='$w[Nama]'/></td>
  </tr>

  <tr>
  <td colspan=2>
      <input type=submit name='Simpan' value='Simpan' />
      <input type=button name='Batal' value='Batal'onClick=\"window.close()\" />
  </td>
  </tr>
  
  </form>
  </table>";
}
function Simpan($md, $id) {
	global $koneksi;
  $Login = $_POST['Login'];
  $Nama  = $_POST['Nama'];
  if ($md == 0) {
    $s = mysqli_query($koneksi, "update pegawai set Nama = '$Nama' where Login='$id'");
    TutupScript();
  }
  elseif ($md == 1) {
    $s = mysqli_query($koneksi, "insert into pegawai(Login,Nama)values('$Login','$Nama')");
    TutupScript();
  }
  else die(PesanError('Error',
    "Tidak.<br />
    <input type=button name='Tutup' value='Tutup' onClick=\"window.close()\" />"));
}
function TutupScript() {
echo <<<SCR
<SCRIPT>
  function ttutup() {
    opener.location='pegawai.php';
    self.close();
    return false;
  }
  ttutup();
</SCRIPT>
SCR;
}
?>
