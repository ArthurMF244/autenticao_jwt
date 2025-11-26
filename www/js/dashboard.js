function copiarToken() {
    const token = document.getElementById("jwtToken").value.trim();

    if (!token) {
        Swal.fire({
            icon: "error",
            title: "Erro",
            text: "Nenhum token encontrado.",
            confirmButtonColor: "#4b7bec"
        });
        return;
    }

    navigator.clipboard.writeText(token)
    .then(() => {
        Swal.fire({
            icon: "success",
            title: "Token copiado!",
            text: "O token JWT foi copiado para a área de transferência.",
            confirmButtonColor: "#4b7bec",
            timer: 2000
        });
    })
    .catch(() => {
        Swal.fire({
            icon: "error",
            title: "Erro ao copiar!",
            text: "Não foi possível copiar o token.",
            confirmButtonColor: "#d9534f"
        });
    });
}

function abrirModalCadastro() {
    document.getElementById("overlay").classList.remove("hidden");
    document.getElementById("modalCadastro").classList.remove("hidden");
}

document.getElementById("overlay").addEventListener("click", fecharModalCadastro);

function fecharModalCadastro() {
    document.getElementById("overlay").classList.add("hidden");
    document.getElementById("modalCadastro").classList.add("hidden");
}

function salvarNovoUsuario() {
    const nome = document.getElementById("cad_nome").value.trim();
    const email = document.getElementById("cad_email").value.trim();
    const user = document.getElementById("cad_user").value.trim();
    const senha = document.getElementById("cad_senha").value.trim();

    if (!nome || !email || !user || !senha) {
        Swal.fire("Atenção", "Preencha todos os campos!", "warning");
        return;
    }

    fetch("create_user.php", {
        method: "POST",
        body: new URLSearchParams({
            nome,
            email,
            user,
            senha
        })
    })
    .then(res => res.json())
    .then(json => {
        Swal.fire(json.status === "OK" ? "Sucesso" : "Erro", json.msg, json.status === "OK" ? "success" : "error");

        if (json.status === "OK") {
            fecharModalCadastro();
        }
    });
}
