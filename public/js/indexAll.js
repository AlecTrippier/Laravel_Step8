

function indexAll(){


fetch('/show_all', { // 第1引数に送り先
  method: 'GET',
  /* headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content}, // CSRFトークン対策 */
})
.then((response) => response.json())
.then((res) => {
     /*--------------------
          PHPからの受取成功
         --------------------*/
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

            var insertHTML = "<tr class=\"target\" >" + insertID + insertIMG + insertName + insertPrice + insertStock + insertCompanyName + insertShow_btn + insertDel_btn + "</tr>"
            var all_result = document.getElementById("all_result");



            all_result.insertAdjacentHTML('afterend', insertHTML);
        })

        // 検索条件保存のため隠しパラメータをinputに設定
        // すでに隠しパラメータが存在する場合は一度リセットしてから記述するよう class名にtargetを付与している
        $condition = document.getElementById("condition");
        $condition.value = "all";


    })

    .catch(error => {
         // 取得したレコードをeachで順次取り出す
        alert("実行失敗");

        alert(error);
    })
}

// 関数を実行
indexAll();