//alert('aaa');
$('#addAccount').on('click', function()
    {
       $.ajax(
           {
               url: 'index.php?r=post/show',
               data: {test: '1'},
               type: 'POST',
               success: function(res)
               {
                   console.log('ok');
               },
               error: function ()
               {
                   alert('error ajax');
               }
           }
       )
    }
);