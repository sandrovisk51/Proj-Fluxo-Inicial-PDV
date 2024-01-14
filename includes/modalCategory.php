<div class="modal fade" id="modCategoryStatic" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modCategoryStaticLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header text-bg-primary text-white">
                <h1 class="modal-title fs-5" id="modCategoryStaticLabel">Formulário Categorias</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body" ng-controller="ctrlCategory">

                <form class="mb-4" name="categoryForm" ng-submit="subFormCategory()">

                    <div class="card">
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-10">
                                    <label for="name" class="form-label">Nome da Categoria</label>
                                    <input type="text" class="form-control" id="name_category" name="name_category" ng-model="ct.name_category" maxlength="60" autocomplete="off" required>
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
                        <a class="navbar-brand" href="#">Relação de Categorias Registradas</a>
                    </div>
                </nav>

                <div class="overflow-auto" style="height: 350px !important;">

                    <div ng-repeat="c in categories">

                        <form class="mb-4" id="categoryForm{{c.id}}" name="categoryForm{{c.id}}" ng-submit="subFormUpdateCategory(c.id)">

                            <div class="card">
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-8">
                                            <label for="name" class="form-label">Nome da Categoria</label>
                                            <input type="text" class="form-control" id="name_category{{c.id}}" name="name_category{{c.id}}" ng-model="c.name_category" maxlength="60"  autocomplete="off" require>
                                        </div>
                                        <div class="col-2 pt-4">
                                            <div class="pt-2"><button type="submit" class="btn btn-outline-secondary">Atualizar</button></div>
                                        </div>
                                        <div class="col-2 pt-4">
                                            <div class="pt-2"><button type="button" ng-click="delCategory(c.id)" class="btn btn-outline-danger">Excluir</button></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>

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