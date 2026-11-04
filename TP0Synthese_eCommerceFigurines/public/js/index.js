document.querySelectorAll(".card .btn-details").forEach((element) => {
    element.addEventListener("click", (e) => {
        e.preventDefault(); // empeche au lien de rediriger

        let modale = document.querySelector("#figurineModal .modal-content");
        modale.innerHTML = "En chargement...";

        const href = e.currentTarget.href; // nous donne l'url a contacter

        // Appel au backend (a l'API)
        axios
            .get(href)
            .then((reponse) => {
                if (reponse.data) {
                    modale.innerHTML = reponse.data;
                } else {
                    modale.innerHTML = "Erreur: pas de données";
                }
            })
            .catch((error) => {
                console.error("Error details:", error);
                console.error("Error status:", error.response?.status);
                console.error("Error data:", error.response?.data);
                modale.innerHTML = `Erreur: ${error.message}`;
            });
    });
});
