<div class="container" ng-controller="ctrlBox">
    <div class="mt-1 border border-2 border-primary rounded" style="height: 650px;">
        <nav class="navbar text-bg-primary mb-2 border-bottom border-info rounded">
            <div class="container-fluid">
                <a class="navbar-brand mb-0 h1 text-white fs-3">CAIXA</a>
            </div>
        </nav>

        <div class="container-md">
            <div class="row g-3" style="height: 590px;">
                <div id="list-product" class="col-8 border border-2 border-primary  border-start-0 border-top-0 border-bottom-0 overflow-auto" style="height: 550px;">
                    <ul class="list-group list-group-flush" onchange="scrollToBottom()" ng-repeat="p in productsPurchased track by $index">
                        <li class="list-group-item fs-5">Item {{ $index }} - {{ p.name_item }} = {{ p.price_item }} x {{ p.qtd_item }} | <span class="text-success"> Total {{ p.total_value_item }} </span> | <span class="text-info"> Impostos {{ p.total_tax_item }} </span> </li>
                    </ul>
                </div>
                <div class="col-4">
                    <div class="card mt-2">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item text-bg-primary fs-5">TOTAL IMPOSTOS: {{totalTax}}</li>
                            <li class="list-group-item text-bg-primary fs-3">TOTAL GERAL: {{grandTotal}}</li>
                        </ul>
                    </div>
                    <div class="card mt-4" ng-show="productsPurchased.length > 0">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item text-bg-primary">
                                <label for="tax" class="form-label fs-5">FORMA DE PAGAMENTO</label>
                                <select class="form-select" name="paymentMethod" ng-model="ca.payment_method">
                                    <option value="Dinheiro">Dinheiro</option>
                                    <option value="Pix">Pix</option>
                                    <option value="Cartão Debito">Cartão Debito</option>
                                    <option value="Cartão Credito">Cartão Credito</option>
                                </select>
                            </li>
                            <li class="list-group-item text-bg-primary fs-5">
                                <label for="bar_code" class="form-label">VALOR RECEBIDO</label>
                                <input type="text" class="form-control" name="amountReceived" ng-model="ca.amount_received" onkeyup="currencyMask(event)" ng-keyup="calculateChange($event)" maxlength="10">
                            </li>
                            <li class="list-group-item text-bg-warning fs-5">TROCO: {{changePurchase}} </li>
                        </ul>
                    </div>
                    <div class="card mt-3">
                        <div class="card-body">
                            <h5 class="card-title">Informativo</h5>
                            <h6 class="card-subtitle mb-2 text-muted">F5 Cancelar Venda </h6>
                            <h6 class="card-subtitle mb-2 text-muted">F6 Sair </h6>
                            <h6 class="card-subtitle mb-2 text-muted">F7 Remover Item </h6>
                            <h6 class="card-subtitle mb-2 text-muted">F9 Localizar Produto</h6>
                            <h6 class="card-subtitle mb-2 text-muted">F2 Finalizar Compra </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal  add Product -->
    <div class="modal fade" id="locateProduct" tabindex="-1" aria-labelledby="locateProductLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-bg-primary">
                    <h1 class="modal-title fs-5" id="locateProductLabel"> Localizar Produto</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-5">
                    <form name="locateProductForm" ng-submit="subFormLocateProduct()">
                        <div class="row g-3">
                            <div class="col-8">
                                <label for="locateBarCode" class="form-label">Código de Barras do Produto</label>
                                <input type="text" id="locateBarCode" class="form-control" name="bar_code_product" ng-model="ca.bar_code_product" maxlength="50"  autocomplete="off" required>
                            </div>
                            <div class="col-2">
                                <label for="quantity_product" class="form-label">Qtd</label>
                                <input type="text" id="quantityProduct" class="form-control" name="quantity_product" ng-model="ca.quantity_product" onkeyup="onlyNumbers(event)" maxlength="10" autocomplete="off" required>
                            </div>
                            <div class="col-2 pt-4">
                                <button type="submit" class="btn btn-info mt-2">OK</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal  remove Product -->
    <div class="modal fade" id="removeItem" tabindex="-1" aria-labelledby="removeItemLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-bg-primary">
                    <h1 class="modal-title fs-5" id="removeItemLabel"> Remover Item </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-5">
                    <form name="removeItemForm" ng-submit="subFormRemoveItem()">
                        <div class="row g-3">
                            <label for="quantity_product" class="form-label">Digite o número do Item, que será removido.</label>
                        </div>
                        <div class="row g-3">
                            <div class="col-8">
                                <input type="text" id="itemProduct" class="form-control" name="item_product" ng-model="ca.item_product" onkeyup="onlyNumbers(event)" maxlength="10" autocomplete="off" required>
                            </div>
                            <div class="col-4">
                                <button type="submit" class="btn btn-info">OK</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal  finalize purchase -->
    <div class="modal fade" id="finalizePurchase" tabindex="-1" aria-labelledby="finalizePurchaseLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-bg-primary">
                    <h1 class="modal-title fs-5" id="finalizePurchaseLabel">Finalizar Compra</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-5">
                    <div class="row g-3 text-center">
                        <label class="form-label">Gostaria de concluir esta compra?</label>
                    </div>
                    <div class="row g-3 text-center">
                        <div class="col-12">
                            <button type="button" class="btn btn-info" ng-click="closePurchase()">Confirmar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>