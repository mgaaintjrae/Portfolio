console.log("hello");

// const header = document.querySelector('.home-header-background');
// const headerContent = header.querySelector('.home-header-background-content');


// window.addEventListener('scroll', e => {
//     headerContent.style.top = `${50 + (window.pageYOffset / 16)}%`
// });

const parallax = document.querySelector('.parallax');

window.addEventListener('scroll', () => {
    parallax.style.backgroundPositionY = -window.scrollY / 4 + "px";
});