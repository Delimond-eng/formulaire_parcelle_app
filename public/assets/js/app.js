document.addEventListener("DOMContentLoaded", function () {
    document
        .getElementById("province_id")
        .addEventListener("change", function () {
            const provinceId = this.value;
            fetch("/villes?province_id=" + provinceId)
                .then((response) => response.json())
                .then((data) => {
                    console.log(data);
                    let villeSelect = document.getElementById("ville_id");
                    cleanSelect("ville_id", "une ville");
                    cleanSelect("commune_id", "une commune");
                    cleanSelect("quartier_id", "un quartier");
                    data.forEach((ville) => {
                        let option = document.createElement("option");
                        option.value = ville.id;
                        option.textContent = ville.ville_libelle;
                        villeSelect.appendChild(option);
                    });
                });
        });

    document.getElementById("ville_id").addEventListener("change", function () {
        const villeId = this.value;
        fetch("/communes?ville_id=" + villeId)
            .then((response) => response.json())
            .then((data) => {
                let communeSelect = document.getElementById("commune_id");
                cleanSelect("commune_id", "une commune");
                cleanSelect("quartier_id", "un quartier");
                data.forEach((commune) => {
                    let option = document.createElement("option");
                    option.value = commune.id;
                    option.textContent = commune.commune_libelle;
                    communeSelect.appendChild(option);
                });
            });
    });

    document
        .getElementById("commune_id")
        .addEventListener("change", function () {
            const communeId = this.value;
            fetch("/quartiers?commune_id=" + communeId)
                .then((response) => response.json())
                .then((data) => {
                    let quartierSelect = document.getElementById("quartier_id");
                    cleanSelect("quartier_id", "un quartier");
                    data.forEach((q) => {
                        let option = document.createElement("option");
                        option.value = q.id;
                        option.textContent = q.quartier_libelle;
                        quartierSelect.appendChild(option);
                    });
                });
        });
});

function cleanSelect(selectId, message) {
    let select = document.getElementById(selectId);
    select.innerHTML = `<option value="" selected hidden>Sélectionner ${message}</option>`;
}
