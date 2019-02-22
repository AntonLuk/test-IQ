<?php
$cur_url = $_SERVER['REQUEST_URI'];
$urls = explode('/', $cur_url);
array_pop($urls);
$crumbs = array();

if (!empty($urls) && $cur_url != '/') {
    foreach ($urls as $key => $value) {
        $prev_urls = array();
        for ($i = 0; $i <= $key; $i++) {
            $prev_urls[] = $urls[$i];
        }
        if ($key == count($urls) - 1)
            $crumbs[$key]['url'] = '';
        elseif (!empty($prev_urls))
            $crumbs[$key]['url'] = count($prev_urls) > 1 ? implode('/', $prev_urls) : '/';

        switch ($value) {
            case 'Calc' : $crumbs[$key]['text'] = 'Калькурятор';
                break;
            default : $crumbs[$key]['text'] = 'Главная страница';
                break;
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Test IQ</title>
    <link href="https://atuin.ru/demo/ui-slider/jquery-ui.css" type="text/css">
    <link href ="/css/style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.4/css/bootstrap.min.css" integrity="2hfp1SzUoho7/TsGGGDaFdsuuDL0LX2hnUp6VkX3CUQ2K4K+xjboZdsXyp4oUHZj" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.4/js/bootstrap.min.js" integrity="VjEeINv9OSwtWFLAtmc4JCtEJXXBub00gtSnszmspDLCtC0I4z4nqz7rEFbIZLLU" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $( function() {
            $( "#datepicker" ).datepicker();
        } );
    </script>

    <script>
        function getdetails(){
            var summ = $('#summ').val();
            var years = $('#years').val();
            $.ajax({
                type: "POST",
                url: "calc.php",
                data: {summ:summ, years:years}
            }).done(function( result )
            {
                $("#msg").html("Address of Roll no " +summ +" is "+result );
            });
        }
    </script>
</head>
<body>
<div class="logo"><img src="/images/logo.png">
    </div>
<div class="contact"><h2>8800-100-5005</h2></div>

<div class="menu">
<ul>
    <li><a href="#">Кредитные карты</a></li>
    <li><a href="#">Вклады</a></li>
    <li><a href="#">Дебетовая карта</a></li>
    <li><a href="#">Страхование</a></li>
    <li><a href="#">Друзья</a></li>
    <li><a href="#">Интернет-банк</a></li>
</ul>
</div>
<section id = "inner-headline">
    <div class = "row">
        <div class = "col-lg-12">
            <?php if (!empty($crumbs)) { ?>
                <ul class="breadcrumb">
                    <?php foreach ($crumbs as $item) { ?>
                        <?php if (isset($item)) { ?>
                            <li>
                                <a href="<?php echo $item['url'] ?>"><?php echo $item['text'];if($item != end($crumbs)){echo '->';} ?></a>
                            </li>
                        <?php } ?>
                    <?php } ?>
                </ul>
            <?php } ?>
        </div>
    </div>
</section>
<div class="content">
    <div class="container">
        <h2>Калькулятор</h2>
    <form method="post" class="calc" >
        <div class="form-group row">
        <label for="date" class="col-sm-2 col-form-label">Дата оформления вклада</label>
            <div class="col-sm-10">
<!--                <input type="date"  name="date"><br>-->
                 <input type="text" id="datepicker" name="date">
            </div>
        </div>
        <div class="form-group row">
        <label for="summ" class="col-sm-2 col-form-label">Сумма</label>
            <div class="col-sm-10">
            <input type="number" name="summ" min="1000" max="3000000"><br>
            </div>
        </div>
        <div class="form-group row">
            <label for="years" class="col-sm-2 col-form-label">Срок вклада</label>
        <div class="col-sm-10">
            <select name="years">
            <option value="365">1 год</option>
            <option value="730">2 года</option>
            <option value="1095">3 года</option>
            <option value="1460">4 года</option>
            <option value="1825">5 лет</option>
        </select>
        </div>
        </div>
        <div class="form-group row">
        <label for="replenishment" class="col-sm-2 col-form-label">Пополнение вклада</label>
           <div class="col-sm-10">
            <label><input type="radio" checked name="replenishment" value="false"/> Нет</label>
            <label><input type="radio"  name="replenishment" value="true"/> Да</label>
           </div>
           </div>
        <div class="form-group row">
            <label for="summadd" class="col-sm-2 col-form-label">Сумма пополнения вклада</label>
            <div class="col-sm-10">
                <input type="number"  name="summadd" min="1000" max="3000000"><br>
            </div>
        </div>
            <input type="submit" class="btn btn-success" onClick = "getdetails()" value="Рассчитать">
        <div id="msg"></div>

    </form>
        </div>
</div>
<div class="footer-menu">
    <ul>
        <li><a href="#">Кредитные карты</a></li>
        <li><a href="#">Вклады</a></li>
        <li><a href="#">Дебетовая карта</a></li>
        <li><a href="#">Страхование</a></li>
        <li><a href="#">Друзья</a></li>
        <li><a href="#">Интернет-банк</a></li>
    </ul>
</div>
</body>

</html>

