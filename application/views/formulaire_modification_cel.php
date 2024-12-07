<!-- Formulaire de Modification de CEL -->
<div class="modal fade" id="modalModification"  aria-labelledby="exampleModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modifier les données du CEL</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= site_url('celController/modifierDonneesCel'); ?>" method="post">
                    <input type="hidden" name="idcel" id="idcel" value="">
                    <div class="mb-3">
                        <label for="date_descente" class="form-label">Date Descente</label>
                        <input type="date" class="form-control" id="date_descente" name="date_descente" required>
                    </div>
                    <div class="mb-3">
                        <label for="resume_pv" class="form-label">Résumé PV</label>
                        <input type="text" class="form-control" id="resume_pv" name="resume_pv" required>
                    </div>
                    <div class="mb-3">
                        <label for="consistance" class="form-label">Consistance</label>
                        <input type="text" class="form-control" id="consistance" name="consistance">
                    </div>
                    <div class="mb-3">
                        <label for="auteur" class="form-label">Auteur</label>
                        <input type="text" class="form-control" id="auteur" name="auteur">
                    </div>
                    <div class="mb-3">
                        <label for="date_mise_valeur" class="form-label">Date Mise en Valeur</label>
                        <input type="text" class="form-control" id="date_mise_valeur" name="date_mise_valeur">
                    </div>
                    <div class="mb-3">
                        <label for="opposition" class="form-label">Opposition</label>
                        <input type="text" class="form-control" id="opposition" name="opposition" required>
                    </div>
                    <div class="mb-3">
                        <label for="avis_cel" class="form-label">Avis CEL</label>
                        <input type="text" class="form-control" id="avis_cel" name="avis_cel">
                    </div>
                    <div class="mb-3">
                        <label for="avis_srat" class="form-label">Avis SRAT</label>
                        <input type="text" class="form-control" id="avis_srat" name="avis_srat">
                    </div>
                    <div class="mb-3">
                        <label for="avis_eauforet" class="form-label">Avis Eau et Forêt</label>
                        <input type="text" class="form-control" id="avis_eauforet" name="avis_eauforet">
                    </div>
                    <div class="mb-3">
                        <label for="avis_tp" class="form-label">Avis TP</label>
                        <input type="text" class="form-control" id="avis_tp" name="avis_tp">
                    </div>
                    <div class="mb-3">
                        <label for="avis_autre" class="form-label">Autres Avis</label>
                        <input type="text" class="form-control" id="avis_autre" name="avis_autre">
                    </div>
                    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                </form>
            </div>
        </div>
    </div>
</div>
