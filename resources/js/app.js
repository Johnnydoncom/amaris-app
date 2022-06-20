require('./bootstrap');

import Alpine from 'alpinejs';

import "pikaday/css/pikaday.css";
var Pikaday = require('pikaday');
window.Pikaday = Pikaday;

import 'flowbite';

window.Alpine = Alpine;

Alpine.start();
