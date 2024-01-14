var app=angular.module("pdv",["ngRoute"]);app.config(function(t){t.when("/",{templateUrl:"home.php"}).when("/product/:id",{templateUrl:"editProduct.php"}).when("/caixa",{templateUrl:"caixa.php"}).otherwise({redirectTo:"/"})}),app.service("msgService",function(t,e){this.msg=function(t){Swal.fire({title:t,confirmButtonColor:"#3085d6"})},this.msgSuccess=function(t){Swal.fire({icon:"success",title:t,showConfirmButton:!1,timer:2e3})},this.msgErro=function(t){Swal.fire({icon:"error",title:"Oops...",text:t,confirmButtonColor:"#CD3333"})},this.msgConfirm=function(o,a,r,c,n=!1,i="#!/"){Swal.fire({title:r,text:c,icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Sim",cancelButtonText:"N\xe3o"}).then(r=>{r.isConfirmed&&t.get(a).then(function(t){Swal.fire({title:t.data,confirmButtonColor:"#3085d6"}),$(o).remove(),n&&(e.location.href=i)})})}}),app.service("ArrayStorageService",function(){var t=[],e=0,o=0;return{getAllArrays:function(){return t},getTotalTax:function(){return e},getGrandTotal:function(){return o},addArray:function(e){t.push(e)},deleteArray:function(e){t.splice(e,1)},addValues:function(t,a){e+=parseFloat(a),o+=parseFloat(t),e=parseFloat(e.toFixed(2)),o=parseFloat(o.toFixed(2))},removeValues:function(t,a){e-=parseFloat(a),o-=parseFloat(t),e=parseFloat(e.toFixed(2)),o=parseFloat(o.toFixed(2))},clean:function(){t=[],e=0,o=0}}}),app.controller("ctrlCountStock",function(t,e,o,a){o.runCountProduct=function(){e.get("src/countProduct.php").then(function(e){t.productsGeneral=e.data.product,t.stockBelow=e.data.stock,t.breakdownsProducts=e.data.breakdowns}).catch(function(t){a.msgErro(t.data)})},o.runCountProduct(),t.generatesProductListStock=function(){e.get("src/listProductStock.php").then(function(e){t.listProducts=e.data.product,t.listStock=e.data.stock}).catch(function(t){a.msgErro(t.data)})}}),app.controller("ctrlRegProduct",function(t,e,o,a){t.pd={},e.get("src/listCategory.php").then(function(e){t.categories=e.data}),t.subFormProduct=function(){e.post("src/registerProducts.php",t.pd).then(function(e){a.msg(e.data),$("#modProductStatic").modal("hide"),$(".modal-backdrop").hide(),o.runCountProduct(),delete t.pd}).catch(function(t){a.msgErro(t.data)})},t.resetFields=function(){delete t.pd,t.pd={},t.productForm.$setPristine()}}),app.controller("ctrlRegLots",function(t,e,o){t.lt={},e.get("src/listTax.php").then(function(e){t.taxes=e.data}),t.subFormLots=function(){e.post("src/registerLots.php",t.lt).then(function(e){o.msg(e.data),$("#modLotsStatic").modal("hide"),$(".modal-backdrop").hide(),delete t.lt}).catch(function(t){o.msgErro(t.data)})},t.resetFields=function(){delete t.lt,t.lt={},t.lotsForm.$setPristine()}}),app.controller("ctrlTax",function(t,e,o){t.tx={},e.get("src/listTax.php").then(function(e){t.taxes=e.data}),t.subFormTax=function(){e.post("src/registerTax.php",t.tx).then(function(e){t.taxes.unshift(e.data),delete t.tx}).catch(function(t){o.msgErro(t.data)})},t.subFormUpdateTax=function(t){var a={id:t,percentage:$("#percentage"+t).val(),type:$("#type"+t).val()};e.post("src/updateTax.php",a).then(function(t){o.msg(t.data)}).catch(function(t){o.msgErro(t.data)})},t.delTax=function(t){o.msgConfirm("#taxForm"+t,"src/deleteTax.php?id="+t,"Deletar Imposto","Deseja realmente excluir este imposto? \n Esta a\xe7\xe3o \xe9 irrevers\xedvel e n\xe3o ser\xe1 poss\xedvel recuperar os dados ap\xf3s a exclus\xe3o.")}}),app.controller("ctrlCategory",function(t,e,o){t.ct={},e.get("src/listCategory.php").then(function(e){t.categories=e.data}),t.subFormCategory=function(){e.post("src/registerCategory.php",t.ct).then(function(e){t.categories.unshift(e.data),delete t.ct}).catch(function(t){o.msgErro(t.data)})},t.subFormUpdateCategory=function(t){var a={id:t,name_category:$("#name_category"+t).val()};e.post("src/updateCategory.php",a).then(function(t){o.msg(t.data)}).catch(function(t){o.msgErro(t.data)})},t.delCategory=function(t){o.msgConfirm("#categoryForm"+t,"src/deleteCategory.php?id="+t,"Deletar Categoria","Deseja realmente excluir esta categoria? \n Esta a\xe7\xe3o \xe9 irrevers\xedvel e n\xe3o ser\xe1 poss\xedvel recuperar os dados ap\xf3s a exclus\xe3o.")}}),app.controller("ctrlSearchProduct",function(t,e,o){t.sh={},t.subFormSearch=function(){e.post("src/searchProducts.php",t.sh).then(function(e){let o=e.data;t.products=o,delete t.sh}).catch(function(t){o.msgErro(t.data)})}}),app.controller("ctrlDataProduct",function(t,e,o,a,r){t.pe={},o.get("src/listCategory.php").then(function(e){t.categories=e.data}),o.get("src/listTax.php").then(function(e){t.taxes=e.data}),o.get("src/editProducts.php?id="+e.id).then(function(e){t.pe=e.data}).catch(function(t){r.msgErro("Houve um erro ao carregar os dados!"),$("#bt-atualizar").hide()}),t.subFormDataProduct=function(){t.pe.id=e.id,o.post("src/updateProducts.php",t.pe).then(function(t){r.msg(t.data)}).catch(function(t){r.msgErro(t.data)})},t.deleteProduct=function(){r.msgConfirm("#false","src/deleteProduct.php?id="+e.id,"Deletar Produto","Deseja realmente excluir esta Produto? \n Esta a\xe7\xe3o \xe9 irrevers\xedvel e n\xe3o ser\xe1 poss\xedvel recuperar os dados ap\xf3s a exclus\xe3o.",!0)}}),app.directive("dateFormat",function(){return{require:"ngModel",link:function(t,e,o,a){a.$formatters.length=0,a.$parsers.length=0}}}),app.directive("autoFocus",function(){return{link:function(t,e){e[0].focus()}}}),app.controller("ctrlBox",function(t,e,o,a,r,c){t.ca={},t.ca.quantity_product=1,t.ca.payment_method="Dinheiro",t.formatCurrency=function(t){return e("currency")(t,"R$ ",2)},t.subFormLocateProduct=function(){o.post("src/locateProductBox.php",t.ca).then(function(e){let o=e.data;t.ca.bar_code_product="",t.ca.quantity_product=1,t.productsPurchased?t.productsPurchased.push(o):t.productsPurchased=[o],c.addArray(o),c.addValues(o.total_value_item,o.total_tax_item),t.totalTax=t.formatCurrency(c.getTotalTax()),t.grandTotal=t.formatCurrency(c.getGrandTotal()),$("#locateProduct").modal("hide")}).catch(function(t){r.msgErro(t.data)})},t.calculateChange=function(e){let o=e.target,a=o.value,r=c.getGrandTotal();t.changePurchase=parseFloat(a-r),t.changePurchase=t.formatCurrency(parseFloat(t.changePurchase.toFixed(2))),""==a&&(t.changePurchase="")},t.subFormRemoveItem=function(){if(!t.productsPurchased)return t.ca.item_product="",$("#removeItem").modal("hide"),r.msgErro("N\xe3o h\xe1 itens a serem removidos."),!1;let e=t.ca.item_product,o=c.getAllArrays(),a=o[e].total_value_item,n=o[e].total_tax_item;c.deleteArray(e),t.productsPurchased.splice(e,1),t.ca.item_product="",t.ca.amount_received="",t.changePurchase="",c.removeValues(a,n),t.totalTax=t.formatCurrency(c.getTotalTax()),t.grandTotal=t.formatCurrency(c.getGrandTotal()),$("#removeItem").modal("hide")},t.closePurchase=function(){if(!t.productsPurchased)return $("#finalizePurchase").modal("hide"),r.msgErro("N\xe3o h\xe1 produtos lan\xe7ados!"),!1;let e=t.ca.payment_method,a=t.ca.amount_received;if("Dinheiro"===e&&(void 0===a||""===a))return $("#finalizePurchase").modal("hide"),r.msgErro("Por favor, informe o valor recebido."),!1;if("Dinheiro"!==e&&(t.ca.amount_received=c.getGrandTotal()),a<c.getGrandTotal())return $("#finalizePurchase").modal("hide"),r.msgErro("Valor recebido esta abaixo do valor  Total."),!1;let n={items:c.getAllArrays(),total:c.getGrandTotal(),tax:c.getTotalTax(),method:t.ca.payment_method,received:t.ca.amount_received};o.post("src/completingPurchase.php",n).then(function(e){r.msgSuccess(e.data),c.clean(),t.productsPurchased=[],t.ca.amount_received="",t.changePurchase="",t.totalTax=c.getTotalTax(),t.grandTotal=c.getGrandTotal()}).catch(function(t){r.msgErro(t.data)}),$("#finalizePurchase").modal("hide")},t.handleKeyDown=function(e){switch(e.keyCode){case 117:t.totalTax=c.clean(),t.changePurchase="",a.location.href="#!/";break;case 118:$("#removeItem").modal("show");break;case 120:$("#locateProduct").modal("show");break;case 113:$("#finalizePurchase").modal("show")}},angular.element(document).on("keydown",t.handleKeyDown),t.$on("$destroy",function(){angular.element(document).off("keydown",t.handleKeyDown)})});