<?php 

/**
 * В этом упражнении нужно реализовать трейт ComparableByAge. 
 * Он полезен в случае, когда у нас есть класс сущностей, 
 * имеющих возраст, и нам нужно производить сравнения по возрасту.
 *
 * Трейт требует реализовать функцию compare в классе, куда его подмешивают. 
 * Эта функция сравнивает переданный аргумент (того же типа) с текущим объектом. 
 * И работает так:
 * 
 * Если текущий объект старше переданного, то функция возвращает 1.
 * Если текущий объект младше переданного, то функция возвращает -1.
 * Функция возвращает 0 в случае, если объекты одного возраста.
 * Функция compare - это все, что требует ComparableByAge от классов. 
 * На основе этой функции можно реализовать множество полезных методов.
 *
 * Пример использования:
 *   $user1 = new User(20);
 *   $user2 = new User(30);
 * 
 *   $user2->isOlderThan($user1); // true
 *   $user1->isYoungerThan($user2); // true
 *   $user1->isAgeTheSame($user2); // false
 * 
 *   $car1 = new Car('bmw', 1985);
 *   $car2 = new Car('lexus', 2000);
 * 
 *   $car2->isOlderThan($car1); // false
 *   $car1->isYoungerThan($car2); // false
 *   $car1->isAgeTheSame($car2); // false
 * 
 * ComparableByAge.php
 * Реализуйте трейт ComparableByAge.
 * 
 * User.php
 * Реализуйте функцию compare.
 * 
 * Car.php
 * Реализуйте функцию compare.
 */

trait ComparableByAge
{
    abstract public function compare($user);

    // BEGIN (write your solution here)
    public function isOlderThan($newObj)
	{
		return ($this->compare($newObj) === 1);
	}
	
	public function isYoungerThan($newObj)
	{
		return ($this->compare($newObj) === -1);
	}
	
	public function isAgeTheSame($newObj)
	{
		return ($this->compare($newObj) === 0);
	}
    // END
}

class User
{
    use ComparableByAge;

    private $age;

    public function __construct($age)
    {
        $this->age = $age;
    }

    public function getAge()
    {
        return $this->age;
    }

    // BEGIN (write your solution here)
    public function compare(User $user)
    {
        $comparedAge = $user->getAge();
        
        if ($this->age > $comparedAge) {
            return 1;
        } elseif ($this->age < $comparedAge) {
            return -1;
        }
        
        return 0;
    }	
    // END
}

class Car
{
    use ComparableByAge;

    private $year;
    private $brand;

    public function __construct($brand, $year)
    {
        $this->year = $year;
        $this->brand = $brand;
    }

    public function getYear()
    {
        return $this->year;
    }

    // BEGIN (write your solution here)
    public function compare(Car $newCar)
    {
        $comparedYear = $newCar->getYear();
        
        if ($this->year > $comparedYear) {
            return -1;
        } elseif ($this->year < $comparedYear) {
            return 1;
        }
        
        return 0;
    }
    // END
}


// === 

class TestCar extends \PHPUnit_Framework_TestCase
{
    public function testCarMoreLess()
    {
        $car1 = new Car('bmw', 1985);
        $car2 = new Car('lexus', 2000);

        $this->assertFalse($car2->isOlderThan($car1));
        $this->assertFalse($car1->isYoungerThan($car2));
    }

    public function testCarEqual()
    {
        $car1 = new Car('fiat', 1985);
        $car2 = new Car('reno', 2000);

        $this->assertFalse($car1->isAgeTheSame($car2));
    }
}

class TestUser extends \PHPUnit_Framework_TestCase
{
    public function testUserMoreLess()
    {
        $user1 = new User(10);
        $user2 = new User(11);

        $this->assertTrue($user2->isOlderThan($user1));
        $this->assertTrue($user1->isYoungerThan($user2));
    }

    public function testUserEqual()
    {
        $user1 = new User(10);
        $user2 = new User(10);

        $this->assertTrue($user1->isAgeTheSame($user2));
    }
}
