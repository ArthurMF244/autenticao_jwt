const form = document.querySelector("form");

form.addEventListener("submit", async function(event) {

    event.preventDefault();

    const formData = new FormData(form);

    const response = await fetch("auth_app.php", {
        method: "POST",
        body: formData
    });

    const json = await response.json();

    if (json.status === "OK") {

        // toast de sucesso direto
        Swal.fire({
            toast: true,
            icon: "success",
            position: "top-end",
            title: json.msg,
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true
        });

        setTimeout(() => form.submit(), 1000);

    } else {

        // toast de erro direto
        Swal.fire({
            toast: true,
            icon: "error",
            position: "top-end",
            title: json.msg,
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true
        });
    }
});
