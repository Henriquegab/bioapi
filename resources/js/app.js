import './bootstrap';

import $ from 'jquery';
window.$ = window.jQuery = $;

import 'lightbox2/dist/css/lightbox.css';
import 'lightbox2';

document.addEventListener('DOMContentLoaded', function() {
    const mainImage = document.querySelector('.gallery-main-image');
    const thumbnails = document.querySelectorAll('.gallery-thumbnail img');

    thumbnails.forEach(thumbnail => {
        thumbnail.addEventListener('click', function() {
            const largeImageUrl = this.dataset.largeImage;
            mainImage.src = largeImageUrl;
            mainImage.classList.add('zoomed');
            mainImage.addEventListener('click', toggleZoom);
        });
    });

    function toggleZoom() {
        this.classList.toggle('zoomed');
    }
});

