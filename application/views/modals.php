<!-- Section Constat d'etat des lieux -->
<section class="formulaircel">
    <div class="modal fade" id="EnvModalContent" tabindex="-3" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" style="max-width: 400px;" role="document">
            <div class="modal-content">
                <div class="modal-body" style="background-color: white">
                    <div class="grandTitre">
                        <h2 class="mb-4" style="color:green">Transfert de dossier</h2>
                    </div>
                    <form action="#" method="post" id="formulaire_celTrans" enctype="multipart/form-data">
                        <!-- Étape 1 -->
                        <div class="etape" id="etape1">
                            <div class="form-group">
                                <label for="id_dossier">Numéro dossier: </label>
                                <input class="form-control d-none" name="id_dossierTrans" type="hidden" class="form-control" id="id_dossierTrans">
                                <input class="form-control" type="hidden" class="form-control" name="numdossierTrans" id="numdossierTrans" Disabled>
                            </div>
                            <div class="form-group">
                                <label for="date_descenteTrans">Date Descente :</label>
                                <input class="form-control" type="date" id="date_descenteTrans" name="date_descenteTrans" required>
                            </div>
                            <div class="mb-3">
                                <label for="type_terrainmodifTrans" class="form-label">autorités</label>
                                <select id="type_terrainmodifTrans">
                                    <option value="1">Pour avis CCDF</option>
                                    <option value="2">Pour avis SRD</option>
                                    <option value="3">Pour avis SDC</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" id="etape_suivanteTrans" class="btn btn-primary ">Enregistrer</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>