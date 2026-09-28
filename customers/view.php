<?php
include('function.php');
view($_GET['id']);


include(HEADER_TEMPLATE);
?>


<h1 style="text-align: center;">Cliente <?php echo $customer['id']; ?></h1>

<div class="form-scroll">
    <form class="form-card">
        <!-- area de campos do form, somente para visualizacao -->
        <div class="form-group">
            <label for="name">Nome completo</label>
            <input type="text" class="form-control" id="name" name="customer['name']"
                value="<?php echo $customer['name']; ?>" disabled>
        </div>

        <div class="form-group">
            <label for="cep">CEP</label>
            <input type="text" class="form-control" id="cep" name="customer['cep']"
                value="<?php echo $customer['cep']; ?>" disabled>
        </div>

        <div class="form-group">
            <label for="coren">COREN</label>
            <input type="text" class="form-control" id="coren" name="customer['coren']"
                value="<?php echo $customer['coren']; ?>" disabled>
        </div>

        <div class="form-group">
            <label for="phone">Telefone</label>
            <input type="text" class="form-control" id="phone" name="customer['phone']"
                value="<?php echo $customer['phone']; ?>" disabled>
        </div>

        <div class="form-group">
            <label for="birthdate">Data de Nascimento</label>
            <input type="text" class="form-control" id="birthdate" name="customer['birthdate']"
                value="<?php echo $customer['birthdate']; ?>" disabled>
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
            <a href="index.php" class="btn btn-crud-secondary">
                <i class="fa-solid fa-rotate-left"></i> Voltar
            </a>
            <a href="edit.php?id=<?php echo $customer['id']; ?>" class="btn btn-crud-primary">
                <i class="fa-solid fa-pencil"></i> Editar
            </a>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // CEP: 12345678 -> 12345-678
        var cep = document.getElementById('cep');
        if (cep && cep.value) {
            var c = cep.value.replace(/\D/g, '');
            if (c.length === 8) {
                cep.value = c.replace(/(\d{5})(\d{3})/, '$1-$2');
            }
        }

        // Formata o telefone como (11) 91234-5678 ou (11) 1234-5678
        var phone = document.getElementById('phone');
        if (phone && phone.value) {
            var digits = phone.value.replace(/\D/g, '');
            var formatted = digits;
            if (digits.length === 11) {
                formatted = digits.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
            } else if (digits.length === 10) {
                formatted = digits.replace(/(\d{2})(\d{4})(\d{4})/, '($1) $2-$3');
            }
            phone.value = formatted;
        }

        // Converte a data de aaaa-mm-dd para o padrao brasileiro dd/mm/aaaa
        var birthdate = document.getElementById('birthdate');
        if (birthdate && birthdate.value) {
            var raw = birthdate.value.split(' ')[0];
            var parts = raw.split('-');
            if (parts.length === 3) {
                birthdate.value = parts[2] + '/' + parts[1] + '/' + parts[0];
            }
        }
    });
</script>

<?php include FOOTER_TEMPLATE; ?>