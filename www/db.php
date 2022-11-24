<div class="wrapper">
    <h2>Робота с базами данных</h2>
    <main>
        <h3>Настройка СУБД</h3>
        <p>
            При работе с БД обычно на хостинге выдается
            логин/пароль и готовая БД. Поэтому, и для локальных
            сайтов желательно создать отдельного пользователя
            и отдельную БД для каждого из сайтов.
        </p>
        <p>
            Подключаемся к СУБД:<br/>
            <b>а)</b> через консоль (терминал)<br/>
            <b>б)</b> phpmyadmin (http://localhost/phpmyadmin)<br/>
            <b>в)</b> стороннее ПО для БД: MySQL Workbench, DBeaver, ...<br/>
            <br/>
            (дальше на примере терминала)
            <br/>
            <pre>
            Запускаем терминал (кнопкой Shell на панели XAMPP / cmd)
            Переходим в папку 
            > cd mysql/bin
            Запускаем консоль БД
            > mysql -u root         (если нет пароля - новая установка)
            > mysql -u root -p      (если пароль установлен)
            -- попадаем в СУБД-клиент (консоль)
            Создаем БД для сайта (pv011)
            >> CREATE DATABASE pv011;
            Создаем пользователя и даем ему доступ к новой БД
            (логин - pv011_user, пароль - pv011_pass)
            >> GRANT ALL PRIVILEGES ON pv011.* 
               TO pv011_user@localhost 
               IDENTIFIED BY 'pv011_pass';
            Проверяем: выходим из консоли
            >> exit
            Опять Запускаем консоль, только от имени нового пользователя
            > mysql -u pv011_user -p
            password: (вводим) pv011_pass
            Если вход успешный - пользователь создан, пароль корректный
            Проверяем видимость БД
            >> SHOW DATABASES;
            +--------------------+
            | Database           |
            +--------------------+
            | information_schema |
            | pv011              | (признак видимости БД)
            | test               |
            +--------------------+
            </pre>
        </p>
        <h3>Подключение к БД из PHP</h3>
        <p>
            Для работы с БД в PHP есть несколько вариантов:<br/>
            -- набор команд для конкретной БД (mysql_... ib_...)<br/>
            -- или более современный инструмент - PDO (аналог ADO .NET)<br/>
        </p>
        <p>Подключение:
        <?php 
        try {
            $connection = new PDO( 
                "mysql:host=localhost;port=3306;dbname=pv011;charset=utf8",
                "pv011_user", "pv011_pass", [
                   PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                   PDO::ATTR_PERSISTENT => true
                ] ) ;
            echo "Connection OK" ;
        } 
        catch( PDOException $ex ) {
           echo $ex->getMessage() ;
        }
        ?>
        </p>
        <p>
            Выполнение запросов. DDL.
            Data Definition Language - язык "разметки" данных, создание баз,
            таблиц и т.п.
            <pre>
            <b>Особенности MySQL:</b>
             💠 нет отдельного типа для UUID, (но есть функции-генераторы)
              используем CHAR(36)
             💠 нет N-типов (Юникод), кодировка текстовых полей задается
              CHARSET-ом для таблицы в целом (либо для каждого поля отдельно)
             💠 есть несколько "движков" в рамках MySQL (MyISAM, InnoDB, ...)
             наличие условий IF EXISTS / IF NOT EXISTS позволяющих
             выполнять команду условно
            </pre>
            Результат запроса:
            <?php
            $sql = <<<SQL
                CREATE TABLE IF NOT EXISTS  demo (
                    id      CHAR(36)   NOT NULL   PRIMARY KEY,
                    var_int INT,
                    val_str VARCHAR(128)
                ) Engine = InnoDB, DEFAULT CHARSET = utf8
            SQL;
            try {
                $connection->query( $sql ) ;
                echo "Table 'demo' OK" ;
            }
            catch( PDOException $ex ) {
                echo $ex->getMessage() ;
            }
            ?>
        </p>
        <p>
            DML - язык манипулирования данными
            <?php
            // $x = random_int(1000, 10000) ; 
            // $s = bin2hex( random_bytes(8) ) ;
            // $sql = "INSERT INTO demo VALUES( UUID(), $x, '$s' ) " ;
            // try {
            //    $connection->query( $sql ) ;
            //    echo "INSERT OK" ;
            // }
            // catch( PDOException $ex ) {
            //    echo $ex->getMessage() ;
            // }
            ?>
        </p>
        <p>
            DML. SELECT<br/>
            <?php
            $sql = "SELECT * FROM `demo` " ; // Делаем запрос на выборку (можно добавить WHERE `demo`.`var_int` % 2 = 0)
            // Запрашиваем имена всех столбцов таблицы
            $sql_columns = "SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME='demo'" ;
            try {
                $res_col = $connection->query( $sql_columns ) ;                       // Получаем "таблицу" рез-тов (имена всех столбцов таблицы)
                echo "<table class='demo' align=center border=1.5 cellspacing=0 cellpadding=0 >" ; // Рисуем таблицу
                    echo "<caption><b>$sql</b></caption>"; 
                    echo "<tr class='demo-header'>" ;                                 // Шапка таблицы
                        while( $col = $res_col->fetch( PDO::FETCH_NUM ) ) 
                            echo "<th>$col[3]</th>" ;                                 // $col[3] - выводим имена всех столбцов таблицы
                    echo "</tr>" ;
                    echo "<tr>" ;                                                     // Данные таблицы
                        $res_col = $connection->query( $sql_columns ) ;               // Обновляем $res_col
                        while( $col = $res_col->fetch( PDO::FETCH_NUM ) ) {           // Проходим по всем столбцам таблицы
                            $res = $connection->query( $sql ) ;                       // ~table (таблица рез-тов)
                            echo "<td>" ;
                            while( $row = $res->fetch( PDO::FETCH_ASSOC ) )           // Строка таблицы
                                echo "<div class='demo-data'>{$row[$col[3]]}</div>" ; // Заполняем каждый столбец таблицы данными
                            echo "</td>" ;
                        }
                    echo "</tr>" ;
                echo "</table>" ;
                // PDO::FETCH_ASSOC - только имена, 
                // PDO::FETCH_NUM - только индексы,
                // PDO::FETCH_BOTH - дублирование (по умолчанию)
            }
            catch( PDOException $ex ) {
                echo $ex->getMessage() ;
            }
            ?>
        </p>

    </main>
</div>
