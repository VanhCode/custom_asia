const btnAddIncluded = document.querySelector('.btn-add-included')
const TBodyAddIncluded = document.querySelector('.service-included-body')

const btnAddExcluding = document.querySelector('.btn-add-excluding')
const TBodyAddExcluding = document.querySelector('.service-excluding-body')

btnAddIncluded.addEventListener('click', function () {
    const random = Math.floor(Math.random() * 10000);
    let newRow = document.createElement('tr');
    newRow.innerHTML =
        `
    <tr>
     <tr>
    <td class="ta-center remove-btn">-</td>
    <td>
     <select class="form-select select2-${random}" name="included[]">
                <option value="">-- Chọn dịch vụ --</option>
                ${serviceIncluded.map(item => `<option value="${item.id}">${item.name}</option>`).join('')}
            </select>
    </td>
</tr>
    </tr>
    `;

    TBodyAddIncluded.appendChild(newRow);

    // Gán sự kiện remove cho các dòng mới
    newRow.querySelector('.remove-btn').addEventListener('click', function () {
        newRow.remove()
    });

    $(`.select2-${random}`).select2({
        placeholder: "-- Chọn dịch vụ --"
    })
})

btnAddExcluding.addEventListener('click', function () {
    const random = Math.floor(Math.random() * 10000);
    let newRow = document.createElement('tr');
    newRow.innerHTML =
        `
    <tr>
     <tr>
    <td class="ta-center remove-btn">-</td>
    <td>
     <select class="form-select select2-${random}" name="excluding[]">
                <option value="">-- Chọn dịch vụ --</option>
                ${serviceIncluded.map(item => `<option value="${item.id}">${item.name}</option>`).join('')}
            </select>
    </td>
</tr>
    </tr>
    `;

    TBodyAddExcluding.appendChild(newRow);

    // Gán sự kiện remove cho các dòng mới
    newRow.querySelector('.remove-btn').addEventListener('click', function () {
        newRow.remove()
    });

    $(`.select2-${random}`).select2({
        placeholder: "-- Chọn dịch vụ không bao gồm --"
    })
})