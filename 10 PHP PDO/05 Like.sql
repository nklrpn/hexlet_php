-- Реализуйте функцию like, которая принимает на вход pdo и массив. 
-- Строит запрос по данным из массива, выполняет его 
-- и возвращает данные в формате PDO::FETCH_COLUMN. 
-- Запрос должен возвращать id из таблицы users. 
-- У массива структура следующая: 
-- 1) ключ - это название поля; 
-- 2) значение - это часть запроса, которую нужно использовать в like выражении. 
-- Лайки из этого массива нужно соединять с помощью OR. 
-- Если массив пустой, то запрос должен выполнять следующий sql: select id from users.
-- 
-- Пример:
-- 
-- $pdo->exec("create table users (id integer, first_name string, email string)");
-- $pdo->exec("insert into users values (1, 'john', 'john@gmail.com')");
-- $pdo->exec("insert into users values (3, 'adel', 'adel@yahoo.org')");
-- 
-- $params = ['email' => '%gmail%', 'first_name' => 'ad%'];
-- 
-- [1, 3] == like($pdo, $params); // select id from users where email LIKE ? OR first_name LIKE ?

function like($pdo, array $params)
{
    // BEGIN (write your solution here)
    $whereQry = array_map(function ($key) {
            return $key . ' LIKE ?';
    }, array_keys($params));
    
    $where = ($whereQry) ? ' WHERE ' . implode(' OR ', $whereQry) : '';
    
    $stmt = $pdo->prepare("SELECT id FROM users" . $where);
    
    $stmt->execute(array_values($params));
    
    return $stmt->fetchAll(\PDO::FETCH_COLUMN);
    
    /* TEACHER'S SOLUTION */
    $likeParts = array_reduce(array_keys($params), function ($acc, $item) {
        $acc[] = "$item LIKE ?";
        return $acc;
    }, []);
    
    $sqlParts = [];
    $sqlParts[] = "select id from users";
    
    if (!empty($likeParts)) {
        $sqlParts[] = "where";
        $sqlParts[] = implode(" OR ", $likeParts);
    }
    
    $sql = implode(" ", $sqlParts);
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array_values($params));

    return $stmt->fetchAll(\PDO::FETCH_COLUMN);
    // END
}

class SolutionTest extends TestCase
{
    private $pdo;

    public function setUp()
    {
        $pdo = new \PDO('sqlite::memory:');
        $pdo->exec("create table users (id integer, first_name string, email string)");

        $data = [
            [1, 'john', 'john@gmail.com'],
            [3, 'adel', 'adel@yahoo.org'],
            [8, 'Mike', 'mike@bing.com'],
            [9, 'ada', 'ada@mydomain.com']
        ];
        $stmt = $pdo->prepare("insert into users values (?, ?, ?)");
        foreach ($data as $value) {
            $stmt->execute($value);
        }
        $this->pdo = $pdo;
    }

    /**
     * @dataProvider additionProvider
     */
    public function testLike($expected, $params)
    {
        $result = like($this->pdo, $params);

        $this->assertEquals($expected, $result);
    }

    public function additionProvider()
    {
        return [
            [['1', '3', '8', '9'], []],
            [['3', '9'], ['first_name' => 'ad%']],
            [['1', '8', '9'], ['email' => '%com']],
            [['1', '3'], ['email' => '%gmail%', 'first_name' => 'ade%']],
        ];
    }
}
