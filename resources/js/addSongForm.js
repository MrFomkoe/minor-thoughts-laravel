// Getting buttons from DOM
const addSongBtn = document.getElementById('addSongBtn');
const saveSongBtn = document.getElementById('saveSongBtn');

// Adding listeners
addSongBtn.addEventListener('click', addSongForm);
saveSongBtn.addEventListener('click', saveSongs);

// Logic for adding input fields
function addSongForm () {
    const container =  document.getElementById('songs-form');
    const inputs = document.querySelector('.dashboard-form-unit')
    const newInputs = inputs.cloneNode(true);
    container.appendChild(newInputs);
}

// Submission of form to server
function saveSongs() {
    document.forms['songs-form'].submit();
}
