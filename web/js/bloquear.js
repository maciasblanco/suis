/**
 * Revisa la tecla presionada y verifica que este permitida, de no estarlo la bloquea
 * @param evento event El evento a revisar
 * @param permitidas string EL tipo de tecla que se aceptara
 * @param opciones object Parametros opcionales, los cuales se pasan como un objeto p. ej.: {"recargar":false}
 *
 * --- Posibles opciones ---
 *   recargar: Permitir F5
 *     valores: true, false
 *     defecto: true
 *
 *   retorno:  Permitir la tecla "Enter"
 *     valores: true, false
 *     defecto: true
 *
 *   borrar: Permitir la tecla "Backspace"
 *     valores: true, false
 *     defecto: true
 *
 * --- Listado de teclas ---
 *            0   1   2  3    4   5   6   7   8   9
 * Numeros = [48, 49, 50, 51, 52, 53, 54, 55, 56, 57];
 *
 *                             0   1   2   3   4    5    6    7    8    9
 * Numeros teclado numerico = [96, 97, 98, 99, 100, 101, 102, 103, 104, 105];
 *
 *           65  66  67  68   69   70   71   72   73   74   75   76   77   78   79   80   81   82   83   84   85   86   87   88   89   90
 * Letras = [a,  b,  c,  d,   e,   f,   g,   h,   i,   j,   k,   l,   m,   n,   o,   p,   q,   r,   s,   t,   u,   v,   w,   x,   y,   z
 * 
 */
function bloquearTeclas(evento, permitidas, opciones){
  var tecla = evento.which || evento.keyCode;
  var estaShift = evento.shiftKey;
  var estaCtrl = evento.ctrlKey;
  var estaAlt = evento.altKey;
  //console.log(tecla);
  var hayOpc = (typeof opciones != "undefined") ? true : false;
  var siRetorno = (hayOpc && typeof opciones['retorno'] != "undefined") ? opciones['retorno'] : true;
  var siBorrar = (hayOpc && typeof opciones['borrar'] != "undefined") ? opciones['borrar'] : true;
  var siDelete = (hayOpc && typeof opciones['delete'] != "undefined") ? opciones['delete'] : true;
  var siRecargar = (hayOpc && typeof opciones['recargar'] != "undefined") ? opciones['recargar'] : true;
  var siFlechas = (hayOpc && typeof opciones['flechas'] != "undefined") ? opciones['flechas'] : true;
  var siTabulador = (hayOpc && typeof opciones['tabulador'] != "undefined") ? opciones['tabulador'] : true;
  var siPunto = (hayOpc && typeof opciones['punto'] != "undefined") ? opciones['punto'] : false;
  var siCopiar = (hayOpc && typeof opciones['copiar'] != "undefined") ? opciones['copiar'] : true;
  var siPegar = (hayOpc && typeof opciones['pegar'] != "undefined") ? opciones['pegar'] : false;

  var teclaRetorno = 13;
  var teclaBorrar = 8;
  var teclaDelete = 46;
  var teclaRecargar = 116;
  var teclaFlechaIzq = 37;
  var teclaFlechaDer = 39;
  var teclaFlechaArr = 38;
  var teclaFlechaAba = 40;
  var teclaTabulador = 9;
  var teclaPunto = 190;
  var teclaPuntoNum = 110;

  
  //Revisa si es la tecla "enter" y esta permitida
  if (tecla == teclaRetorno)
    return (siRetorno) ? true : false;

  //Revisa si es la tecla "backspace" y esta permitida
  if (tecla == teclaBorrar)
    return (siBorrar) ? true : false;

  //Revisa si es la tecla "delete" y esta permitida
  if (tecla == teclaDelete)
    return (siDelete) ? true : false;

  //Revisa si es la tecla "F5" y esta permitida
  if (tecla == teclaRecargar)
    return (siRecargar) ? true : false;

  //Revisa si es una tecla de "flechas" y esta permitida
  if (tecla == teclaFlechaIzq || tecla == teclaFlechaDer || tecla == teclaFlechaArr || tecla == teclaFlechaAba)
    return (siFlechas) ? true : false;

  //Revisa si es la tecla "tabulador" y esta permitida
  if (tecla == teclaTabulador)
    return (siTabulador) ? true : false;
    
  //Revisa si es la tecla "punto" y esta permitida
  if (tecla == teclaPunto || tecla == teclaPuntoNum)
  return (siPunto) ? true : false;
  
  //Revisa si es la combinacion "Ctrl + C" y esta permitida
  if (tecla == 67 && estaCtrl)
      return siCopiar ? true : false;
  
  //Revisa si es la combinacion "Ctrl + V" y esta permitida
  if (tecla == 86 && estaCtrl)
      return siPegar ? true : false;

  //Revisa que las teclas esten en un grupo permitido
  switch (permitidas){
    case 'letra':
      if (tecla >= 65 && tecla <= 90)
        return true;
      break;

    case 'num':
      if (estaShift || estaCtrl || estaAlt)
        return false;
      if ((tecla >= 48 && tecla <= 57) || (tecla >=96 && tecla <= 105))
        return true;
      break;

    default:
      return true;
  }

  return false;
}