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

            <div class="match_form banner_submit">
                <h2 class="content_title">공지사항 등록하기</h2>
                <div class="match_title match_box">
                    <ul>
                        <li class="li_title">제목</li>
                        <li class="li_content mr0"><input type="text"></input></li>
                    </ul>
                </div>
                <div class="match_content match_box">
                    <p class="li_title mb15">내용</p><textarea class="match_content_inner fwb fs16"></textarea>
                </div>
                <div class="df_jsb"><a href="./appNotice.php"><button class="block black">목록보기</button></a>
                    <div class="btn_wrap"><a href="./appNoticeAdd.php" class="a-block">등록</a></div>
                </div>
            </div>
            <!-- match_form -->

        </div>
        <!-- content_wrap -->
    </div>
    <!--index_wrap -->

    <script src="http://code.jquery.com/jquery-latest.min.js?ver=<?= time() ?>"></script>
    <script type="text/javascript" src="js/app.js?ver=<?= time() ?>"></script>
</body>

</html>