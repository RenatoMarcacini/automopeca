<?php require("./components/header.php") ?>

<form id="login_formulario" action="#" method="post">
    <h3><i class="fa fa-user-circle" aria-hidden="true"></i> Login</h3>
    <div class="form-group">
        <label for="exampeInputEmail1">Email <i class="fa fa-envelope" aria-hidden="true"></i></label>
        <input id="email" name="email" type="email" class="form-control" aria-describedby="emailHelp" placeholder="Digite seu email...">
    </div>
    <div class="form-group">
        <label for="">Senha <i class="fa fa-unlock-alt" aria-hidden="true"></i></label>
        <input id="password" name="password" type="password" class="form-control" placeholder="Digite sua senha...">
    </div>
    <span class="erro"></span>

    <div class="d-flex flex-row-reverse">
        <button type="submit" class="btn btn-primary">Entrar</button>
    </div>
</form>

<?php require("./components/footer.php") ?>

<script>
    $(function() {
        $("#login_formulario").submit((event) => {
            let erro = $(".erro");
            let iconErro = '<i class="fa fa-frown-o" aria-hidden="true"></i> ';

            erro.html("");

            let email = $("#email").val();
            let password = $("#password").val();

            if (!email || !password) {
                erro.html(iconErro + "Por favor, preencha todos os campos.");
                return false;
            }

            var regex = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
            if (!regex.test(email)) {
                erro.html(iconErro + "Por favor, digite um email valido.");
                return false;
            }

            $.ajax({
                url: './dao/authentication.php',
                method: 'POST',
                data: {
                    email: email,
                    password: password
                },
                dataType: 'JSON',
                success: function(data) {

                    if (data) {
                        window.location = "dashboard.php";
                    } else {
                        erro.html(iconErro + "Usuário ou senha incorreto.");
                    }

                },
                error: function(error) {
                    console.log("Erro");
                    console.log(error.message);
                    console.log(error.status);
                }
            });
            event.preventDefault();

        });
    });
</script>