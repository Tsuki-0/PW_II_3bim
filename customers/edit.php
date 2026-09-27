<?php
include "function.php";
edit();
include HEADER_TEMPLATE;
?>

<h1 style="text-align: center;">Atualizar Cliente</h1>

<div class="form-scroll">
    <form action="edit.php?id=<?= $customer['id']; ?>" method="post" enctype="multipart/form-data" class="form-card">
        <!-- area de campos do form -->
        <div class="form-group">
            <label for="name">Nome completo</label>
            <input type="text" class="form-control" id="name" name="customer['name']"
                value="<?php echo $customer['name']; ?>">
        </div>

        <div class="form-group">
            <label for="address">Endereço</label>
            <input type="text" class="form-control" id="address" name="customer['address']"
                value="<?php echo $customer['address']; ?>">
        </div>

        <div class="form-group">
            <label for="ie">COREN</label>
            <input type="text" class="form-control" id="ie" name="customer['ie']" maxlength="15"
                value="<?php echo $customer['ie']; ?>">
        </div>

        <div class="form-group">
            <label for="phone">Telefone</label>
            <input type="text" class="form-control" id="phone" name="customer['phone']" maxlength="15"
                value="<?php echo $customer['phone']; ?>">
        </div>

        <div class="form-group">
            <label for="birthdate">Data de Nascimento</label>
            <input type="date" class="form-control" id="birthdate" name="customer['birthdate']"
                value="<?php echo $customer['birthdate']; ?>">
        </div>

        <div class="form-group">
            <label for="foto">Trocar Foto</label>
            <label for="foto" class="photo-upload">
                <i class="fa-regular fa-image"></i>
                <span class="photo-upload-label">Clique para selecionar</span>
                <span class="photo-upload-hint">JPG, PNG, WEBP ou GIF · máx. recomendado 5MB</span>
            </label>
            <input type="file" id="foto" name="foto" accept="image/png, image/jpeg, image/webp, image/gif"
                style="display: none;">
        </div>

        <div class="form-group">
            <label>Foto Atual</label>
            <div class="photo-preview" id="foto-preview">
                <?php if (!empty($customer['foto'])): ?>
                    <img src="<?php echo IMG_URL . $customer['foto']; ?>" alt="Foto atual">
                <?php else: ?>
                    <i class="fa-regular fa-image"></i>
                    <span>Sem Imagem</span>
                <?php endif; ?>
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
    document.addEventListener('DOMContentLoaded', function () {
        // Mascara o telefone enquanto edita: (11) 91234-5678
        var phone = document.getElementById('phone');
        function maskPhone(value) {
            var digits = value.replace(/\D/g, '').slice(0, 11);
            if (digits.length > 10) {
                return digits.replace(/(\d{2})(\d{5})(\d{0,4})/, function (m, a, b, c) {
                    return c ? '(' + a + ') ' + b + '-' + c : '(' + a + ') ' + b;
                });
            } else if (digits.length > 6) {
                return digits.replace(/(\d{2})(\d{4})(\d{0,4})/, function (m, a, b, c) {
                    return c ? '(' + a + ') ' + b + '-' + c : '(' + a + ') ' + b;
                });
            } else if (digits.length > 2) {
                return digits.replace(/(\d{2})(\d{0,5})/, '($1) $2');
            }
            return digits;
        }
        if (phone) {
            phone.value = maskPhone(phone.value);
            phone.addEventListener('input', function () {
                phone.value = maskPhone(phone.value);
            });
        }

        var form = phone ? phone.closest('form') : null;
        if (form) {
            // Remove a mascara antes de enviar, so os digitos vao pro banco
            form.addEventListener('submit', function () {
                if (phone) phone.value = phone.value.replace(/\D/g, '');
            });
        }

        // Pre-visualizacao da nova foto escolhida
        var input = document.getElementById('foto');
        var preview = document.getElementById('foto-preview');
        if (!input || !preview) return;

        var placeholder = preview.innerHTML;

        input.addEventListener('change', function () {
            var file = input.files && input.files[0];
            if (!file) {
                preview.innerHTML = placeholder;
                return;
            }
            var reader = new FileReader();
            reader.onload = function (e) {
                preview.innerHTML = '<img src="' + e.target.result + '" alt="Pré-visualização">';
            };
            reader.readAsDataURL(file);
        });

        if (form) {
            form.addEventListener('reset', function () {
                setTimeout(function () {
                    preview.innerHTML = placeholder;
                }, 0);
            });
        }
    });
</script>

<?php include FOOTER_TEMPLATE; ?>