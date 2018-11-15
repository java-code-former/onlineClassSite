//修改排序
function sort(data)
{
    var mysql=$("#mysql").val();
    var sort=$("#sort"+data).val();
    var id=data;
    $.ajax({
        url:"/enad/Login/sort",
        type:"post",
        data:{sort:sort,mysql:mysql,id:id},
        success:function(data){
            if(data.data=='200'){ 
              $("#sort"+data).val(sort);
               alert('修改成功');
              }else{
                alert('修改失败');
            }
        }

    });

}


//修改是否显示
function is_show(data)
{
    var mysql=$("#mysql").val();
    var sort=$("#is_show"+data).text();
    var id=data;
    if(sort=='是'){
        var d=0;
        var c="否"
    }else{
        var d=1;
        var c="是";
    }
    // alert(c);
    $.ajax({
        url:"/enad/Login/is_show",
        type:"post",
        data:{sort:d,mysql:mysql,id:id},
        success:function(data){
            if(data.data=='200'){
                $("#is_show"+id).text(c);
                alert('修改成功');
            }else{
                alert('修改失败');
            }
        }

    });

}






//修改排序
function del(data)
{
    var mysql=$("#mysql").val();
    // var sort=$("#sort"+data).val();
    var id=data;
    $.ajax({
        url:"/enad/Login/del",
        type:"post",
        data:{mysql:mysql,id:id},
        success:function(data){
            if(data.data=='200'){ 
              // $("#del"+data).removeNode();
               location.reload();
               alert('删除成功');
              }else{
                alert('删除失败');
            }
        }
    });

}
