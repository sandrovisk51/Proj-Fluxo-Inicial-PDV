<div class="container-sm mt-3">

    <form name="productDataForm" ng-controller="ctrlDataProduct" ng-submit="subFormDataProduct()">

        <a class="btn btn-link fs-3" href="#!/" role="button">Voltar</a>

        <nav class="navbar text-bg-primary mt-2 mb-2 border-bottom border-info rounded">
            <div class="container-fluid">
                <a class="navbar-brand mb-0 h1 text-white">Produto</a>
            </div>
        </nav>

        <div class="row g-3">
            <div class="col-4">
                <label for="name" class="form-label">Nome do Produto</label>
                <input type="text" class="form-control" name="name" ng-model="pe.name" maxlength="50" required>
            </div>
            <div class="col-4">
                <label for="bar_code" class="form-label">Código de Barras</label>
                <input type="text" class="form-control" name="bar_code" ng-model="pe.bar_code" maxlength="50" required>
            </div>
            <div class="col-4">
                <label for="category" class="form-label">Categoria</label>
                <select class="form-select" name="category" ng-model="pe.category" ng-options="c.id as c.name_category for c in categories" required>
                    <option selected>Selecione</option>
                </select>
            </div>
        </div>
        <div class="row g-3">
            <div class="col-12">
                <label for="type" class="form-label">Tipo</label>
                <select class="form-select" name="type" ng-model="pe.type" required>
                    <option selected>Selecione</option>
                    <option value="L">Produto Líquido</option>
                    <option value="S">Produto Sólido</option>
                    <option value="P">Produto Pastoso</option>
                </select>
            </div>
        </div>
        <div class="row g-3">
            <div class="col-12">
                <label for="description" class="form-label">Descrição</label>
                <textarea class="form-control" ng-model="pe.description" maxlength="255" rows="3" required></textarea>
            </div>
        </div>

        <nav class="navbar text-bg-primary mt-3 mb-2 border-bottom border-info rounded">
            <div class="container-fluid">
                <a class="navbar-brand mb-0 h1 text-white">Lote</a>
            </div>
        </nav>

        <div class="row g-3">
            <div class="col-3">
                <label for="batch" class="form-label">Código do Lote</label>
                <input type="text" class="form-control" ng-model="pe.batch" name="batch" maxlength="50" autocomplete="off" required>
            </div>
            <div class="col-3">
                <label for="due_date" class="form-label">Data de Vencimento</label>
                <input type="date" class="form-control"  ng-model="pe.due_date" name="due_date" date-format required>
            </div>
            <div class="col-3">
                <label for="amount" class="form-label">Quantidade</label>
                <input type="text" class="form-control" ng-model="pe.amount" name="amount" onkeyup="onlyNumbers(event)" maxlength="16" autocomplete="off" required>
            </div>
            <div class="col-3">
                <label for="weight" class="form-label">Peso</label>
                <input type="text" class="form-control" ng-model="pe.weight" name="weight" placeholder="Ex: 20 litros" maxlength="50" required>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-4">
                <label for="purchase_price" class="form-label">Valor de Compra</label>
                <input type="text" class="form-control" ng-model="pe.purchase_price" name="purchase_price" onkeyup="currencyMask(event)" maxlength="10" autocomplete="off" required>
            </div>
            <div class="col-4">
                <label for="sale_value" class="form-label">Valor de Venda</label>
                <input type="text" class="form-control" ng-model="pe.sale_value" name="sale_value" onkeyup="currencyMask(event)" maxlength="10" autocomplete="off" required>
            </div>
            <div class="col-4">
                <label for="tax" class="form-label">Imposto</label>
                <select class="form-select" name="tax" ng-model="pe.tax" name="tax" ng-options="t.id as t.type for t in taxes" autocomplete="off" required>
                    <option selected>Selecione</option>
                </select>
            </div>
        </div>

        <nav class="navbar text-bg-primary mt-3 mb-2 border-bottom border-info rounded">
            <div class="container-fluid">
                <a class="navbar-brand mb-0 h1 text-white">Avaria</a>
            </div>
        </nav>

        <div class="row g-3 mt-1">
            <div class="col-6">
                <label for="quantity_damage" class="form-label">Quantidade de Produtos Avariados</label>
                <input type="text" class="form-control" onkeyup="onlyNumbers(event)" ng-model="pe.quantity_damage" name="quantity_damage" maxlength="10">
            </div>
            <div class="col-6">
                <label for="details_breakdown" class="form-label">Detalhes da Avaria</label>
                <input type="text" class="form-control" ng-model="pe.details_breakdown" name="details_breakdown" maxlength="255">
            </div>
        </div>

        <div class=" mt-4 mb-5 modal-footer">
            <button type="submit" class="btn btn-success w-25" id="bt-update">Atualizar</button>
            <button type="button" class="btn btn-danger ms-5" ng-click="deleteProduct()" id="bt-erase">Excluir</button>
        </div>

    </form>

</div>