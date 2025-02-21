<div class="content">
    <div class="container-fluid">
        <form id="excelForm"  method="post" enctype="multipart/form-data">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title text-center"><i class="fas fa-file-excel"></i> Subir Archivo Excel</h5>

                    <!-- Subir archivo -->
                    <div class="form-group text-center">
                        <input type="file" id="excelFile" name="excelFile" accept=".xls,.xlsx" required hidden>
                        <label for="excelFile" class="upload-btn">
                            <i class="fas fa-upload"></i> Seleccionar Archivo
                        </label>
                        <p id="file-name" class="text-muted mt-2">Ningún archivo seleccionado</p>
                        <div class="invalid-feedback">Por favor, seleccione un archivo Excel.</div>
                    </div>

                    <!-- Vista previa -->
                    <div class="form-group">
                        <label><i class="fas fa-eye"></i> Vista Previa</label>
                        <div id="preview-container" class="preview-box">
                            <p class="text-muted">Aún no se ha seleccionado ningún archivo.</p>
                            <table id="preview-table" class="table table-striped table-bordered" style="display: none;">
                                <thead>
                                    <tr id="preview-header"></tr>
                                </thead>
                                <tbody id="preview-body"></tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card-footer text-center">
                    <button type="submit" class="upload-submit-btn"><i class="fas fa-cloud-upload-alt"></i> Subir Archivo</button>
                </div>
            </div>
        </form>
        <?php
        // Controlador para agregar el usuario
        $upload = new FileController();
        $upload->handleFileUpload();
        ?>
    </div>
</div>

<!-- CSS -->
<style>
/* Estilo general */
.card {
    border-radius: 10px;
    border: none;
}

.card-title {
    font-weight: bold;
    font-size: 1.2rem;
    color: #333;
}

/* Botón de selección de archivo */
.upload-btn {
    
    display: inline-block;
    background: linear-gradient(135deg, #28a745, #218838);
    color: white;
    padding: 12px 20px;
    font-size: 16px;
    font-weight: bold;
    border-radius: 30px;
    cursor: pointer;
    transition: all 0.3s ease-in-out;
   margin-top: 20px;

}

.upload-btn:hover {
    background: linear-gradient(135deg, #218838, #1e7e34);
    transform: scale(1.05);
}

/* Contenedor de vista previa */
.preview-box {
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 15px;
    background: #f9f9f9;
    max-height: 300px;
    overflow-y: auto;
}

/* Botón de subir archivo */
.upload-submit-btn {
    background: linear-gradient(135deg, #007bff, #0056b3);
    color: white;
    border: none;
    padding: 12px 20px;
    font-size: 16px;
    font-weight: bold;
    border-radius: 30px;
    cursor: pointer;
    transition: all 0.3s ease-in-out;
}

.upload-submit-btn:hover {
    background: linear-gradient(135deg, #0056b3, #004494);
    transform: scale(1.05);
}
</style>

<!-- Script para mostrar el nombre del archivo y vista previa -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.full.min.js"></script>
<script>
document.getElementById('excelFile').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        document.getElementById('file-name').textContent = file.name;
        
        const reader = new FileReader();
        reader.onload = function(e) {
            const data = new Uint8Array(e.target.result);
            const workbook = XLSX.read(data, { type: 'array' });
            const sheet = workbook.Sheets[workbook.SheetNames[0]];
            const json = XLSX.utils.sheet_to_json(sheet, { header: 1 });

            if (json.length > 0) {
                document.querySelector('#preview-container p').style.display = 'none';
                document.getElementById('preview-table').style.display = 'table';
                const headerRow = document.getElementById('preview-header');
                const bodyTable = document.getElementById('preview-body');
                headerRow.innerHTML = '';
                bodyTable.innerHTML = '';

                json[0].forEach(header => {
                    let th = document.createElement('th');
                    th.textContent = header;
                    headerRow.appendChild(th);
                });

                json.slice(1).forEach(row => {
                    let tr = document.createElement('tr');
                    row.forEach(cell => {
                        let td = document.createElement('td');
                        td.textContent = cell;
                        tr.appendChild(td);
                    });
                    bodyTable.appendChild(tr);
                });
            }
        };
        reader.readAsArrayBuffer(file);
    }
});
</script>
