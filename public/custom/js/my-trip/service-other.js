const btnAddServiceOtherBtn = document.querySelector('.add-btn-service-other')
const TBodyServiceOtherBtn = document.querySelector('.service-other-table tbody')

btnAddServiceOtherBtn.addEventListener('click', function () {
    const random = Math.floor(Math.random() * 10000);
    let newRow = document.createElement('tr');
    newRow.innerHTML =
        `<td class="ta-center remove-btn" style="cursor: pointer" data-remove="service-all-price-${random}">-</td>
                 <td>
                     <select class="my-select select2-${random}" style="width: 100%;" name="service_other_id[]">
                         <option value=""></option>
                         ${serviceOther.map(item => `<option value="${item.id}" data-price="${item.price}" >${item.name}</option>`).join('')}
                     </select>
                 </td>
                 <td class="ta-center service-other-price-one service-other-price-one-${random}" data-price="0" data-input-hidden="price_other_one-${random}">
      0 VND/ Người
      </td>
      <input type="hidden" name="price_other_one[]" id="price_other_one-${random}">
                 <td class="ta-center service-other-price-total service-other-price-${random} " data-target="service-other-price-one-${random}" data-price="0" data-input-hidden="price_other-${random}">
                 0 VND
                 
                 </td><input type="hidden" name="price_other[]" id="price_other-${random}">`;

    TBodyServiceOtherBtn.appendChild(newRow);

    // Gán sự kiện remove cho các dòng mới
    newRow.querySelector('.remove-btn').addEventListener('click', function () {
        newRow.remove()
        countTotalPriceFinal()
    });

    // Khởi tạo Select2 chỉ cho các thẻ <select> mới
    $(newRow).find(`.select2-${random}`).select2({
        placeholder: 'Select an service',
        allowClear: true,
    })

    $(`.select2-${random}`).on('select2:select', function (e) {
        const optionsElement = e.target.querySelectorAll('option');
        const findEle = Array.from(optionsElement).find(item => item.value == e.params.data.id);

        const element = document.querySelector(`.service-other-price-${random}`)

        const pricePeople = findEle.dataset.price * Number(number_adult_person.value)
        element.innerHTML = `${formatCurrency(pricePeople)}`
        element.setAttribute('data-price', pricePeople)
        document.getElementById(element.dataset.inputHidden).value = pricePeople

        const inputTarget = document.querySelector(`.${element.dataset.target}`)
        inputTarget.setAttribute('data-price', findEle.dataset.price)
        inputTarget.innerHTML = `${formatCurrency(findEle.dataset.price)} / NGƯỜI`
        document.getElementById(inputTarget.dataset.inputHidden).value = findEle.dataset.price

        countTotalPriceService()
        countTotalPriceFinal()
    });

})

function countTotalPriceService() {
    let countTotal = 0;
    let countTotalOne = 0;
    document.querySelectorAll('.service-other-price-total').forEach(item => {
        countTotal += (Number(item.dataset.price))
    })
    const elementTotal = document.querySelector('.total-price-service-other')
    const elementTotalOne = document.querySelector('.total-price-service-other-one')

    elementTotal.innerText = `${formatCurrency(countTotal)}`
    elementTotal.setAttribute('data-price', countTotal)
    document.getElementById(elementTotal.dataset.inputHidden).value = countTotal

    document.querySelectorAll('.service-other-price-one').forEach(item => {
        countTotalOne += Number(item.dataset.price)
    })
    elementTotalOne.innerText = `${formatCurrency(countTotalOne)}/ người`
    elementTotalOne.setAttribute('data-price', countTotalOne)
    document.getElementById(elementTotalOne.dataset.inputHidden).value = countTotalOne
}