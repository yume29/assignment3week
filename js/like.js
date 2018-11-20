    $(document).on('click', '.favorite', function() {
    // どの投稿に関してか
    var diary_id = $(this).siblings('.diary_id').text();
    // 誰がいいねしたか
    var user_id = $(this).siblings('.user_id').text();

    var fav_btn = $(this);
    var fav_count = $(this).siblings('.fav_count').text();
    console.log('DiaryID:' + diary_id);
    console.log('UserID:' + user_id);
    $.ajax({
    // 送信先、送信するデータを記述
    url: 'like.php',  //送信先
    type: 'POST',  //送信メゾット
    datatype: 'json',  //データのタイプ　
    data: {            //送信するデータ
        'diary_id':diary_id,
        'user_id':user_id,
    }
    })
    .done(function(data) {
        

    // 処理が成功したときのデータを記述
    // dataにはINSERT文の結果が入っている（成功したらtrue）
    console.log();
    if(data == 'true'){
        fav_count++;
        fav_btn.siblings('.fav_count').text(fav_count);
        fav_btn.removeClass('favorite');
        fav_btn.addClass('dis_fav');
        fav_btn.children('span').html('<span>お気に入り取り消し</span>');
    }
    })
    .fail(function(error) {
        console.log(error);
    // 処理が失敗したときの処理を記述
    })
});

    // 取り消し処理
    $(document).on('click', '.dis_fav', function() {
    // 必要な値を取り出す
    // どの投稿に関してか
    var diary_id = $(this).siblings('.diary_id').text();
    // 誰がいいねしたか
    var user_id = $(this).siblings('.user_id').text();
    // 
    var fav_btn = $(this)
    // 
    var fav_count = $(this).siblings('.fav_count').text();
    // 非同期処理
    $.ajax({
    // 送信先、送信するデータを記述
    url: 'like.php',  //送信先
    type: 'POST',  //送信メゾット
    datatype: 'json',  //データのタイプ　
    data:{            //送信するデータ
        'diary_id':diary_id,
        'user_id':user_id,
        'dis_fav': true
        }
    })
    .done(function(data) {
        console.log('data')
    // 処理が成功したときのデータを記述
    // dataにはINSERT文の結果が入っている（成功したらtrue）
    if(data == 'true'){
        fav_count--;
        fav_btn.siblings('.fav_count').text(fav_count);
        fav_btn.removeClass('dis_fav');
        fav_btn.addClass('favorite');
        fav_btn.children('span').html('<span><img src="img/fav.jpg" alt=""></span>');
    }
    })
    .fail(function(error) {
    // 処理が失敗したときの処理を記述
    })
});
