const btnPayBook = $$('.btn-pay-book');
Array.from(btnPayBook).forEach(btnPayBook => {
    btnPayBook.onclick = function (e) {
        $('.pay-book').removeAttribute('hidden');
        $('.lost-book').setAttribute('hidden', '');
        const allCol = e.target.closest('tr').querySelectorAll('td');
        const data = Array.from(allCol).reduce((acc, curr, index) => {
            acc[curr.getAttribute('class')] = curr.innerText;
            return acc;
        }, {})
        $$('#name_users')[0].value = data.name;
        $$('#name_users')[1].value = data.name;
        $('#TIEN').value = Number(data.TRI_GIA) + 5000 + Number(subtractDateStrings(data.NGAY_TRA, getCurrentDay()) > 0 ? subtractDateStrings(data.NGAY_TRA, getCurrentDay()) * 1000 : 0);
        $$('input[name="NGAY_TRA"]')[0].value = getCurrentDay();
        $$('input[name="NGAY_TRA"]')[1].value = getCurrentDay();
        $$('input[name="MA_DG"]')[0].value = data.MA_DG;
        $$('input[name="MA_DG"]')[1].value = data.MA_DG;
        $$('input[name="MA_SACH"]')[0].value = data.MA_SACH;
        $$('input[name="MA_SACH"]')[1].value = data.MA_SACH;
        $('#name_book').value = data.name_book;
        $('#TIEN_PHAT_KNAY').value = subtractDateStrings(data.NGAY_TRA, getCurrentDay()) > 0 ? subtractDateStrings(data.NGAY_TRA, getCurrentDay()) * 1000 : 0;
        fetch(`http://127.0.0.1:8000/get/bill/book/${data.MA_DG}`)
            .then(res => res.json())
            .then(data => {
                $('#TIEN_NO').value = data.TIEN_PHAT || 0;
                $$('input[name="TIEN_PHAT"]')[0].value = data.TIEN_PHAT ? Number($('#TIEN_PHAT_KNAY').value) + Number(data.TIEN_PHAT) : Number($('#TIEN_PHAT_KNAY').value);
                $$('input[name="TIEN_PHAT"]')[1].value = data.TIEN_PHAT ? Number($('#TIEN').value) + Number(data.TIEN_PHAT) : Number($('#TIEN').value);
            })
            .catch(error => console.log(error))
    }
})
function subtractDateStrings(dateString1, dateString2) {
    const dateParts1 = dateString1.split("/");
    const date1 = new Date(dateParts1[2], dateParts1[1] - 1, dateParts1[0]); // Lưu ý: tháng trong Date bắt đầu từ 0
    const dateParts2 = dateString2.split("/");
    const date2 = new Date(dateParts2[2], dateParts2[1] - 1, dateParts2[0]); // Lưu ý: tháng trong Date bắt đầu từ 0
    const millisecondsPerDay = 24 * 60 * 60 * 1000; // Số mili giây trong 1 ngày
    const timeDiff = date2.getTime() - date1.getTime(); // Độ chênh lệch thời gian
    const dayDiff = Math.round(timeDiff / millisecondsPerDay); // Độ chênh lệch ngày, làm tròn đến ngày gần nhất
    return dayDiff;
}
function getCurrentDay() {
    const today = new Date(); // Lấy ngày hiện tại
    const day = today.getDate().toString().padStart(2, "0"); // Lấy ngày (có thêm ký tự '0' nếu chỉ có một chữ số)
    const month = (today.getMonth() + 1).toString().padStart(2, "0"); // Lấy tháng (phải cộng thêm 1 vì tháng trong Date bắt đầu từ 0)
    const year = today.getFullYear().toString(); // Lấy năm
    return `${day}/${month}/${year}`; // Trả về chuỗi định dạng dd/mm/yyyy
}
$('.btn-lost-book').onclick = function (e) {
    e.preventDefault();
    console.log(1);
    $('.pay-book').setAttribute('hidden', '');
    $('.lost-book').removeAttribute('hidden');
}