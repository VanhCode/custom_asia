const resultPriceBox = document.querySelectorAll('.total-price-box')
const resultPriceBox1 = document.querySelector('.result-price-box-1')
const resultPriceBox1PercentInput = document.querySelector('.result-price-box-1-percent')
const serviceFullTotalPrice = document.querySelectorAll('.service-full-total-price')

const listPriceTourBox2 = document.querySelectorAll('.price-tour-box-2')

const number_adult_person = document.getElementById('number_adult')

const totalPriceFinal = document.querySelector('.total-price-final')
const totalPriceFinalOne = document.querySelector('.total-price-final-one')
const priceTotalItems = document.querySelectorAll('.price-total-item')


const totalPriceBox1 = () => {
    const listPriceBox1 = document.querySelectorAll('.total-price-box-1')
    let count = 0;
    serviceFullTotalPrice.forEach(item => {
        item.innerText = `${formatCurrency(item.dataset.price ?? 0)}`
    })
    listPriceBox1.forEach(item => {
        item.innerText = `${formatCurrency(item.dataset.price ?? 0)}`
        document.getElementById(item.dataset.inputHidden).value = item.dataset.price ?? 0
        count += parseInt(item.dataset.price ?? 0)
    })

    resultPriceBox.forEach(item => {
        if (item.classList.contains('result-price-box-1')) {
            const countPercent = count + (count * (resultPriceBox1PercentInput.value / 100))
            item.innerText = `${formatCurrency(countPercent)}`
            item.setAttribute('data-price', countPercent)
            item.setAttribute('data-limit', count)
            document.getElementById(item.dataset.inputHidden).value = countPercent
            document.querySelector('.price-total-item.input-hidden-box-1').setAttribute('data-price', countPercent - count)
            const priceOneElement = document.querySelector(`.${item.dataset.target}`)
            if (priceOneElement) {
                priceOneElement.innerText = `${formatCurrency(countPercent / Number(number_adult_person.value))}/ Người`
                priceOneElement.setAttribute('data-price', countPercent / Number(number_adult_person.value))
            }
        } else {
            item.innerText = `${formatCurrency(count)}`
            item.setAttribute('data-price', count)
            item.setAttribute('data-limit', count)
            document.getElementById(item.dataset.inputHidden).value = count
            const priceOneElement = document.querySelector(`.${item.dataset.target}`)
            if (priceOneElement) {
                priceOneElement.innerText = `${formatCurrency(count / Number(number_adult_person.value))}/ Người`
                priceOneElement.setAttribute('data-price', count / Number(number_adult_person.value))
            }
        }
    })



    totalPriceBox2()
    countTotalPriceFinal()

}

const totalPriceBox2 = () => {
    listPriceTourBox2.forEach(item => {
        let count = 0
        const listPriceBox2Element = document.querySelectorAll(`.${item.dataset.target}`)
        listPriceBox2Element.forEach(item2 => {
            if (item2.dataset.type == 2) {
                count += (parseInt(item2.dataset.price ?? 0) * parseInt(number_adult_person.value ?? 0))
            } else {
                count += parseInt(item2.dataset.price ?? 0)
            }
        })
        const listClass = item.classList.value.split(' ')
        const inputPercent = document.querySelector(`input[data-target="${listClass[listClass.length - 1]}"]`)

        item.setAttribute('data-limit', count)
        count = count + (count * (inputPercent.value / 100))

        item.innerText = `${formatCurrency(count)}`
        item.setAttribute('data-price', count)

        document.getElementById(item.dataset.inputHidden).value = count
    })
    countTotalPriceTourBox2()
}

resultPriceBox1PercentInput.onchange = function () {
    let price = Number(resultPriceBox1.dataset.limit) + Number(resultPriceBox1.dataset.limit * (this.value / 100))
    resultPriceBox1.setAttribute('data-price', price)
    resultPriceBox1.innerText = `${formatCurrency(price)}`
    const inputHidden = document.querySelector(`.${resultPriceBox1.dataset.hidden}`)
    const inputHidden1 = document.getElementById(resultPriceBox1.dataset.inputHidden)
    inputHidden1.value = price
    inputHidden.setAttribute('data-price', formatCurrencyNumber(price) - Number(resultPriceBox1.dataset.limit))
    countTotalPriceFinal()
}

const countTotalPriceFinal = () => {
    let count = 0;
    priceTotalItems.forEach(item => {
        count += Number(item.dataset.price ?? 0)
    })
    totalPriceFinal.innerText = `${formatCurrency(count)}`
    totalPriceFinalOne.innerText = `${formatCurrency(count / Number(number_adult_person.value))}/ người`
    totalPriceFinal.setAttribute('data-price', count)
    document.getElementById(totalPriceFinal.dataset.inputHidden).value = count
    totalPriceFinalOne.setAttribute('data-price', count / Number(number_adult_person.value))
    document.getElementById(totalPriceFinalOne.dataset.inputHidden).value = count / Number(number_adult_person.value)
}

const countTotalPriceTourBox2 = () => {
    const priceItemsBox2 = document.querySelectorAll('.price-tour-box-2')
    const priceTotalBox2Element = document.querySelector('.total-price-tour-box-2')
    let priceTotalBox2 = 0;
    priceItemsBox2.forEach(item => {
        priceTotalBox2 += Number(item.dataset.price)
    })
    priceTotalBox2Element.innerText = `${formatCurrency(priceTotalBox2)}`
    priceTotalBox2Element.setAttribute('data-price', priceTotalBox2)
    document.getElementById(`${priceTotalBox2Element.dataset.inputHidden}`).value = priceTotalBox2
    const priceOneElement = document.querySelector(`.${priceTotalBox2Element.dataset.target}`)
    document.getElementById(`${priceOneElement.dataset.inputHidden}`).value = priceTotalBox2 / Number(number_adult_person.value)
    priceOneElement.innerText = `${formatCurrency(priceTotalBox2 / Number(number_adult_person.value))}/ người`
}
