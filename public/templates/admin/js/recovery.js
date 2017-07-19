//回收
function restore(obj, tablename, Id) {
    layer.confirm('确认要还原吗？',function(index){
        var $ = layui.jquery;
        var index = layer.load(2);
        $.ajax({
            type: 'post',
            url: '/admin/recovery',
            data: {"id": Id ,'tablename':tablename},
            success: function (data) {
                layer.close(index);
                if(data.status == 0){
                    //传参数错误
                    layer.msg(data.msg, {icon: 5,time:1000});
                    layer.close( index );

                } else if(data.status == 1){
                    //删除成功
                    layer.msg(data.msg,{icon:1,time:1000});
                    $(obj).parents("tr").remove();
                    layer.close( index );
                } else {
                    //删除失败
                    layer.msg(data.msg, {icon: 5,time:1000});
                    layer.close( index );
                }
            }

        });
    });
}