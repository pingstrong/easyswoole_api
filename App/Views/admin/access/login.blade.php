<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <title>登录</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/font-awesome.min.css" rel="stylesheet">
    <link href="/css/animate.css" rel="stylesheet">
    <link href="/css/login.css" rel="stylesheet">

    <script src="/js/jquery.min.js" charset="utf-8"></script>
	<script src="/layer/layer.min.js" charset="utf-8"></script>
	<script src="/js/axios.min.js" charset="utf-8"></script>
    <script src="/js/global.js"   charset="utf-8"></script>

    <script>
		code();
		function code() {
			$('.verify').attr('src','/backdata/verify?t='+Date.parse(new Date()));
		}
    </script>

</head>

<body class="signin">
    <div class="signinpanel">
        <div class="row">
            <div class="col-sm-12">
                <form>
                	<div>
	                    <h4 class="no-margins">登录：</h4>
	                    <p class="m-t-md">数据管理平台</p>
	                    <input type="text" class="form-control uname" name="uname" placeholder="用户名" />
	                    <input type="password" class="form-control pword m-b" name='pwd' placeholder="密码" />

	                    <div class="row">
	                    	<div class="col-sm-6">
						    	<input type="text" class="form-control" name="verify" placeholder="验证码" autocomplete="off">
						    </div>
						    <div class="col-sm-6">
						    	<img src="/backdata/verify" class="verify" onclick="code();" width="100%" height="100%" />
						    </div>
	                    </div>
                    </div>
                    <div class="btn btn-success btn-block submit">登录</div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    	function callback(data){
    		if(data.code === 0){
    			localStorage.setItem('jmz_uname', $('input[name="uname"]').val());
    			localStorage.setItem('jmz_pwd', $('input[name="pwd"]').val());
    			layer.msg('登录成功');
    			location.href = '/backdata/main';
    		} else {
    			layer.msg(data.msg);
    			code();
    		}
    	}

		function submit_form()
		{
			var uname = $('input[name="uname"]').val();
			var pwd = $('input[name="pwd"]').val();
			var verify = $('input[name="verify"]').val();
			if(uname && pwd && verify){
				var data = {'uname':uname,'pwd':pwd, 'verify':verify};

				http_post("/backdata/login", data, function(res){
					console.log(res)
					if(res.code === 0){
						localStorage.setItem('jmz_uname', $('input[name="uname"]').val());
						localStorage.setItem('jmz_pwd', $('input[name="pwd"]').val());
						layer.msg('登录成功');
						location.href = '/backdata/main';
					} else {
						layer.msg(res.msg);
						code();
					}
				})
				 
			} else {
				layer.msg('请填写完成信息');
			}
		}

		$('body').on('click','.submit',function(){
			submit_form()
		})
		
		$(document).keyup(function(e){
			if(e.keyCode == 13){
				//
				submit_form()
			}
		});

		$('input[name="uname"]').val(localStorage.getItem('jmz_uname'));
		$('input[name="pwd"]').val(localStorage.getItem('jmz_pwd'));

    </script>
</body>

</html>
