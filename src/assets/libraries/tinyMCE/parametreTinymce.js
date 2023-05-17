tinymce.init({
    selector: '#description',
    // Plugins
    plugins: 'lists code emoticons link wordcount',
    // Toolbar
    toolbar: "undo redo | styles fontfamily fontsize | bold italic underline strikethrough subscript superscript | alignleft aligncenter alignright alignjustify| numlist bullist link | forecolor backcolor | outdent indent emoticons",
    // Permet de mettre Arial comme police par défault
    setup: function (editor) {
        editor.on('init', function (e) {
            editor.execCommand("fontName", false, "Arial");
        });
    },

    // Style
    style_formats: 
    [
        {
            title: "Headers",
            items:
            [
                {
                    title: "Header 1",
                    format: "h1"
                },
                {
                    title: "Header 2",
                    format: "h2"
                },
                {
                    title: "Header 3",
                    format: "h3"
                },
                {
                    title: "Header 4",
                    format: "h4"
                },
                {
                    title: "Header 5",
                    format: "h5"
                },
                {
                    title: "Header 6",
                    format: "h6"
                }
            ]
        },
        {
            title: "Blocks",
            items:
            [
                {
                    title: "Paragraph",
                    format: "p"
                },
                {
                    title: "Blockquote",
                    format: "blockquote"
                },
                {
                    title: "Div",
                    format: "div"
                },
                {
                    title: "Pre",
                    format: "pre"
                }
            ]
        },
    ]
});

