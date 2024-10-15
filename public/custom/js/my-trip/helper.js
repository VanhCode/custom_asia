function formatCurrency(value) {
    // Kiểm tra xem giá trị đầu vào có phải là số không
    if (isNaN(value)) {
        return "0 VND";
    }

    // Chuyển đổi số thành chuỗi và làm tròn về số nguyên
    value = Math.round(Number(value));

    // Tách phần nguyên
    const formattedInteger = value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

    // Trả về kết quả với đơn vị VND
    return formattedInteger + " VND";
}

function formatCurrencyNumber(value) {
    // Kiểm tra xem giá trị đầu vào có phải là số không
    if (isNaN(value)) {
        return "0 VND";
    }

    // Chuyển đổi số thành chuỗi và làm tròn về số nguyên
    value = Math.round(Number(value));

    // Tách phần nguyên
    const formattedInteger = value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

    // Trả về kết quả với đơn vị VND
    return formattedInteger.replace(/,/g, '');
}