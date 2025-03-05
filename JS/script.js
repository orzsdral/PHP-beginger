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