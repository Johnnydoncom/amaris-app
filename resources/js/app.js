require('./bootstrap');

import Alpine from 'alpinejs';

import 'flowbite';

import "pikaday/css/pikaday.css";
var Pikaday = require('pikaday');
window.Pikaday = Pikaday;

window.Alpine = Alpine;

Alpine.start();
