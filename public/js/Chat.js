$(document).ready(function() {

    function ajax(url, data, method) {
        let result = 1;
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: method,
            url: url,
            data: data,
            dataType: 'json',
            async: false,
            success: function(data) {
                result = data;
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(xhr.responseText);
            }
        })
        return result;
    }

    function delAlert(target, targetNode, event, url, data, method) {
        let alertResult = Swal.fire({
            title: 'Are you sure?',
            text: `確定要刪除此${target}?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
        }).then((result) => {
            if (result.value) {
                let result = event(url, data, method);
                console.log(result);
                targetNode.slideUp();
                Swal.fire(
                    'Deleted!',
                    `${target}已刪除`,
                    'success'
                )
            }
        })
        return alertResult;
    }

    $(".replyLink").on('click', function() {
        $("div[msgId=" + $(this).attr('msgId') + "]").toggle(500);
    });

    //刪除文章
    $('a.delMsg').on('click', function() {
        let url = $(this).attr('url');
        let msgid = $(this).attr('msgId');
        let targetNode = $(`div#msg_${msgid}`);
        let target = '貼文';
        let event = ajax;
        let data = {};

        delAlert(target, targetNode, event, url, data, 'delete');

    });

    // $('a.editMsg').on('click', function() {
    //     alert(222);
    //     let msgid = $(this).attr('msgId');
    //     let url = $(this).attr('url');
    //     alert(msgid);
    //     alert(url);
    // })

    $('a.delReply').on('click', function() {
        let url = $(this).attr('url');
        let replyid = $(this).attr('replyId');
        let targetNode = $(`div#reply_${replyid}`);
        let target = '回覆';
        let event = ajax;
        let data = {};

        delAlert(target, targetNode, event, url, data, 'delete');
    })

    // $('a.editReply').on('click', function() {
    //     alert(444);
    //     let msgid = $(this).attr('msgId');
    //     let url = $(this).attr('url');
    //     alert(msgid);
    //     alert(url);
    // })

    //編輯文章
    $('a.editMsg').on('click', function() {
        //取得此留言的ID
        let msgid = $(this).attr('msgId');
        //取得此留言的URL
        let url = $(this).attr('url');
        //取得空白表單
        let form = $('#edit').children();
        //取得原本文章內文要用html(因為你要讀到<br>html標籤)
        let contain = $("div[msgContain=" + msgid + "]").html().trim().replace(/<br>/g, "\r");

        // //將文章內文改為表單
        let editarea = $("div[msgContain=" + msgid + "]").html(form);


        // 再將原本的內文塞入編輯表單內要用val(因為你已經轉換行符號了)
        $("div[msgContain=" + msgid + "] #textarea1").val(contain);

        $("#editBtn").on('click', function() {
            let body = $("div[msgContain=" + msgid + "] #textarea1").val();
            let result = ajax(url, { 'body': body }, 'PUT');
            console.log(result)
            if (result.status) {
                //成功時將修改的值塞進去原本表單的位置
                $("div[msgContain=" + msgid + "]").html($("div[msgContain=" + msgid + "] #textarea1").val().replace(/\n/g, "<br>"))
                form.find('#textarea1').val('');
                //再塞入編輯表單
                $('#edit').html(form);
            }
        })
    })




    //編輯回復
    $('a.editReply').on('click', function() {
        //取得此留言的ID
        let replyid = $(this).attr('replyId');
        //取得此留言的URL
        let url = $(this).attr('url');
        //取得空白表單
        let form = $('#edit').children();
        //取得原本文章內文要用html(因為你要讀到<br>html標籤)
        let contain = $("div[replyContain=" + replyid + "]").html().trim().replace(/<br>/g, "\r");

        // //將文章內文改為表單
        let editarea = $("div[replyContain=" + replyid + "]").html(form);


        // 再將原本的內文塞入編輯表單內要用val(因為你已經轉換行符號了)
        $("div[replyContain=" + replyid + "] #textarea1").val(contain);

        $("#editBtn").on('click', function() {
            let body = $("div[replyContain=" + replyid + "] #textarea1").val();
            let result = ajax(url, { 'body': body }, 'PUT');
            console.log(result)
            if (result.status) {
                //成功時將修改的值塞進去原本表單的位置
                $("div[replyContain=" + replyid + "]").html($("div[replyContain=" + replyid + "] #textarea1").val().replace(/\n/g, "<br>"))
                form.find('#textarea1').val('');
                //再塞入編輯表單
                $('#edit').html(form);
            }
        })
    })

})