import Vue from 'vue'
import RegisterEvolution from './components/evolution.js'
import axios from 'axios'
import 'bootstrap'
import $ from 'jquery'
import 'jquery-mask-plugin';
window.axios = axios;
window.$ = window.jQuery = $;

Vue.component('evolution', RegisterEvolution)
window.Vue = Vue;