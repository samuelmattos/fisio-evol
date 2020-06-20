/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./src/App/js/evolucao.js":
/*!********************************!*\
  !*** ./src/App/js/evolucao.js ***!
  \********************************/
/*! no static exports found */
/***/ (function(module, exports) {

var evolucoes_vue = new Vue({
  delimiters: ['%{', '}'],
  el: '#evolucoes_vue',
  data: {
    evolucoes: []
  }
});
var nova_evolucao = document.querySelector('#nova_evolucao');

nova_evolucao.onclick = function () {
  var id_paciente = $("#id_paciente").val();
  $("#nova_evolucao").addClass("loading");
  axios.get('cadastrar/' + id_paciente + '/' + null).then(function (response) {
    popCadastro(response.data);
    $("#nova_evolucao").removeClass("loading");
  })["catch"](function (error) {
    $("#nova_evolucao").removeClass("loading");
    popError('Erro', error);
  });
};

function cadastrarEvolucao() {
  var formData = getFormData($("#cad_evolucao"));
  $("#cad_evolucao").addClass("loading");
  axios.post('salvar', formData).then(function (response) {
    $("#cad_evolucao").removeClass("loading");
    $('#myModal').modal('toggle');
    var avaliacao = response.data.evolucao;
    evolucoes_vue.evolucoes.push(avaliacao);
  })["catch"](function (error) {
    $("#cad_evolucao").removeClass("loading");
    $('#myModal').modal('toggle');
    popError('Erro', error.response.data.error.message);
  });
}

;

function editarEvolucao(id_evolucao, index) {
  var formData = getFormData($("#cad_evolucao"));
  $("#cad_evolucao").addClass("loading");
  axios.post('update/' + id_evolucao, formData).then(function (response) {
    if (response.data == 1) {
      evol = [];
      getFormData($("#cad_evolucao")).forEach(function (value, key) {
        evol[key] = value;
      });
      evolucoes_vue.evolucoes.splice(index, 1, evol);
      $('#myModal').modal('toggle');
    }

    $("#cad_evolucao").removeClass("loading");
  })["catch"](function (error) {
    $("#cad_evolucao").removeClass("loading");
    popError('Erro', error.response.data.error.message);
  });
}

;

function confirmaRemocao(id, id_paciente) {
  creat_popup('Atenção', 'Deseja remover a evolução do sistema?', function () {
    return removeEvolucao(id, id_paciente);
  });
}

;

function removeEvolucao(id, id_paciente, index) {
  axios.get('remove/' + id + '/' + id_paciente).then(function (response) {
    if (response.data) {
      evolucoes_vue.evolucoes.splice(index, 1);
    }
  })["catch"](function (error) {
    popError('Erro', error.response.data.error.message);
  });
}

;

function viewEditEvolucao(id_evolucao, index) {
  $("#cad_evolucao").addClass("loading");
  axios.get('viewEdit/' + id_evolucao + '/' + index).then(function (response) {
    popCadastro(response.data);
    $("#cad_evolucao").removeClass("loading");
  });
}

;

/***/ }),

/***/ 1:
/*!**************************************!*\
  !*** multi ./src/App/js/evolucao.js ***!
  \**************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\Projects\fisio-evol\src\App\js\evolucao.js */"./src/App/js/evolucao.js");


/***/ })

/******/ });