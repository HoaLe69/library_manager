const search = $$('.search-input-sta');
search[1].oninput = function (e) {
    console.log(e);
    fetch(`http://127.0.0.1:8000/thong-ke-tra-muon?q=${e.target.value}`)
        .then(res => res.json())
        .then(data => {
            if (data) {
                renderBorrow(data)
            }
        })
        .catch(error => console.log(error))
}
search[2].oninput = function (e) {
    fetch(`http://127.0.0.1:8000/thong-ke-tien-no?q=${e.target.value}`)
        .then(res => res.json())
        .then(data => {
            if (data[0]) {
                renderMoneyLend(data)
            }
        })
        .catch(error => console.log(error))
}
function renderMoneyLend(data) {
    const tag = data.map((value, index) => {
        return `
            <tr>
                <td>${index + 1}</td>
                <td>${value.TEN_DG  }</td>
                <td>${value.TIEN_PHAT}</td>
            </tr>
        `
    })
    $('.money-lend').innerHTML = tag.join(' ');
}
function renderBorrow(data) {
    const tag = data.map((value, index) => {
        const day = subtractDateStrings(value.NGAY_TRA , value.NGAY_TRA_THUC_TE)
        return `
            <tr>
                <td>${index + 1}</td>
                <td>${value.TEN_SACH}</td>
                <td>${value.NGAY_MUON}</td>
                <td>${day > 0 ? day : 0}</td>
            </tr>
        `
    })
    $('.day-late').innerHTML = tag.join(' ');
}
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