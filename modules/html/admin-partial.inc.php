<?php 

if($provider->variables->content_action ==  consts::$action_index || $provider->variables->content_action ==  consts::$action_view)
{
    $entity = $provider->database->item("SELECT * FROM " . consts::$table_partial_module_html . " WHERE `partials_id` = '".$provider->variables->content_id . "' ORDER BY `id` LIMIT 1");
    
    if(empty($entity))
    {
        $provider->content->formContent($provider->route->partial($provider->variables->content_id, consts::$action_insert));
    }
    else
    {
        $provider->content->entity($entity);
        $provider->content->formContent($provider->route->partial($provider->variables->content_id, consts::$action_update, $entity['id']));
    }
}

if($provider->variables->content_action ==  consts::$action_insert)
{
    $provider->database->query("INSERT INTO " . consts::$table_partial_module_html . "(`partials_id`, `title`, `description`) VALUES
            (
                '" . $provider->variables->content_id . "',
                '" . $provider->variables->post_module('html', 'title') . "',
                '" . $provider->variables->post_module('html', 'description') . "'
            )");
    
    $provider->message->message($provider->language->translate("massage_content_modified"), consts::$message_success);
    $provider->route->redirect($provider->route->partial($provider->variables->content_id, consts::$action_view));
}

if($provider->variables->content_action ==  consts::$action_update)
{
    $provider->database->query("UPDATE " . consts::$table_partial_module_html . " SET
            `title` = '" . $provider->variables->post_module('html', 'title') . "',
            `description` = '" . $provider->variables->post_module('html', 'description') . "',
            `modified` = current_timestamp()
        WHERE `partials_id` = '" . $provider->variables->content_id . "'");
    
    $provider->message->message($provider->language->translate("massage_content_modified"), consts::$message_success);
    $provider->route->redirect($provider->route->partial($provider->variables->content_id, consts::$action_view));
}

$provider->layout->include_in_header('<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">');
$provider->layout->include_in_header('<link rel="stylesheet" href="/vendor/froala-editor/css/froala_editor.css">');
$provider->layout->include_in_header('<link rel="stylesheet" href="/vendor/froala-editor/css/froala_style.css">');
$provider->layout->include_in_header('<link rel="stylesheet" href="/vendor/froala-editor/css/plugins/code_view.css">');
$provider->layout->include_in_header('<link rel="stylesheet" href="/vendor/froala-editor/css/plugins/draggable.css">');
$provider->layout->include_in_header('<link rel="stylesheet" href="/vendor/froala-editor/css/plugins/colors.css">');
$provider->layout->include_in_header('<link rel="stylesheet" href="/vendor/froala-editor/css/plugins/emoticons.css">');
$provider->layout->include_in_header('<link rel="stylesheet" href="/vendor/froala-editor/css/plugins/image_manager.css">');
$provider->layout->include_in_header('<link rel="stylesheet" href="/vendor/froala-editor/css/plugins/image.css">');
$provider->layout->include_in_header('<link rel="stylesheet" href="/vendor/froala-editor/css/plugins/line_breaker.css">');
$provider->layout->include_in_header('<link rel="stylesheet" href="/vendor/froala-editor/css/plugins/table.css">');
$provider->layout->include_in_header('<link rel="stylesheet" href="/vendor/froala-editor/css/plugins/char_counter.css">');
$provider->layout->include_in_header('<link rel="stylesheet" href="/vendor/froala-editor/css/plugins/video.css">');
$provider->layout->include_in_header('<link rel="stylesheet" href="/vendor/froala-editor/css/plugins/fullscreen.css">');
$provider->layout->include_in_header('<link rel="stylesheet" href="/vendor/froala-editor/css/plugins/file.css">');
$provider->layout->include_in_header('<link rel="stylesheet" href="/vendor/froala-editor/css/plugins/quick_insert.css">');
$provider->layout->include_in_header('<link rel="stylesheet" href="/vendor/froala-editor/css/plugins/help.css">');
$provider->layout->include_in_header('<link rel="stylesheet" href="/vendor/froala-editor/css/third_party/spell_checker.css">');
$provider->layout->include_in_header('<link rel="stylesheet" href="/vendor/froala-editor/css/plugins/special_characters.css">');
$provider->layout->include_in_header('<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/codemirror.min.css">');

$provider->layout->include_in_footer('<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/codemirror.min.js"></script>');
$provider->layout->include_in_footer('<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/mode/xml/xml.min.js"></script>');
$provider->layout->include_in_footer('<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dompurify/2.2.7/purify.min.js"></script>');
$provider->layout->include_in_footer('<script type="text/javascript" src="/vendor/froala-editor/js/froala_editor.min.js"></script>');
$provider->layout->include_in_footer('<script type="text/javascript" src="/vendor/froala-editor/js/plugins/align.min.js"></script>');
$provider->layout->include_in_footer('<script type="text/javascript" src="/vendor/froala-editor/js/plugins/char_counter.min.js"></script>');
$provider->layout->include_in_footer('<script type="text/javascript" src="/vendor/froala-editor/js/plugins/code_beautifier.min.js"></script>');
$provider->layout->include_in_footer('<script type="text/javascript" src="/vendor/froala-editor/js/plugins/code_view.min.js"></script>');
$provider->layout->include_in_footer('<script type="text/javascript" src="/vendor/froala-editor/js/plugins/colors.min.js"></script>');
$provider->layout->include_in_footer('<script type="text/javascript" src="/vendor/froala-editor/js/plugins/draggable.min.js"></script>');
$provider->layout->include_in_footer('<script type="text/javascript" src="/vendor/froala-editor/js/plugins/emoticons.min.js"></script>');
$provider->layout->include_in_footer('<script type="text/javascript" src="/vendor/froala-editor/js/plugins/entities.min.js"></script>');
$provider->layout->include_in_footer('<script type="text/javascript" src="/vendor/froala-editor/js/plugins/file.min.js"></script>');
$provider->layout->include_in_footer('<script type="text/javascript" src="/vendor/froala-editor/js/plugins/font_size.min.js"></script>');
$provider->layout->include_in_footer('<script type="text/javascript" src="/vendor/froala-editor/js/plugins/font_family.min.js"></script>');
$provider->layout->include_in_footer('<script type="text/javascript" src="/vendor/froala-editor/js/plugins/fullscreen.min.js"></script>');
$provider->layout->include_in_footer('<script type="text/javascript" src="/vendor/froala-editor/js/plugins/image.min.js"></script>');
$provider->layout->include_in_footer('<script type="text/javascript" src="/vendor/froala-editor/js/plugins/image_manager.min.js"></script>');
$provider->layout->include_in_footer('<script type="text/javascript" src="/vendor/froala-editor/js/plugins/line_breaker.min.js"></script>');
$provider->layout->include_in_footer('<script type="text/javascript" src="/vendor/froala-editor/js/plugins/inline_style.min.js"></script>');
$provider->layout->include_in_footer('<script type="text/javascript" src="/vendor/froala-editor/js/plugins/link.min.js"></script>');
$provider->layout->include_in_footer('<script type="text/javascript" src="/vendor/froala-editor/js/plugins/lists.min.js"></script>');
$provider->layout->include_in_footer('<script type="text/javascript" src="/vendor/froala-editor/js/plugins/paragraph_format.min.js"></script>');
$provider->layout->include_in_footer('<script type="text/javascript" src="/vendor/froala-editor/js/plugins/paragraph_style.min.js"></script>');
$provider->layout->include_in_footer('<script type="text/javascript" src="/vendor/froala-editor/js/plugins/quick_insert.min.js"></script>');
$provider->layout->include_in_footer('<script type="text/javascript" src="/vendor/froala-editor/js/plugins/quote.min.js"></script>');
$provider->layout->include_in_footer('<script type="text/javascript" src="/vendor/froala-editor/js/plugins/table.min.js"></script>');
$provider->layout->include_in_footer('<script type="text/javascript" src="/vendor/froala-editor/js/plugins/save.min.js"></script>');
$provider->layout->include_in_footer('<script type="text/javascript" src="/vendor/froala-editor/js/plugins/url.min.js"></script>');
$provider->layout->include_in_footer('<script type="text/javascript" src="/vendor/froala-editor/js/plugins/video.min.js"></script>');
$provider->layout->include_in_footer('<script type="text/javascript" src="/vendor/froala-editor/js/plugins/help.min.js"></script>');
$provider->layout->include_in_footer('<script type="text/javascript" src="/vendor/froala-editor/js/plugins/print.min.js"></script>');
$provider->layout->include_in_footer('<script type="text/javascript" src="/vendor/froala-editor/js/third_party/spell_checker.min.js"></script>');
$provider->layout->include_in_footer('<script type="text/javascript" src="/vendor/froala-editor/js/plugins/special_characters.min.js"></script>');
$provider->layout->include_in_footer('<script type="text/javascript" src="/vendor/froala-editor/js/plugins/word_paste.min.js"></script>');
$provider->layout->include_in_footer('<script type="text/javascript" src="/vendor/froala-editor/js/languages/pl.js"></script>');

$provider->layout->include_in_footer("<script>
    (function () {
      new FroalaEditor('.froala_editor',
        {
            language: 'pl',
            height: 500,
            imageManagerLoadMethod: 'GET',
            imageManagerLoadURL: '/vendor/froala-editor-php/image_manager.php',
            imageUploadMethod: 'POST',
            imageUploadParam: 'froala_editor_image',
            imageUploadURL: '/vendor/froala-editor-php/image_upload.php',
            imageManagerDeleteMethod: 'POST',
            imageManagerDeleteURL: '/vendor/froala-editor-php/image_delete.php',
            imageAllowedTypes: ['jpeg', 'jpg', 'png', 'gif'],
            imageMaxSize: 1024 * 1024 * 10, // 10MB
            toolbarButtons:
            [
                ['fontFamily', 'fontSize', '|', 'paragraphFormat'],
                ['bold', 'italic', 'underline', 'strikeThrough', '|', 'subscript', 'superscript'],
                ['textColor', 'backgroundColor', '|', 'clearFormatting'],
                ['insertImage', 'insertLink', 'insertTable', 'specialCharacters', 'insertHR'],
                ['alignLeft', 'alignCenter', 'alignRight', 'alignJustify', '|', 'formatOL', 'formatUL', '|', 'outdent', 'indent', '|', 'quote'],
                ['undo', 'redo', '|', 'fullscreen', '|', 'html'],
            ]
        })
    })()
  </script>");


$provider->layout->include_in_header('<link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">');
$provider->layout->include_in_footer('<script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>');

?>