//############## Only numbers ###############
const onlyNumbers = (event) => {
  let input = event.target;
  input.value = validateCampoNumerico(input.value);
};

const validateCampoNumerico = (value) => {
  if (!value) return "";
  value = value.replace(/\D/g, "");
  return value;
};

//############## Currency Mask ###############
const currencyMask = (event) => {
  const input = event.target;
  let valor = input.value;

  valor = valor.replace(/\D/g, "");
  valor = valor.replace(/([0-9]{2})$/g, ".$1");

  if (valor.length > 6) {
    valor = valor.replace(/([0-9]{3}),([0-9]{2}$)/g, "$1.$2");
  }

  input.value = valor;
  if (valor === "NaN") input.value = "";
};

//############## Scroll Bottom ###############
const scrollToBottom = () => {
  const listProductDiv = $("#list-product");
  listProductDiv.scrollTop(listProductDiv.prop("scrollHeight"));
};

