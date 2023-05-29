const modal = $('.modal-container');
const btnAdd = $('.add-book');
const btnclose = $('.close');
const rowListBook = $('tbody');
const inputFileImg = $('.input-file');
const thumbBook = $('.thum-img');
const inputTypeBook = $('input[name="MA_TL"]');
const submenuTypeBook = $('.submenu');
const showBtn = $('.another-show');
const tableListBook = $('.table');
const galleryBook = $('.gallery');
const cards = $$('.container-card');
const rowsInTableListBook = $$('.table tbody tr');
const btnUpdate = $('.btn-update');
// show  and clear input field  modal infor book 
btnAdd.onclick = function (e) {
    Array.from(modal.querySelectorAll('input')).forEach(input => input.value = '')
    thumbBook.src = './img/books.png';
    $('.btn-submit').innerText = 'Thêm'
    $('.btn-submit').removeAttribute('hidden')
    btnUpdate.setAttribute('hidden', '');

    modal.style.transform = 'translateX(0)'
}
//update data
btnUpdate.onclick = (e) => {
    e.preventDefault();
    const data = Array.from($$('input[name]')).reduce((acc, curr, index) => {
        if (curr.value !== '' && curr.name !== 'THUMBNAIL') {
            acc[curr.name] = curr.value;
        }
        return acc;
    }, {})
    fetch('http://127.0.0.1:8000/update-book', {
        method: 'PUT',
        headers : {
            "Content-Type": "application/json",
        },
        body : JSON.stringify(data)
    })
        .then(response => response.json())
        .then(data => {
            if (data) {
                alert(data);
                window.location.href = 'http://127.0.0.1:8000/book';
            }
        })
        .catch(error => console.error(error))
}
// hide modal
btnclose.onclick = function (e) {
    modal.style.transform = 'translateX(calc(100% + 32px))'
}
//click on card container
Array.from(cards).forEach(card => {
    card.onclick = () => {
        const index = Number(card.dataset.index);
        fillContent(rowsInTableListBook[index])
    }
})
// switch view in bookmn site
showBtn.onclick = function (e) {
    if (tableListBook.hasAttribute('hidden')) {
        showBtn.innerHTML = '<i class="bx bxs-grid"></i>';
        tableListBook.removeAttribute('hidden');
        galleryBook.setAttribute('hidden', '');
    }
    else {
        showBtn.innerHTML = '<i class="bx bx-list-ul"></i>';
        tableListBook.setAttribute('hidden', '');
        galleryBook.removeAttribute('hidden');
    }
}
// event select row in table books
rowListBook.onclick = function (e) {
    const row = e.target.closest('tr');
    if (!e.target.closest('.btn-delete')) {
        fillContent(row);
        btnUpdate.removeAttribute('hidden');
        $('.btn-add').setAttribute('hidden', '');
    }
}
function fillContent(list) {
    if (list) {
        const allCol = Array.from(list.querySelectorAll('td'));
        Array.from($$('input[name]')).forEach(input => {
            switch (input.name) {
                case 'TEN_SACH':
                    input.value = allCol[0].innerText + ':' + allCol[1].innerText;
                    break;
                case 'MA_TL':
                    input.value = allCol[11].innerText + ':' + allCol[4].innerText;
                    break;
                case 'TAC_GIA':
                    input.value = allCol[3].innerText;
                    break;
                case 'TINH_TRANG':
                    input.value = allCol[2].innerText;
                    break;
                case 'NHA_XUAT_BAN':
                    input.value = allCol[5].innerText;
                    break;
                case 'NXB':
                    input.value = allCol[6].innerText;
                    break;
                case 'TRI_GIA':
                    input.value = allCol[8].innerText.split(' ')[0];
                    break;
                case 'NGAY_NHAP':
                    input.value = allCol[7].innerText;
                    break;
                case 'MA_NV':
                    input.value = allCol[9].innerText;
                    break;
                default:
                    break;
            }
        })
        $('.thum-img').src = allCol[10].innerText
        modal.style.transform = 'translateX(0)'
    }
}
// event slect file .png input file
inputFileImg.onchange = function (e) {
    thumbBook.src = URL.createObjectURL(inputFileImg.files[0]);
}
// show and hide modal infor book
document.onclick = function (e) {
    if ((!e.target.closest('.modal-container')) && !(e.target.closest('.add-book'))
        && !(e.target.closest('table')) && !(e.target.closest('.container-card'))) {
        modal.style.transform = 'translateX(calc(100% + 32px))'
    }
}

function debounce(fn, ms = 300) {
    let timer;
    return function () {
        // Nhận các đối số
        const args = arguments;
        const context = this;

        if (timer) clearTimeout(timer);

        timer = setTimeout(() => {
            fn.apply(context, args);
        }, ms)
    }
}
function render(list) {
    submenuTypeBook.innerHTML = '';
    const listType = list.map(list => {
        return `<li class='list-type-book-item'>${list.MA_TL} : ${list.TEN_TL}</li>`
    })
    const ulElement = document.createElement('ul');
    ulElement.classList.add('list-type-book');
    ulElement.innerHTML = listType.join(' ');
    submenuTypeBook.appendChild(ulElement);

}
inputTypeBook.onkeyup = function (e) {
    debounce(() => {
        const q = inputTypeBook.value;
        fetch(`http://127.0.0.1:8000/get-book-type?q=${q}`)
            .then(res => res.json())
            .then(data => {
                if (data[0]) {
                    submenuTypeBook.style.display = 'block';
                    render(data[0])
                }
                else {
                    submenuTypeBook.style.display = 'none';
                }
            })
            .catch(err => console.log(err))
    })();
}
submenuTypeBook.onclick = function (e) {
    if (e.target.closest('.list-type-book-item')) {
        inputTypeBook.value = e.target.innerHTML;
        submenuTypeBook.style.display = 'none';
    }
}
function getCurrentDay() {
    var currentDate = new Date();
    var day = ("0" + currentDate.getDate()).slice(-2);
    var month = ("0" + (currentDate.getMonth() + 1)).slice(-2);
    var year = currentDate.getFullYear();
    var formattedDate = day + "/" + month + "/" + year;
    return formattedDate;
}
Array.from($$('.btn-borrow')).forEach(btn => {
    btn.onclick = function(e) {
        const allCol = e.target.closest('tr').querySelectorAll('td');
        $('input[name="MA_SACH"]').value = allCol[0].innerText;
        $$('input[name="TEN_SACH"]')[1].value = allCol[1].innerText;
        $('.thumnails img').src = allCol[10].innerText;
        $('input[name="NGAY_MUON"]').value = getCurrentDay();
        $$('input[name="MA_TL"]')[1].value = allCol[11].innerText;
    }
})
Array.from($$('.btn-thanh-ly')).forEach(btn => {
    btn.onclick = function (e) {
        console.log(e);
        const code = e.target.closest('tr').querySelectorAll('td')[0].innerText;
        fetch(`http://127.0.0.1:8000/delete/book/${code}`,{
            method : 'DELETE'
        })
        .then (res=>res.json())
        .then(data => {
            alert(data)
            window.location.href = 'http://127.0.0.1:8000/book';
        })
        .catch(err => console.log(err));
    }
})
// $$('.search-input')[0].oninput = (e) => {
//     console.log(e);
//     CallApi(e.target.value);
// }
// $$('.search-input')[1].oninput = (e) => {
//     CallApi(e.target.value);
// }
// function  CallApi(value) {
//     const Api = `http://127.0.0.1:8000/get-book-by-query?q=${value}`
//     fetch(Api)
//         .then(res => res.json())
//         .then(data => render(data))
//         .catch(err => console.log(err))
// }
// function render(data){
//     console.log(data);
//     const books = data.map(data => {
//         return `<tr>
//                 <td>${data.MA_SACH }</td>
//                 <td>${data.TEN_SACH }</td>
//                 <td>${data.TINH_TRANG }</td>
//                 <td>${data.TAC_GIA }</td>
//                 <td>${data.TEN_TL }</td>
//                 <td>${data.NHA_XUAT_BAN }</td>
//                 <td>${data.NXB }</td>
//                 <td>${data.NGAY_NHAP }</td>
//                 <td>${data.TRI_GIA } VNĐ</td>
//                 <td hidden>${data.MA_NV }</td>
//                 <td hidden>${asset('storage/' . data.THUMBNAIL) }</td>
//                 <td hidden>${data.MA_TL }</td>
//                 <td>
//                     <button class="btn-delete">Xóa</button>
//                     @if (data.TINH_TRANG === 'Đang cho mượn')
//                         <button disabled='true' class="btn-delete btn-borrow" class="btn btn-primary"
//                             data-bs-toggle="modal" data-bs-target="#staticBackdrop">Mượn</button>
//                     @else
//                         <button  class="btn-delete btn-borrow" class="btn btn-primary"
//                             data-bs-toggle="modal" data-bs-target="#staticBackdrop">Mượn</button>
//                     @endif
//                 </td>
//         </tr>`
//     })
//     $('.list-books').innerHTML = books.join(' ');
// }

