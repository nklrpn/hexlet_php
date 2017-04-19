-- UserMapper это класс отвечающий за сохранение объектов класса User в базе вместе с зависимостями. 
-- В нашем примере User может содержать фотографии (класс Photo).
-- 
-- Структура таблиц описана в файле TestUserMapper.php.
-- 
-- Пример:
-- 
-- $user = new User();
-- $user->addPhoto('family', '/path/to/photo/family');
-- $user->addPhoto('party', '/path/to/photo/party');
-- $user->addPhoto('friends', '/path/to/photo/friends');
-- 
-- $mapper = new UserMapper($pdo);
-- $mapper->save($user);
-- file: UserMapper.php
-- Реализуйте функцию save в классе UserMapper. 
-- В этом задании достаточно реализовать логику сохранения (только вставку) фотографий пользователя.

class UserMapper
{
    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    public function save(User $user)
    {
        $stmtUser = $this->pdo->prepare("INSERT INTO users (name) VALUES (?)");
        $stmtUser->execute([$user->getName()]);
        $user->setId($this->pdo->lastInsertId());

        // BEGIN (write your solution here)
        $stmtUserPhoto = $this->pdo->prepare("
            INSERT INTO user_photos (user_id, name, filepath)
                VALUES (?, ?, ?)
        ");
        
        foreach ($user->getPhotos() as $photo) {
            $stmtUserPhoto->bindValue(1, $user->getId());
            $stmtUserPhoto->bindValue(2, $photo->getName());
            $stmtUserPhoto->bindValue(3, $photo->getFilepath());
            
            $stmtUserPhoto->execute();
        }        
        // END
    }
}

class User
{
    private $photos;
    private $id;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function addPhoto($name, $filepath)
    {
        $photo = new Photo($this, $name, $filepath);
        $this->photos[] = $photo;
    }

    public function getPhotos()
    {
        return $this->photos;
    }
}

class Photo
{
    private $user;
    private $name;
    private $filepath;

    public function __construct($user, $name, $filepath)
    {
        $this->user = $user;
        $this->name = $name;
        $this->filepath = $filepath;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getFilepath()
    {
        return $this->filepath;
    }
}

class UserMapperTest extends TestCase
{
    private $pdo;
    private $mapper;

    public function setUp()
    {
        $opt = array(
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        );
        $pdo = new \PDO('sqlite::memory:', null, null, $opt);

        $pdo->exec("create table users (
            id integer primary key autoincrement,
            name string not null)");

        $pdo->exec("create table user_photos (
            id integer primary key autoincrement,
            user_id integer not null,
            name string not null,
            filepath string not null)");

        $this->mapper = new UserMapper($pdo);
        $this->pdo = $pdo;
    }

    public function testFetchReducer()
    {
        $user = new User('Mark');
        $user->addPhoto('family', '/path/to/photo/family');
        $user->addPhoto('party', '/path/to/photo/party');
        $user->addPhoto('friends', '/path/to/photo/friends');

        $this->mapper->save($user);

        $stmt = $this->pdo->query("SELECT COUNT(*) FROM user_photos");
        $this->assertEquals(3, $stmt->fetchColumn());
    }
}
