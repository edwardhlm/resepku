<?php

include 'process.php';

if (cek_data_post("dor") == 'daftar'){
  register(
    cek_data_post("user"),
    cek_data_post("email"),
    cek_data_post("pass"),
    "Akun berhasil di tambah!",
    "login.php"
  );
} 

?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Daftar — Ember</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,600;0,9..144,900;1,9..144,500&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
  :root{
    --charcoal:#211714;
    --cream:#FBF3E7;
    --chili:#E8452C;
    --mustard:#F0A93B;
  }
  *{margin:0;padding:0;box-sizing:border-box;}
  body{
    background:#000;
    color:var(--cream);
    font-family:'Space Grotesk',sans-serif;
    min-height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
    padding:24px;
    overflow:hidden;
    position:relative;
  }
  @media (prefers-reduced-motion: reduce){
    *{animation-duration:.001ms !important; transition-duration:.001ms !important;}
  }

  /* background photo of chef cooking with fire */
  .bg-photo{
    position:fixed; inset:0;
    background-image:
      linear-gradient(180deg, rgba(15,8,6,.55) 0%, rgba(15,8,6,.35) 40%, rgba(15,8,6,.85) 100%),
      url('https://images.stockcake.com/public/a/a/e/aae6cd62-635f-434c-a7b0-8e341c05f811_large/flaming-cooking-performance-stockcake.jpg');
    background-size:cover;
    background-position:center 30%;
    transform:scale(1.08);
    animation:bgpan 22s ease-in-out infinite alternate;
    z-index:0;
  }
  @keyframes bgpan{
    0%{transform:scale(1.08) translate(0,0);}
    100%{transform:scale(1.14) translate(-1.5%,-1%);}
  }
  .bg-flicker{
    position:fixed; inset:0; z-index:0;
    background:radial-gradient(circle at 30% 75%, rgba(232,69,44,.25), transparent 55%);
    animation:flicker 3.2s ease-in-out infinite;
    mix-blend-mode:screen;
  }
  @keyframes flicker{
    0%,100%{opacity:.55;}
    25%{opacity:.85;}
    50%{opacity:.4;}
    75%{opacity:.9;}
  }

  /* floating ingredient icons (SVG) */
  .float-item{
    position:absolute;
    width:46px; height:46px;
    filter:drop-shadow(0 8px 16px rgba(0,0,0,.5));
    pointer-events:none;
    user-select:none;
    will-change:transform;
    z-index:1;
  }
  .float-item svg{width:100%; height:100%; display:block;}

  /* steam */
  .steam{position:absolute; bottom:0; width:2px;}
  .steam span{
    position:absolute; bottom:0; width:6px; height:6px;
    background:rgba(251,243,231,.3); border-radius:50%; filter:blur(3px);
    animation:rise 4.5s infinite ease-in;
  }
  @keyframes rise{
    0%{transform:translateY(0) translateX(0) scale(1); opacity:0;}
    10%{opacity:1;}
    100%{transform:translateY(-140px) translateX(16px) scale(2.2); opacity:0;}
  }

  .promo{
    position:relative; z-index:2;
    max-width:460px;
    color:var(--cream);
    padding:0 12px 32px;
    text-align:left;
  }
  .promo .tag{
    display:inline-flex; align-items:center; gap:8px;
    background:rgba(232,69,44,.15);
    border:1px solid rgba(232,69,44,.5);
    color:var(--mustard);
    font-size:12px; font-weight:600; letter-spacing:.18em; text-transform:uppercase;
    padding:7px 14px; border-radius:100px; margin-bottom:18px;
  }
  .promo h1.hero-line{
    font-family:'Fraunces',serif; font-weight:900;
    font-size:clamp(2rem,4vw,3rem); line-height:1.02; letter-spacing:-0.01em;
    margin-bottom:14px; text-shadow:0 4px 24px rgba(0,0,0,.5);
  }
  .promo h1.hero-line .fire{color:var(--chili); font-style:italic; font-weight:500;}
  .promo p.lead{
    font-size:15px; line-height:1.6; color:#EFE1D2; max-width:400px;
    text-shadow:0 2px 12px rgba(0,0,0,.5);
  }
  .wrap{
    position:relative; z-index:2;
    display:flex; gap:56px; align-items:center; flex-wrap:wrap;
    max-width:960px; width:100%; justify-content:center;
  }
  .card{
    position:relative;
    z-index:2;
    width:100%;
    max-width:420px;
    background:rgba(251,243,231,0.97);
    color:var(--charcoal);
    border-radius:28px;
    padding:48px 40px;
    box-shadow:0 30px 70px rgba(0,0,0,.55);
    backdrop-filter:blur(6px);
  }
  .eyebrow{
    font-size:12px; letter-spacing:.25em; text-transform:uppercase;
    color:var(--chili); font-weight:600; margin-bottom:10px;
  }
  h1{
    font-family:'Fraunces',serif; font-weight:900;
    font-size:2.4rem; line-height:1; letter-spacing:-0.01em;
    margin-bottom:8px;
  }
  h1 .fire{color:var(--chili); font-style:italic; font-weight:500;}
  .sub{font-size:14px; color:#6a5c50; margin-bottom:32px; line-height:1.5;}

  form{display:flex; flex-direction:column; gap:16px;}
  .field label{
    display:block; font-size:12px; font-weight:600; letter-spacing:.04em;
    text-transform:uppercase; color:#8a7c6e; margin-bottom:6px;
  }
  .field input{
    width:100%; padding:14px 16px; border-radius:14px;
    border:2px solid #EAD9C4; background:#FFFDF9;
    font-family:'Space Grotesk',sans-serif; font-size:15px; color:var(--charcoal);
    outline:none; transition:border-color .2s ease, transform .2s ease;
  }
  .field input:focus{border-color:var(--chili); transform:translateY(-1px);}
  .field p.err{font-size:12px; color:var(--chili); margin-top:5px; display:none;}

  button[type=submit]{
    margin-top:8px;
    background:var(--chili); color:var(--cream);
    border:none; padding:16px; border-radius:100px;
    font-family:'Space Grotesk',sans-serif; font-weight:700; font-size:15px;
    letter-spacing:.02em;
    cursor:pointer;
    transition:transform .25s ease, background .25s ease;
  }
  button[type=submit]:hover{transform:translateY(-3px) scale(1.02); background:#ff5b3d;}
  button[type=submit]:active{transform:scale(.98);}

  .login-pill{
    margin-top:22px; text-align:center;
    background:#F3E4CE; border-radius:100px; padding:12px 18px;
    font-size:13px;
  }
  .login-pill a{color:var(--chili); font-weight:700; text-decoration:none;}

  @media (max-width:860px){
    .wrap{flex-direction:column; text-align:center;}
    .promo{text-align:center; padding-bottom:8px;}
    .promo p.lead{margin:0 auto;}
    .promo .tag{margin-left:auto; margin-right:auto;}
  }
</style>
</head>
<body>

  <div class="bg-photo"></div>
  <div class="bg-flicker"></div>

  <!-- modern flat-style SVG ingredient icons -->
  <div class="float-item" data-depth="0.03" style="top:10%; left:5%;">
    <svg viewBox="0 0 64 64"><path d="M20 14c8-6 20-4 26 4 5 7 4 17-3 24-8 8-21 9-29 1-7-7-6-19 2-26 1.5-1.4 3-2.2 4-3z" fill="#E8452C"/><path d="M22 12c2-4 6-7 10-7 1 0 2 1 1.5 2.5C32 10 29 12 27 15c-1.5 2-2 4-1 5" fill="none" stroke="#3E7A3E" stroke-width="3" stroke-linecap="round"/></svg>
  </div>
  <div class="float-item" data-depth="0.05" style="top:74%; left:8%;">
    <svg viewBox="0 0 64 64"><path d="M32 4c3 6-2 10-2 16 0 3 2 5 2 5s2-2 2-5c0-6-5-10-2-16z" fill="#EFE7D8"/><ellipse cx="32" cy="38" rx="18" ry="20" fill="#F6F0E3" stroke="#D8CBB5" stroke-width="2"/><path d="M32 20c-6 4-10 11-10 18M32 20c6 4 10 11 10 18M32 20v24" stroke="#D8CBB5" stroke-width="2" fill="none"/></svg>
  </div>
  <div class="float-item" data-depth="0.04" style="top:16%; left:90%;">
    <svg viewBox="0 0 64 64"><ellipse cx="32" cy="32" rx="24" ry="18" fill="#F0A93B"/><ellipse cx="32" cy="32" rx="17" ry="12" fill="#F6C462"/><g stroke="#E8952A" stroke-width="1.5"><line x1="32" y1="20" x2="32" y2="44"/><line x1="20" y1="24" x2="44" y2="40"/><line x1="20" y1="40" x2="44" y2="24"/></g></svg>
  </div>
  <div class="float-item" data-depth="0.06" style="top:78%; left:90%;">
    <svg viewBox="0 0 64 64"><path d="M32 6c10 4 18 14 18 26 0 12-8 20-18 26-10-6-18-14-18-26C14 20 22 10 32 6z" fill="#5C7A4E"/><path d="M32 12v34" stroke="#3E5C34" stroke-width="2"/></svg>
  </div>

  <div class="steam" style="left:16%;">
    <span style="animation-delay:0s;"></span>
    <span style="animation-delay:1.4s;"></span>
    <span style="animation-delay:2.8s;"></span>
  </div>
  <div class="steam" style="left:84%;">
    <span style="animation-delay:.7s;"></span>
    <span style="animation-delay:2.1s;"></span>
    <span style="animation-delay:3.4s;"></span>
  </div>

  <div class="wrap">
    <div class="promo">
      <div class="tag">🔥 Now Firing Up Orders</div>
      <h1 class="hero-line">Hungry?<br>Join Ember & <span class="fire">eat bold.</span></h1>
      <p class="lead">Create your account and unlock member-only pricing, early access to weekly specials, and one-tap reordering of your favorite dishes. Sign up now and get <strong>15% off</strong> your first order.</p>
    </div>

    <div class="card">
      <div class="eyebrow">Ember Kitchen</div>
      <h1>Join the <span class="fire">fire.</span></h1>
      <p class="sub">Create your account to start ordering, save your favorite dishes, and book a table.</p>

      <form action="" method="post" id="registerForm" novalidate>
        <div class="field">
          <label for="user">Username</label>
          <input type="text" name="user" id="user" required placeholder="e.g. chilihead">
          <p class="err" id="userError">Username minimal 3 karakter</p>
        </div>
        <div class="field">
          <label for="pass">Password</label>
          <input type="password" name="pass" id="pass" required placeholder="••••••••">
          <p class="err" id="passError">Password minimal 6 karakter</p>
        </div>
        <div class="field">
          <label for="email">Email</label>
          <input type="email" name="email" id="email" required placeholder="you@email.com">
          <p class="err" id="emailError">Format email tidak valid</p>
        </div>
        <button type="submit" name="dor" value="daftar">Daftar & Mulai Pesan →</button>
      </form>

      <div class="login-pill">Sudah punya akun? <a href="#">Login & pesan sekarang</a></div>
    </div>
  </div>

<script>
  document.body.addEventListener('mousemove', (e) => {
    const cx = window.innerWidth/2, cy = window.innerHeight/2;
    const dx = e.clientX - cx, dy = e.clientY - cy;
    document.querySelectorAll('.float-item').forEach(item => {
      const depth = parseFloat(item.dataset.depth);
      item.style.transform = `translate(${dx*depth}px, ${dy*depth}px) rotate(${dx*depth*0.3}deg)`;
    });
  });

  const form = document.getElementById('registerForm');
  const userInput = document.getElementById('user');
  const passInput = document.getElementById('pass');
  const emailInput = document.getElementById('email');

  function validateField(input, errorId, condition){
    const errorEl = document.getElementById(errorId);
    if(!condition){
      input.style.borderColor = '#E8452C';
      errorEl.style.display = 'block';
      return false;
    } else {
      input.style.borderColor = '#EAD9C4';
      errorEl.style.display = 'none';
      return true;
    }
  }

  form.addEventListener('submit', (e) => {
    const validUser = validateField(userInput, 'userError', userInput.value.trim().length >= 3);
    const validPass = validateField(passInput, 'passError', passInput.value.length >= 6);
    const validEmail = validateField(emailInput, 'emailError', /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailInput.value));
    if(!validUser || !validPass || !validEmail) e.preventDefault();
  });

  userInput.addEventListener('input', () => validateField(userInput, 'userError', userInput.value.trim().length >= 3));
  passInput.addEventListener('input', () => validateField(passInput, 'passError', passInput.value.length >= 6));
  emailInput.addEventListener('input', () => validateField(emailInput, 'emailError', /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailInput.value)));
</script>

</body>
</html>