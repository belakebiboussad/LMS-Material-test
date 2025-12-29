import './bootstrap';
import Choices from 'choices.js';
import 'choices.js/public/assets/styles/choices.min.css'; // Import the CSS
import './mdl.js'; // Import your file
window.Choices = Choices;
/*
import Dropzone from 'dropzone';
window.Dropzone = Dropzone; 
*/
window.Dropzone = import('dropzone');
document.addEventListener('DOMContentLoaded', () => {
    /*
    const elements = document.querySelectorAll('.choices-select');
    elements.forEach(element => {
        new Choices(element, {
            // Options can be added here
            searchEnabled: true,
            itemSelectText: '', // Disable the "Press to select" text
            closeDropdownOnSelect: 'auto',
            removeItemButton: true,
        });
    });
    */

});
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start(); 
