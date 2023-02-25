const mobileNavBtn = document.getElementById('mobile-nav-btn');
const navigation = document.querySelector('.navigation');
// const btnStripe = document.querySelector('.mobile-nav-btn-stripe');

mobileNavBtn.addEventListener('click', collapseMobileNav);

function collapseMobileNav() {
    mobileNavBtn.classList.toggle('checked');
    navigation.classList.toggle('collapsed');
    // console.log('click');
}

const navCollapseSection = document.getElementById('navigation-collapse-section');
const navCollapseLinks = document.getElementById('navigation-collapse-links');

navCollapseSection.addEventListener('mouseenter', collapseLink);
navCollapseSection.addEventListener('mouseleave', uncollapseLink);

function collapseLink() {
    navCollapseLinks.classList.add('collapsed')
}

function uncollapseLink() {
    navCollapseLinks.classList.remove('collapsed')
}