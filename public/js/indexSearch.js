

ajax_search.addEventListener('click', () => {



    /*--------------------
     POST送信
     -------------------*/



    $high = document.getElementById('stock_high').value;
    $low = document.getElementById('stock_low').value;





    const postData = new FormData; // フォーム方式で送る場

    // set()で格納する

    postData.set('high', $high);
    postData.set('low', $low);



    fetch('ajax-test/show', { // 第1引数に送り先
        method: 'POST',
        headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content}, // CSRFトークン対策
        body: postData //inputタグの情報をコントローラへ送る
    })
        .then(response => response.json()) // 返ってきたレスポンスをjsonで受け取って次のthenへ渡す
        .then(res => {

             /*--------------------
          PHPからの受取成功
         --------------------*/


         const elements = document.getElementsByClassName('target') // "target"クラスを持つ全てのタグを取得
                while (elements.length) { //繰り返し処理 "target"クラスの数だけ繰り返し
                    elements.item(0).remove() //"target"クラスの0番目を削除
                }

        // 取得したレコードをeachで順次取り出す

        res.forEach(elm =>{



            var insertID = "<td>" + elm['id'] + "</td>"
            var insertIMG = "<td><img style=\"width:80px;\" src=\"{{asset(" + elm['img'] + "])}}\" ></td>" /* imgタグ */
            var insertName = "<td>" + elm['name'] + "</td>"
            var insertPrice = "<td>" + elm['price'] + "</td>"
            var insertStock = "<td>" + elm['stock'] + "</td>"
            var insertCompanyName = "<td>" + elm['companyName'] + "</td>"

            var insertShow_btn = "<td><a href=\"/show/"+ elm['id'] + "\"><button type=\"button\" class= \"btn btn-success\">詳細</button></a></td>"
            var insertDel_input =  "<td><input  value=\"" + elm['id'] + "\" id=\"" + elm['id'] + "\"/td>"
            var insertDel_btn =  "<td><button onclick=\"ajax_del(this);\" value=\"" + elm['id'] + "\" id=\"" + elm['id'] + "\" type=\"button\" class= \"btn btn-danger btn-dell\">削除</button></a></td>"

            var insertHTML = "<tr class=\"target\">" + insertID + insertIMG + insertName + insertPrice + insertStock + insertCompanyName + insertShow_btn + insertDel_btn + "</tr>"
            var all_result = document.getElementById("all_result");



            all_result.insertAdjacentHTML('afterend', insertHTML);
        })

            // 検索条件保存のため隠しパラメータをinputに設定
            // すでに隠しパラメータが存在する場合は一度リセットしてから記述するよう class名にtargetを付与している
            $condition = document.getElementById("condition");
            $condition_high = document.getElementById("condition_high");
            $condition_low = document.getElementById("condition_low");


            //検索キーワードが空の場合はコンディションにallを入れる
            if($high || $low){
                //検索キーワードがある場合は条件をinputに保存する
                $condition.value = "stock";
                $condition_high.value = $high;
                $condition_low.value = $low;

            }else{
                $condition.value = "all";
                $condition_high.value = "";
                $condition_low.value = "";
            }

        })
        .catch(error => {
            alert(error); // エラー表示
        });
});