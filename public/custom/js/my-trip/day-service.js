const btnAddDay = document.querySelector('.btn-add-day')

//  Lấy ngày hôm nay theo định dạng yyyy-mm-dd
const today = new Date().toISOString().split('T')[0];

// Đặt giá trị min cho input date
document.getElementById('date_start').setAttribute('min', today);
// document.getElementById('date_start').setAttribute('value', today);

const listTourDay = document.getElementById('list-tour-day')
const listTourDayContent = document.getElementById('list-tour-day-content')

let dayNumber = 0;
let dateStart = new Date().toISOString().split('T')[0];

function getNextFiveDays(dayLimit, dayNumber) {
    const today = new Date(dayLimit);
    const nextFiveDays = [dayLimit];

    for (let i = 1; i <= dayNumber; i++) {
        // Tạo một bản sao của ngày hiện tại và cộng thêm i ngày
        const nextDay = new Date(today);
        nextDay.setDate(today.getDate() + i);

        // Chuyển đổi ngày thành định dạng yyyy-mm-dd
        const formattedDate = nextDay.toISOString().split('T')[0];
        nextFiveDays.push(formattedDate);
    }

    return nextFiveDays;
}

document.getElementById('number_day').addEventListener('change', function () {
    dayNumber = this.value
    generateListDay(getNextFiveDays(dateStart, dayNumber), dayNumber)
})

document.getElementById('date_start').addEventListener('change', function () {
    dateStart = this.value
    generateListDay(getNextFiveDays(dateStart, dayNumber), dayNumber)
})

const number_adult = document.querySelector('#number_adult')

function countTotalServicePrice() {
    let count = 0
    const servicePrice = document.querySelectorAll('.service-price');
    const individual = document.querySelector('.service-individual-total-price')
    const listPrice = Array.from(servicePrice).map(item => {
        return item.dataset.price
    })

    listPrice.forEach(item => {
        count += (Number(item) * Number(number_adult.value))
    })

    individual.innerHTML = `${formatCurrency(count)}`
    individual.setAttribute('data-price', count)
}

function generateListDay(listDay, dayNumber, add = null, day = null) {
    let listDayHtml = '';
    let listDayContentHtml = '';
    const random = Math.floor(Math.random() * 10000);
    for (let i = 0; i < dayNumber; i++) {
        listDayHtml += `
        <li class="day-box" data-target="day-box-${i + 1}-${random}">
                            <span>Day ${day ? day : i + 1}</span>
                            [${listDay[i]}]
                        </li>
        `
    }
    if (add) {
        listTourDay.innerHTML += listDayHtml
    } else {
        listTourDay.innerHTML = listDayHtml
    }
    const listIdFileManager = []
    for (let i = 0; i < dayNumber; i++) {

        let count = 1;
        listDayContentHtml += `
        <li class="wrap-list-option-ad" data-target="day-box-${i + 1}-${random}">
                                        <span>Day ${day ? day : i + 1}</span>
                                        <input type="hidden" name="day_order[]" value="${day ? day : i + 1}"/>
                                          <input type="hidden" name="day_time[]" value="${listDay[i]}"/>
                                  [${listDay[i]}]
                                   <input type="text" class="w-100" value="" name="day_title[]"/>
                                    
                                    </li>
                                    <div class="list-tour-ad-desc ${i > 0 ? 'd-none' : ''}" id="day-box-${i + 1}-${random}">
                                        <div class="desc">
                                            <textarea class="w-100" name="day_description[]">
                                            </textarea>
                                        </div>
                                        <div class="row">
                                            <div class="clm" style="--w-lg: 6; --w-xs: 12;">
                                                <div class="check-img" id="content${i + 1}-${count}-wrapper">
                    <img class="d-block img-content${i + 1}-${count}"
                        src="https://cdn.icon-icons.com/icons2/1993/PNG/512/add_circle_create_expand_new_plus_icon_123218.png"
                        alt="">
                    <div style="display: none">
                        <div class="input-group">
                            <span class="input-group-btn">
                                <a data-input="img-content${i + 1}-${count}-input" data-preview="img-content${i + 1}-${count}"
                                    class="btn btn-primary" id="img-content${i + 1}-${count}">
                                    <i class="fa fa-picture-o"></i> Choose
                                </a>
                            </span>
                            <input id="img-content${i + 1}-${count}-input" class="form-control" type="text" name="day_image_path1[]">
                        </div>
                    </div>
                </div>
                                            </div>
                                            `;
        listIdFileManager.push(`content${i + 1}-${count}`)
        count++
        listDayContentHtml += `<div class="clm" style="--w-lg: 6; --w-xs: 12;">
                                             
                                                <div class="check-img" id="content${i + 1}-${count}-wrapper">
                    <img class="d-block img-content${i + 1}-${count}"
                        src="https://cdn.icon-icons.com/icons2/1993/PNG/512/add_circle_create_expand_new_plus_icon_123218.png"
                        alt="">
                    <div style="display: none">
                        <div class="input-group">
                            <span class="input-group-btn">
                                <a data-input="img-content${i + 1}-${count}-input" data-preview="img-content${i + 1}-${count}"
                                    class="btn btn-primary" id="img-content${i + 1}-${count}">
                                    <i class="fa fa-picture-o"></i> Choose
                                </a>
                            </span>
                            <input id="img-content${i + 1}-${count}-input" class="form-control" type="text" name="day_image_path2[]">
                        </div>
                    </div>
                </div>
                                            
                                            </div>
                                        </div>
                                        <table class="w-100">

                                            <thead>
                                                <tr>
                                                    <th style="width: 45px;" class="btn-add-option" data-day="${day ? day : i + 1}">+</th>
                                                    <th class="tt-up">Gói giá dịch vụ cho cả tour</th>
                                                    <th class="tt-up">Gói giá dịch vụ cho cả tour</th>
                                                    <th class="ta-center tt-up">Tên gói</th>
                                                    <th class="ta-center tt-up">Tổng giá</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                               
                                            </tbody>
                                        </table>
                                    </div>`
        listIdFileManager.push(`content${i + 1}-${count}`)
    }

    if (add) {
        listTourDayContent.innerHTML += listDayContentHtml
    } else {
        listTourDayContent.innerHTML = listDayContentHtml
    }

    listIdFileManager.forEach(item => {
        handleFileManager(item)
    })

    const listDayBox = document.querySelectorAll('.day-box')
    listDayBox.forEach(item => {
        item.addEventListener('click', function () {
            const listDayContent = document.getElementById(this.dataset.target)
            listDayContent.classList.toggle('d-none')
        })
    })

    // Xử lý chọn dịch vụ 
    // const serviceTour = @json($serviceTour);
    document.addEventListener('click', function (event) {
        const random = Math.floor(Math.random() * 10000000);
        if (event.target.classList.contains('btn-add-option')) {
            const tableServiceTBody = event.target.closest('table').querySelector('tbody');
            let newRow = document.createElement('tr');
            newRow.innerHTML = `
        <td class="ta-center remove-btn " data-remove="service-all-price-${random}" style="cursor: pointer">-</td>
        <td>
            <select class="my-select select2-${random}" style="width: 100%;" name="day_service[${event.target.dataset.day}][]">
                <option value=""></option>
                ${serviceTour.map(item => `<option value="${item.id}">${item.name}</option>`).join('')}
            </select>
        </td>
        <td class="ta-center service-all-2" >
            <select class="my-select select2-child-${random}" style="width: 100%;" name="day_service_child[${event.target.dataset.day}][]">
                <option value=""></option>
            </select>
        </td>
        <td class="ta-center">
            <select class="my-select select2-child-2-${random}" style="width: 100%;" name="day_service_option[${event.target.dataset.day}][]">
                <option value=""></option>
            </select>
        </td>
        <td class="ta-center service-price service-all-price-${random}" data-price="0">---</td>`;
            tableServiceTBody.appendChild(newRow);

            // Event for removing the row
            newRow.querySelector('.remove-btn').addEventListener('click', function () {
                const elementPriceBox = document.querySelector(`.${this.dataset.remove}`);
                const price = elementPriceBox.dataset.price;
                const listTotalPrice = document.querySelector('.service-individual-total-price')

                // const priceTourBox2 = document.querySelectorAll('.price-tour-box-2')
                // priceTourBox2.forEach(item => {
                //     if (elementPriceBox.dataset.class.split('-').pop() == item.dataset.target.split('-').pop()) {
                //         item.setAttribute('data-price', item.dataset.price - (elementPriceBox.dataset.price * number_adult.value))
                //     }
                // })
                elementPriceBox.setAttribute('data-price', 0)
                listTotalPrice.setAttribute('data-price', Number(listTotalPrice.dataset.price) - (Number(price) * number_adult.value))
                totalPriceBox1()
                newRow.remove()
                countTotalPriceFinal()
            });

            // Initialize Select2 for the new row
            $(newRow).find(`.select2-${random}`).select2({
                placeholder: 'Select an service',
                allowClear: true,
            });

            $(`.select2-${random}`).on('select2:select', function (e) {
                const data = e.params.data;
                let url = routeServiceGetChild;
                url = url.replace(':id', data.id);
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function ({
                        error,
                        data
                    }) {
                        if (!error) {
                            if (data && data.length > 0) {
                                $(newRow).find(`.select2-child-${random}`).html([
                                    '<option value=""></option>', ...data.map(
                                        item => {
                                            return `<option value="${item.id}">${item.name}</option>`
                                        })
                                ].join(''))
                            } else {
                                $(newRow).find(`.select2-child-${random}`).html(
                                    '<option value=""></option>')
                            }
                        }
                    }
                })
            });

            $(newRow).find(`.select2-child-${random}`).select2({
                placeholder: 'Select an service',
                allowClear: true,
            })
            $(`.select2-child-${random}`).on('select2:select', function (e) {
                const data = e.params.data;
                let url = routeServiceGetOptionByServiceId;
                url = url.replace(':id', data.id);
                $.ajax({
                    url: url,
                    type: 'GET',
                    data: {
                        time: document.getElementById('date_start').value
                    },
                    success: function ({
                        error,
                        data
                    }) {
                        if (!error) {
                            if (data && data.length > 0) {
                                $(newRow).find(`.select2-child-2-${random}`).html([
                                    '<option value=""></option>', ...data.map(
                                        item => {
                                            return `<option value="${item.id}" data-price="${item.price}" data-class="price-tour-box-2-${item.service_type_id}" data-type="2">${item.name}</option>`
                                        })
                                ].join(''))
                            } else {
                                $(newRow).find(`.select2-child-2-${random}`).html(
                                    '<option value=""></option>')
                            }
                        }
                    }
                })
            });

            $(newRow).find(`.select2-child-2-${random}`).select2({
                placeholder: 'Select an service',
                allowClear: true,
            })
            $(`.select2-child-2-${random}`).on('select2:select', function (e) {
                const listOption = e.target.querySelectorAll('option');
                const option = listOption[e.target.selectedIndex];

                $(newRow).find(`.service-all-price-${random}`).text(formatCurrency(option.dataset
                    .price))
                $(newRow).find(`.service-all-price-${random}`).attr('data-price', option.dataset
                    .price)
                $(newRow).find(`.service-all-price-${random}`).attr('data-type', option.dataset
                    .type)
                $(newRow).find(`.service-all-price-${random}`).addClass(option.dataset.class)
                $(newRow).find(`.service-all-price-${random}`).attr('data-class', option.dataset
                    .class)
                countTotalServicePrice()
                totalPriceBox1()
            });
        }
    });
    // Kết thúc xử lý chọn dịch vụ
}

btnAddDay.addEventListener('click', function () {
    generateListDay([getNextFiveDays(dateStart, dayNumber)[getNextFiveDays(dateStart, dayNumber).length - 1]], 1, 1, ++dayNumber)
})