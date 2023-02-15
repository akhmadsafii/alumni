var SummernoteDemo = {
    init: function () {
        $(".summernote").summernote({
            followingToolbar: false,
            height: 150,
        });
    },
};
jQuery(document).ready(function () {
    SummernoteDemo.init();
});
