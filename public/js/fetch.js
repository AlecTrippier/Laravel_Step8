

function indexAll(){


  alert("実行");


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
            var insertHTML = "<tr class=\"target\"><td>" + elm['id'] + "</td><td>" + elm['name'] + "</td><td>" + elm['price'] + "</td></tr>"
            var all_result = document.getElementById("all_result");
            all_result.insertAdjacentHTML('afterend', insertHTML);
        })
        alert("実行成功");

    })

    .catch(error => {
         // 取得したレコードをeachで順次取り出す
        alert("実行失敗");


    })
}

// 関数を実行
indexAll();