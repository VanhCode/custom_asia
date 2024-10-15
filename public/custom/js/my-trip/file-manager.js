// CKEDITOR.replace('editor', configCkEditor);

// CKEDITOR.replace('editor1', configCkEditor);

var route_prefix = "/filemanager";

var lfm = function (id, type, options) {
    let button = document.getElementById(id);
    button.addEventListener('click', function () {
        var route_prefix = (options && options.prefix) ? options.prefix :
            '/laravel-filemanager';
        var target_input = document.getElementById(button.getAttribute('data-input'));
        var target_preview = document.getElementById(button.getAttribute('data-preview'));

        let fileManagerWindow = window.open(
            route_prefix + '?type=' + type || 'file',
            'FileManager',
            'width=900,height=600'
        );

        window.SetUrl = function (items) {
            var file_path = items.map(function (item) {
                return item.url;
            }).join(',');

            // set the value of the desired input to image url
            target_input.value = file_path;
            target_input.dispatchEvent(new Event('change'));
            fileManagerWindow.close()

            // clear previous preview
            target_preview.innerHTML = '';

            // set or change the preview image src
            items.forEach(function (item) {
                let img = document.createElement('img');
                img.setAttribute('style', 'height: 5rem');
                img.setAttribute('src', item.thumb_url);
                target_preview.appendChild(img);
            });

            // trigger change event
            target_preview.dispatchEvent(new Event('change'));
            // Đóng cửa sổ file manager sau khi chọn file
        };

    });
};

lfm(`img-thumbnail`, 'Images', {
    prefix: route_prefix
});

document.getElementById('thumbnail-wrapper').addEventListener('click', function () {
    document.getElementById('img-thumbnail').click();
});

document.getElementById('img-thumbnail-input').addEventListener('change', function () {
    document.querySelector('#thumbnail-wrapper img').setAttribute('src', this.value);
})

function handleFileManager(name) {
    lfm(`img-${name}`, 'Images', {
        prefix: route_prefix
    });

    document.getElementById(`${name}-wrapper`).addEventListener('click', function () {
        document.getElementById(`img-${name}`).click();
    });

    document.getElementById(`img-${name}-input`).addEventListener('change', function () {
        document.querySelector(`#${name}-wrapper img`).setAttribute('src', this.value);
    })
}