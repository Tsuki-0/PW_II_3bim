<?php
include "function.php";
edit();
include HEADER_TEMPLATE;
?>

<h1 style="text-align: center;">Atualizar Cliente</h1>

<?php // Mostra o erro de upload (edit() nao redireciona quando a foto e invalida) ?>
<?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_SESSION['message'])): ?>
    <div class="alert alert-<?php echo $_SESSION['type']; ?>" role="alert">
        <?php echo $_SESSION['message']; ?>
    </div>
    <?php unset($_SESSION['message'], $_SESSION['type']); ?>
<?php endif; ?>

<div class="form-scroll">
    <form action="edit.php?id=<?= $customer['id']; ?>" method="post" enctype="multipart/form-data" class="form-card">
        <!-- area de campos do form -->
        <div class="form-group">
            <label for="name">Nome completo</label>
            <input type="text" class="form-control" id="name" name="customer['name']" required
                minlength="3" maxlength="100"
                value="<?php echo $customer['name']; ?>">
        </div>

        <div class="form-group">
            <label for="cep">CEP</label>
            <input type="text" class="form-control" id="cep" name="customer['cep']" required
                inputmode="numeric" minlength="9" maxlength="9" pattern="\d{5}-\d{3}"
                title="Informe o CEP completo, com 8 números (ex: 12345-678)"
                value="<?php echo $customer['cep']; ?>">
        </div>

        <div class="form-group">
            <label for="coren">COREN</label>
            <input type="text" class="form-control" id="coren" name="customer['coren']" required
                minlength="4" maxlength="20" autocapitalize="characters" spellcheck="false"
                pattern="\d{4,7}|COREN-(AC|AL|AP|AM|BA|CE|DF|ES|GO|MA|MT|MS|MG|PA|PB|PR|PE|PI|RJ|RN|RS|RO|RR|SC|SP|SE|TO)-\d{4,7}(-(ENF|TEC|AUX|PAR|TE|AE|P))?"
                title="Informe só o número (4 a 7 dígitos) ou o registro completo, ex: COREN-SP-123456-ENF"
                value="<?php echo $customer['coren']; ?>">
        </div>

        <div class="form-group">
            <label for="phone">Telefone</label>
            <input type="text" class="form-control" id="phone" name="customer['phone']" required
                inputmode="tel" minlength="14" maxlength="15" pattern="\(\d{2}\) \d{4,5}-\d{4}"
                title="Informe o telefone com DDD, com 10 ou 11 números (ex: (11) 91234-5678)"
                value="<?php echo $customer['phone']; ?>">
        </div>

        <div class="form-group">
            <label for="birthdate">Data de Nascimento</label>
            <input type="text" class="form-control" id="birthdate" name="customer['birthdate']" required
                inputmode="numeric" minlength="10" maxlength="10" pattern="\d{2}/\d{2}/\d{4}"
                title="Informe a data completa no formato dd/mm/aaaa"
                placeholder="dd/mm/aaaa"
                value="<?php echo !empty($customer['birthdate']) ? formatData($customer['birthdate'], 'd/m/Y') : ''; ?>">
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
        // ---- Mascaras ----
        function maskCep(v) {
            v = v.replace(/\D/g, '').slice(0, 8);
            return v.length > 5 ? v.slice(0, 5) + '-' + v.slice(5) : v;
        }

        function maskPhone(v) {
            var d = v.replace(/\D/g, '').slice(0, 11);
            if (d.length > 10) return '(' + d.slice(0, 2) + ') ' + d.slice(2, 7) + '-' + d.slice(7);
            if (d.length > 6) return '(' + d.slice(0, 2) + ') ' + d.slice(2, 6) + '-' + d.slice(6);
            if (d.length > 2) return '(' + d.slice(0, 2) + ') ' + d.slice(2);
            return d;
        }

        function maskDate(v) {
            var d = v.replace(/\D/g, '').slice(0, 8);
            if (d.length > 4) return d.slice(0, 2) + '/' + d.slice(2, 4) + '/' + d.slice(4);
            if (d.length > 2) return d.slice(0, 2) + '/' + d.slice(2);
            return d;
        }

        var cep = document.getElementById('cep');
        var coren = document.getElementById('coren');
        var phone = document.getElementById('phone');
        var birthdate = document.getElementById('birthdate');

        // ---- Validacao da data (dd/mm/aaaa): precisa existir, ano >= 1900 e nao ser futura ----
        function validateDate() {
            birthdate.setCustomValidity('');
            var v = birthdate.value;
            if (v.length !== 10) return; // incompleta: "required" e "pattern" cuidam disso

            var p = v.split('/');
            var day = parseInt(p[0], 10), month = parseInt(p[1], 10), year = parseInt(p[2], 10);
            var dt = new Date(year, month - 1, day);

            if (dt.getFullYear() !== year || dt.getMonth() !== month - 1 || dt.getDate() !== day) {
                birthdate.setCustomValidity('Data inválida. Confira o dia e o mês.');
                return;
            }
            if (year < 1900) {
                birthdate.setCustomValidity('O ano deve ser 1900 ou posterior.');
                return;
            }
            var today = new Date();
            today.setHours(0, 0, 0, 0);
            if (dt > today) {
                birthdate.setCustomValidity('A data de nascimento não pode ser futura.');
            }
        }

        // Formata os valores que vieram do banco (so digitos) e mascara enquanto edita
        cep.value = maskCep(cep.value);
        phone.value = maskPhone(phone.value);
        validateDate();

        cep.addEventListener('input', function () { cep.value = maskCep(cep.value); });
        // COREN: aceita so o numero (123456) ou o registro completo (COREN-SP-123456-ENF)
        function maskCoren(v) {
            return v.toUpperCase()
                .replace(/\./g, '')               // 1.104 -> 1104
                .replace(/[^A-Z0-9\s\/-]/g, '')    // remove caracteres invalidos
                .replace(/[\s\/]+/g, '-')          // espaco e barra viram hifen
                .replace(/-{2,}/g, '-')            // hifens repetidos viram um
                .slice(0, 20);
        }

        coren.addEventListener('input', function () { coren.value = maskCoren(coren.value); });
        coren.addEventListener('blur', function () { coren.value = coren.value.replace(/^-+|-+$/g, ''); });
        phone.addEventListener('input', function () { phone.value = maskPhone(phone.value); });
        birthdate.addEventListener('input', function () {
            birthdate.value = maskDate(birthdate.value);
            validateDate();
        });

        // ---- Pre-visualizacao da nova foto escolhida ----
        var input = document.getElementById('foto');
        var preview = document.getElementById('foto-preview');
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

        var form = input.closest('form');
        form.addEventListener('reset', function () {
            setTimeout(function () {
                preview.innerHTML = placeholder;
                // reset volta ao valor original (so digitos): reaplica a mascara
                cep.value = maskCep(cep.value);
                phone.value = maskPhone(phone.value);
                validateDate();
            }, 0);
        });

        // Antes de enviar (ja validado), remove as mascaras: o banco recebe so digitos
        // e a data no formato aaaa-mm-dd
        form.addEventListener('submit', function () {
            cep.value = cep.value.replace(/\D/g, '');
            phone.value = phone.value.replace(/\D/g, '');
            var p = birthdate.value.split('/');
            if (p.length === 3) birthdate.value = p[2] + '-' + p[1] + '-' + p[0];
        });
    });
</script>

<?php include FOOTER_TEMPLATE; ?>