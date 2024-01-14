<div class="container mt-3">
    <div class="container text-center" ng-controller="ctrlCountStock">
        <div class="row">
            <div class="col">
                <div class="shadow mb-5 bg-body rounded card">
                    <h5 class="card-header">Produtos Gerais</h5>
                    <div class="card-body">
                        <h5 class="card-title fs-1">{{productsGeneral}}</h5>
                        <a class="btn btn-primary" ng-click="generatesProductListStock()" data-bs-toggle="modal" data-bs-target="#modListProductStatic">Visualizar</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="shadow mb-5 bg-body rounded card">
                    <h5 class="card-header">Produtos Estoque Baixo</h5>
                    <div class="card-body">
                        <h5 class="card-title fs-1">{{stockBelow}}</h5>
                        <a class="btn btn-primary" ng-click="generatesProductListStock()" data-bs-toggle="modal" data-bs-target="#modListLotsStatic">Visualizar</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="shadow mb-5 bg-body rounded card pb-1">
                    <h5 class="card-header">Produtos Com Avarias</h5>
                    <div class="card-body pb-5">
                        <h5 class="card-title fs-1">{{breakdownsProducts}}</h5>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal List product -->
        <?php require 'includes/modalListProduct.php' ?>

        <!-- Modal List Lots -->
        <?php require 'includes/modalListLots.php' ?>


    </div>
    <div class="container mt-4" ng-controller="ctrlSearchProduct">

        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">

                                <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
                                <label class="btn btn-outline-primary" for="btnradio1" data-bs-toggle="modal" data-bs-target="#modProductStatic">Cadastrar Produtos</label>

                                <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
                                <label class="btn btn-outline-primary" for="btnradio2" data-bs-toggle="modal" data-bs-target="#modLotsStatic">Cadastrar Lotes</label>

                                <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off">
                                <label class="btn btn-outline-primary" for="btnradio3" data-bs-toggle="modal" data-bs-target="#modTaxStatic">Cadastrar Impostos</label>

                                <input type="radio" class="btn-check" name="btnradio" id="btnradio4" autocomplete="off">
                                <label class="btn btn-outline-primary" for="btnradio4" data-bs-toggle="modal" data-bs-target="#modCategoryStatic">Cadastrar Categorias</label>

                                <a class="btn btn-outline-success" href="#!/caixa" role="button">Caixa</a>

                            </div>
                        </li>
                    </ul>
                    <form class="d-flex" name="searchForm" ng-submit="subFormSearch()" role="search">
                        <input class="form-control me-2" type="search" id="search" name="search" ng-model="sh.search" placeholder="Localizar Produtos" aria-label="Search" autocomplete="off" required>
                        <button class="btn btn-outline-success" type="submit">OK</button>
                    </form>
                </div>
            </div>
        </nav>

        <ol class="list-group" ng-repeat="p in products">
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div>{{p.id}} - <span class="fw-bold text-capitalize">{{p.name}}</span></div>
                    Código de Barras ( {{p.bar_code}} )
                </div>
                <a class="btn badge bg-primary rounded-pill" href="#!/product/{{p.id}}" role="button">Editar</a>
            </li>
        </ol>

    </div>
</div>

<!-- Modal Product -->
<?php require 'includes/modalProduct.php' ?>

<!-- Modal Lots -->
<?php require 'includes/modalLots.php' ?>

<!-- Modal Tax -->
<?php require 'includes/modalTax.php' ?>

<!-- Modal Category -->
<?php require 'includes/modalCategory.php' ?>