document.addEventListener("DOMContentLoaded", () => {

    const form = document.querySelector("form");

    form.addEventListener("submit", async function(event) {
        event.preventDefault();

        const formData = new FormData(form);

        const response = await fetch("login.php", {
            method: "POST",
            body: formData
        });

        const json = await response.json();

        // Login OK
        if (json.status === "OK") {

            Swal.fire({
                toast: true,
                icon: "success",
                title: json.msg,
                position: "top-end",
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true
            });

            setTimeout(() => form.submit(), 1200);

        } else {

            Swal.fire({
                toast: true,
                icon: "error",
                title: json.msg,
                position: "top-end",
                showConfirmButton: false,
                timer: 2400,
                timerProgressBar: true
            });

        }

    });

});