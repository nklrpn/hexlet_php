-- Реализуйте функцию where, которая принимает на вход соединение с базой данных и 
-- массив описывающий условия выборки. Функция должна вернуть список 
-- идентификаторов пользователей отсортированных по возрастанию.
-- 
-- Пример:
-- 
-- where($pdo, []); // select id from users order by id
-- where($pdo, ['id' => []]); // select id from users order by id
-- 
-- // select id from users where first_name in ('john', 'adel')
-- where($pdo, ['first_name' => ['john', 'adel']])
-- 
-- // select id from users where first_name = 'ada' or source in ('bing', 'gmail')
-- where($pdo, ['first_name' => 'ada', 'source' => ['bing', 'gmail']])

function where($pdo, array $params)
{
    // BEGIN (write your solution here)
    $sql = 'SELECT id FROM users';
    $order = ' ORDER BY id';
    
    $whereQry = array_map(function ($key, $val) {
        if (is_array($val)) {
            return "'$key'" . " IN ('" . implode("', '", $val) . "')";
        } else {
            return "'$key'='{$val}'";
        }
    }, array_keys($params), $params);
    
    $where = ($whereQry) ? ' WHERE ' . implode(' OR ', $whereQry) : '';
    
    $stmt = $pdo->prepare('select id from users' . $where . $order);    
    $stmt->execute();
    
    return $stmt->fetchAll(\PDO::FETCH_COLUMN);
    
    /* TEACHER'S SOLUTION */
    $whereParts = array_reduce(
        array_keys($params),
        function ($acc, $key) use ($pdo, $params) {
            $values = (array) $params[$key];
            if ($values) {
                $in = array_map(function ($item) use ($pdo) {
                    return $pdo->quote($item);
                }, $values);
                $joinedIn = implode(", ", $in);
                $acc[] = "$key IN ($joinedIn)";
            }
            return $acc;
        },
        []
    );

    $where = $whereParts ? 'WHERE ' . implode(' OR ', $whereParts) : '';
    $query = sprintf("SELECT id FROM users %s ORDER BY id", $where);
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    return $stmt->fetchAll(\PDO::FETCH_COLUMN);
    // END
}

class SolutionTest extends TestCase
{
    private $pdo;

    public function setUp()
    {
        $opt = array(
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
        );
        $pdo = new \PDO('sqlite::memory:', null, null, $opt);
        $pdo->exec("create table users (id integer, first_name string, source string)");

        $pdo->exec("insert into users values (1, 'john', 'yahoo')");
        $pdo->exec("insert into users values (3, 'adel', 'gmail')");
        $pdo->exec("insert into users values (8, 'Mike', 'bing')");
        $pdo->exec("insert into users values (9, 'ada', 'yandex')");
        $this->pdo = $pdo;
    }

    /**
     * @dataProvider additionProvider
     */
    public function testWhere($expected, $params)
    {
        $result = where($this->pdo, $params);

        $this->assertEquals($expected, $result);
    }

    public function additionProvider()
    {
        return [
            [['1', '3', '8', '9'], []],
            [['1', '3', '8', '9'], ['id' => []]],
            [['1', '3'], ['first_name' => ['john', 'adel']]],
            [['3', '8', '9'], ['first_name' => 'ada', 'source' => ['bing', 'gmail']]],
            [['3'], ['first_name' => 'adel']],
            [['1', '3', '9'], ['first_name' => ['ada', 'john'], 'source' => ['gmail', 'yandex']]],
        ];
    }
}
