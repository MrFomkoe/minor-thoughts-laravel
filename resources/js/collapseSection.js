const collapseBtns = document.querySelectorAll(".collaplse-btn");

collapseBtns.forEach((button) => {
    button.addEventListener("click", collapseSection);
});

function collapseSection(e) {
    const button = e.currentTarget;
    const list = button.parentNode.querySelector(".dashboard-list");

    list.classList.toggle("collapsed");
}

