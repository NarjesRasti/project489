let searchform = document.querySelector('.search-form');





document.querySelector('#search-btn').onclick = () => {
searchform.classList.toggle('active');

    tonav.classList.remove('active');
    loginform.classList.remove('active');

}
let loginform = document.querySelector('.login-form');

document.querySelector('#user').onclick = () => {
loginform.classList.toggle('active');
searchform.classList.remove('active');
    tonav.classList.remove('active');
   

}
let tonav = document.querySelector('.tonav');

document.querySelector('#bars-btn').onclick = () => {
tonav.classList.toggle('active');
searchform.classList.remove('active');
    
    loginform.classList.remove('active');

}
window.onscroll = () => {
    searchform.classList.remove('active');
    tonav.classList.remove('active');
    loginform.classList.remove('active');}




