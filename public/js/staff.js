const rowListBook = $('tbody');
const btnUpdate = $('.btn-update')
const btnAddUser = $('.add-user');
const btnDelete = $$('.btn-delete')
const btnAddStaff = $('.add-staff')
rowListBook.onclick = function (e) {
    const row = e.target.closest('tr');
    if (row && !e.target.closest('.btn-delete')) {
        const allCol = Array.from(row.querySelectorAll('td'));
        Array.from($$('input[name]')).forEach(input => {
            switch (input.name) {
                case 'MA_NV':
                    input.value = allCol[0].innerText;
                    break;
                case 'TEN_NV':
                    input.value = allCol[1].innerText;
                    break;
                case 'NGAY_SINH':
                    input.value = allCol[2].innerText;
                    break;
                case 'DIA_CHI':
                    input.value = allCol[3].innerText;
                    break;
                case 'SDT':
                    input.value = allCol[4].innerText;
                    break;
                default:
                    break;
            }
        })
        $('select[name="MA_BP"]').selectedIndex  = $(`option[value="${hanldeString(allCol[5].innerText)}"]`).index;
        $('select[name="CHUC_VU"]').selectedIndex = $(`option[value="${(allCol[6].innerText)}"]`).index;
        $('.OLD_MA_NV').innerText = allCol[0].innerText;
        btnUpdate.removeAttribute('hidden');
        $('.btn-add').setAttribute('hidden', '');
    }

}
function hanldeString(str) {
    const string = str.split(' ');
    let result = '';
    for (let index = 0; index < string.length; index++) {
        result+=string[index][0];
    }
    return result;
}
btnAddStaff.onclick = function(e) {
    Array.from($$('input[name]')).forEach(input => input.value = '');
    $('select[name="MA_BP"]').selectedIndex  = 0;
    $('select[name="CHUC_VU"]').selectedIndex = 0;
    btnUpdate.setAttribute('hidden' , '');
    $('.btn-add').removeAttribute('hidden');
}
btnUpdate.onclick = function (e) {
    e.preventDefault();
    const code =    $('.OLD_MA_NV').innerText
    const Api = `http://127.0.0.1:8000/update/staff/${code}`
    const data = Array.from($$('input[name]')).reduce((acc, curr, index) => {
            acc[curr.name] = curr.value;
        return acc;
    }, {})
    if ($('select[name="MA_BP"]').value !== ""){
        data['MA_BP'] =  $('select[name="MA_BP"]').value;
    }
    if ($('select[name="CHUC_VU"]').value !== ""){
        data['CHUC_VU'] = $('select[name="CHUC_VU"]').value;
    }
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
            window.location.href = '/staff-manager';
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
                window.location.href = '/staff-manager';
            })
            .catch(error => console.log(error))
    }
})