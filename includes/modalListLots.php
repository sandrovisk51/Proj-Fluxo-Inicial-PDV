<div class="modal fade" id="modListLotsStatic" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modListLotsStaticLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header text-bg-primary text-white">
                <h1 class="modal-title fs-5" id="modListLotsStaticLabel">Lista dos Produtos</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body overflow-auto" style="height:550px">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">LOTE</th>
                            <th scope="col">QUANTIDADE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="s in listStock">
                            <th scope="row">{{s.id}}</th>
                            <td>{{s.batch}}</td>
                            <td>{{s.amount}}</td>
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