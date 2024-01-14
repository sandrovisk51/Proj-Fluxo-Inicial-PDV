<div class="modal fade" id="modLotsStatic" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modLotsStaticLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header text-bg-primary text-white">
                <h1 class="modal-title fs-5" id="modLotsStaticLabel">Formulário Lote</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form name="lotsForm" ng-controller="ctrlRegLots" ng-submit="subFormLots()">

                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-4">
                            <label for="batch" class="form-label">Código do Lote</label>
                            <input type="text" class="form-control" id="batch" ng-model="lt.batch" name="batch" maxlength="50" autocomplete="off" required>
                        </div>
                        <div class="col-4">
                            <label for="bar_code" class="form-label">Código de Barras</label>
                            <input type="text" class="form-control" id="bar_code" ng-model="lt.bar_code" name="bar_code" maxlength="50"  autocomplete="off" required>
                        </div>
                        <div class="col-4">
                            <label for="amount" class="form-label">Quantidade</label>
                            <input type="text" class="form-control" id="amount" ng-model="lt.amount" name="amount" onkeyup="onlyNumbers(event)" maxlength="16"  autocomplete="off" required>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-4">
                            <label for="purchase_price" class="form-label">Valor de Compra (Unidade)</label>
                            <input type="text" class="form-control" id="purchase_price" ng-model="lt.purchase_price" name="purchase_price" onkeyup="currencyMask(event)" maxlength="10" autocomplete="off" required>
                        </div>
                        <div class="col-4">
                            <label for="sale_value" class="form-label">Valor de Venda (Unidade)</label>
                            <input type="text" class="form-control" id="sale_value" ng-model="lt.sale_value" name="sale_value" onkeyup="currencyMask(event)" maxlength="10" autocomplete="off" required>
                        </div>
                        <div class="col-4">
                            <label for="tax" class="form-label">Imposto</label>
                            <select class="form-select" name="tax" id="tax" ng-model="lt.tax" name="tax" autocomplete="off" required>
                                <option selected>Selecione</option>
                                <option ng-repeat="t in taxes" value="{{t.id}}">{{t.type}}</option>

                            </select>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-6">
                            <label for="due_date" class="form-label">Data de Vencimento</label>
                            <input type="date" class="form-control" id="due_date" ng-model="lt.due_date" name="due_date" required>
                        </div>
                        <div class="col-6">
                            <label for="weight" class="form-label">Peso (Unidade)</label>
                            <input type="text" class="form-control" id="weight" ng-model="lt.weight" name="weight" placeholder="Ex: 20 litros"  maxlength="50" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" ng-click="resetFields()" data-bs-dismiss="modal">cancelar</button>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>

            </form>
        </div>
    </div>
</div>