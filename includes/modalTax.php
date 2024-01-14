<div class="modal fade" id="modTaxStatic" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modTaxStaticLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header text-bg-primary text-white">
                <h1 class="modal-title fs-5" id="modTaxStaticLabel">Formulário de Impostos</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body" ng-controller="ctrlTax">

                <form class="mb-4" name="taxForm" ng-submit="subFormTax()">

                    <div class="card">
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-3">
                                    <label for="percentage" class="form-label">Porcentual</label>
                                    <input type="text" class="form-control" id="percentage" name="percentage" ng-model="tx.percentage" onkeyup="currencyMask(event)" maxlength="10"  autocomplete="off" required>
                                </div>
                                <div class="col-7">
                                    <label for="type" class="form-label">Tipo</label>
                                    <input type="text" class="form-control" id="type" name="type" ng-model="tx.type" maxlength="50"  autocomplete="off" required>
                                </div>
                                <div class="col-2 pt-4">
                                    <div class="pt-2"><button type="submit" class="btn btn-outline-primary">Cadastrar</button></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>

                <nav class="navbar navbar-light bg-light mb-2">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#">Relação de Impostos Registrados</a>
                    </div>
                </nav>

                <div class="overflow-auto" style="height: 350px !important;">

                    <div ng-repeat="t in taxes">

                        <form class="mb-4" id="taxForm{{t.id}}" name="taxForm{{t.id}}" ng-submit="subFormUpdateTax(t.id)">
                            <div class="card mt-3">
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-2">
                                            <label for="percentage" class="form-label">Porcentual</label>
                                            <input type="text" class="form-control" id="percentage{{t.id}}" name="percentage{{t.id}}"  ng-model="t.percentage"  onkeyup="currencyMask(event)" maxlength="10"  autocomplete="off" required>
                                        </div>
                                        <div class="col-6">
                                            <label for="type" class="form-label">Tipo</label>
                                            <input type="text" class="form-control" id="type{{t.id}}" name="type{{t.id}}"  ng-model="t.type"  autocomplete="off" required>
                                        </div>
                                        <div class="col-2 pt-4">
                                            <div class="pt-2"><button type="submit" class="btn btn-outline-secondary">Atualizar</button></div>
                                        </div>
                                        <div class="col-2 pt-4">
                                            <div class="pt-2"><button type="button" ng-click="delTax(t.id)" class="btn btn-outline-danger">Excluir</button></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>