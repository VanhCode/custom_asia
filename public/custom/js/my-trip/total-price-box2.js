const priceTourBox2Percent = document.querySelectorAll('.price-tour-box-2-percent')


priceTourBox2Percent.forEach(item => {
    item.onchange = function () {
        const targetElement = document.querySelector(`.${item.dataset.target}`)
        let price = Number(targetElement.dataset.limit) + Number(targetElement.dataset.limit * (this.value / 100))

        targetElement.setAttribute('data-price', price)
        targetElement.innerText = `${formatCurrency(price)}`
        let countTotal = 0;
        document.getElementById(targetElement.dataset.inputHidden).value = price
        document.querySelectorAll('.price-tour-box-2').forEach(item => {
            countTotal += Number(item.dataset.price)
        })
        const elementTotal = document.querySelector('.total-price-tour-box-2')

        elementTotal.innerText = `${formatCurrency(countTotal)}`
        elementTotal.setAttribute('data-price', countTotal)
        countTotalPriceTourBox2()
        countTotalPriceFinal()
    }
})