<?php
include "function.php";
edit();
include HEADER_TEMPLATE;
?>

<h2>Atualizar Cliente</h2>

<form action="edit.php?id=<?= $customer['id']; ?>" method="post">
    <!-- area de campos do form -->
    <hr>
    <div class="row">
        <div class="form-group col-md-7">
            <label for="name">Nome / Razão Social</label>
            <input type="text" class="form-control" id="name" name="customer['name']"
                value="<?php echo $customer['name']; ?>">
        </div>

        <div class="form-group col-md-3">
            <label for="cpf_cnpj">CNPJ / CPF</label>
            <input type="text" class="form-control" id="cpf_cnpj" name="customer['cpf_cnpj']" maxlength="14"
                value="<?php echo $customer['cpf_cnpj']; ?>">
        </div>

        <div class="form-group col-md-2">
            <label for="birthdate">Data de Nascimento</label>
            <input type="date" class="form-control" id="birthdate" name="customer['birthdate']"
            value="<?php echo formatData($customer['birthdate'], "Y-m-d"); ?>">
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-5">
            <label for="address">Endereço</label>
            <input type="text" class="form-control" id="address" name="customer['address']"
                value="<?php echo $customer['address']; ?>">
        </div>

        <div class="form-group col-md-3">
            <label for="hood">Bairro</label>
            <input type="text" class="form-control" id="hood" name="customer['hood']"
                value="<?php echo $customer['hood']; ?>">
        </div>

        <div class="form-group col-md-2">
            <label for="zip_code">CEP</label>
            <input type="text" class="form-control" id="zip_code" name="customer['zip_code']" maxlength="8"
                value="<?php echo $customer['zip_code']; ?>">
        </div>

        <div class="form-group col-md-2">
            <label for="created">Data de Cadastro</label>
            <input type="date" class="form-control" id="created" name="customer['created']" disabled
                value="<?php echo formatData($customer['created'], "Y-m-d"); ?>">
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-5">
            <label for="city">Município</label>
            <input type="text" class="form-control" id="city" name="customer['city']"
                value="<?php echo $customer['city']; ?>">
        </div>

        <div class="form-group col-md-2">
            <label for="phone">Telefone</label>
            <input type="text" class="form-control" id="phone" name="customer['phone']" maxlength="11"
                value="<?php echo $customer['phone']; ?>">
        </div>

        <div class="form-group col-md-2">
            <label for="mobile">Celular</label>
            <input type="text" class="form-control" id="mobile" name="customer['mobile']" maxlength="11"
                value="<?php echo $customer['mobile']; ?>">
        </div>

        <div class="form-group col-md-1">
            <label for="state">UF</label>
            <input type="text" class="form-control" id="state" name="customer['state']" maxlength="2"
                value="<?php echo $customer['state']; ?>">
        </div>

        <div class="form-group col-md-2">
            <label for="ie">Inscrição Estadual</label>
            <input type="text" class="form-control" id="ie" name="customer['ie']" maxlength="15"
                value="<?php echo $customer['ie']; ?>">
        </div>
    </div>

    <div id="actions" class="row">
        <div class="col-md-12">
            <button type="submit" class="btn btn-secondary">
                <i class="fa-solid fa-floppy-disk"></i> Salvar
            </button>
            <a href="index.php" class="btn btn-light">
                <i class="fa-solid fa-rotate-left"></i> Cancelar
            </a>
        </div>
    </div>
</form>

<?php include FOOTER_TEMPLATE; ?>