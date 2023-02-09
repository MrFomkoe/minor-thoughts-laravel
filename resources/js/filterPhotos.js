const selector = document.getElementById('gallery-select');

selector.addEventListener('change', filterPhotos);

function filterPhotos(e) {
    document.forms[0].submit()
}