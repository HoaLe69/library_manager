const $$ = document.querySelectorAll.bind(document);
const $ = document.querySelector.bind(document);
const listItem = Array.from($$('.nav-item-link'));
$('.nav-item-link.active').classList.remove('active');
const index = localStorage.getItem('index') || 0;
listItem[index].classList.add('active');
listItem.forEach((item , index) => {
    item.onclick = (e) => {
        localStorage.setItem('index' ,index )
        item.classList.add('active')
    }
}) 
