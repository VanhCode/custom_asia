$(function () {
    CKEDITOR.config.versionCheck = false;
    CKEDITOR.config.allowedContent = true;
    $(document).ready(function () {
        $(".tinymce_editor_init").each(function () {
            var textareaID = $(this).attr("id");
            CKEDITOR.replace(textareaID, {});
        });
    });

    // LOAD ẢNH 
    const loadAvatarInputs = document.querySelectorAll(".load-avatar");
    const loadGalleryImageInput = document.querySelector(".load-gallery-image");
    const formGroupGallery = document.querySelector(".form-group__gallery");
    const imageOldItems = document.querySelectorAll(".images_old-item");
    // const deleteAvatarBtns = document.querySelectorAll(".delete-avatar");
    const imagesOldItemInputs = document.querySelectorAll(".images_old-gallery");

    loadAvatarInputs.forEach(input => {
        input.addEventListener("change", function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.addEventListener("load", function () {
                    const preview = input
                        .closest(".form-group")
                        .querySelector(".preview-avatar img");
                    const deleteAvatar = input
                        .closest(".form-group")
                        .querySelector(".preview-avatar .delete-avatar");
                    deleteAvatar.classList.remove("d-none");
                    deleteAvatar.addEventListener("click", function () {
                        preview.src = "/admin_asset/images/upload-image.png";
                        input.value = "";
                        deleteAvatar.classList.add("d-none");
                    });
                    preview.src = reader.result;
                });
                reader.readAsDataURL(file);
            }
        });
    });

    function assignFilesToInput(fileArray) {
        // Tạo đối tượng DataTransfer để chứa file
        const dataTransfer = new DataTransfer();

        // Duyệt qua mảng và thêm file vào DataTransfer
        fileArray.forEach(file => {
            dataTransfer.items.add(file);
        });

        // Gán giá trị DataTransfer cho input file
        loadGalleryImageInput.files = dataTransfer.files;
    }

    function removeGalleryImage(index, filesArr) {
        filesArr.splice(index, 1);
        assignFilesToInput(filesArr)
        loadFilesImageGallery(filesArr);
    }

    function loadFilesImageGallery(files) {
        const filesArr = Array.from(files);
        if (filesArr.length > 0) {
            filesArr.forEach((file, index) => {
                const reader = new FileReader();

                // Khi FileReader hoàn thành việc đọc file
                reader.onload = function (e) {
                    const imageURL = e.target.result; // URL của ảnh sau khi đọc
                    const html = `<div class="col-lg-6 col-12">
                                    <div class="form-group__img">
                                        <img src="${imageURL}" alt="">
                                        <div class="form-group__delete delete-btn" style="cursor: pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                                <path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0L284.2 0c12.1 0 23.2 6.8 28.6 17.7L320 32l96 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 96C14.3 96 0 81.7 0 64S14.3 32 32 32l96 0 7.2-14.3zM32 128l384 0 0 320c0 35.3-28.7 64-64 64L96 512c-35.3 0-64-28.7-64-64l0-320zm96 64c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16z"/>
                                            </svg>
                                        </div>
                                    </div>
                                </div>`;

                    // Thêm phần tử ảnh vào .form-group__gallery
                    formGroupGallery.insertAdjacentHTML('beforeend', html);
                    const deleteButton = formGroupGallery.querySelectorAll('.delete-btn')[index];
                    deleteButton.addEventListener('click', function () {
                        removeGalleryImage(index, filesArr);
                    });
                };

                // Đọc file dưới dạng URL để hiển thị ảnh
                reader.readAsDataURL(file);
            });
        }
    }

    loadGalleryImageInput.onchange = function (event) {
        const files = event.target.files;
        loadFilesImageGallery(files);
    };

    if (imageOldItems.length > 0) {
        // deleteAvatarBtns.forEach((btn) => {
        //     btn.addEventListener('click', function () {
        //         this.classList.add('d-none');
        //         const imageElement = this
        //             .closest(".form-group")
        //             .querySelector(".preview-avatar img");
        //         imageElement.src = "/admin_asset/images/upload-image.png";
        //         imageOldItems.forEach((item) => {
        //             if (item.getAttribute('data-name') === imageElement.parentElement.getAttribute('data-name')) {
        //                 item.value = '';
        //             }
        //         })
        //     })
        // })
    }

    if (imagesOldItemInputs.length > 0) {
        let htmls = '';
        htmls = Array.from(imagesOldItemInputs).map((input, index) => {
            return `<div class="col-lg-6 col-12">
                        <div class="form-group__img">
                            <img src="${input.value}" alt="">
                            <div class="form-group__delete delete-btn1" data-index="data-index-${index}" style="cursor: pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                    <path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0L284.2 0c12.1 0 23.2 6.8 28.6 17.7L320 32l96 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 96C14.3 96 0 81.7 0 64S14.3 32 32 32l96 0 7.2-14.3zM32 128l384 0 0 320c0 35.3-28.7 64-64 64L96 512c-35.3 0-64-28.7-64-64l0-320zm96 64c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16z"/>
                                </svg>
                            </div>
                        </div>
                    </div>`
        }).join('')
        formGroupGallery.innerHTML = htmls;
        const deleteButtons = formGroupGallery.querySelectorAll('.delete-btn1');
        deleteButtons.forEach((btn) => {
            btn.addEventListener('click', function () {
                this.classList.add('d-none');
                const imageElement = this
                    .closest(".form-group__img")
                    .querySelector("img");
                document.getElementById(this.dataset.index).value = '';
                imageElement.src = "/admin_asset/images/upload-image.png";

            })
        })
    }

    // END LOAD ẢNH

    // upload image
    // load image
    // $(document).on("change", ".load-avatar", function () {
    //     console.lo
    //     let input = $(this);
    //     displayAvatar(input, ".preview-avatar", "img");
    //     input.parents('.form-group').find(".delete-avatar").show(); // Hiển thị nút xóa khi có ảnh được chọn
    // });

    // $(document).on("click", ".delete-avatar", function () {
    //     let formGroup = $(this).parents(".form-group");

    //     // Đặt lại ảnh mặc định
    //     formGroup.find(".preview-avatar img").attr("src", "{{ asset('admin_asset/images/upload-image.png') }}");

    //     // Xóa giá trị của input file
    //     formGroup.find("input[type='file']").val('');

    //     // Ẩn icon delete
    //     $(this).hide();
    // });

    function displayAvatar(input, selectorWrap, selectorImg) {
        let file = input.prop("files")[0];
        let reader = new FileReader();

        reader.addEventListener(
            "load",
            function () {
                let img = input
                    .parents(".form-group")
                    .find(selectorWrap)
                    .find(selectorImg);
                img.attr("src", reader.result); // Hiển thị ảnh mới
            },
            false
        );

        if (file) {
            reader.readAsDataURL(file);
        }
    }

    $(document).on("change", ".load-multiple-image", function () {
        let input = $(this);

        // Không ẩn ảnh cũ, chỉ thêm ảnh mới
        displayMultipleImage2(input, ".form-group__img.load-multiple");
    });

    function displayMultipleImage2(input, selectorWrap) {
        let files = input.prop("files");
        let length = files.length;

        for (let i = 0; i < length; i++) {
            let fileItem = files[i];
            let reader = new FileReader();
            reader.addEventListener(
                "load",
                function () {
                    // Tạo một thẻ div mới chứa ảnh và icon xóa
                    let newImageWrap = $(
                        '<div class="col-lg-3 col-12"><div class="form-group__img load-multiple"></div></div>'
                    );
                    let img = $("<img />");
                    img.attr({
                        src: reader.result,
                        alt: fileItem.name
                    });

                    // Thêm ảnh vào div
                    newImageWrap
                        .find(".form-group__img.load-multiple")
                        .append(img);

                    // Thêm icon xóa vào div
                    // let deleteIcon = $('<div class="form-group__delete"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!-- icon xóa --><path d="M135.2 17.7..."></path></svg></div>');

                    let deleteIcon = $(
                        `<div class="form-group__delete load-multiple">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0L284.2 0c12.1 0 23.2 6.8 28.6 17.7L320 32l96 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 96C14.3 96 0 81.7 0 64S14.3 32 32 32l96 0 7.2-14.3zM32 128l384 0 0 320c0 35.3-28.7 64-64 64L96 512c-35.3 0-64-28.7-64-64l0-320zm96 64c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16z"></path>
                        </svg>
                    </div>`
                    );

                    newImageWrap
                        .find(".form-group__img.load-multiple")
                        .append(deleteIcon);

                    // Thêm div chứa ảnh và icon vào DOM
                    input
                        .closest(".form-group")
                        .find(".row")
                        .append(newImageWrap);
                },
                false
            );

            if (fileItem) {
                reader.readAsDataURL(fileItem);
            }
        }
    }

    // Xử lý sự kiện xóa ảnh
    $(document).on("click", ".form-group__delete.load-multiple", function () {
        $(this)
            .closest(".col-lg-3")
            .remove(); // Xóa div chứa ảnh và icon xóa
    });
    // end update

    // js load ảnh khi upload
    $(document).on("change", ".img-load-input", function () {
        let input = $(this);
        displayImage(input, ".wrap-load-image", ".img-load");
    });
    // js load nhiều ảnh khi upload
    $(document).on("change", ".img-load-input-multiple", function () {
        let input = $(this);
        displayMultipleImage(input, ".wrap-load-image", ".load-multiple-img");
    });
    // end js load ảnh khi upload

    // js render slug khi nhập tên
    $(document).on("change keyup", "#name", function () {
        let name = $(this).val();
        $("#slug").val(ChangeToSlug(name));
    });

    $(document).on("click", ".lb-active-star", function () {
        event.preventDefault();
        let wrapActive = $(this).parents("td");
        let urlRequest = $(this).data("url");
        Swal.fire({
            title: "Bạn có chắc chắn muốn thay đổi trạng thái đánh giá",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Tôi đồng ý"
        }).then(result => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "GET",
                    url: urlRequest,
                    success: function (data) {
                        if (data.code == 200) {
                            let html = data.html;
                            wrapActive.html(html);
                        }
                    }
                });
            }
        });
    });

    // js render slug khi nhập tên
    $(document).on("change keyup", ".nameChangeSlug", function () {
        let name = $(this).val();
        $(this)
            .parents(".wrapChangeSlug")
            .find(".resultSlug")
            .val(ChangeToSlug(name));
    });
    // end js render slug khi nhập tên

    // js  show childs category đệ quy
    $(document).on("click", ".lb-toggle", function () {
        $(this)
            .parent()
            .parent()
            .parent("li")
            .children("ul")
            .slideToggle();
        $(this)
            .find("i")
            .toggleClass("fa-plus")
            .toggleClass("fa-minus");
    });
    // end js  show childs category đệ quy

    // js create select tag
    $(".tag-select-choose").select2({
        tags: true,
        tokenSeparators: [","]
    });
    $(".select-2-init").select2({
        placeholder: "--- Chọn danh mục ---",
        allowClear: true
    });
    // end create select tag

    // js tinymce
    // let editor_config = {
    //   path_absolute: "/",
    //   selector: "textarea.tinymce_editor_init",
    //   relative_urls: false,
    //   // default_link_target: [
    //   //     'dofollow'
    //   // ],
    //   allow_unsafe_link_target: true,
    //   rel_list: [
    //     { title: "None", value: "" },
    //     { title: "nofollow", value: "nofollow" },
    //     { title: "dofollow", value: "dofollow" },
    //   ],
    //   plugins: [
    //     "advlist autolink lists link image charmap print preview hr anchor pagebreak",
    //     "searchreplace wordcount visualblocks visualchars code fullscreen",
    //     "insertdatetime media nonbreaking save table directionality",
    //     "emoticons template paste textpattern",
    //   ],
    //   //   toolbar:
    //   //     "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
    //   toolbar:
    //     "styleselect fontsizeselect forecolor | bold underline italic | alignleft aligncenter alignright | bullist numlist | link image media",
    //   file_picker_callback: function (callback, value, meta) {
    //     let x =
    //       window.innerWidth ||
    //       document.documentElement.clientWidth ||
    //       document.getElementsByTagName("body")[0].clientWidth;
    //     let y =
    //       window.innerHeight ||
    //       document.documentElement.clientHeight ||
    //       document.getElementsByTagName("body")[0].clientHeight;

    //     let cmsURL =
    //       editor_config.path_absolute +
    //       "laravel-filemanager?editor=" +
    //       meta.fieldname;
    //     if (meta.filetype == "image") {
    //       cmsURL = cmsURL + "&type=Images";
    //     } else {
    //       cmsURL = cmsURL + "&type=Files";
    //     }

    //     tinyMCE.activeEditor.windowManager.openUrl({
    //       url: cmsURL,
    //       title: "Filemanager",
    //       width: x * 0.8,
    //       height: y * 0.8,
    //       resizable: "yes",
    //       close_previous: "no",
    //       onMessage: (api, message) => {
    //         callback(message.content);
    //       },
    //     });
    //   },
    //   setup: function (editor) {
    //     editor.on("BeforeSetLink", function (event) {
    //       if (event.target.nodeName === "A") {
    //         if (event.content.rel === "noopener") {
    //           delete event.content.rel;
    //         }
    //       }
    //     });
    //   },
    // };
    // if ($("textarea.tinymce_editor_init").length) {
    //   tinymce.init(editor_config);
    // }

    // end  tinymce

    // js load change trạng thái hot và active
    $(document).on("click", ".lb-active", function () {
        event.preventDefault();
        let wrapActive = $(this).parents(".wrap-load-active");
        let urlRequest = wrapActive.data("url");
        let value = $(this).data("value");
        let type = $(this).data("type");
        let title = "";
        if (value) {
            title = "Bạn có chắc chắn muốn ẩn " + type;
        } else {
            title = "Bạn có chắc chắn muốn hiển thị " + type;
        }
        Swal.fire({
            title: title,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, next step!"
        }).then(result => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "GET",
                    url: urlRequest,
                    success: function (data) {
                        if (data.code == 200) {
                            let html = data.html;
                            wrapActive.html(html);
                        }
                    }
                });
            }
        });
    });

    $(document).on("click", ".lb-active-user", function () {
        event.preventDefault();
        let wrapActive = $(this).parents(".wrap-load-active");
        let urlRequest = wrapActive.data("url");
        let value = $(this).data("value");
        let type = $(this).data("type");
        let title = "";
        if (value) {
            title = "Bạn có chắc chắn muốn ẩn " + type;
        } else {
            title = "Bạn có chắc chắn muốn kích hoạt " + type;
        }
        Swal.fire({
            title: title,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, next step!"
        }).then(result => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "GET",
                    url: urlRequest,
                    success: function (data) {
                        if (data.code == 200) {
                            let html = data.html;
                            wrapActive.html(html);
                        }
                    }
                });
            }
        });
    });

    $(document).on("click", ".lb-hot", function () {
        event.preventDefault();
        let wrapActive = $(this).parents(".wrap-load-hot");
        let urlRequest = wrapActive.data("url");
        let value = $(this).data("value");
        let type = $(this).data("type");
        let title = "";
        if (value) {
            title = "Bạn có chắc chắn muốn bỏ nổi bật " + type;
        } else {
            title = "Bạn có chắc chắn muốn chuyển " + type + " sang nổi bật";
        }
        Swal.fire({
            title: title,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, next step!"
        }).then(result => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "GET",
                    url: urlRequest,
                    success: function (data) {
                        if (data.code == 200) {
                            let html = data.html;
                            wrapActive.html(html);
                        }
                    }
                });
            }
        });
    });

    $(document).on("click", ".lb-thanhtoan", function () {
        event.preventDefault();
        let wrapActive = $(this).parents(".wrap-load-thanhtoan");
        let urlRequest = wrapActive.data("url");
        let value = $(this).data("value");
        let title = "";
        if (value) {
            title =
                "Bạn có chắc chắn muốn chuyển đơn hàng sang trạng thái chưa thanh toán ";
        } else {
            title =
                "Bạn có chắc chắn muốn chuyển  đơn hàng sang trạng thái đã thanh toán";
        }
        Swal.fire({
            title: title,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Tiếp tục!"
        }).then(result => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "GET",
                    url: urlRequest,
                    success: function (data) {
                        if (data.code == 200) {
                            let html = data.html;
                            wrapActive.html(html);
                        }
                    }
                });
            }
        });
    });

    // js load change trạng thái hot và active
    $(document).on("change", ".lb-order", function () {
        event.preventDefault();
        let wrap = $(this);
        let urlRequest = wrap.data("url");
        let value = $(this).val();

        if (value !== "") {
            var number_regex = /([0-9]{1,})/;
            if (number_regex.test(value) == false) {
                alert("Số thứ tự của bạn không đúng định dạng!");
            } else {
                let title = "";
                title = "Bạn có chắc chắn muốn đổi số thứ tự ";
                $.ajax({
                    type: "GET",
                    url: urlRequest,
                    data: { order: value },
                    dataType: "json",
                    success: function (response) {
                        if (response.code == 200) {
                            Swal.fire({
                                position: "center",
                                icon: "success",
                                title: response.html,
                                showConfirmButton: false,
                                timer: 1500
                            });
                        } else {
                            Swal.fire({
                                position: "center",
                                icon: "error",
                                title: response.html,
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }

                        // console.log( response.html);
                    },
                    error: function (response) {
                        Swal.fire({
                            position: "top-end",
                            icon: "error",
                            title: response.html,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                });
            }
        } else {
            alert("Bạn chưa điền số thứ tự");
        }
    });

    // end  js load change trạng thái hot và active

    // js chọn quyền
    $(".checkall").on("click", function () {
        $(this)
            .parents(".wrap-permission")
            .find(".check-children,.check-parent")
            .prop("checked", $(this).prop("checked"));
    });
    $(".check-parent").on("click", function () {
        $(this)
            .parents(".item-permission")
            .find(".check-children")
            .prop("checked", $(this).prop("checked"));
    });
    // end js chọn quyền

    // js load ajax đơn hàng
    $(document).on("click", "#btn-load-transaction-detail", function () {
        let contentWrap = $("#loadTransactionDetail");

        let urlRequest = $(this).data("url");
        $.ajax({
            type: "GET",
            url: urlRequest,
            success: function (data) {
                if (data.code == 200) {
                    let html = data.htmlTransactionDetail;
                    contentWrap.html(html);
                    $("#transactionDetail").modal("show");
                }
            }
        });
    });
    // end js load ajax đơn hàng

    // js load ajax chuyển trạng thái đơn hàng
    $(document).on("click", ".status span", loadNextStepStatus);

    function loadNextStepStatus(event) {
        event.preventDefault();
        let statusWrap = $(this).parents(".status");
        // get url load ajax
        let urlRequest = statusWrap.data("url");
        // get giá trị status hiện tại
        let statusCurrent = parseInt($(this).data("status"));

        // set giá trị các trạng thái
        let arrListStatus = [
            {
                status: "hủy bỏ",
                nextstep:
                    "Đơn hàng đã bị hủy bỏ không thể chuyển đến trạng thái tiếp theo"
            },
            {
                status: "Đặt hàng thành công chờ xử lý",
                nextstep:
                    "Bạn có muốn chuyển đơn hàng sang trang thái đã tiếp nhận đơn hàng"
            },
            {
                status: "Đã tiếp nhận",
                nextstep:
                    "Bạn có muốn chuyển đơn hàng sang trang thái đang vận chuyển"
            },
            {
                status: "Đang vận chuyển",
                nextstep:
                    "Bạn có muốn chuyển đơn hàng sang trang thái hoàn thành"
            },
            { status: "Hoàn thành", nextstep: "Đơn hàng đã hoàn thành" }
        ];

        let swalOption = {
            //  title: "test",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33"
            // confirmButtonText: 'Yes, next step!'
        };
        if (statusCurrent > 0 && statusCurrent < 4) {
            swalOption.confirmButtonText = "Yes, next step!";
            swalOption.title = arrListStatus[statusCurrent].nextstep;
        } else if (statusCurrent < 0) {
            swalOption.title = arrListStatus[0].nextstep;
            swalOption.showCancelButton = false;
        } else {
            swalOption.title = arrListStatus[statusCurrent].nextstep;
            swalOption.showCancelButton = false;
            swalOption.icon = "success";
        }

        Swal.fire(swalOption).then(result => {
            if (result.isConfirmed && statusCurrent > 0 && statusCurrent < 4) {
                $.ajax({
                    type: "GET",
                    url: urlRequest,
                    success: function (data) {
                        if (data.code == 200) {
                            let html = data.htmlStatus;
                            statusWrap.html(html);
                        }
                    }
                });
            }
        });
    }
    // end js load ajax chuyển trạng thái đơn hàng

    // js load ajax chuyển trạng thái thông tin liên hệ
    $(document).on("click", ".status-2 span", loadNextStepStatus_2);

    function loadNextStepStatus_2(event) {
        event.preventDefault();
        let statusWrap = $(this).parents(".status-2");
        // get url load ajax
        let urlRequest = statusWrap.data("url");
        // get giá trị status hiện tại
        let statusCurrent = parseInt($(this).data("status"));

        // set giá trị các trạng thái
        let arrListStatus = [
            {
                status: "hủy bỏ",
                nextstep:
                    "Thông tin đã bị hủy bỏ không thể chuyển đến trạng thái tiếp theo"
            },
            {
                status: "Đặt hàng thành công chờ xử lý",
                nextstep: "Bạn có muốn chuyển sang trạng thái hoàn thành"
            },
            {
                status: "Hoàn thành",
                nextstep: "Thông tin liên hệ đã hoàn thành"
            }
        ];

        let swalOption = {
            //  title: "test",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33"
            // confirmButtonText: 'Yes, next step!'
        };
        if (statusCurrent > 0 && statusCurrent < 4) {
            swalOption.confirmButtonText = "Yes, next step!";
            swalOption.title = arrListStatus[statusCurrent].nextstep;
        } else if (statusCurrent < 0) {
            swalOption.title = arrListStatus[0].nextstep;
            swalOption.showCancelButton = false;
        } else {
            swalOption.title = arrListStatus[statusCurrent].nextstep;
            swalOption.showCancelButton = false;
            swalOption.icon = "success";
        }

        Swal.fire(swalOption).then(result => {
            if (result.isConfirmed && statusCurrent > 0 && statusCurrent < 4) {
                $.ajax({
                    type: "GET",
                    url: urlRequest,
                    success: function (data) {
                        if (data.code == 200) {
                            let html = data.htmlStatus;
                            statusWrap.html(html);
                        }
                    }
                });
            }
        });
    }
    // end js load ajax chuyển trạng thái liên hệ
});
