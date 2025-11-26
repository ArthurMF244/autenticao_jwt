<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Identificar Aplicação</title>
    <link rel="stylesheet" href="css/style.css">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

</head>
<body>

    <div class="card">

        <h2><i class="bi bi-shield-lock-fill"></i> Identificar Aplicação</h2>

        <form method="POST" action="login_form.php">

            <label>Client ID</label>
            <div class="div-cliente-id">
                <span class="input-icon"><i class="bi bi-key"></i></span>
                <input type="text" name="clientID" value="batman" required>
            </div>

            <label>Client Secret</label>
            <div class="div-cliente-secret">
                <span class="input-icon"><i class="bi bi-lock-fill"></i></span>
                <input type="password" name="clientSecret" value="arthur123" required>
            </div>

            <button type="submit" class="btn">
                <i class="bi bi-check-circle"></i> Validar Aplicação
            </button>
        </form>

    </div>

    <script src="js/script.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>
</html>
