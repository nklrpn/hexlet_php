-- Query — класс, который является абстракцией поверх sql. 
-- Его главное достоинство это возможность строить динамические запросы без склеивания строк.
-- 
-- Пример использования:
-- 
-- <?php
-- $query = new Query($this->pdo, 'users');
-- $query = $query->where('from', 'github');
-- $query = $query->select('id', 'name');
-- 
-- $query->count() == sizeof($query->all());
-- 
-- $coll = $query->map(function ($row) {
--     return $row['id'] . '-' . $row['name'];
-- });
-- print_r($coll); // ['id1-name1', 'id2-name2', ...]
-- src/Query.php
-- Реализуйте метод count в соответствии с примером выше.
-- Реализуйте метод map в соответствии с примером выше.

class Query
{
    private $pdo;
    private $table;
    private $data = [
        'select' => '*',
        'where' => []
    ];

    public function __construct($pdo, $table, $data = null)
    {
        $this->pdo = $pdo;
        $this->table = $table;
        if ($data) {
            $this->data = $data;
        }
    }

    public function count()
    {
        // BEGIN (write your solution here)
        return sizeof($this->all());
        
        /* TEACHER'S SOLUTION */
        $query = $this->select('COUNT(*)');
        $stmt = $this->pdo->query($query->toSql());
        return $stmt->fetchColumn();
        // END
    }

    public function map($func)
    {
        // BEGIN (write your solution here)
        return array_map($func, $this->all());
        
        /* TEACHER'S SOLUTION */
        $stmt = $this->pdo->query($this->toSql());
        return array_map($func, $stmt->fetchAll());
        // END
    }

    public function select(...$arguments)
    {
        $select = implode(', ', $arguments);
        return $this->getClone(['select' => $select]);
    }

    public function where($key, $value)
    {
        $data = ['where' => array_merge($this->data['where'], [$key => $value])];
        return $this->getClone($data);
    }

    public function all()
    {
        return $this->pdo->query($this->toSql())->fetchAll();
    }

    public function toSql()
    {
        $sqlParts = [];
        $sqlParts[] = "SELECT {$this->data['select']} FROM {$this->table}";
        if ($this->data['where']) {
            $where = $this->buildWhere();
            $sqlParts[] = "WHERE $where";
        }

        return implode(' ', $sqlParts);
    }

    private function buildWhere()
    {
        return implode(' AND ', array_map(function ($key, $value) {
            $quotedValue = $this->pdo->quote($value);
            return "$key = $quotedValue";
        }, array_keys($this->data['where']), $this->data['where']));
    }

    private function getClone($data)
    {
        $mergedData = array_merge($this->data, $data);
        return new self($this->pdo, $this->table, $mergedData);
    }
}
