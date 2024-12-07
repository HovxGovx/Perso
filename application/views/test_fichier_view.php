<!DOCTYPE html>
<html>
<head>
    <title>Afficher les fichiers PDF</title>
    <script>
        function changePdf() {
            var selectBox = document.getElementById('pdfSelect');
            var selectedValue = selectBox.options[selectBox.selectedIndex].value;

            // Utilisez le chemin complet du fichier sélectionné
            var pdfPath = "<?php echo base_url('A:/Stage/'); ?>" + selectedValue;

            // Mettez à jour l'attribut src de la balise <embed>
            document.getElementById('pdfContainer').innerHTML = '<embed src="' + pdfPath + '" type="application/pdf" width="100%" height="600px" />';
        }
    </script>
</head>
<body>
    <select id="pdfSelect" onchange="changePdf()">
        <option value="370694-codeigniter-le-framework-au-service-des-zeros.pdf">Fichier 1</option>
        <option value="370694-codeigniter-le-framework-au-service-des-zeros - Copie (2)">Fichier 2</option>
        <option value="370694-codeigniter-le-framework-au-service-des-zeros - Copie">Fichier 3</option>
    </select>

    <div id="pdfContainer">
       javascript vas le genere automatiquement.
    </div>
</body>
</html>