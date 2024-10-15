const btnViewAll = document.querySelector('.btn-view-all')

btnViewAll.addEventListener('click', function () {
    const listTourAdDesc = document.querySelectorAll('.list-tour-ad-desc')
    listTourAdDesc.forEach(item => {
        item.classList.remove('d-none')
    })
})