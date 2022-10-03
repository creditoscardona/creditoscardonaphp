var public_spreadsheet_url =
  "https://docs.google.com/spreadsheets/d/e/2PACX-1vQgk9dOKKJ2z6zucAlhe242092gwRY0ZIIW1J_OUcGHeOrYO18SlPtxmDhomCVLtdPlubP89EJYc_tj/pub?output=csv";
var public_spreadsheet_url1 =
  "https://docs.google.com/spreadsheets/d/e/2PACX-1vRE7Qh38z6fiqvp_pcoVhyiafKeVlQvSLsfuurm0P5X2T5a4qHm9t7rx2sPKl6sSfVsdgUr3AbnT1I7/pub?output=csv";
var public_spreadsheet_url2 =
  "https://docs.google.com/spreadsheets/d/e/2PACX-1vTMXUhA0KfuCNLPgvE1AfF-Bwt4-k25hYYgoi3jhtse6SPHjqtQkNQyh1bK2ysxvYV5-J0jfcKD0FHi/pub?output=csv";
edades = [];
tasas = [];
factores = [];

async function init() {
  Papa.parse(public_spreadsheet_url, {
    download: true,
    header: true,
    complete: showInfo,
  });
  Papa.parse(public_spreadsheet_url1, {
    download: true,
    header: true,
    complete: showInfo2,
  });
  Papa.parse(public_spreadsheet_url2, {
    download: true,
    header: true,
    complete: showInfo3,
  });

  let entidad = document.getElementById("entidad");
  let edad = document.getElementById("edad");
  let tasa = document.getElementById("tasa");
  let cuota = document.getElementById("factcuo");
  if (typeof EntidadResult !== "undefined") {
    entidad.value = EntidadResult;
    setTimeout(changeEntity, 1000);
    setTimeout(() => (edad.value = EdadResult), 2500);
    setTimeout(changeAge, 3000);

    setTimeout(() => (tasa.value = TasaResult), 4500);
    setTimeout(changeRate, 5000);
    setTimeout(() => (cuota.value = factorResult), 6500);
  }

  // changeEntity()
}

window.addEventListener("DOMContentLoaded", init);

function showInfo(results) {
  var data = results.data;
  edades = data;
}
function showInfo2(results) {
  var data2 = results.data;
  tasas = data2;
}
function showInfo3(results) {
  var data3 = results.data;
  factores = data3;
}

async function changeEntity() {
  let entidad = document.getElementById("entidad");
  let edad = document.getElementById("edad");
  // let colonia = document.getElementById(colonia);
  let tasa = document.getElementById("tasa");
  let cuota = document.getElementById("factcuo");
  edad.value = "";
  edad.innerHTML = "";
  tasa.value = "";
  tasa.innerHTML = "";
  cuota.value = "";
  cuota.innerHTML = "";
  optionArray = [];
  optionArray1 = [];
  optionArray2 = [];
  arraySelect = [
    {
      valorFactor: 0,
      Tiempo: "Seleccionar",
    },
  ];
  var public_spreadsheet_url =
    "https://docs.google.com/spreadsheets/d/e/2PACX-1vSQfhSFW-o0okli3fEnan58HwG0czBf_NaubhEwlIxNMZeVvc3axqzSTKnJK8rMLP6YYrMWlV4erTGa/pub?output=csv";
  await Papa.parse(public_spreadsheet_url, {
    download: true,
    header: true,
    complete: (results) => {
      // console.log("PENDIENTE ACA-->",results)
      var data = results.data;

      switch (entidad.value) {
        case data[0].idEntidad:
          let nuevo = edades.filter(
            (number) => number.idEntidad === data[0].idEntidad
          );
          let nuevo4 = tasas.filter(
            (number) => number.idEdad === nuevo[0].idEdad
          );
          let nuevo5 = factores.filter(
            (number) => number.idTasa === nuevo4[0].idTasa
          );
          optionArray = nuevo;
          optionArray1 = nuevo4;
          optionArray2 = arraySelect.concat(nuevo5);
          break;
        case data[1].idEntidad:
          let nuevo1 = edades.filter(
            (number) => number.idEntidad === data[1].idEntidad
          );
          let nuevo6 = tasas.filter(
            (number) => number.idEdad === nuevo1[0].idEdad
          );
          let nuevo7 = factores.filter(
            (number) => number.idTasa === nuevo6[0].idTasa
          );
          optionArray = nuevo1;
          optionArray1 = nuevo6;
          optionArray2 = arraySelect.concat(nuevo7);
          break;
        case data[2].idEntidad:
          let nuevo2 = edades.filter(
            (number) => number.idEntidad === data[2].idEntidad
          );
          let nuevo8 = tasas.filter(
            (number) => number.idEdad === nuevo2[0].idEdad
          );
          let nuevo9 = factores.filter(
            (number) => number.idTasa === nuevo8[0].idTasa
          );
          optionArray = nuevo2;
          optionArray1 = nuevo8;
          optionArray2 = arraySelect.concat(nuevo9);
          break;
        case data[3].idEntidad:
          let nuevo3 = edades.filter(
            (number) => number.idEntidad === data[3].idEntidad
          );
          let nuevo10 = tasas.filter(
            (number) => number.idEdad === nuevo3[0].idEdad
          );
          let nuevo11 = factores.filter(
            (number) => number.idTasa === nuevo10[0].idTasa
          );
          optionArray = nuevo3;
          optionArray1 = nuevo10;
          optionArray2 = arraySelect.concat(nuevo11);
          break;
      }

      for (option = 0; option < optionArray.length; option++) {
        var newOption = document.createElement("option");
        newOption.value = optionArray[option].idEdad;
        newOption.innerHTML = optionArray[option].nombreEdad;
        edad.options.add(newOption);
      }
      for (option = 0; option < optionArray1.length; option++) {
        var newOption1 = document.createElement("option");
        newOption1.value = optionArray1[option].idTasa;
        newOption1.innerHTML = optionArray1[option].nombreTasa;
        tasa.options.add(newOption1);
      }
      for (option = 0; option < optionArray2.length; option++) {
        var newOption2 = document.createElement("option");
        newOption2.value = optionArray2[option].valorFactor;
        newOption2.innerHTML = optionArray2[option].Tiempo;
        cuota.options.add(newOption2);
      }

      // const options89 = Array.from(cuota.options);
      // const optionToSelect89 = options89.find(item => item.value === "0,0223751");
      // optionToSelect89.selected = true;
    },
  });
}
function changeAge() {
  let edad = document.getElementById("edad");
  let tasa = document.getElementById("tasa");
  let cuota = document.getElementById("factcuo");
  cuota.value = "";
  cuota.innerHTML = "";
  tasa.value = "";
  tasa.innerHTML = "";
  optionArray1 = [];
  optionArray2 = [];
  arraySelect = [
    {
      valorFactor: 0,
      Tiempo: "Seleccionar",
    },
  ];
  for (option = 0; option < edades.length; option++) {
    if (edad.value === edades[option].idEdad) {
      optionArray1 = tasas.filter(
        (number) => number.idEdad === edades[option].idEdad
      );
      let nuevo = factores.filter(
        (number) => number.idTasa === optionArray1[0].idTasa
      );
      optionArray2 = arraySelect.concat(nuevo);
      // console.log(optionArray2)
      // console.log(optionArray1)
    }
  }
  for (option = 0; option < optionArray1.length; option++) {
    var newOption1 = document.createElement("option");
    newOption1.value = optionArray1[option].idTasa;
    newOption1.innerHTML = optionArray1[option].nombreTasa;
    tasa.options.add(newOption1);
  }
  for (option = 0; option < optionArray2.length; option++) {
    var newOption2 = document.createElement("option");
    newOption2.value = optionArray2[option].valorFactor;
    newOption2.innerHTML = optionArray2[option].Tiempo;
    cuota.options.add(newOption2);
  }
}
function changeRate() {
  // console.log(tasas)
  let tasa = document.getElementById("tasa");
  let cuota = document.getElementById("factcuo");
  cuota.value = "";
  cuota.innerHTML = "";
  optionArray2 = [];
  arraySelect = [
    {
      valorFactor: 0,
      Tiempo: "Seleccionar",
    },
  ];
  for (option = 0; option < tasas.length; option++) {
    if (tasa.value === tasas[option].idTasa) {
      let nuevo = factores.filter(
        (number) => number.idTasa === tasas[option].idTasa
      );
      optionArray2 = arraySelect.concat(nuevo);
      // console.log(optionArray2)
    }
  }
  for (option = 0; option < optionArray2.length; option++) {
    var newOption2 = document.createElement("option");
    newOption2.value = optionArray2[option].valorFactor;
    newOption2.innerHTML = optionArray2[option].Tiempo;
    cuota.options.add(newOption2);
  }
}

function setValorCuota() {
  let pagaduria = document.getElementById("pagaduria").value;
  let totaldevengado = document
    .getElementById("totald")
    .value.replaceAll(".", "");
  let salud = document.getElementById("salud").value.replaceAll(".", "");
  let pension = document.getElementById("pension").value.replaceAll(".", "");
  let caprovimpo = document
    .getElementById("caprovimpo")
    .value.replaceAll(".", "");
  let pricom = document.getElementById("pricom").value.replaceAll(".", "");
  let partiali = document.getElementById("partiali").value.replaceAll(".", "");
  let salmin = document.getElementById("salmin").value.replaceAll(".", "");
  // let deducciones = document.getElementById('deducciones').value.replaceAll('.', '');
  let priordpub = document
    .getElementById("priordpub")
    .value.replaceAll(".", "");
  let bonordpub = document
    .getElementById("bonordpub")
    .value.replaceAll(".", "");
  let prespe = document.getElementById("prespe").value.replaceAll(".", "");
  let devopartialiment = document
    .getElementById("devopartialiment")
    .value.replaceAll(".", "");
  let servicimedi = document
    .getElementById("servicimedi")
    .value.replaceAll(".", "");
  let casurautom = document
    .getElementById("casurautom")
    .value.replaceAll(".", "");
  let devengadorestas = document.getElementById("devengadorestas");
  let devengadorestasmitad = document.getElementById("devengadorestasmitad");
  let descuentos = document
    .getElementById("descuentos")
    .value.replaceAll(".", "");
  let descuentosalud = document.getElementById("descuentosalud");
  let descuentoscuota = document.getElementById("descuentoscuota");
  let capacidadcuota = document.getElementById("capacidadcuota");
  let valorcartera1 = document
    .getElementById("valorcartera1")
    .value.replaceAll(".", "");
  let valorcartera2 = document
    .getElementById("valorcartera2")
    .value.replaceAll(".", "");
  let valorcartera3 = document
    .getElementById("valorcartera3")
    .value.replaceAll(".", "");
  let valorcartera4 = document
    .getElementById("valorcartera4")
    .value.replaceAll(".", "");
  let valorcartera5 = document
    .getElementById("valorcartera5")
    .value.replaceAll(".", "");
  let valorcartera6 = document
    .getElementById("valorcartera6")
    .value.replaceAll(".", "");
  let totalcompracartera = document.getElementById("totalcompracartera");
  let cuota = document.getElementById("factcuo").value;
  let monto = document.getElementById("monto");
  let aval = document.getElementById("aval");
  //   console.log(pagaduria);
  let beneficios = document.getElementById("beneficios");
  if (pagaduria == 2 || pagaduria == 6 || pagaduria == 9 || pagaduria == 24 || pagaduria == 25 || pagaduria == 26 ) {
    // console.log(pagaduria)
    let result =
      Math.round(totaldevengado) -
      Math.round(salud) -
      Math.round(pension) -
      Math.round(caprovimpo) -
      Math.round(priordpub) -
      Math.round(bonordpub) -
      Math.round(prespe) -
      Math.round(pricom) -
      Math.round(partiali) -
      Math.round(salmin) -
      Math.round(devopartialiment) -
      Math.round(servicimedi) -
      Math.round(casurautom) -
      Math.round(descuentos);
    let result2 =
      Math.round(salud) + Math.round(pension) + Math.round(caprovimpo);
    let resultcomprascartera =
      Math.round(valorcartera1) +
      Math.round(valorcartera2) +
      Math.round(valorcartera3) +
      Math.round(valorcartera4) +
      Math.round(valorcartera5) +
      Math.round(valorcartera6);
    // console.log(result)
    devengadorestas.value = new Intl.NumberFormat("de-DE").format(
      Math.round(result) + Math.round(descuentos)
    );
    devengadorestasmitad.value = new Intl.NumberFormat("de-DE").format(
      Math.round(result) + Math.round(descuentos)
    );
    descuentosalud.value = new Intl.NumberFormat("de-DE").format(
      Math.round(salud) + Math.round(pension) + Math.round(caprovimpo)
    );
    descuentoscuota.value = new Intl.NumberFormat("de-DE").format(
      Math.round(result)
    );
    totalcompracartera.value =
      resultcomprascartera == ""
        ? 0
        : new Intl.NumberFormat("de-DE").format(resultcomprascartera);
    if (resultcomprascartera == "") {
      capacidadcuota.value = new Intl.NumberFormat("de-DE").format(
        Math.round(result)
      );
      let result3 = parseInt(result) / parseFloat(cuota);
      capacidadGeneral = Math.round(result3);
      monto.value = new Intl.NumberFormat("de-DE").format(Math.round(result3));
      aval.value = new Intl.NumberFormat("de-DE").format(Math.round(result3));
      beneficios.value = new Intl.NumberFormat("de-DE").format(
        Math.round(result3)
      );
    } else {
      capacidadcuota.value = new Intl.NumberFormat("de-DE").format(
        Math.round(result) + Math.round(resultcomprascartera)
      );
      let result3 =
        parseInt(Math.round(result) + Math.round(resultcomprascartera)) /
        parseFloat(cuota);
      capacidadGeneral = Math.round(result3);
      monto.value = new Intl.NumberFormat("de-DE").format(Math.round(result3));
      aval.value = new Intl.NumberFormat("de-DE").format(Math.round(result3));
      beneficios.value = new Intl.NumberFormat("de-DE").format(
        Math.round(result3)
      );
    }
  } else {
    let result =
      Math.round(totaldevengado) -
      Math.round(salud) -
      Math.round(pension) -
      Math.round(caprovimpo) -
      Math.round(priordpub) -
      Math.round(bonordpub) -
      Math.round(prespe) -
      Math.round(pricom) -
      Math.round(partiali) -
      Math.round(salmin) -
      Math.round(devopartialiment) -
      Math.round(servicimedi) -
      Math.round(casurautom);
    let result2 =
      Math.round(descuentos) -
      (Math.round(salud) +
        Math.round(pension) +
        Math.round(caprovimpo) +
        Math.round(servicimedi) +
        Math.round(casurautom));
    let resultcomprascartera =
      Math.round(valorcartera1) +
      Math.round(valorcartera2) +
      Math.round(valorcartera3) +
      Math.round(valorcartera4) +
      Math.round(valorcartera5) +
      Math.round(valorcartera6);
    // console.log(result)
    devengadorestas.value = new Intl.NumberFormat("de-DE").format(
      Math.round(result)
    );
    devengadorestasmitad.value = new Intl.NumberFormat("de-DE").format(
      Math.round(result / 2)
    );
    descuentosalud.value = new Intl.NumberFormat("de-DE").format(
      Math.round(salud) +
        Math.round(pension) +
        Math.round(caprovimpo) +
        Math.round(servicimedi) +
        Math.round(casurautom)
    );
    descuentoscuota.value = new Intl.NumberFormat("de-DE").format(
      Math.round(Math.round(result) / 2) - Math.round(result2)
    );
    totalcompracartera.value =
      resultcomprascartera == ""
        ? 0
        : new Intl.NumberFormat("de-DE").format(resultcomprascartera);
    if (resultcomprascartera == "") {
      capacidadcuota.value = new Intl.NumberFormat("de-DE").format(
        Math.round(Math.round(result) / 2) - Math.round(result2)
      );
      let result3 =
        parseInt(Math.round(Math.round(result) / 2) - Math.round(result2)) /
        parseFloat(cuota);
      monto.value = new Intl.NumberFormat("de-DE").format(Math.round(result3));
      capacidadGeneral = Math.round(result3);
      aval.value = new Intl.NumberFormat("de-DE").format(Math.round(result3));
      beneficios.value = new Intl.NumberFormat("de-DE").format(
        Math.round(result3)
      );
    } else {
      capacidadcuota.value = new Intl.NumberFormat("de-DE").format(
        Math.round(Math.round(result) / 2) -
          Math.round(result2) +
          Math.round(resultcomprascartera)
      );
      let result3 =
        parseInt(
          (Math.round(Math.round(result) / 2) -
            Math.round(result2)) +
            Math.round(resultcomprascartera)
        ) / parseFloat(cuota);
      capacidadGeneral = Math.round(result3);
      monto.value = new Intl.NumberFormat("de-DE").format(Math.round(result3));
      aval.value = new Intl.NumberFormat("de-DE").format(Math.round(result3));
      beneficios.value = new Intl.NumberFormat("de-DE").format(
        Math.round(result3)
      );
    }
  }
  // console.log(pagaduria)
}

function setAval() {
  let monto = document.getElementById("monto").value.replaceAll(".", "");
  let optionaval = document.getElementById("optionaval").value;
  let optionbeneficios = document.getElementById("optionbeneficios");
  let benef = optionbeneficios.options[optionbeneficios.selectedIndex].text;
  // console.log(optionaval)
  let vaval = document.getElementById("vaval");
  let result = Math.round(monto) * parseFloat(optionaval);
  vaval.value = new Intl.NumberFormat("de-DE").format(Math.round(result));
  let aval = document.getElementById("aval");
  aval.value = new Intl.NumberFormat("de-DE").format(
    Math.round(Math.round(monto - result))
  );
  let result2 = Math.round(monto - result) - Math.round(benef);
  let beneficios = document.getElementById("beneficios");
  let rema = document.getElementById("remanente");
  beneficios.value = new Intl.NumberFormat("de-DE").format(Math.round(result2));
  rema.value = new Intl.NumberFormat("de-DE").format(Math.round(result2));
}

function setBeneficio() {
  let optionbeneficios = document.getElementById("optionbeneficios");
  let benef = optionbeneficios.options[optionbeneficios.selectedIndex].text;
  // console.log(benef)
  let aval = document.getElementById("aval").value.replaceAll(".", "");
  console.log(Math.round(aval));
  console.log(Math.round(benef));
  let reslt = Math.round(aval) - Math.round(benef);
  let beneficios = document.getElementById("beneficios");
  let rema = document.getElementById("remanente");
  beneficios.value = new Intl.NumberFormat("de-DE").format(Math.round(reslt));
  rema.value = new Intl.NumberFormat("de-DE").format(Math.round(reslt));
}

function changeMonto(input) {
  var num = input.value.replace(/\./g, "");
  if (!isNaN(num)) {
    num = num
      .toString()
      .split("")
      .reverse()
      .join("")
      .replace(/(?=\d*\.?)(\d{3})/g, "$1.");
    num = num.split("").reverse().join("").replace(/^[\.]/, "");
    input.value = num;
  } else {
    alert("Solo se permiten numeros");
    input.value = input.value.replace(/[^\d\.]*/g, "");
  }
  let aval = document.getElementById("aval");
  let vaval = document.getElementById("vaval");
  let beneficios = document.getElementById("beneficios");
  let rema = document.getElementById("remanente");
  let optionaval = document.getElementById("optionaval").value;
  let optionbeneficios = document.getElementById("optionbeneficios");
  let benef = optionbeneficios.options[optionbeneficios.selectedIndex].text;
  let cuota = document.getElementById("factcuo").value;
  let monto = document.getElementById("monto").value.replaceAll(".", "");
  // console.log("MONTO", monto);
  // console.log("CAPA", Math.max(capacidadGeneral));
  if (monto <= Math.max(capacidadGeneral)) {
    let result = monto * parseFloat(cuota);
    let capacidadcuota = document.getElementById("capacidadcuota");
    capacidadcuota.value = new Intl.NumberFormat("de-DE").format(
      Math.round(result)
    );
    let result2 = Math.round(monto) * parseFloat(optionaval);
    vaval.value = new Intl.NumberFormat("de-DE").format(Math.round(result2));
    aval.value = new Intl.NumberFormat("de-DE").format(
      Math.round(monto - result2)
    );
    let result3 = Math.round(monto - result2) - Math.round(benef);
    beneficios.value = new Intl.NumberFormat("de-DE").format(
      Math.round(result3)
    );
    rema.value = new Intl.NumberFormat("de-DE").format(Math.round(result3));
  } else {
    alert("Monto maximo superado");
    document.getElementById("monto").value = new Intl.NumberFormat(
      "de-DE"
    ).format(capacidadGeneral);
    changeMonto();
  }
}

const setComAs = () => {
  let enti = document.getElementById("entidad").value;
  let saldoc = document
    .getElementById("saldocartera")
    .value.replaceAll(".", "");
  let refi = document.getElementById("refi").value.replaceAll(".", "");
  let comas = document.getElementById("optioncomis").value;
  let monto = document.getElementById("monto").value.replaceAll(".", "");
  let optionaval = document.getElementById("optionaval").value;
  let remanente = document.getElementById("remanente");
  if (enti == 3) {
    let comcred = 150000;
    let ivacomcred = comcred * 0.19;
    let cheque = 3000;
    let ivacheque = cheque * 0.19;
    let segvid = (Math.round(monto) * 1066) / 1000000;
    let av = Math.round(monto) * parseFloat(optionaval);
    let ivav = Math.round(av) * 0.19;
    let cargfij =
      comcred +
      ivacomcred +
      cheque +
      ivacheque +
      segvid +
      Math.round(av) +
      ivav;
    let com = Math.round(Math.round(monto) * parseFloat(comas));
    let resultado =
      Math.round(monto) -
      com -
      Math.round(saldoc) -
      Math.round(refi) -
      Math.round(cargfij);
    remanente.value = new Intl.NumberFormat("de-DE").format(
      Math.round(resultado)
    );
  } else if (enti == 4) {
    let comcred = 150000;
    let ivacomcred = comcred * 0.19;
    let cheque = 3000;
    let ivacheque = cheque * 0.19;
    let segvid = (Math.round(monto) * 969) / 1000000;
    let av = Math.round(monto) * parseFloat(optionaval);
    let ivav = Math.round(av) * 0.19;
    let segVol = 13020;
    let cargfij =
      comcred + ivacomcred + cheque + ivacheque + segvid + av + ivav + segVol;
    let com = Math.round(Math.round(monto) * parseFloat(comas));
    let resultado =
      Math.round(monto) -
      com -
      Math.round(saldoc) -
      Math.round(refi) -
      Math.round(cargfij);
    remanente.value = new Intl.NumberFormat("de-DE").format(
      Math.round(resultado)
    );
  }
};

var checkbox = document.getElementById("checkmonto");
if (typeof EntidadResult !== "undefined") {
  checkbox.addEventListener("change", function () {
    if (this.checked) {
      document.getElementById("monto").readOnly = false;
    } else {
      document.getElementById("monto").readOnly = true;
    }
  });
}


