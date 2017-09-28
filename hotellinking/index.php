<?php
if(isset($_SESSION)){
    session_destroy();
}
?>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <title>Login con singleton y pdo</title>
    <link href="content/login.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="error_alert"> <h2>Ha habido un error en el login</h2></div>
<div class="content">
    <div class="caja_login">
        <div class="login_usuario">
        <h2>Login</h2>
        <form class="form" action="controllers/Login.php?method=login" method="post">

            <label>Nick</label>
            <input type="text"  id="nick" name="nick" required="true" placeholder="Introduce tu nick" />

            <label>Password</label>
            <input type="password" name="password" required="true" placeholder="Introduce tu password" />

            <input type="submit" value="Login" />
        </form>
        </div>
        <div class="crear_usuario">
            <button id="signUp">Sign Up</button>
            <form id="form_signUp" action="controllers/Login.php?method=signUp" method="post">
                <label>Nick</label>
                <input type="text"  id="nick" name="nick" required="true" placeholder="Introduce tu nick" />

                <label>Password</label>
                <input type="password" name="password" required="true" placeholder="Introduce tu password" />

                <input type="submit" value="SignUp" />
            </form>
        </div>
    </div>
</div>
</body>
<script>
    var button = document.getElementById('signUp'); // Assumes element with id='button'

    button.onclick = function() {
        var div = document.getElementById('form_signUp');
        if (div.style.display !== 'block') {
            div.style.display = 'block';
        }
        else {
            div.style.display = 'none';
        }
    };

    function findGetParameter(parameterName) {
        var result = null,
            tmp = [];
        var items = location.search.substr(1).split("&");
        for (var index = 0; index < items.length; index++) {
            tmp = items[index].split("=");
            if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
        }
        return result;
    }

    function findErrorOnLogin(){
        if(findGetParameter("errorLogin") =="true") {
            document.getElementById('error_alert').style.display = 'block';
        }
        else{
            document.getElementById('error_alert').style.display = 'none';
        }
    }

    findErrorOnLogin();
</script>
</html>