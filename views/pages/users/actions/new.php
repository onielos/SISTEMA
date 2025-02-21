<div class="content">
    <div class="container-fluid">
        <form role="form" method="post" enctype="multipart/form-data" id="userForm" novalidate>
            <div class="card">
                <div class="card-body">
                    <!-- Nombre -->
                    <div class="form-group">
                        <label for="displayname"><i class="fas fa-user"></i> Nombre</label>
                        <input type="text" class="form-control" id="displayname" name="displayname" required>
                        <div class="invalid-feedback">Por favor, ingrese el nombre completo.</div>
                    </div>
                    
                    <!-- Usuario -->
                    <div class="form-group">
                        <label for="username"><i class="fas fa-user-circle"></i> Usuario</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                        <div class="invalid-feedback">Por favor, ingrese un nombre de usuario.</div>
                    </div>
                    
                    <!-- Contraseña -->
                    <div class="form-group">
                        <label for="password"><i class="fas fa-key"></i> Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                        <div class="invalid-feedback">Por favor, ingrese una contraseña.</div>
                    </div>
                    
                    <!-- Rol -->
                    <div class="form-group">
                        <label for="role"><i class="fas fa-user-tag"></i> Rol</label>
                        <select class="form-control" id="role" name="role" required>
                            <option value="">Seleccione el rol</option>
                            <option value="Administrador">Administrador</option>
                            <option value="Empleado">Empleado</option>
                        </select>
                        <div class="invalid-feedback">Por favor, seleccione un rol.</div>
                    </div>
                    
                    <!-- Foto -->
                    <div class="form-group">
                        <label for="photo"><i class="fas fa-image"></i> Foto de Perfil</label>
                        <input type="file" class="form-control-file" id="photo" name="picture" accept="image/*" onchange="previewImage(event)">
                        <div class="invalid-feedback">Por favor, seleccione una foto de perfil.</div>
                    </div>
                    
                    <!-- Vista Previa de Foto -->
                    <div class="form-group">
                        <div id="preview-container" class="border rounded p-3 text-center">
                            <p>Vista previa de la foto</p>
                            <img id="preview-img" src="" alt="Vista previa de la foto" style="max-width: 100%; max-height: 200px; display: none;">
                        </div>
                    </div>
                </div>

                <div class="card-footer text-right">
                    <button type="submit" class="btn bg-navy"><i class="fas fa-save"></i> Guardar Usuario</button>
                </div>
            </div>
        </form>

        <?php
        // Controlador para agregar el usuario
        $createUser = new UserController();
        $createUser->ctrCreateUser();
        ?>
    </div>
</div>

<script>
document.getElementById('userForm').addEventListener('submit', function(e) {
    e.preventDefault();
    let valid = true;

    // Validación de campos requeridos
    this.querySelectorAll('[required]').forEach(function(field) {
        if (field.value === '') {
            field.classList.add('is-invalid');
            valid = false;
        } else {
            field.classList.remove('is-invalid');
        }
    });

    if (valid) {
        this.submit(); // Enviar el formulario
    }
});

// Previsualización de la imagen seleccionada
function previewImage(event) {
    const previewContainer = document.getElementById('preview-img');
    const file = event.target.files[0];

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewContainer.src = e.target.result;
            previewContainer.style.display = 'block';
        };
        reader.readAsDataURL(file);
    } else {
        previewContainer.src = '';
        previewContainer.style.display = 'none';
    }
}
</script>
