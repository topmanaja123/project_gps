function checkInterval() {
    let date1 = document.getElementById("startDate").value;
    let time1 = document.getElementById("timeStart").value;
    let date2 = document.getElementById("dateEnd").value;
    let time2 = document.getElementById("timeEnd").value;

    let datestart = Date.parse(date1);
    let dateend = Date.parse(date2);
    let interval = Math.abs(datestart - dateend) / 1000 / 60 / 60 / 24 + 1;

    console.log(interval);
    if (interval <= 31) {
        return true;
    } else {
        alert('คุณเลือกเกิน 31 วัน');
        return false;
    }
}