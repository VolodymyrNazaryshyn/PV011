<div class="wrapper">
    <h1>Формы. Данные форм.</h1>

    <p>
        Все GET-параметры (передаваемые в адресной строке после ?)
        собираются в глобальный массив $_GET, доступный в любой части кода
        <br/>
        $_GET: <?php print_r( $_GET ) ?>
    </p>

    <form class="formdata-form" method="get">
        <label>Введите строку: <input class="formdata-input" name="str" /></label>
        <button class="formdata-btn">Послать GET</button>
    </form>

    <p>
        POST-данные передаются в теле запроса, в адресной строке их
        не видно. Значения попадают в массив 
        <br/>
        $_POST: <?php print_r( $_POST ) ?>
        <br/>
        GET- и POST- данные могут приходить одновременно, но только 
        не GET-запросом (он не должен иметь тела)
    </p>

    <form class="formdata-form" method="post">
        <label>Введите строку: <input class="formdata-input" name="strp" /></label>
        <button class="formdata-btn">Послать POST</button>
    </form>

    <p>
        Массив $_REQUEST является объединением GET- и POST- данных
        но для использования не рекомендуется
        <br/>
        $_REQUEST: <?php print_r( $_REQUEST ) ?>
    </p>

    <p>
        Файлы, передаваемые формой, сохраняются в временной папке
        сервера и удаляются после обработки запроса. Если файл нужен
        на постоянной основе, то его необходимо перенести (скопировать)
        в постоянную папку.
        <br/>
        Данные о загруженных (переданных формой) файлах
        собираются в отдельном глобальном массиве $_FILES:
        <pre><?php print_r( $_FILES ) ?></pre>
    </p>

    <form class="formdata-form" method="post" enctype="multipart/form-data">
        <label class="formdata-label-file-input">Файл: <input type="file" name="formfile" /></label>
        <label>Введите описание: <input class="formdata-input" name="descr" value="A file" /></label>
        <input class="formdata-input" disabled name="bescr" value="B file" />
        <br/>
        <button class="formdata-btn">Послать файл</button>
    </form>

    <?php
        if( isset( $_FILES['formfile'] ) ) { // Передача есть
            if( $_FILES['formfile']['error'] === 0 ) {  // Нет ошибки
                if( $_FILES['formfile']['size'] > 0 ) { // Есть данные
                    $dot_position = strrpos( $_FILES['formfile']['name'], '.' ) ;
                    $extension = substr( $_FILES['formfile']['name'], $dot_position ) ;
                    
                    if( in_array($extension, $_CONTEXT[ 'image_extensions' ])  ) { // Присутствие в массиве значения
                        move_uploaded_file( 
                            $_FILES['formfile']['tmp_name'],
                            './uploads/' . $_FILES['formfile']['name'] 
                        ) ;
                        echo '<b class="success">✅ The file was copied successfully!</b>';
                    } else {
                        $img_ext = "";
                        foreach( $_CONTEXT[ 'image_extensions' ] as $val ) $img_ext .= $val . " ";
                        echo "<b class=\"error\">🚫 '$extension' is invalid extension, choose from '{$img_ext}'<b>";
                    }
                } else {
                    echo '<b class="error">🚫 No data!<b>';
                }
            } else {
                echo '<b class="error">🚫 Formfile error!<b>';
            }
        }
    ?>
</div>