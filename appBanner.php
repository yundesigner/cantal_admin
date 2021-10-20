<?php?>

<!DOCTYPE html>
<html lang="en">
<?php include('_head.php');?>
<!-- head -->

<body>
    <div class="index_wrap appBannerPage">
        <?php $navApp='menu_focus'; include('_nav.php');?>
        <!-- nav -->

        <div class="content_wrap banner_wrap">
            <?php include('_header.php');?>
            <!-- header -->

            <div class="match_form banner_in">
                <h2 class="content_title">배너관리</h2>
                <div class="match_title match_box">
                    <ul>
                        <li class="li_title">제목</li>
                        <li class="li_content">
                            <p>이벤트제목</p>
                            <p class="li_date">2021.08.12</p>
                        </li>
                    </ul>
                </div>
                <!-- match_title -->

                <div class="match_person">
                    <div class="match_user">
                        <ul class="match_user_writer match_box">
                            <li class="li_title">작성자</li>
                            <li class="li_content">홍길동</li>
                        </ul>
                        <ul class="match_user_writer match_box">
                            <li class="li_title">작성일</li>
                            <li class="li_content">2021.08.12</li>
                        </ul>
                        <ul class="match_user_writer match_box">
                            <li class="li_title">기간</li>
                            <li class="li_content">2021.08.12~2021.08.18</li>
                        </ul>
                    </div>
                    <div class="match_partner match_box dn">
                    </div>
                </div>
                <!-- match_person -->

                <div class="df">
                    <div class="match_content match_box">
                        <p class="li_title">이미지</p>
                        <div class="img_area"></div>
                    </div>
                    <div class="match_content match_box">
                        <p class="li_title">내용</p>
                        <textarea class="match_content_inner fwb fs16" readonly></textarea>
                    </div>
                    <!-- match_content -->
                </div>

                <div class="df_jsb">
                    <a href="./appmanage.php"><button class="block black">목록보기</button></a>

                    <div class="btn_wrap">
                        <button class="block orange">삭제</button>
                        <button class="block" onclick="appBannerEdit()">수정</button>
                    </div>
                </div>
            </div>
            <!-- match_form -->

        </div>
        <!-- content_wrap -->
    </div>
    <!--index_wrap -->

    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script type="text/javascript" src="js/app.js"></script>
</body>

</html>