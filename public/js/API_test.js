function onButtonClick(){



    const postData = new FormData; // フォーム方式で送る場
    postData.set('id', 1); // set()で格納する




    /*--------------------POST送信　セット-------------------*/


    /*-----------------------POST送信----------------------*/
    fetch('api/sales', { // 第1引数に送り先
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


                alert("実行しました");

              })

              .catch(error => {
                  // 取得したレコードをeachで順次取り出す
                  alert("実行失敗");

                  alert(error);
              })


  }

