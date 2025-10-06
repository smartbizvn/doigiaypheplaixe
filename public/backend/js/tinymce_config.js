function showTinymce() {
    if (!$('.tinymce_content').length) return;

    tinymce.init({
        selector: ".tinymce_content",
        width: '100%',
        height: 500,
        menubar: 'file edit view insert format table',
        plugins: [
            "autosave advlist autolink link image lists charmap preview hr anchor pagebreak fullscreen",
            "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
            "table directionality emoticons paste textcolor code toc template imagetools plg_short_code"
        ],
        toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | table | hr | emoticons code |preview fullscreen | pageembed | form_contact",
        toolbar2: "styleselect | fontselect | fontsizeselect | forecolor backcolor removeformat | link unlink | media | media_library | short_code_bak",
        autosave_ask_before_unload: true,
        autosave_interval: "30s",
        autosave_prefix: "{path}{query}-{id}-",
        autosave_restore_when_empty: false,
        autosave_retention: "2m",
        image_caption: true,
        image_advtab: true,
        branding: false,
        setup: function(editor) {
            registerMediaLibraryButton(editor);
            registerShortcodePlugin(editor);
        }
    });
}

// ========== Plugin: Media Library ==========
function registerMediaLibraryButton(editor) {
    editor.ui.registry.addButton('media_library', {
        text: 'Hình ảnh',
        icon: 'image',
        onAction: function() {
            $("#ckfinder_modal").modal('hide').modal('show');
            CKFinder.widget('ckfinder_widget', {
                chooseFiles: true,
                width: '100%',
                height: '100%',
                language: 'vi',
                onInit: function(finder) {
                    finder.on('files:choose', function(evt) {
                        const file = evt.data.files.first();
                        $("#ckfinder_modal").modal('hide');
                        finder.request('command:send', {
                            name: 'ImageInfo',
                            folder: file.get('folder'),
                            params: { fileName: file.get('name') }
                        }).done(function(resp) {
                            editor.insertContent(`<p><img width="${resp.width}" height="${resp.height}" src="${file.getUrl()}" /></p>`);
                        });
                    });
                }
            });
        }
    });
}

// ========== Plugin: Shortcode Menu ==========
function registerShortcodePlugin(editor) {
    tinymce.PluginManager.add('plg_short_code', function(editor, url) {
        editor.ui.registry.addMenuButton('short_code', {
            text: 'ShortCode',
            fetch: function(callback) {
                callback([
                    { type: 'menuitem', text: 'Form Liên hệ', onAction: () => openContactShortcodeModal(editor) },
                    { type: 'menuitem', text: 'Gallery hình ảnh', onAction: () => openGalleryShortcodeModal(editor) },
                    { type: 'menuitem', text: 'Tab Nội dung', onAction: () => openTabShortcodeModal(editor) },
                ]);
            }
        });
    });
}

// ========== Modal: Form Liên hệ ==========
function openContactShortcodeModal(editor) {
    $('#contact_shortcode_popup').modal('show');
    $('#phone_shortcode_contact, #email_shortcode_contact').val('');

    $('#insert_shortcode_contact').off('click').on('click', function(e) {
        const phone = $('#phone_shortcode_contact').val();
        const email = $('#email_shortcode_contact').val();

        if (phone) {
            editor.insertContent(`<div class='wap_shortcode'>[shortcode_form_contact phone='${phone}' email='${email}']</div>&nbsp;`);
            $('#contact_shortcode_popup').modal('hide');
        } else {
            showAlert('warning','Vui lòng nhập số điện thoại liên hệ');
        }

        e.stopImmediatePropagation();
    });
}

// ========== Modal: Gallery ==========
function openGalleryShortcodeModal(editor) {
    $('#slideshow_shortcode_popup').modal('show');
    $('#shortcode_slideshow_id, #shortcode_slideshow_type').val('');

    $('#insert_shortcode_gallery').off('click').on('click', function(e) {
        const id = $('#shortcode_slideshow_id').val();
        const type = $('#shortcode_slideshow_type').val();

        if (id && type) {
            editor.insertContent(`<div class='wap_shortcode'>[shortcode_slideshow id='${id}' type='${type}']</div>&nbsp;`);
            $('#slideshow_shortcode_popup').modal('hide');
        } else {
            showAlert('warning','Vui lòng chọn bộ hình trình chiếu và kiểu hiển thị');
        }

        e.stopImmediatePropagation();
    });
}

// ========== Modal: Tab ==========
function openTabShortcodeModal(editor) {
    $('#tabs_shortcode_popup').modal('show');
    $('#shortcode_tab_id').val('');

    $('#insert_shortcode_tab').off('click').on('click', function(e) {
        const id = $('#shortcode_tab_id').val();

        if (id) {
            editor.insertContent(`<div class='wap_shortcode'>[shortcode_tab id='${id}']</div>&nbsp;`);
            $('#tabs_shortcode_popup').modal('hide');
        } else {
            showAlert('warning', 'Vui lòng chọn tab');
        }

        e.stopImmediatePropagation();
    });
}
