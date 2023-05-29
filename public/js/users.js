const rowListBook = $('tbody');
const btnUpdate = $('.btn-update')
const btnAddUser = $('.add-user');
const btnDelete = $$('.btn-delete')
rowListBook.onclick = function (e) {
    const row = e.target.closest('tr');
    if (row && !e.target.closest('.btn-delete')) {
        const allCol = Array.from(row.querySelectorAll('td'));
        Array.from($$('input[name]')).forEach(input => {
            switch (input.name) {
                case 'MA_DG':
                    input.value = allCol[0].innerText;
                    break;
                case 'TEN_DG':
                    input.value = allCol[1].innerText;
                    break;
                case 'NGAY_SINH':
                    input.value = allCol[2].innerText;
                    break;
                case 'DIA_CHI':
                    input.value = allCol[3].innerText;
                    break;
                case 'NGAY_LAP':
                    input.value = setDateValue(allCol[6].innerText);
                    break;
                case 'email':
                    input.value = allCol[4].innerText;
                    break;
                default:
                    break;
            }
        })
        $('.OLD_MA_DG').innerText = allCol[0].innerText;
    }
    btnUpdate.removeAttribute('hidden');
    $('.btn-add').setAttribute('hidden', '');
}
btnAddUser.onclick = () => {
    Array.from($$('input[name]')).forEach(input => {
        input.value = '';
    })
    btnUpdate.setAttribute('hidden', '');
    $('.btn-add').removeAttribute('hidden');
}
function setDateValue(dateValue) {
    try {
        var dateParts = dateValue.split("/");
        var year = dateParts[2];
        var month = dateParts[1];
        var day = dateParts[0];
        console.log(year, month, day);
        const date = `${year}-${month}-${day}`
        var newDate = new Date(date);
        var formattedDate = newDate.toISOString().slice(0, 10);
        return formattedDate
    } catch (err) {
        console.error("Lỗi: " + err.message);
    }
}

btnUpdate.onclick = function (e) {
    e.preventDefault();
    const code =    $('.OLD_MA_DG').innerText
    const Api = `http://127.0.0.1:8000/update/users/${code}`
    const data = Array.from($$('input[name]')).reduce((acc, curr, index) => {
        if (curr.name !== 'OLD_MA_DG') {
            acc[curr.name] = curr.value;
        }
        return acc;
    }, {})
    console.log(code, data);
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
            window.location.href = '/users-manager';
        })
        .catch(error => console.log(error))
}
Array.from(btnDelete).forEach(btndel => {
    btndel.onclick = function (e) {
        const code = e.target.closest('tr').querySelector('td').innerText;
        const Api = `http://127.0.0.1:8000/delete/users/${code}`
        fetch(Api, {
            method: 'Delete',
        })
            .then(res => res.json())
            .then(data => {
                alert(data);
                window.location.href = '/users-manager';
            })
            .catch(error => console.log(error))
    }
})
Array.from($$('.btn-money')).forEach(btn => {
    btn.onclick = function(e) {
        const allCol = e.target.closest('tr').querySelectorAll('td');
        $('#name_user').value = allCol[1].innerText;
        $('#tien_no').value = allCol[8].innerText;
        $$('input[name="MA_DG"]')[1].value =  allCol[0].innerText;
        $('#so_tien_thu').oninput = function(e) {
            $('input[name="TONG_NO"]').value = Number(allCol[8].innerText.split(' ')[0]) - Number(e.target.value)
        }
    }
})