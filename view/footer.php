
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="../libraries/cart.js"></script>
<script>
      
        //This is the minus button click event for the product_page.php
        $(".btn-minus").on("click",function(){
            var now = $(".section > div > input").val();
            var prodId = $("#prodId").val();
            if ($.isNumeric(now)){
                if (parseInt(now) -1 > 0){ now--;}
                //if we click the minus button make a get request to update our session in PHP
                 window.open("product_page.php?id=" + prodId + "&qty=" + now , "_self");
                $(".section > div > input").val(now);
            }else{
                window.open("product_page.php?id=" + prodId + "&qyt=1" , "_self");
                $(".section > div > input").val("1");
            }
        })  
        //This is the plus button click event for the product_page.php          
        $(".btn-plus").on("click",function(){
            var now = $(".section > div > input").val();
            var prodId = $("#prodId").val();
            if ($.isNumeric(now)){
               
                $(".section > div > input").val(parseInt(now)+1);
                //if we click the plus button then make a get requrest to update our session in PHP
                window.open("product_page.php?id=" + prodId  + "&qty=" + (parseInt(now)+1) , "_self");
            }else{
                window.open("product_page.php?id=" + prodId  + "&qty=1", "_self");
                $(".section > div > input").val("1");
            }
        })           

</script>
        <footer  style="height:55px; width:100%; background:black; margin-top:20px;position:fixed; bottom:0;left:0;right:0;">
            <div style="margin:0 auto; width:150px;"> 
               <a class="navbar-brand" href="#"><span style="color:red">PET</span><span class="glyphicon glyphicon-heart"></span><span style="color:green">MART</span></a>                
            </div>
            <p style="float:right;margin-top:20px;margin-right:40px;color:white;">&copy; <?php echo date("Y"); ?> Vladimir Heredia</p>
        </footer>
</body>
</html>