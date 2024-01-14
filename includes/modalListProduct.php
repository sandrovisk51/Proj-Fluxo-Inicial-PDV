<div class="modal fade" id="modListProductStatic" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modListProductStaticLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header text-bg-primary text-white">
                <h1 class="modal-title fs-5" id="modListProductStaticLabel">Lista dos Produtos</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body overflow-auto" style="height:550px">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">NOME</th>
                            <th scope="col">COD. BARRAS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="p in listProducts">
                            <th scope="row">{{p.id}}</th>
                            <td>{{p.name}}</td>
                            <td>{{p.bar_code}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" ng-click="resetFields()" data-bs-dismiss="modal">Fecha</button>
            </div>

        </div>
    </div>
</div>