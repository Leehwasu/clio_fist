<div class="col-md-3 left_col">
  <div class="left_col scroll-view">
    <div class="navbar nav_title" style="border: 0;">
      <a href="/" class="site_title"><i class="fa fa-pagelines"></i> <span style="margin-left:8px">수권서관리</span></a>
    </div>

    <div class="clearfix"></div>

    <!-- menu profile quick info -->
    <div class="profile clearfix">
      <div class="profile_pic">
        <img src="/images/yoonchul.png" alt="..." class="img-circle profile_img" style="width:56px;object-fit: cover;height: 56px;">
      </div>
      <div class="profile_info" style="padding: 30px 10px 10px;">
        <h2><?=$_SESSION['user_name']?></h2>
        <span><?=$_SESSION['team_name']?></span>
      </div>
    </div>
    <!-- /menu profile quick info -->

    <br />

    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
      <div class="menu_section">
        <h3>수권서관리</h3>
        <ul class="nav side-menu">
          <li class="active"><a><i class="fa fa-file-o"></i> 수권서 <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu" style="display: block;">
              <li class="current-page"><a href="index.html">수권서 등록</a></li>
              <li><a href="index2.html">수권서 목록</a></li>
            </ul>
          </li>
          <li><a><i class="fa fa-user"></i> 사용자 <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="form.html">접속내역</a></li>
            </ul>
          </li>
        </ul>
      </div>
      <div class="menu_section">
        <h3>관리자</h3>
        <ul class="nav side-menu">
          <li><a><i class="fa fa-eye-slash"></i> 권한 <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="projects.html">권한 만들기</a></li>
              <li><a href="e_commerce.html">권한 부여</a></li>
            </ul>
          </li>
          <li><a><i class="fa fa-list-alt"></i> 내역 <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="page_403.html">접속내역</a></li>
              <li><a href="page_404.html">팀별 사용 내역</a></li>
            </ul>
          </li>
          <li><a><i class="fa fa-cog"></i> 환경설정 <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
                <li><a href="#level1_2">공지사항</a></li>
            </ul>
          </li>                  
        </ul>
      </div>

    </div>
    <!-- /sidebar menu -->

    <!-- /menu footer buttons -->
    <div class="sidebar-footer hidden-small">
      <a data-toggle="tooltip" data-placement="top" title="담당자 : 김윤철 [디지털솔루션팀] (1895)" style="width:50%">
        <i class="fa fa-user"></i>
      </a>
      <!-- <a data-toggle="tooltip" data-placement="top" title="FullScreen">
        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
      </a>
      <a data-toggle="tooltip" data-placement="top" title="Lock">
        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
      </a> -->
      <a data-toggle="tooltip" data-placement="top" title="로그아웃" href="login.html" style="width:50%">
        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
      </a>
    </div>
    <!-- /menu footer buttons -->
  </div>
</div>