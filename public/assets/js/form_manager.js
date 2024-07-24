document.addEventListener("DOMContentLoaded", function () {
    dimensionsFixer();
    etageSelectors();
    maisonInputsAppendingAfterRefresh();
    maisonInputsAppending();
    toggleOtherSelect();
    checkNPI(
        `identite_proprietaire_0`,
        `npi_proprietaire_0`,
        `npi_proprietaire_0`
    );
    addProprietaire();
    let checked = document.getElementById("etageOui").checked;
    if (checked) {
        document.getElementById("nbre_etages_group").classList.remove("d-none");
    }
    appendFormAfterRefresh();
});

function dimensionsFixer() {
    const formeToSides = {
        Carré: 4,
        Rectangle: 4,
        Losange: 4,
        Trapèze: 4,
        Triangle: 3,
    };

    document
        .getElementById("forme_geometrique")
        .addEventListener("change", function () {
            const selectedForme = this.value;
            const dimensionsSection =
                document.getElementById("dimensionsSection");
            const dimensionsInputs =
                document.getElementById("dimensionsInputs");
            const dimensionsField = document.getElementById("dimensions");

            if (selectedForme) {
                const sides = formeToSides[selectedForme] || 0;
                dimensionsInputs.innerHTML = "";

                for (let i = 1; i <= sides; i++) {
                    const colSize = Math.floor(12 / sides);
                    const inputDiv = document.createElement("div");
                    inputDiv.className = `col-md-${colSize}`;
                    inputDiv.innerHTML = `<input type="number" class="form-control" placeholder="côté ${i} en mètre" data-side="${i}">`;
                    dimensionsInputs.appendChild(inputDiv);
                }
                dimensionsSection.classList.remove("d-none");
                drawShape(selectedForme);
            } else {
                dimensionsSection.classList.add("d-none");
                dimensionsField.style.visibility = "hidden";
                dimensionsInputs.innerHTML = "";
                dimensionsField.value = "";
            }
        });

    document
        .getElementById("dimensionsInputs")
        .addEventListener("input", function (event) {
            const inputs = this.querySelectorAll("input");
            const values = Array.from(inputs)
                .map((input) => `${input.value} mètre`)
                .filter((value) => value.trim() !== "mètre");
            document.getElementById("dimensions").value = values.join(", ");
        });
}

function etageSelectors() {
    document.getElementById("etageOui").addEventListener("change", function () {
        document.getElementById("nbre_etages_group").classList.remove("d-none");
    });

    document.getElementById("etageNon").addEventListener("change", function () {
        document.getElementById("nbre_etages_group").classList.add("d-none");
        document.getElementById("nbre_etages").value = ""; // Clear the input value
    });
}

function maisonInputsAppending() {
    const types = ["Commerciale", "Habitation"];
    document
        .getElementById("nbre_maisons_location")
        .addEventListener("input", function () {
            const container = document.getElementById("maison-content");
            container.innerHTML = ""; // Clear existing content
            const count = parseInt(this.value);

            if (!isNaN(count) && count > 0) {
                document
                    .getElementById("section-cols")
                    .classList.remove("d-none");
                for (let i = 0; i < count; i++) {
                    const maisonGroup = document.createElement("div");
                    maisonGroup.classList.add(
                        "maison-group",
                        "border",
                        "p-3",
                        "mb-3"
                    );
                    maisonGroup.innerHTML = `
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="type_usage_${i}">Type d’utilisation*</label>
                                    <select name="maisons[${i}][type_usage]" id="type_usage_${i}" class="form-control">
                                        <option value="" selected hidden>Sélectionnez un type d'usage</option>
                                        ${types
                                            .map(
                                                (type) =>
                                                    `<option value="${type}">${type}</option>`
                                            )
                                            .join("")}
                                    </select>
                                </div>
                                <div class="form-group col-md-8 d-none" id="description_activite_group_${i}">
                                    <label for="description_activite_${i}">Description activité</label>
                                    <input type="text" class="form-control" placeholder="Veuillez décrire l’activité réalisée" id="description_activite_${i}" name="maisons[${i}][description_activite]">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="caracteristiques_${i}">Caracteristiques</label>
                                    <input type="text" class="form-control" placeholder="Local, studio, hangar, nombre de chambres et autres..." id="caracteristiques_${i}" name="maisons[${i}][caracteristiques]">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="montant_loyer_${i}">Montant du loyer *</label>
                                    <div class="d-flex">
                                        <input type="number" name="maisons[${i}][montant_loyer]" class="form-control mr-2 w-100" placeholder="Entrez montant du loyer">
                                        <select name="maisons[${i}][montant_loyer_devise]" class="form-control" style="width: 120px">
                                            <option value="CDF" selected>CDF</option>
                                            <option value="USD">USD</option>
                                            <option value="EURO">EURO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 col-6">
                                    <div class="form-group radio_input">
                                        <label for="contrat_bail_${i}">Contrat du bail:</label>
                                        <label class="container_radio mr-3">Non
                                            <input type="radio" id="bailNon_${i}" name="maisons[${i}][contrat_bail]" value="non" required>
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="container_radio">Oui
                                            <input type="radio" id="bailOui_${i}" checked name="maisons[${i}][contrat_bail]" value="oui" required>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="duree_occupation_${i}">Durée actuelle d'occupation **</label>
                                    <div class="d-flex">
                                        <input type="number" name="maisons[${i}][duree_occupation]" class="form-control mr-2 w-100" placeholder="Entrez la durée">
                                        <select name="maisons[${i}][duree_occupation_unite]" class="form-control" style="width: 120px">
                                            <option value="Jours" selected>Jours</option>
                                            <option value="Mois">Mois</option>
                                            <option value="Années">Années</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="locataire_nom_${i}">Nom du locataire</label>
                                    <input type="text" class="form-control" id="locataire_nom_${i}" placeholder="Entrez le nom du locataire" name="maisons[${i}][locataire][nom]">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="locataire_prenom_${i}">Prénom du locataire</label>
                                    <input type="text" placeholder="Entrez le prénom du locataire" class="form-control" id="locataire_prenom_${i}" name="maisons[${i}][locataire][prenom]">
                                </div>
                                <div class="col-md-4 col-6">
                                    <div class="form-group radio_input">
                                        <label for="locataire_genre_${i}">Genre :</label>
                                        <label class="container_radio mr-3">Homme
                                            <input type="radio" id="locataire_male_${i}" name="maisons[${i}][locataire][sexe]" value="M" required>
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="container_radio">Femme
                                            <input type="radio" id="locataire_female_${i}" name="maisons[${i}][locataire][sexe]" value="F" required>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="locataire_phone_${i}">Téléphone</label>
                                    <input type="text" class="form-control" placeholder="Entrez le téléphone du locataire" id="locataire_phone_${i}" name="maisons[${i}][locataire][telephone]">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="locataire_npi_${i}">NPI Locataire</label>
                                    <input type="text" class="form-control" id="locataire_npi_${i}" placeholder="Entrez le NPI du locataire" name="maisons[${i}][locataire][nip_locataire]">
                                </div>
                            </div>
                        `;
                    container.appendChild(maisonGroup);

                    document
                        .getElementById(`type_usage_${i}`)
                        .addEventListener("change", function () {
                            const descriptionGroup = document.getElementById(
                                `description_activite_group_${i}`
                            );
                            if (this.value === "Commerciale") {
                                descriptionGroup.classList.remove("d-none");
                            } else {
                                descriptionGroup.classList.add("d-none");
                            }
                        });
                }
            } else {
                document.getElementById("section-cols").classList.add("d-none");
            }
        });
}

function maisonInputsAppendingAfterRefresh() {
    const types = ["Commerciale", "Habitation"];
    const value = document.getElementById("nbre_maisons_location").value;
    const container = document.getElementById("maison-content");
    const count = parseInt(value);
    container.innerHTML = "";

    if (!isNaN(count) && count > 0) {
        document.getElementById("section-cols").classList.remove("d-none");
        for (let i = 0; i < count; i++) {
            const maisonGroup = document.createElement("div");
            maisonGroup.classList.add("maison-group", "border", "p-3", "mb-3");
            maisonGroup.innerHTML = `
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="type_usage_${i}">Type d’utilisation*</label>
                                    <select name="maisons[${i}][type_usage]" id="type_usage_${i}" class="form-control">
                                        <option value="" selected hidden>Sélectionnez un type d'usage</option>
                                        ${types
                                            .map(
                                                (type) =>
                                                    `<option value="${type}">${type}</option>`
                                            )
                                            .join("")}
                                    </select>
                                </div>
                                <div class="form-group col-md-8 d-none" id="description_activite_group_${i}">
                                    <label for="description_activite_${i}">Description activité</label>
                                    <input type="text" class="form-control" placeholder="Veuillez décrire l’activité réalisée" id="description_activite_${i}" name="maisons[${i}][description_activite]">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="caracteristiques_${i}">Caracteristiques</label>
                                    <input type="text" class="form-control" placeholder="Local, studio, hangar, nombre de chambres et autres..." id="caracteristiques_${i}" name="maisons[${i}][caracteristiques]">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="montant_loyer_${i}">Montant du loyer *</label>
                                    <div class="d-flex">
                                        <input type="number" name="maisons[${i}][montant_loyer]" class="form-control mr-2 w-100" placeholder="Entrez montant du loyer">
                                        <select name="maisons[${i}][montant_loyer_devise]" class="form-control" style="width: 120px">
                                            <option value="CDF" selected>CDF</option>
                                            <option value="USD">USD</option>
                                            <option value="EURO">EURO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 col-6">
                                    <div class="form-group radio_input">
                                        <label for="contrat_bail_${i}">Contrat du bail:</label>
                                        <label class="container_radio mr-3">Non
                                            <input type="radio" id="bailNon_${i}" name="maisons[${i}][contrat_bail]" value="non" required>
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="container_radio">Oui
                                            <input type="radio" id="bailOui_${i}" checked name="maisons[${i}][contrat_bail]" value="oui" required>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="duree_occupation_${i}">Durée actuelle d'occupation **</label>
                                    <div class="d-flex">
                                        <input type="number" name="maisons[${i}][duree_occupation]" class="form-control mr-2 w-100" placeholder="Entrez la durée">
                                        <select name="maisons[${i}][duree_occupation_unite]" class="form-control" style="width: 120px">
                                            <option value="Jours" selected>Jours</option>
                                            <option value="Mois">Mois</option>
                                            <option value="Années">Années</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="locataire_nom_${i}">Nom du locataire</label>
                                    <input type="text" class="form-control" id="locataire_nom_${i}" placeholder="Entrez le nom du locataire" name="maisons[${i}][locataire][nom]">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="locataire_prenom_${i}">Prénom du locataire</label>
                                    <input type="text" placeholder="Entrez le prénom du locataire" class="form-control" id="locataire_prenom_${i}" name="maisons[${i}][locataire][prenom]">
                                </div>
                                <div class="col-md-4 col-6">
                                    <div class="form-group radio_input">
                                        <label for="locataire_genre_${i}">Genre :</label>
                                        <label class="container_radio mr-3">Homme
                                            <input type="radio" id="locataire_male_${i}" name="maisons[${i}][locataire][sexe]" value="M" required>
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="container_radio">Femme
                                            <input type="radio" id="locataire_female_${i}" name="maisons[${i}][locataire][sexe]" value="F" required>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="locataire_phone_${i}">Téléphone</label>
                                    <input type="text" class="form-control" placeholder="Entrez le téléphone du locataire" id="locataire_phone_${i}" name="maisons[${i}][locataire][telephone]">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="locataire_npi_${i}">NPI Locataire</label>
                                    <input type="text" class="form-control" id="locataire_npi_${i}" placeholder="Entrez le NPI du locataire" name="maisons[${i}][locataire][nip_locataire]">
                                </div>
                            </div>
                        `;
            container.appendChild(maisonGroup);

            document
                .getElementById(`type_usage_${i}`)
                .addEventListener("change", function () {
                    const descriptionGroup = document.getElementById(
                        `description_activite_group_${i}`
                    );
                    if (this.value === "Commerciale") {
                        descriptionGroup.classList.remove("d-none");
                    } else {
                        descriptionGroup.classList.add("d-none");
                    }
                });
        }
    } else {
        document.getElementById("section-cols").classList.add("d-none");
    }
}

function toggleOtherSelect() {
    const titreSelect = document.getElementById("titreSelect");
    const otherTitleGroup = document.getElementById("otherTitleGroup");
    const otherTitleInput = document.getElementById("otherTitleInput");
    const toggleButton = document.getElementById("toggleButton");
    const formGroup = titreSelect.closest(".form-group");

    titreSelect.addEventListener("change", function () {
        if (this.value === "Autre") {
            this.classList.add("d-none");
            otherTitleGroup.classList.remove("d-none");
            otherTitleInput.required = true; // Make input required
            otherTitleInput.focus();
            otherTitleInput.setAttribute("name", "type_titre"); // Set the correct name for form submission
            titreSelect.removeAttribute("name"); // Remove the name attribute from the select
        } else {
            otherTitleInput.required = false;
            otherTitleInput.removeAttribute("name"); // Remove the name attribute from the input
            titreSelect.setAttribute("name", "type_titre"); // Set the correct name for form submission
        }
    });

    toggleButton.addEventListener("click", function () {
        titreSelect.classList.remove("d-none");
        otherTitleGroup.classList.add("d-none");
        otherTitleInput.value = ""; // Clear the input value
        otherTitleInput.required = false; // Make input not required
        titreSelect.value = ""; // Reset the select value
        otherTitleInput.removeAttribute("name"); // Remove the name attribute from the input
        titreSelect.setAttribute("name", "type_titre"); // Set the correct name for form submission
    });
}

function addProprietaire() {
    const addButton = document.querySelector(".add-proprietaire-button");
    const container = document.getElementById("proprietaire-section");
    let rowIndex = 1;

    addButton.addEventListener("click", function () {
        // Create a new form-row div
        const newFormRow = document.createElement("div");
        newFormRow.classList.add("form-row");

        // Create and configure the first form-group (select input)
        const formGroup1 = document.createElement("div");
        formGroup1.classList.add("form-group", "col-md-4");
        const label1 = document.createElement("label");
        label1.textContent = "Identification *";
        const select = document.createElement("select");
        select.name = `proprietaires[${rowIndex}][type_proprietaire]`;
        select.classList.add("form-control");
        const option1 = document.createElement("option");
        option1.value = "Propriétaire";
        option1.textContent = "Propriétaire";
        const option2 = document.createElement("option");
        option2.value = "Co-Propriétaire";
        option2.textContent = "Co-Propriétaire";
        const option3 = document.createElement("option");
        option3.value = "Héritier";
        option3.textContent = "Héritier";
        select.appendChild(option1);
        select.appendChild(option2);
        select.appendChild(option3);
        formGroup1.appendChild(label1);
        formGroup1.appendChild(select);

        // Create and configure the second form-group (text input)
        const formGroup2 = document.createElement("div");
        formGroup2.classList.add("form-group", "col-md-4");
        const label2 = document.createElement("label");
        label2.textContent = "Numéro d'Identification Nationale *";
        const input1 = document.createElement("input");
        input1.type = "text";
        input1.placeholder = "Entrez le NPI...";
        input1.classList.add("form-control");
        input1.name = `proprietaires[${rowIndex}][npi_proprietaire]`;
        input1.id = `npi_proprietaire_${rowIndex}`;
        formGroup2.appendChild(label2);
        formGroup2.appendChild(input1);

        // Create and configure the third form-group (readonly input)
        const formGroup3 = document.createElement("div");
        formGroup3.classList.add("form-group", "col-md-4");
        const label3 = document.createElement("label");
        label3.htmlFor = "assureur";
        label3.innerHTML =
            'Identité <sup class="text-primary">infos de NPI</sup>';
        const input2 = document.createElement("input");
        input2.type = "text";
        input2.classList.add("form-control");
        input2.readOnly = true;
        input2.id = `identite_proprietaire_${rowIndex}`;
        formGroup3.appendChild(label3);
        formGroup3.appendChild(input2);

        // Append form-groups to the new form-row
        newFormRow.appendChild(formGroup1);
        newFormRow.appendChild(formGroup2);
        newFormRow.appendChild(formGroup3);

        // Append the new form-row to the container
        container.appendChild(newFormRow);

        // Initialize the NPI check function for the new input
        checkNPI(
            `identite_proprietaire_${rowIndex}`,
            `npi_proprietaire_${rowIndex}`,
            `npi_proprietaire_${rowIndex}`
        );
        // Increment the row index
        rowIndex++;
    });
}

function checkNPI(section, sectionInputID, inputID) {
    const nipInput = document.getElementById(inputID);
    const input = document.getElementById(section);
    let loader; // Variable pour stocker le loader

    // Fonction pour effectuer la requête
    function fetchNPIData(nip) {
        // Ajouter le loader
        loader = document.createElement("div");
        loader.classList.add(
            "spinner-border",
            "spinner-border-sm",
            "text-primary",
            "mr-2"
        );
        nipInput.parentNode.insertBefore(loader, nipInput.nextSibling);

        fetch(
            `https://formulaireidnat.groupepaixservice.net/api/check.npi/${nip}`
        )
            .then((response) => response.json())
            .then((data) => {
                // Retirer le loader
                if (loader) {
                    loader.remove();
                }

                if (data.status === "success" && data.personne) {
                    const personne = data.personne;
                    const nomComplet = `${personne.nom} ${personne.postnom} ${personne.prenom}`;
                    input.value = nomComplet;
                } else {
                    input.value = "";
                }
            })
            .catch((error) => {
                // Retirer le loader en cas d'erreur
                if (loader) {
                    loader.remove();
                }
                input.value = "";
            });
    }

    // Vérifier si l'input contient déjà une donnée lors du chargement de la page
    const initialNip = nipInput.value;
    if (initialNip.length > 4) {
        fetchNPIData(initialNip);
    }

    nipInput.addEventListener("input", function () {
        const nip = this.value;
        if (nip.length > 4) {
            // Supprimer les loaders précédemment ajoutés
            if (loader) {
                loader.remove();
            }
            fetchNPIData(nip);
        }
    });
}

function appendFormAfterRefresh() {
    const formeToSides = {
        Carré: 4,
        Rectangle: 4,
        Losange: 4,
        Trapèze: 4,
        Triangle: 3,
    };
    const value = document.getElementById("forme_geometrique").value;
    const dimensionsSection = document.getElementById("dimensionsSection");
    const dimensionsInputs = document.getElementById("dimensionsInputs");
    if (value !== "") {
        drawShape(value);
        const sides = formeToSides[value] || 0;
        dimensionsInputs.innerHTML = "";
        for (let i = 1; i <= sides; i++) {
            const colSize = Math.floor(12 / sides);
            const inputDiv = document.createElement("div");
            inputDiv.className = `col-md-${colSize}`;
            inputDiv.innerHTML = `<input type="number" class="form-control" placeholder="côté ${i} en mètre" data-side="${i}">`;
            dimensionsInputs.appendChild(inputDiv);
        }
        dimensionsSection.classList.remove("d-none");
    }
}

function drawShape(forme) {
    const viewer = document.getElementById("formes-draw");
    const canvas = document.getElementById("shapeCanvas");
    const ctx = canvas.getContext("2d");
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    const centerX = canvas.width / 2;
    const centerY = canvas.height / 2;
    const size = 60;
    viewer.classList.add("d-none");
    if (forme === "Carré" || forme === "Rectangle") {
        viewer.classList.remove("d-none");
        drawRectangle(
            centerX,
            centerY,
            size,
            forme === "Carré" ? size : size / 2
        );
    } else if (forme === "Triangle") {
        viewer.classList.remove("d-none");
        drawTriangle(centerX, centerY, size);
    } else if (forme === "Losange") {
        viewer.classList.remove("d-none");
        drawLosange(centerX, centerY, size);
    } else if (forme === "Trapèze") {
        viewer.classList.remove("d-none");
        drawTrapezoid(centerX, centerY, size);
    }
}

function drawRectangle(x, y, width, height) {
    const canvas = document.getElementById("shapeCanvas");
    const ctx = canvas.getContext("2d");
    const increment = 5;
    let currentWidth = 0;
    let currentHeight = 0;
    function animate() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        ctx.strokeRect(
            x - currentWidth / 2,
            y - currentHeight / 2,
            currentWidth,
            currentHeight
        );
        if (currentWidth < width) currentWidth += increment;
        if (currentHeight < height) currentHeight += increment;
        if (currentWidth < width || currentHeight < height) {
            requestAnimationFrame(animate);
        }
    }
    animate();
}

function drawTriangle(x, y, size) {
    const canvas = document.getElementById("shapeCanvas");
    const ctx = canvas.getContext("2d");
    const increment = 5;
    let currentSize = 0;

    function animate() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        ctx.beginPath();
        ctx.moveTo(x, y - currentSize / 2);
        ctx.lineTo(x - currentSize / 2, y + currentSize / 2);
        ctx.lineTo(x + currentSize / 2, y + currentSize / 2);
        ctx.closePath();
        ctx.stroke();
        if (currentSize < size) {
            currentSize += increment;
            requestAnimationFrame(animate);
        }
    }
    animate();
}

function drawLosange(x, y, size) {
    const canvas = document.getElementById("shapeCanvas");
    const ctx = canvas.getContext("2d");
    const increment = 5;
    let currentSize = 0;

    function animate() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        ctx.beginPath();
        ctx.moveTo(x, y - currentSize / 2);
        ctx.lineTo(x - currentSize / 2, y);
        ctx.lineTo(x, y + currentSize / 2);
        ctx.lineTo(x + currentSize / 2, y);
        ctx.closePath();
        ctx.stroke();
        if (currentSize < size) {
            currentSize += increment;
            requestAnimationFrame(animate);
        }
    }
    animate();
}

function drawTrapezoid(x, y, size) {
    const canvas = document.getElementById("shapeCanvas");
    const ctx = canvas.getContext("2d");
    const increment = 5;
    let currentSize = 0;

    function animate() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        ctx.beginPath();
        ctx.moveTo(x - currentSize / 2, y + currentSize / 4);
        ctx.lineTo(x + currentSize / 2, y + currentSize / 4);
        ctx.lineTo(x + currentSize / 4, y - currentSize / 4);
        ctx.lineTo(x - currentSize / 4, y - currentSize / 4);
        ctx.closePath();
        ctx.stroke();
        if (currentSize < size) {
            currentSize += increment;
            requestAnimationFrame(animate);
        }
    }
    animate();
}

function labelRectangle(x, y, width, height) {
    ctx.font = "14px Arial";
    ctx.fillText("1", x, y - height / 2 - 10);
    ctx.fillText("2", x + width / 2 + 10, y);
    ctx.fillText("3", x, y + height / 2 + 20);
    ctx.fillText("4", x - width / 2 - 20, y);
}

function labelLosange(x, y, size) {
    ctx.font = "16px Arial";
    ctx.fillStyle = "black";
    ctx.fillText("1", x - 10, y - size / 2 - 10); // top
    ctx.fillText("2", x - size / 2 - 30, y + 5); // left
    ctx.fillText("3", x - 10, y + size / 2 + 20); // bottom
    ctx.fillText("4", x + size / 2 + 10, y + 5); // right
}

function labelTriangle(x, y, size) {
    ctx.font = "16px Arial";
    ctx.fillStyle = "black";
    ctx.fillText("1", x - 10, y - size / 2 - 10); // top corner
    ctx.fillText("2", x - size / 2 - 20, y + size / 2); // bottom-left corner
    ctx.fillText("3", x + size / 2 + 10, y + size / 2); // bottom-right corner
}

function labelTrapezoid(x, y, size) {
    ctx.font = "16px Arial";
    ctx.fillStyle = "black";
    ctx.fillText("1", x - size / 2 - 10, y + size / 4 + 10); // bottom-left
    ctx.fillText("2", x + size / 2, y + size / 4 + 10); // bottom-right
    ctx.fillText("3", x + size / 4 + 5, y - size / 4 - 10); // top-right
    ctx.fillText("4", x - size / 4 - 20, y - size / 4 - 10); // top-left
}
