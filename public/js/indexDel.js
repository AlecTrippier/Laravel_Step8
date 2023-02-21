function ajax_del(ele){



  const postData = new FormData; // フォーム方式で送る場
  postData.set('id', document.getElementById(ele.value).value); // set()で格納する




  /*--------------------POST送信　セット-------------------*/


  /*-----------------------POST送信----------------------*/
  fetch('ajax-test/del', { // 第1引数に送り先
      method: 'POST',
      headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content}, // CSRFトークン対策
      body: postData
  })
        .then((response) => response.json())
        .then((res) => {
            /*--------------------
                  PHPからの受取成功
                --------------------*/
                // 取得したレコードをeachで順次取り出す



                const elements = document.getElementsByClassName('target') // "target"クラスを持つ全てのタグを取得
                while (elements.length) { //繰り返し処理 "target"クラスの数だけ繰り返し
                    elements.item(0).remove() //"target"クラスの0番目を削除
                }

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

            })

            .catch(error => {
                // 取得したレコードをeachで順次取り出す
                alert("実行失敗");

                alert(error);
            })


}

