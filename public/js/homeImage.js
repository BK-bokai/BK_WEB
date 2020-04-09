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

    function changeAlert(event, url, data, method) {
        let alertResult = Swal.fire({
            title: 'Are you sure?',
            text: `確定要將此相片設為首頁?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, change it!',
        }).then((result) => {
            if (result.value) {
                let result = event(url, data, method);
                // console.log(result);
                Swal.fire(
                    'Updata!',
                    `相片已設為首頁`,
                    'success'
                )
            } else {
                window.location.reload();
            }
        })
        return alertResult;
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
                // console.log(result);
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
    $('.index_img').on('change', function() {
        let url = $(this).attr('url');
        let event = ajax;
        let data = {};
        let method = 'PUT'
        changeAlert(event, url, data, method)
            // alert(url);
    })

    $('button.delImg').on('click', function() {
        let url = $(this).attr('url');
        let event = ajax;
        let index = $(this).attr('delete');
        let data = { 'delete': index };
        let method = 'DELETE'
        let dataId = $(this).attr('dataId')
        let targetNode = $(`div#Img${dataId}`)
        let target = '相片';
        let radio = $(`#radio${dataId}`)
        if (radio.is(":checked")) {
            swal.fire({
                title: '此相片已設為首頁相片',
                html: $('<div>')
                    .addClass('some-class')
                    .text('請先更改首頁相片再進行刪除'),
                animation: false,
                customClass: 'animated tada'
            })
        } else {
            delAlert(target, targetNode, event, url, data, method)
        }
    })
})