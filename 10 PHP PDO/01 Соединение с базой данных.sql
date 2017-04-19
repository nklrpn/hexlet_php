-- Реализуйте интерфейс App\DDLManagerInterface в классе App\DDLManager
-- 
-- Пример использования:
-- 
-- $dsn = 'sqlite::memory:';
-- $ddl = new DDLManager($dsn);
-- 
-- $ddl->createTable('users', [
--     'id' => 'integer',
--     'name' => 'string'
-- ]);
-- 
-- Получившийся запрос в базу:
-- 
-- CREATE TABLE users (
--     id integer,
--     name string
-- );

class DDLManager implements DDLManagerInterface
{
    private $pdo;

    // BEGIN (write your solution here)
    public function __construct($dsn, $user = null, $pass = null)
    {
        $options = [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION];
        $this->pdo = new \PDO($dsn, $user, $pass, $options);
    }

    public function createTable($tableName, array $tableParams)
    {
        $par = implode(', ',
            array_map(function ($key, $val) {
                return $key . ' ' . $val;
            }, array_keys($tableParams), array_values($tableParams))
        );

        $this->pdo->query('CREATE TABLE ' . $tableName . ' (' . $par . ');');
    }
    // END

    public function getConnection()
    {
        return $this->pdo;
    }
}
