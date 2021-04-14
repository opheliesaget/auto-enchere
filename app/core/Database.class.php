<?php

/**
 * core/Database.class.php - Classe database
 */

/* Namespace */

namespace App\Database;


/* Alias */

use PDO;

/**
 * Classe base de données
 */
abstract class Database
{

    const ADDRESS = "mysql:dbname=enchere;host=127.0.0.1:8889";
    const USER = "root";
    const PASSWORD = "root";

    public static function createDBConnection()
    {
        return new PDO(self::ADDRESS, self::USER, self::PASSWORD);
    }
}
