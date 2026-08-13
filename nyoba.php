<?php
require_once 'process.php';

// ================= AKSI PENGGUNA =================
if(cek_data_post('aksi_pengguna') == 'tambah'){
    $nama = cek_data_post('nama');
    $email = cek_data_post('email');
    $username = cek_data_post('username');
    $password = cek_data_post('password');
    $role = cek_data_post('role');
    $query = "INSERT INTO pengguna VALUES(NULL, '$nama', '$email', '$username', '$password', '$role')";
    mysqli_query(connect(), $query);
    header('Location: index.php');
    exit();
}

if(cek_data_post('aksi_pengguna') == 'edit'){
    $id = cek_data_post('id');
    $nama = cek_data_post('nama');
    $email = cek_data_post('email');
    $username = cek_data_post('username');
    $password = cek_data_post('password');
    $role = cek_data_post('role');
    $query = "UPDATE pengguna SET nama='$nama', email='$email', username='$username', password='$password', role='$role' WHERE id='$id'";
    mysqli_query(connect(), $query);
    header('Location: index.php');
    exit();
}

if(cek_data_get('hapus_pengguna')){
    $id = cek_data_get('hapus_pengguna');
    $query = "DELETE FROM pengguna WHERE id='$id'";
    mysqli_query(connect(), $query);
    header('Location: index.php');
    exit();
}

// ================= AKSI RESEP =================
if(cek_data_post('aksi_resep') == 'tambah'){
    $nama_resep = cek_data_post('nama_resep');
    $step = cek_data_post('step');
    $author = cek_data_post('author');
    $bahan_resep = cek_data_post('bahan_resep');
    $query = "INSERT INTO resep VALUES(NULL, '$nama_resep', '$step', '$author', '$bahan_resep')";
    mysqli_query(connect(), $query);
    header('Location: index.php');
    exit();
}

if(cek_data_post('aksi_resep') == 'edit'){
    $id_resep = cek_data_post('id_resep');
    $nama_resep = cek_data_post('nama_resep');
    $step = cek_data_post('step');
    $author = cek_data_post('author');
    $bahan_resep = cek_data_post('bahan_resep');
    $query = "UPDATE resep SET nama_resep='$nama_resep', step='$step', author='$author', resep='$bahan_resep' WHERE id_resep='$id_resep'";
    mysqli_query(connect(), $query);
    header('Location: index.php');
    exit();
}

if(cek_data_get('hapus_resep')){
    $id_resep = cek_data_get('hapus_resep');
    $query = "DELETE FROM resep WHERE id_resep='$id_resep'";
    mysqli_query(connect(), $query);
    header('Location: index.php');
    exit();
}

// ================= AKSI BAHAN =================
if(cek_data_post('aksi_bahan') == 'tambah'){
    $nama_bahan = cek_data_post('nama_bahan');
    $query = "INSERT INTO bahan VALUES(NULL, '$nama_bahan')";
    mysqli_query(connect(), $query);
    header('Location: index.php');
    exit();
}

if(cek_data_get('hapus_bahan')){
    $id_bahan = cek_data_get('hapus_bahan');
    $query = "DELETE FROM bahan WHERE id_bahan='$id_bahan'";
    mysqli_query(connect(), $query);
    header('Location: index.php');
    exit();
}

// ================= AMBIL DATA UNTUK FORM EDIT =================
$edit_pengguna = null;
if(cek_data_get('edit_pengguna')){
    $id = cek_data_get('edit_pengguna');
    $q = mysqli_query(connect(), "SELECT * FROM pengguna WHERE id='$id'");
    $edit_pengguna = mysqli_fetch_assoc($q);
}

$edit_resep = null;
if(cek_data_get('edit_resep')){
    $id_resep = cek_data_get('edit_resep');
    $q = mysqli_query(connect(), "SELECT * FROM resep WHERE id_resep='$id_resep'");
    $edit_resep = mysqli_fetch_assoc($q);
}

// ================= AMBIL DATA UNTUK TABEL =================
$list_pengguna = mysqli_query(connect(), "SELECT * FROM pengguna ORDER BY id DESC");
$list_resep = mysqli_query(connect(), "SELECT * FROM resep ORDER BY id_resep DESC");
$list_bahan = mysqli_query(connect(), "SELECT * FROM bahan ORDER BY id_bahan DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Kelola Dapur — Pengguna, Resep & Bahan</title>
<style>
  :root{
    --bg:#F6F3EC;
    --ink:#2B2620;
    --ink-soft:#6B6255;
    --line:#DCD5C6;
    --card:#FFFFFF;
    --accent:#7A6A4F;
    --accent-ink:#FFFFFF;
    --user-tint:#EFE7D8;
    --resep-tint:#E9EFE2;
    --danger:#B14A3D;
    --radius:10px;
  }
  *{box-sizing:border-box;}
  body{
    margin:0;
    font-family:'Segoe UI', system-ui, sans-serif;
    background:var(--bg);
    color:var(--ink);
    padding:2rem;
  }
  h1{ font-size:1.4rem; font-weight:600; letter-spacing:.02em; margin:0 0 .25rem; }
  .sub{ color:var(--ink-soft); font-size:.9rem; margin:0 0 1.75rem; }
  .top{ display:grid; grid-template-columns:1fr 1fr; gap:1.25rem; }
  @media (max-width:820px){ .top{grid-template-columns:1fr;} }

  .panel{ background:var(--card); border:1px solid var(--line); border-radius:var(--radius); padding:1.25rem; }
  .panel.pengguna{ border-top:3px solid #A98F5F; }
  .panel.resep{ border-top:3px solid #6E8A55; }
  .panel.bahan{ border-top:3px solid #7A6A4F; margin-top:1.25rem; }

  .panel h2{ font-size:1rem; font-weight:600; margin:0 0 1rem; display:flex; align-items:center; gap:.5rem; }
  .badge{ font-size:.7rem; background:var(--user-tint); padding:2px 8px; border-radius:20px; color:var(--ink-soft); }
  .resep .badge{ background:var(--resep-tint); }

  form{ display:flex; flex-direction:column; gap:.6rem; margin-bottom:1rem; }
  .row2{ display:grid; grid-template-columns:1fr 1fr; gap:.6rem; }
  label{ font-size:.75rem; color:var(--ink-soft); margin-bottom:2px; display:block; }
  input, select, textarea{
    width:100%; padding:.5rem .6rem; border:1px solid var(--line); border-radius:6px;
    font-size:.85rem; background:#FDFCF9; color:var(--ink); font-family:inherit;
  }
  textarea{ resize:vertical; min-height:60px; }
  input:focus, select:focus, textarea:focus{ outline:none; border-color:var(--accent); }

  .form-actions{ display:flex; gap:.5rem; }
  button, .btn-link{
    cursor:pointer; border:none; border-radius:6px; padding:.5rem .9rem;
    font-size:.8rem; font-weight:500; font-family:inherit; text-decoration:none; display:inline-block;
  }
  .btn-primary{ background:var(--accent); color:var(--accent-ink); }
  .btn-primary:hover{ background:#665942; }
  .btn-secondary{ background:transparent; border:1px solid var(--line); color:var(--ink-soft); }
  .btn-secondary:hover{ background:#F0EDE4; }
  .btn-danger{ background:transparent; color:var(--danger); border:1px solid #E6C9C4; padding:.3rem .5rem; font-size:.7rem; }
  .btn-danger:hover{ background:#FBEEEC; }
  .btn-edit{ background:transparent; color:var(--accent); border:1px solid var(--line); padding:.3rem .5rem; font-size:.7rem; }
  .btn-edit:hover{ background:#F0EDE4; }

  table{ width:100%; border-collapse:collapse; font-size:.8rem; }
  th, td{ text-align:left; padding:.5rem .4rem; border-bottom:1px solid var(--line); vertical-align:top; }
  th{ color:var(--ink-soft); font-weight:500; font-size:.72rem; text-transform:uppercase; letter-spacing:.03em; }
  td.actions{ white-space:nowrap; display:flex; gap:.3rem; }
  .empty{ color:var(--ink-soft); font-size:.8rem; padding:1rem 0; text-align:center; }
  .scroll{ max-height:260px; overflow-y:auto; }
  .role-tag{ font-size:.68rem; padding:1px 7px; border-radius:20px; background:#EFE7D8; color:#7A6A4F; }
  .role-tag.penguasa{ background:#F0E2DC; color:#B14A3D; }
  .clip{ max-width:180px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; }

  .bahan-add{ display:flex; gap:.5rem; margin-bottom:1rem; }
  .bahan-add input{ flex:1; }
  .bahan-grid{ display:grid; grid-template-columns:repeat(auto-fill, minmax(160px,1fr)); gap:.5rem; }
  .bahan-chip{
    display:flex; align-items:center; justify-content:space-between; background:#FAF8F2;
    border:1px solid var(--line); border-radius:6px; padding:.45rem .6rem; font-size:.8rem;
  }
  .bahan-chip a{ color:var(--danger); font-weight:600; text-decoration:none; padding:0 .3rem; }
</style>
</head>
<body>

<h1>Kelola Dapur</h1>
<p class="sub">Kelola pengguna, resep, dan bahan — pakai <code>connect()</code>, <code>cek_data_post()</code>, dan <code>cek_data_get()</code> dari <code>process.php</code>.</p>

<div class="top">

  <!-- PANEL PENGGUNA -->
  <div class="panel pengguna">
    <h2>Kelola Pengguna <span class="badge"><?= mysqli_num_rows($list_pengguna) ?></span></h2>
    <form method="post" action="index.php">
      <?php if($edit_pengguna): ?>
        <input type="hidden" name="id" value="<?= htmlspecialchars($edit_pengguna['id']) ?>">
        <input type="hidden" name="aksi_pengguna" value="edit">
      <?php else: ?>
        <input type="hidden" name="aksi_pengguna" value="tambah">
      <?php endif; ?>
      <div>
        <label>Nama</label>
        <input type="text" name="nama" value="<?= $edit_pengguna ? htmlspecialchars($edit_pengguna['nama']) : '' ?>" required>
      </div>
      <div class="row2">
        <div>
          <label>Email</label>
          <input type="email" name="email" value="<?= $edit_pengguna ? htmlspecialchars($edit_pengguna['email']) : '' ?>" required>
        </div>
        <div>
          <label>Username</label>
          <input type="text" name="username" value="<?= $edit_pengguna ? htmlspecialchars($edit_pengguna['username']) : '' ?>" required>
        </div>
      </div>
      <div class="row2">
        <div>
          <label>Password</label>
          <input type="text" name="password" value="<?= $edit_pengguna ? htmlspecialchars($edit_pengguna['password']) : '' ?>" required>
        </div>
        <div>
          <label>Role</label>
          <select name="role">
            <option value="rakyat" <?= ($edit_pengguna && $edit_pengguna['role']=='rakyat') ? 'selected' : '' ?>>rakyat</option>
            <option value="penguasa" <?= ($edit_pengguna && $edit_pengguna['role']=='penguasa') ? 'selected' : '' ?>>penguasa</option>
          </select>
        </div>
      </div>
      <div class="form-actions">
        <button type="submit" class="btn-primary"><?= $edit_pengguna ? 'Simpan perubahan' : 'Tambah pengguna' ?></button>
        <?php if($edit_pengguna): ?>
          <a href="index.php" class="btn-link btn-secondary">Batal</a>
        <?php endif; ?>
      </div>
    </form>
    <div class="scroll">
      <table>
        <thead><tr><th>Nama</th><th>Username</th><th>Role</th><th></th></tr></thead>
        <tbody>
        <?php if(mysqli_num_rows($list_pengguna) == 0): ?>
          <tr><td colspan="4" class="empty">Belum ada pengguna.</td></tr>
        <?php else: while($p = mysqli_fetch_assoc($list_pengguna)): ?>
          <tr>
            <td><?= htmlspecialchars($p['nama']) ?><br><span style="color:var(--ink-soft);font-size:.72rem;"><?= htmlspecialchars($p['email']) ?></span></td>
            <td><?= htmlspecialchars($p['username']) ?></td>
            <td><span class="role-tag <?= htmlspecialchars($p['role']) ?>"><?= htmlspecialchars($p['role']) ?></span></td>
            <td class="actions">
              <a class="btn-link btn-edit" href="index.php?edit_pengguna=<?= $p['id'] ?>">Ubah</a>
              <a class="btn-link btn-danger" href="index.php?hapus_pengguna=<?= $p['id'] ?>" onclick="return confirm('Hapus pengguna ini?')">Hapus</a>
            </td>
          </tr>
        <?php endwhile; endif; ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- PANEL RESEP -->
  <div class="panel resep">
    <h2>Kelola Resep <span class="badge"><?= mysqli_num_rows($list_resep) ?></span></h2>
    <form method="post" action="index.php">
      <?php if($edit_resep): ?>
        <input type="hidden" name="id_resep" value="<?= htmlspecialchars($edit_resep['id_resep']) ?>">
        <input type="hidden" name="aksi_resep" value="edit">
      <?php else: ?>
        <input type="hidden" name="aksi_resep" value="tambah">
      <?php endif; ?>
      <div>
        <label>Nama resep</label>
        <input type="text" name="nama_resep" value="<?= $edit_resep ? htmlspecialchars($edit_resep['nama_resep']) : '' ?>" required>
      </div>
      <div>
        <label>Author</label>
        <input type="text" name="author" value="<?= $edit_resep ? htmlspecialchars($edit_resep['author']) : '' ?>" required>
      </div>
      <div>
        <label>Bahan (resep)</label>
        <textarea name="bahan_resep" placeholder="Daftar bahan yang dipakai..." required><?= $edit_resep ? htmlspecialchars($edit_resep['resep']) : '' ?></textarea>
      </div>
      <div>
        <label>Langkah (step)</label>
        <textarea name="step" placeholder="Langkah-langkah memasak..." required><?= $edit_resep ? htmlspecialchars($edit_resep['step']) : '' ?></textarea>
      </div>
      <div class="form-actions">
        <button type="submit" class="btn-primary"><?= $edit_resep ? 'Simpan perubahan' : 'Tambah resep' ?></button>
        <?php if($edit_resep): ?>
          <a href="index.php" class="btn-link btn-secondary">Batal</a>
        <?php endif; ?>
      </div>
    </form>
    <div class="scroll">
      <table>
        <thead><tr><th>Nama resep</th><th>Author</th><th></th></tr></thead>
        <tbody>
        <?php if(mysqli_num_rows($list_resep) == 0): ?>
          <tr><td colspan="3" class="empty">Belum ada resep.</td></tr>
        <?php else: while($r = mysqli_fetch_assoc($list_resep)): ?>
          <tr>
            <td class="clip"><?= htmlspecialchars($r['nama_resep']) ?></td>
            <td><?= htmlspecialchars($r['author']) ?></td>
            <td class="actions">
              <a class="btn-link btn-edit" href="index.php?edit_resep=<?= $r['id_resep'] ?>">Ubah</a>
              <a class="btn-link btn-danger" href="index.php?hapus_resep=<?= $r['id_resep'] ?>" onclick="return confirm('Hapus resep ini?')">Hapus</a>
            </td>
          </tr>
        <?php endwhile; endif; ?>
        </tbody>
      </table>
    </div>
  </div>

</div>

<!-- PANEL BAHAN -->
<div class="panel bahan">
  <h2>Daftar Bahan <span class="badge"><?= mysqli_num_rows($list_bahan) ?></span></h2>
  <form method="post" action="index.php" class="bahan-add">
    <input type="hidden" name="aksi_bahan" value="tambah">
    <input type="text" name="nama_bahan" placeholder="Nama bahan, contoh: Bawang putih" required>
    <button type="submit" class="btn-primary">Tambah bahan</button>
  </form>
  <div class="bahan-grid">
    <?php if(mysqli_num_rows($list_bahan) == 0): ?>
      <p class="empty">Belum ada bahan.</p>
    <?php else: while($b = mysqli_fetch_assoc($list_bahan)): ?>
      <div class="bahan-chip">
        <span><?= htmlspecialchars($b['nama']) ?></span>
        <a href="index.php?hapus_bahan=<?= $b['id_bahan'] ?>" onclick="return confirm('Hapus bahan ini?')">&times;</a>
      </div>
    <?php endwhile; endif; ?>
  </div>
</div>

</body>
</html>