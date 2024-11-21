document.addEventListener('DOMContentLoaded', function () {
    const juridictionSelect = document.querySelector('select[name="Audience[juridiction]"]');
    const chambreSelect = document.querySelector('select[name="Audience[chambre]"]');

    if (juridictionSelect && chambreSelect) {
        juridictionSelect.addEventListener('change', function () {
            const juridictionId = juridictionSelect.value;
            console.log('Juridiction ID sélectionné:', juridictionId);

            // Si une juridiction est sélectionnée
            if (juridictionId) {
                // Appel AJAX pour récupérer les chambres
                fetch(`/admin/filtrer-chambres/${juridictionId}`)
                    .then(response => response.json())
                    .then(data => {
                        console.log('Chambres reçues:', data);

                        // Vider les options de la chambre
                        chambreSelect.innerHTML = '';

                        // Ajouter une option vide ou un message par défaut
                        const defaultOption = document.createElement('option');
                        defaultOption.value = '';
                        defaultOption.textContent = 'Sélectionnez une chambre';
                        chambreSelect.appendChild(defaultOption);

                        // Vérifier si des chambres ont été récupérées
                        if (data.length > 0) {
                            // Ajouter les options récupérées via AJAX
                            data.forEach(chambre => {
                                const option = document.createElement('option');
                                option.value = chambre.id;
                                option.textContent = chambre.nom;
                                chambreSelect.appendChild(option);
                            });
                        } else {
                            // Si aucune chambre n'est disponible, ajouter une option indiquant cela
                            const noChambreOption = document.createElement('option');
                            noChambreOption.value = '';
                            noChambreOption.textContent = 'Aucune chambre disponible';
                            chambreSelect.appendChild(noChambreOption);
                        }
                    })
                    .catch(error => {
                        console.error('Erreur AJAX:', error);
                    });
            } else {
                // Si aucune juridiction n'est sélectionnée, vider le champ chambre
                chambreSelect.innerHTML = '';
                const defaultOption = document.createElement('option');
                defaultOption.value = '';
                defaultOption.textContent = 'Sélectionnez une chambre';
                chambreSelect.appendChild(defaultOption);
            }
        });
    }
});
