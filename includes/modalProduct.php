<div class="modal fade" id="modProductStatic" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modProductStaticLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header text-bg-primary text-white">
                <h1 class="modal-title fs-5" id="modProductStaticLabel">Formulário de Produtos</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form name="productForm" ng-controller="ctrlRegProduct" ng-submit="subFormProduct()">

                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-4">
                            <label for="name" class="form-label">Nome do Produto</label>
                            <input type="text" class="form-control" name="name" ng-model="pd.name" id="name" maxlength="50"  autocomplete="off" required>
                        </div>
                        <div class="col-4">
                            <label for="bar_code" class="form-label">Código de Barras</label>
                            <input type="text" class="form-control" name="bar_code" ng-model="pd.bar_code" id="bar_code" maxlength="50"  autocomplete="off" required>
                        </div>
                        <div class="col-4">
                            <label for="category" class="form-label">Categoria</label>
                            <select class="form-select" name="category" id="category" ng-model="pd.category"  autocomplete="off" required >
                                <option value="" selected>Selecione</option>
                                <option ng-repeat="c in categories" value="{{c.id}}">{{c.name_category}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="type" class="form-label">Tipo</label>
                            <select class="form-select" name="type" id="type" ng-model="pd.type"  autocomplete="off" required>
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
                            <textarea class="form-control" id="description" ng-model="pd.description" maxlength="255" rows="3"  autocomplete="off" required></textarea>
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