<?

class Dbinterface {
  private$conn;


  function __construct() {
    $this -> conn = $this -> dbConnect();
  }


  function dbConnect() {
    $host     = 'localhost';
    $dbName   = 'u2824440_randyFilm';
    $userName = 'u2824440_randyFilm';
    $password = 'jN2aO0sS6efK8pA7';
    $opts = [ PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4'" ];

    return new PDO(
      "mysql:host=$host;dbname=$dbName", 
      $userName, $password,
      $opts
    );
  }

  function dbInsert($table, $data) {
    $db = $this -> conn;
    $query = $db -> prepare("INSERT INTO $table SET ?");
    $query->execute([$data]);

    return $db -> lastInsertId();
  }


  function dbSelect($table, $where = null) {
    $db = $this -> conn;
    $query = "SELECT * FROM $table";

    if ($where != null) {
      $query = "SELECT * FROM $table WHERE $where";
    }

    $res = $db -> prepare($query);
    $res -> execute();

    return $res -> fetchAll(PDO::FETCH_ASSOC);
  }


  function dbUpdate($table, $data, $where) {
    $db = $this -> conn;
    $query = $db -> prepare("UPDATE $table SET $data WHERE $where");

    return $query;
  }


  function dbDelete($table, $where) {
    $db = $this -> conn;
    $query = "DELETE * FROM $table WHERE $where";
    $req = $db -> prepare($query);
    $req -> execute();

    return $req;
  }


  function dbDeleteAll($table) {
    $db = $this -> conn;
    $query = $db -> prepare("DELETE * FROM $table");
    $query->execute();

    return $query;
  }
}

?>