<?php
include "function.php";
add();
include HEADER_TEMPLATE;
?>

<h1>Novo Enfermeiro</h1>

<div class="form-scroll">
    <form action="add.php" method="post" enctype="multipart/form-data" class="form-card">
        <!-- area de campos do form -->
        <div class="form-group">
            <label for="name">Nome completo</label>
            <input type="text" class="form-control" id="name" name="customer['name']"
                placeholder="Ex: Ana Maria Santos">
        </div>

        <div class="form-group">
            <label for="address">Endereço</label>
            <input type="text" class="form-control" id="address" name="customer['address']"
                placeholder="Ex: Rua das Flores, 123 — São Paulo/SP">
        </div>

        <div class="form-group">
            <label for="ie">COREN</label>
            <input type="text" class="form-control" id="ie" name="customer['ie']" maxlength="15"
                placeholder="Ex: 123456">
        </div>

        <div class="form-group">
            <label for="phone">Telefone</label>
            <input type="text" class="form-control" id="phone" name="customer['phone']" maxlength="15"
                placeholder="Ex: (11) 91234-5678">
        </div>

        <div class="form-group">
            <label for="birthdate">Data de Nascimento</label>
            <input type="date" class="form-control" id="birthdate" name="customer['birthdate']">
        </div>

        <div class="form-group">
            <label for="foto">Foto</label>
            <label for="foto" class="photo-upload">
                <i class="fa-regular fa-image"></i>
                <span class="photo-upload-label">Clique para selecionar</span>
                <span class="photo-upload-hint">JPG, PNG, WEBP ou GIF · máx. recomendado 5MB</span>
            </label>
            <input type="file" id="foto" name="foto" accept="image/png, image/jpeg, image/webp, image/gif"
                style="display: none;">
        </div>

        <div class="form-group">
            <label>Pré-visualização</label>
            <div class="photo-preview" id="foto-preview">
                <i class="fa-regular fa-image"></i>
                <span>Sem Imagem</span>
            </div>
        </div>

        <div id="actions">
            <button type="submit" class="btn btn-crud-primary">
                <i class="fa-solid fa-floppy-disk"></i> Salvar
            </button>
            <button type="reset" class="btn btn-crud-secondary">
                <i class="fa-solid fa-eraser"></i> Limpar
            </button>
            <a href="index.php" class="btn btn-crud-secondary">
                <i class="fa-solid fa-rotate-left"></i> Cancelar
            </a>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var input = document.getElementById('foto');
        var preview = document.getElementById('foto-preview');
        if (!input || !preview) return;

        var placeholder = preview.innerHTML;

        input.addEventListener('change', function() {
            var file = input.files && input.files[0];
            if (!file) {
                preview.innerHTML = placeholder;
                return;
            }
            var reader = new FileReader();
            reader.onload = function(e) {
                preview.innerHTML = '<img src="' + e.target.result + '" alt="Pré-visualização">';
            };
            reader.readAsDataURL(file);
        });

        var form = input.closest('form');
        if (form) {
            form.addEventListener('reset', function() {
                setTimeout(function() {
                    preview.innerHTML = placeholder;
                }, 0);
            });
        }
    });
</script>

<?php include FOOTER_TEMPLATE; ?>