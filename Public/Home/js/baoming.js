    function BMbut(BMbut) {
        var a = $('#a option:selected') .val();
        var b = $('#b option:selected') .val();
        var c = $('#c option:selected') .val();
        var d = document.getElementById('d').value.trim();
        var e = document.getElementById('e').value.trim();
        var f = document.getElementById('f').value.trim();
        var g = document.getElementById('g').value.trim();
        var h = document.getElementById('h').value.trim();
        var i = document.getElementById('i').value.trim();
        var j = document.getElementById('j').value.trim();
        var k = $('input[name="k"]:checked').val();
        var l = $('#l option:selected') .val();
        var m = document.getElementById('m').value.trim();
        var n = document.getElementById('n').value.trim();


        if (d.length==0) {
            alert('请输入街道！');
            return false;
        }


  if (e.length==0) {
            alert('请输入社区！');
            return false;
        }

  if (f.length==0) {
            alert('请输入推选单位！');
            return false;
        }
  if (g.length==0) {
            alert('请输入通讯地址！');
            return false;
        }

  if (h.length==0) {
            alert('请输入负责人姓名！');
            return false;
        }

        if (i.length == 0) {
            alert('请输入您的手机号');
            return false;
        }
        if (!(/^1[34578]\d{9}$/.test(i))) {
            alert('手机号码有误！');
            return false;
        }



        if (j.length == 0) {
            alert('请输入您的QQ');
            return false;
        }
        if (!(/^[0-9]{5,10}$/.test(j))) {
            alert('QQ号码有误！');
            return false;
        }




        if (m.length == 0) {
            alert('请输入申报资料');
            return false;
        }

        if (n.length == 0) {
            alert('请输入推选单位');
            return false;
        }

        $.ajax({
            url: "/Home/iwa/iwa",
            type: "POST",
            dataType:'json',
            data: {
                    a:a,
                    b:b,
                    c:c,
                    d:d,
                    e:e,
                    f:f,
                    g:g,
                    h:h,
                    i:i,
                    j:j,
                    k:k,
                    l:l,
                    m:m,
                    n:n
            },
            success: function (data) {
                var strobj = eval(data);
                if(data.data==200){
                   alert('报名成功！！！！！');

                }
            },
        });
        return true;
    }




    function onblus (){
        
        var pw = document.getElementById('pw').value.trim();
        var pwd = document.getElementById('pwd').value.trim();
        if( pw.length!=0  && pwd.length!=0 && pw!=pwd ){
            $('#ppt').val(1);
        }else{
             $('#ppt').val(0);
        }



    }


    function n (){
        var pw = document.getElementById('name').value.trim();
        if( pw.length!=0){
        $.ajax({
            url: "/Home/log/name",
            type: "POST",
            dataType:'json',
            data:{name:pw},
            success: function (data) {
                var strobj = eval(data);
                if(data.data==200){
                    $('#n').val(1);
                }else{
                    $('#n').val(0);
                }
            },
        });
           
        }
    }



    //登录
    function checkgetEl(checkgetEl) {
        var na = document.getElementById('na').value.trim();
        var np = document.getElementById('np').value.trim();
       // var n = document.getElementById('n').value.trim();
        if (na.length==0) {
            alert('请输入您的用户名4到16位（字母，数字，下划线）！');
            return false;
        }
        if (!(/^[a-zA-Z0-9_-]{4,16}$/.test(na))) {
            alert('用户名有误！');
            return false;
        }

        // if (n!=1) {
        //     alert('用户名不存在！！！！！');
        //     return false;
        // }
        if (np.length==0) {
            alert('请输入您的密码6-10位!');
            return false;
        }
        if (!(/^[a-zA-Z0-9]{6,10}$/.test(np))) {
            alert('密码有误！必须且只含有数字和字母，6-10位！');
            return false;
        }

        $.ajax({
            url: "/Home/log/loginname",
            type: "POST",
            dataType:'json',
            data:{na:na,np:np},
            success: function (data) {
                var strobj = eval(data);
                if(data.data==200){
                    $('.cd-popup').removeClass('is-visible');
                    alert('登录成功');
                    window.location.href=window.location.href
                }else{
                     alert('账号或密码错误！');
                }
            },
        });
        return true;
    }







function to()
{
        $.ajax({
        url: "/Home/log/to",
        type: "POST",
        dataType:'json',
        success: function (data) {
            var strobj = eval(data);


                if(data.data==200){
                    alert('退出成功');
                    window.location.href='/'
                }else{
                    $('#n').val(0);
                }


               
        },
    });
}








    // <input class="check"   name="items" value="1" id="xyi" type="radio">
     //textarea  检测
     function textdown(e) {
            textevent = e;
            if (textevent.keyCode == 8) {
                return;
            }
            if (document.getElementById('u_information').value.length >= 100) {
                alert("大侠，手下留情，此处限字100");
                if (!document.all) {
                    textevent.preventDefault();
                } else {
                    textevent.returnValue = false;
                }
            }
        }
        function textup() {
            var s = document.getElementById('u_information').value;
            if (s.length > 100) {
                document.getElementById('u_information').value = s.substring(0, 100);
            }
        }






