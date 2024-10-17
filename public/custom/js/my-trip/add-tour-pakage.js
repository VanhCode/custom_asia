const btnAddTourPackage = document.querySelector('.add-tour-package');
const tourOptions = document.querySelectorAll('.tour-option');
const customBtnConfirm = document.querySelector('.custom-btn-confirm')

const radioTourInputs = document.querySelectorAll('.radio-tour');

radioTourInputs.forEach(item => {
    item.addEventListener('click', function () {
        tourOptions.forEach(item2 => {
            if (!item2.classList.contains('d-none')) {
                item2.classList.add('d-none')
            }
            item2.querySelectorAll('input').forEach(item3 => {
                item3.checked = false
            })
        })
        const option = document.querySelector(`.${item.id}`)
        option.classList.remove('d-none')
    })
})

customBtnConfirm.addEventListener('click', function () {
    const listOption = document.querySelectorAll('.tour-option input:checked')
    const listIds = Array.from(listOption).map(item => item.id)

    if (listIds.length == 0) {
        alert('Vui lòng chọn gói tour!')
        return
    }

    const listDayBox = document.querySelectorAll('.list-tour-ad-text .day-box')
    const inputDate = document.getElementById('date_start')
    const date_start = listDayBox.length > 0 ? listDayBox[listDayBox.length - 1].dataset.date : inputDate.value
    const day_start = listDayBox.length > 0 ? listDayBox[listDayBox.length - 1].dataset.day : 0
    console.log(date_start)
    $.ajax({
        url: routeAddTourPackage,
        type: 'GET',
        data: {
            date_start,
            day_start,
            listIds: listIds
        },
        success: function ({ status, dayHtml, dayContentHtml, dayLast, date_Start }) {
            if (status === 'success') {
                const listTourDay = document.getElementById('list-tour-day')
                listTourDay.innerHTML += dayHtml

                const listTourDayContent = document.getElementById('list-tour-day-content')
                listTourDayContent.innerHTML += dayContentHtml

                $('.select2').select2();

                const listFileManager = document.querySelectorAll('.img-filemanager')
                listFileManager.forEach(item => {
                    handleFileManager(item.dataset.class)
                })
                countTotalServicePrice()
                totalPriceBox1()
                dayNumber = dayLast + listIds.length - 1;
                dateStart = date_Start;
                document.getElementById("custom-modal").classList.remove("active");

                listOption.forEach(item => {
                    item.checked = false
                })

                document.querySelectorAll('.radio-tour').forEach(item => {
                    item.checked = false
                })
            }
        }
    })
})