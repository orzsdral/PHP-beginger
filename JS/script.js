$('a.delete').on('click', function(e) {
    //停止鏈接原始行為
    e.preventDefault();

    if (confirm("Are you sure?")){
        //宣告創建一個form元素
        var frm = $("<form>");
        //form元素 method屬性設定設定
        frm.attr("method", "post");
        //form元素 action屬性設定設定到當前元素的href屬性
        frm.attr("action", $(this).attr("href"));
        //需附加到body元數
        frm.appendTo("body");
        //提交表單
        frm.submit();
    }
});

//沒有內置驗證，用addMethod添加自定義驗證
$.validator.addMethod("dateTime", function(value, element){
    return (value == "") || ! isNaN(Date.parse(value));
}, "Must be a valid date and time");


$('#formArticle').validate({
    rules:{
        title:{
            required: true
        },
        content:{
            required: true
        },
        published_at:{
            dateTime: true
        }
    }

});

$("button.publish").on('click', function(e){
    var id = $(this).data('id');
    var button = $(this);

    $.ajax({
        url: '/admin/publishing-article.php',
        type: 'POST',
        data:{id: id},
    })
    .done(function(data){
        button.parent().html(data);
    })
});

$('#published_at').datetimepicker({
    format: 'Y-m-d H:i:s'
});