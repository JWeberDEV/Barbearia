console.log("Hello World");

const obj = {
  nome: 'Josias',
  idade: 24,
}

console.log(obj.idade);

//DOM - MODELO DE OBJETO DE DOCUMENTO
const tds = document.querySelectorAll('td'); // RETORNA UM ARRAY

for (let index = 0; index < tds.length; index++) {
  tds[index].addEventListener('click', () => {
    tds.style.backgroundColor = 'red';
  });
}

// function parOuImpar(numero) { (numero % 2 === 0) ? 'PAR' : 'ÍMPAR'; }