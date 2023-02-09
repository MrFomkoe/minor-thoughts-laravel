const collapseBtns = document.querySelectorAll(".collaplse-btn");

collapseBtns.forEach((button) => {
    button.addEventListener("click", collapseSection);
});

function collapseSection(e) {
    const button = e.currentTarget;
    const list = button.parentNode.querySelector(".dashboard-list");

    list.classList.toggle("collapsed");
}


const navCollapseSection = document.getElementById('navigation-collapse-section');
const navCollapseLinks = document.getElementById('navigation-collapse-links');

navCollapseSection.addEventListener('mouseenter', collapseNav);
navCollapseSection.addEventListener('mouseleave', uncollapseNav);

function collapseNav() {
    navCollapseLinks.classList.add('collapsed')
}

function uncollapseNav() {
    navCollapseLinks.classList.remove('collapsed')
}