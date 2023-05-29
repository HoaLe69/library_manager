const rowListBook = $('tbody');
const btnUpdate = $('.btn-update');
const btnDel = $$('.btn-delete');
rowListBook.onclick = function (e) {
    if (!e.target.closest('.btn-delete')) {
        const row = e.target.closest('tr')
        const allCol = row.querySelectorAll('td');
        Array.from($$('input[name]')).forEach(input => {
            switch (input.name) {
                case 'MA_TL':
                    input.value = allCol[0].innerText;
                    break;
                case 'TEN_TL':
                    input.value = allCol[1].innerText;
                    break;
                default:
                    break;
            }
        })
        $('input[name="code"]').value = allCol[0].innerText;
        $('.btn-update').removeAttribute('hidden');
        $('.btn-submit').setAttribute('hidden', '');
    }
    btnUpdate.onclick = function (e) {
        e.preventDefault();
        const code = $('input[name="code"]').value;
        const data = {
            MA_TL: $('input[name="MA_TL"]').value,
            TEN_TL: $('input[name="TEN_TL"]').value,
        }
        const Api = `http://127.0.0.1:8000/update/book-type/${code}`
        fetch(Api, {
            method: 'PUT',
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(data)
        })
            .then(res => res.json())
            .then(data => {
                alert(data);
                window.location.href = '/book-type';
            })
            .catch(error => console.log(error))
    }
}
Array.from(btnDel).forEach(btndel => {
    btndel.onclick = function (e) {
        const code = e.target.closest('tr').querySelector('td').innerText;
        const Api = `http://127.0.0.1:8000/delete/book-type/${code}`
        fetch(Api, {
            method: 'Delete',
        })
            .then(res => res.json())
            .then(data => {
                alert(data);
                window.location.href = '/book-type';
            })
            .catch(error => console.log(error))
    }
})
$('.search-input').oninput = function (e) {
    const Api = `http://127.0.0.1:8000/get-book-type?q=${e.target.value}`;
    fetch(Api)
        .then(res => res.json())
        .then(data => {
            if (data) {
                render(data);
            }
        })
        .catch(err => console.log(err))
}
function render(data) {
    console.log(data);
    const tag = data[0].map((value, index) => {
        return `
        <tr>
            <td>${ value.MA_TL }</td>
            <td>${ value.TEN_TL }</td>
            <td>${ value.LUOT_MUOT }</td>
            <td><button type="button" class="btn-delete">Xóa</button></td>
    </tr>
        `
    })
    $('.body-book-type').innerHTML = tag.join(' ');
}
