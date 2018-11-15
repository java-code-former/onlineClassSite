    //
    function checkstartshopsubmit(checkstartshopsubmit) {
        var name = document.getElementById('name').value.trim();
        var pw = document.getElementById('pw').value.trim();
        var pwd = document.getElementById('pwd').value.trim();
        var phone = document.getElementById('phone').value.trim();
        var crty = document.getElementById('crty').value.trim();
        var address = document.getElementById('address').value.trim();
        var mail = document.getElementById('mail').value.trim();
        var ppt = document.getElementById('ppt').value.trim();
        var n = document.getElementById('n').value.trim();

        if (name.length==0) {
            alert('请输入您的用户名4到16位（字母，数字，下划线）！');
            return false;
        }
        if (!(/^[a-zA-Z0-9_-]{4,16}$/.test(name))) {
            alert('用户名有误！');
            return false;
        }

        if (n==1) {
            alert('用户名已存在！！！！！');
            return false;
        }


        if (pw.length==0) {
            alert('请输入您的密码6-10位!');
            return false;
        }
        if (!(/^[a-zA-Z0-9]{6,10}$/.test(pw))) {
            alert('密码有误！必须且只含有数字和字母，6-10位！');
            return false;
        }


        if (pwd.length==0) {
            alert('请输入您的确认密码6-10位!');
            return false;
        }
        if (!(/^[a-zA-Z0-9]{6,10}$/.test(pwd))) {
            alert('确认密码有误！必须且只含有数字和字母，6-10位！');
            return false;
        }

        if(ppt==1)
        {
            alert('两次密码不一样！');
            return false;            
        }

        if (phone.length == 0) {
            alert('请输入您的手机号');
            return false;
        }
        if (!(/^1[34578]\d{9}$/.test(phone))) {
            alert('手机号码有误！');
            return false;
        }

        if (crty.length == 0) {
            alert('请输入您城市');
            return false;
        }

        if (address.length == 0) {
            alert('请输入您的地址');
            return false;
        }

        if (mail.length == 0) {
            alert('请输入您的邮箱');
            return false;
        }
        if (!(/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/.test(mail))) {
            alert('邮箱有误！');
            return false;
        }


        $.ajax({
            url: "/Home/log/reg",
            type: "POST",
            dataType:'json',
            data: {
                name:name,
                pw:pw,
                phone:phone,
                crty:crty,
                address:address,
                mail:mail,
            },
            success: function (data) {
                var strobj = eval(data);
                if(data.data==200){
                    $('.cd-popup1').removeClass('is-visible1');
                    alert('注册成功？去登录吧');

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






