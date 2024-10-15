$(document).ready(function () {
    const messageError = 'An error has occurred.';

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    const swal = {
        success: function (title = "", text = "") {
            return Swal.fire({
                title: title,
                text: text,
                icon: 'success',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ok',
                timer: 1500
            })
        },
        confirm: function (title = "", text = "", callback = () => { }) {
            Swal.fire({
                title: title,
                text: text,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    callback();
                }
            })
        }
    };

    $('.change-active').click(function () {
        const that = $(this)
        const url = that.data('url')
        const type = that.data('method')
        swal.confirm('Are you sure?', 'Are you sure you want to change the status?', function () {
            $.ajax({
                url,
                type,
                success: function ({ error }) {
                    if (!error) {
                        if (that.hasClass('active')) {
                            that.text('Hide');
                        } else {
                            that.text('Active');
                        }

                        that.toggleClass('active');
                    } else {
                        alert(messageError)
                    }
                }
            })
        })
    });

    $('.change-order').change(function () {
        const that = $(this)
        const url = that.data('url')
        const type = that.data('method')
        const order = that.val()
        $.ajax({
            url,
            type,
            data: { order },
            success: function ({ error }) {
                if (!error) {
                    swal.success('Success', 'Change order success').then(() => {
                        window.location.reload()
                    })
                } else {
                    alert(messageError)
                }
            }
        })
    });

    $('.delete-record').click(function () {
        const that = $(this)
        const url = that.data('url')
        const type = that.data('method')

        swal.confirm('Are you sure?', 'Are you sure you want to delete this record?', function () {
            $.ajax({
                url,
                type,
                success: function ({ error }) {
                    if (!error) {
                        swal.success('Success', 'Deleted success').then(() => {
                            window.location.reload()
                        })
                    } else {
                        alert(messageError)
                    }
                }
            })
        })
    });

    const triggerModalBtn = document.querySelectorAll('.trigger-modal-btn');
    const customCloseBtn = document.querySelector('.custom-close-btn');
    const customConfirmBtn = document.querySelector('.custom-btn-confirm');
    const customCancelBtn = document.querySelector('.custom-btn-cancel');
    const modelCustom = document.getElementById("custom-modal")
    const customForm = document.getElementById('customForm');

    if (triggerModalBtn) {
        triggerModalBtn.forEach((btn) => {
            btn.addEventListener('click', function () {
                customForm.setAttribute('data-type', this.dataset.type)
                showCustomModal();
                if (this.dataset.type == 'update') {
                    const name = this.getAttribute('data-name');
                    const date_from = this.getAttribute('data-date_from');
                    const date_to = this.getAttribute('data-date_to');
                    const url = this.getAttribute('data-url');
                    modelCustom.querySelector('#name').value = name;
                    modelCustom.querySelector('#date_from').value = date_from.split(' ')[0];
                    modelCustom.querySelector('#date_to').value = date_to.split(' ')[0];
                    modelCustom.querySelector('#customForm').setAttribute('action', url);

                    // modelCustom.querySelector('#customForm').addEventListener('submit', function (e) {
                    //     e.preventDefault();
                    //     if (this.dataset.type = 'update') {
                    //         const name = modelCustom.querySelector('#name').value;
                    //         const date_from = modelCustom.querySelector('#date_from').value;
                    //         const date_to = modelCustom.querySelector('#date_to').value;
                    //         const url = modelCustom.querySelector('#customForm').getAttribute('action');
                    //         $.ajax({
                    //             url,
                    //             type: 'PUT',
                    //             data: {
                    //                 name,
                    //                 date_from,
                    //                 date_to
                    //             },
                    //             success: function ({ error }) {
                    //                 if (!error) {
                    //                     swal.success('Success', 'Update success').then(() => {
                    //                         window.location.reload()
                    //                     })
                    //                 } else {
                    //                     alert(messageError)
                    //                 }
                    //             }
                    //         })
                    //     }
                    // })
                }
            })
        })
    }

    if (customCloseBtn) {
        customCloseBtn.addEventListener('click', hideCustomModal);
    }

    if (customConfirmBtn) {
        // customConfirmBtn.addEventListener('click', confirmCustomAction);
    }

    if (customCancelBtn) {
        customCancelBtn.addEventListener('click', hideCustomModal);
    }

    function showCustomModal() {
        modelCustom.classList.add("active");
    }

    function hideCustomModal() {
        modelCustom.classList.remove("active");
    }

    function confirmCustomAction() {
        alert("Xác nhận hành động!");
        hideCustomModal();
    }

    if (customForm) {
        customForm.addEventListener('submit', function (e) {
            e.preventDefault();
            const name = this.querySelector('#name').value;
            const date_from = this.querySelector('#date_from').value;
            const date_to = this.querySelector('#date_to').value;
            const url = this.getAttribute('action');
            $.ajax({
                url: url,
                type: this.dataset.type == 'create' ? 'POST' : 'PUT',
                data: {
                    name: name,
                    date_from: date_from,
                    date_to: date_to
                },
                success: function ({
                    error
                }) {
                    if (!error) {
                        modelCustom.classList.remove("active");
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Create success',
                            timer: 1500
                        }).then(() => {
                            window.location.reload();
                        })
                    }
                }
            })

        })
    }

});