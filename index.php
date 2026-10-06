<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Sport Academy - Login</title>

<link href="https://fonts.googleapis.com/css2?family=Anton&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:'Poppins',sans-serif;

    background:
    linear-gradient(rgba(0,0,0,.78),rgba(0,0,0,.78)),
    url('assets/img/lapangan.png');

    background-size:cover;
    background-position:center;
    background-attachment:fixed;

    min-height:100vh;

    display:flex;
    flex-direction:column;
    align-items:center;

    color:white;
    overflow:hidden;
}

/* Efek cahaya */

body::before{
    content:"";
    position:fixed;
    inset:0;

    background:
    radial-gradient(circle at 20% 30%,
    rgba(243,156,18,.18),
    transparent 35%),

    radial-gradient(circle at 80% 20%,
    rgba(255,255,255,.06),
    transparent 30%);

    animation:cahaya 8s ease-in-out infinite alternate;

    pointer-events:none;
}

@keyframes cahaya{
    from{
        transform:translateY(0);
    }

    to{
        transform:translateY(-40px);
    }
}

/* Navbar */

nav{
    width:100%;

    padding:25px 60px;

    display:flex;
    justify-content:space-between;
    align-items:center;

    background:rgba(0,0,0,.25);

    backdrop-filter:blur(12px);

    position:fixed;
    top:0;
    left:0;

    z-index:999;
}

.logo{
    font-family:'Anton',sans-serif;

    color:#f39c12;

    font-size:34px;

    letter-spacing:2px;

    text-shadow:
    0 0 15px rgba(243,156,18,.6);
}

/* Login Card */

.login-card{

    margin-top:120px;

    width:550px;

    padding:70px 60px;

    border-radius:35px;

    background:rgba(20,20,20,.70);

    backdrop-filter:blur(20px);

    border:1px solid rgba(255,255,255,.08);

    box-shadow:
    0 25px 60px rgba(0,0,0,.55),
    0 0 30px rgba(243,156,18,.15);

    animation:muncul 1s ease;
}

.login-card:hover{

    transform:translateY(-8px);

    box-shadow:
    0 25px 50px rgba(0,0,0,.5);
}

@keyframes muncul{

    from{
        opacity:0;
        transform:translateY(50px);
    }

    to{
        opacity:1;
        transform:translateY(0);
    }
}

.judul{

    font-family:'Arial Black',sans-serif;

    color:#f39c12;

    font-size:52px;

    text-align:center;

    letter-spacing:2px;

    line-height:1.1;

    text-shadow:
    0 0 20px rgba(243,156,18,.3);
}

.subjudul{

    text-align:center;

    font-size:13px;

    color:#ccc;

    margin-top:10px;

    margin-bottom:35px;

    letter-spacing:1px;
}

/* Input */

.input-group{

    margin-bottom:25px;
}

.input-group label{

    display:block;

    margin-bottom:8px;

    font-size:12px;

    color:#bbb;

    letter-spacing:1px;
}

.input-box{

    position:relative;
}

.input-box i{

    position:absolute;

    top:50%;
    left:15px;

    transform:translateY(-50%);

    color:#999;

    font-size:16px;
}

.input-box input{

    width:100%;

    padding:15px 15px 15px 45px;

    border-radius:12px;

    border:1px solid #444;

    background:rgba(255,255,255,.05);

    color:white;

    transition:.3s;
}

.input-box input::placeholder{

    color:#888;
}

.input-box input:focus{

    outline:none;

    border-color:#f39c12;

    box-shadow:
    0 0 15px rgba(243,156,18,.3);
}

/* Footer */

.footer-form{

    display:flex;

    justify-content:space-between;

    align-items:center;

    margin-top:30px;
}

.footer-form a{

    color:#f39c12;

    text-decoration:none;

    font-size:13px;

    font-weight:500;

    transition:.3s;
}

.footer-form a:hover{

    color:#ffb340;

    text-decoration:underline;
}

/* Button */

button{

    width:150px;

    padding:15px;

    border:none;

    border-radius:12px;

    background:#f39c12;

    color:black;

    font-weight:700;

    cursor:pointer;

    transition:.3s;
}

button:hover{

    background:#ffad2f;

    transform:translateY(-3px);

    box-shadow:
    0 10px 20px rgba(243,156,18,.4);
}

button i{

    margin-right:8px;
}

/* Responsive */

@media(max-width:500px){

    .login-card{

        width:90%;

        padding:35px 25px;
    }

    nav{

        padding:20px;
    }

    .logo{

        font-size:28px;
    }

    .judul{

        font-size:42px;
    }

    .footer-form{

        flex-direction:column;
        gap:20px;
    }

    button{

        width:100%;
    }
}

</style>
</head>

<body>

<nav>

    <div class="logo">
        SPORT ACADEMY
    </div>

</nav>

<div class="login-card">

    <div class="judul" >
        SELAMAT
    </div>

    <div class="judul">
        DATANG
    </div>

    <div class="subjudul">
        DI SPORT ACADEMY
    </div>

    <form action="proses_login.php" method="POST">

        <div class="input-group">

            <label>EMAIL</label>

            <div class="input-box">

                <i class="fa-solid fa-envelope"></i>

                <input
                type="email"
                name="email"
                placeholder="Masukkan Email"
                required>

            </div>

        </div>

        <div class="input-group">

            <label>KATA SANDI</label>

            <div class="input-box">

                <i class="fa-solid fa-lock"></i>

                <input
                type="password"
                name="password"
                placeholder="Masukkan Password"
                required>

            </div>

        </div>

        <div class="footer-form">

            <a href="register.php">
                BUAT AKUN
            </a>

            <button type="submit">

                <i class="fa-solid fa-right-to-bracket"></i>

                MASUK

            </button>

        </div>

    </form>

</div>

</body>
</html>