$(document).ready(function () {
  $('a.memberPage').on('click', function () {
    let url = $(this).attr('url');
    window.open(url)
  });

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

  //刪除使用者
  $('a.delMem').on('click', function () {
    let url = $(this).attr('url');
    let userId = $(this).attr('userId');
    let targetNode = $(`tr#${userId}`);
    let data = {};
    let method = 'DELETE'
    let event = ajax;
    delAlert('會員',targetNode,event,url,data,method)

  })
})