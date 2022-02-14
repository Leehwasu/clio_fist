<!DOCTYPE html>
<html lang="ko">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CLIO - Letter Of Auth </title>

    <link href="/gentelella_design/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/gentelella_design/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="/gentelella_design/vendors/nprogress/nprogress.css" rel="stylesheet">
    <link href="/gentelella_design/vendors/animate.css/animate.min.css" rel="stylesheet">
    <link href="/gentelella_design/build/css/custom.css" rel="stylesheet">
  </head>
  
  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form method="post" action="/common/login_ok.php">
              <h1>수권서관리 시스템</h1>
              <div>
                <input type="text" class="form-control" name='userid' placeholder="아이디" required="" />
              </div>
              <div>
                <input type="password" class="form-control" name ='userpw' placeholder="비밀번호" required="" />
              </div>
              <div>
              <button type="submit" id="btn" >로그인</button>
                <a class="reset_pass" href="#">비밀번호 찾기</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">
                  <a href="#signup" class="to_register"> 회원 가입 </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-pagelines"></i> CLIO COSMETICS</h1>
                  <p>©2016 All Rights Reserved. Every Pouch One CLIO.</p>
                </div>
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form>
              <h1>회원 가입</h1>
              <div>
                <input type="text" class="form-control" placeholder="아이디" required="" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="이메일" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="비밀번호" required="" />
              </div>
              <div>
                <a class="btn btn-default submit" href="index.html">회원가입 완료</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">이미 회원이신가요?
                  <a href="#signin" class="to_register"> 로그인 </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> CLIO COSMETICS</h1>
                  <p>©2016 All Rights Reserved. Every Pouch One CLIO.</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
