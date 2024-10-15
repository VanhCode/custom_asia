// Xử lý chọn dịch vụ cả tour
const tableServiceAll = document.querySelector('.table-service-all-body');
const tableServiceAllTBody = document.querySelector('.table-service-all-body tbody');
const btnAddServiceAll = document.querySelector('.table-service-all-body .btn-add');

function countTotalPriceServiceFull() {
    let totalPrice = 0;
    document.querySelectorAll('.service-all-price-total').forEach(item => {
        totalPrice += Number(item.dataset.price)
    })
    document.querySelectorAll('.service-full-total-price').forEach(item => {
        item.setAttribute('data-price', totalPrice)
        item.innerText = `${formatCurrency(totalPrice)}`
    })
}

btnAddServiceAll.addEventListener('click', function () {
    // Thêm một dòng mới vào bảng
    const random = Math.floor(Math.random() * 10000);
    let newRow = document.createElement('tr');
    newRow.innerHTML =
        `<td class="ta-center remove-btn" style="cursor: pointer" data-remove="service-all-price-${random}">-</td>
                 <td>
                     <select class="my-select select2-${random}" style="width: 100%;" name="full_tour[]">
                         <option value=""></option>
                         ${serviceFullTour.map(item => `<option value="${item.id}">${item.name}</option>`).join('')}
                     </select>
                 </td>
                 <td class="ta-center service-all-2">
                       <select class="my-select select2-child-${random}" style="width: 100%;" name="full_tour_child[]">
                         <option value=""></option>
                     </select>
                     </td>
                 <td class="ta-center">
                    <select class="my-select select2-child-2-${random}" style="width: 100%;" name="full_tour_option[]">
                         <option value=""></option>
                     </select>
                      </td>
                 <td class="ta-center service-all-price-total service-all-price-${random}" data-price="0">---</td>`;

    tableServiceAllTBody.appendChild(newRow);

    // Gán sự kiện remove cho các dòng mới
    newRow.querySelector('.remove-btn').addEventListener('click', function () {
        const price = document.querySelector(`.${this.dataset.remove}`).dataset.price;
        const listTotalPrice = document.querySelectorAll('.service-full-total-price')
        listTotalPrice.forEach(item => {
            item.setAttribute('data-price', Number(item.dataset.price) - Number(price))
        })
        totalPriceBox1()
        newRow.remove()
        countTotalPriceFinal()
    });

    // Khởi tạo Select2 chỉ cho các thẻ <select> mới
    $(newRow).find(`.select2-${random}`).select2({
        placeholder: 'Select an service',
        allowClear: true,
    })
    $(`.select2-${random}`).on('select2:select', function (e) {
        const data = e.params.data;
        let url = routeGetChild;
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
                            '<option value=""></option>', ...data.map(item => {
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
        let url = routeGetOptionByServiceId;
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
                            '<option value=""></option>', ...data.map(item => {
                                return `<option value="${item.id}" data-price="${item.price}" data-class="price-tour-box-2-${item.service_type_id}" data-type="1">${item.name}</option>`
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
        $(newRow).find(`.service-all-price-${random}`).text(formatCurrency(option.dataset.price))
        $(newRow).find(`.service-all-price-${random}`).attr('data-price', option.dataset.price)
        $(newRow).find(`.service-all-price-${random}`).attr('data-type', option.dataset
            .type)
        $(newRow).find(`.service-all-price-${random}`).addClass(option.dataset.class)
        countTotalPriceServiceFull()
        totalPriceBox1()
    });

});

// Kết thúc xử lý chọn dịch vụ cả tour