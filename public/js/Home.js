$(document).ready(function () {
  $('button#index_img').on('click', function () {
    let url = $(this).attr('url');
    window.location.href = url;
  })


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
      success: function (data) {
        result = data;
      },
      error: function (xhr, ajaxOptions, thrownError) {
        console.log(xhr.responseText);
      }
    })
    return result;
  }
  function delAlert(target,targetNode,event,url,data,method) {
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
        let result=event(url,data,method);
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

  $("#content_1,#content_2,#content_3,#content_4").on('keyup', function () {
    let url = $(this).attr('url');
    let content_1 = $("#content_1").val();
    let content_2 = $("#content_2").val();
    let content_3 = $("#content_3").val();
    let content_4 = $("#content_4").val();
    let method = 'POST';

    let data = {
      'content_1': content_1,
      'content_2': content_2,
      'content_3': content_3,
      'content_4': content_4,
    }
    let result = ajax(url, data, method);
    if (result.change) {
      $("button#home_submit").removeClass('disabled');
    }
    else {
      $("button#home_submit").addClass('disabled');
    }
  })

  $('a.delSkill').on('click', function () {
    let url = $(this).attr('url');
    alert(url)
    let targetNode = $(this).parent().parent();
    let data = {};
    let method = 'DELETE'
    let event = ajax;
    //輸入要刪除的項目、目標、動作、此動作需要的參數
    let alertResult = delAlert('技能',targetNode,event,url,data,method);
  })

  $('a.delWorkSkill').on('click', function () {
    let url = $(this).attr('url');
    let target = $(this).parent().parent();
    target.slideUp();
    alert(url)
  })

})
