<?php

// Задание 1-3

class User
{
    protected $id;
    protected $login;
    protected $passwordHash;
    protected $username;
    protected $gender;
    protected $age;
    protected $about;
    protected $role;
    protected $status;

    public function __construct($id, $login, $passwordHash, $username, $gender, $age, $about, $role, $status)
    {
        $this->id = $id;
        $this->login = $login;
        $this->passwordHash = $this->ChangePassword($password);
        $this->username = $username;
        $this->gender = $gender;
        $this->age = $age;
        $this->about = $about;
        $this->role = $role;
        $this->status = $status;
    }

    public function ChangePassword($password)
    {
        return password_hash($password, $algo = PASSWORD_DEFAULT);
    }

    public function changeUsername($username)
    {
        $this->username = $username;
    }

    public function blockSelf()
    {
        $this->status = 'blocked';
    }
}

$user1 = new User(1, 'test', '12345', 'John', 'male', 20, 'I am a human', 'N/A', 'active');
//echo '<p>Newly created user</p>';
//var_dump($user1);

$user1->changeUsername('Jack');
$user1->blockSelf();
// echo '<p>Calling methods on User</p>';
// var_dump($user1);

// Задание 4

class RegularUser extends User
{
    protected $cart;

    public function __construct($id, $login, $passwordHash, $username, $gender, $age, $about, $role, $status)
    {
        parent::__construct($id, $login, $passwordHash, $username, $gender, $age, $about, $role, $status);
        $this->role = 'regular user';
        $this->cart = new Cart($id); // Сюда помещается объект корзины.
    }

    public function addToCart($item)
    {
        // Прверяем, находится ли товар в корзине
        if (!isset($this->getCart()->getItems()[$item->getId()])) {
            $this->cart->addToSelf($item);
        } else {
            $this->cart->changeQuantity($item->getId(), 'increase');
        }
    }

    public function getCart()
    {
        return $this->cart;
    }
}

class Cart
{
    protected $userId;
    protected $items;

    public function __construct($userId)
    {
        $this->userId = $userId;
        $this->items = [];
    }

    public function addToSelf($item)
    {
        // Добавляем клон объекта в корзину
        $this->items[$item->getId()] = clone $item;
        $this->items[$item->getId()]->setQuantity(1);
        $this->items[$item->getId()]->setLocation('in cart');
    }

    public function changeQuantity($itemId, $direction = 'increase')
    {
        foreach ($this->items as $value) {
            switch ($direction) {
                case 'increase':
                    if ($itemId == $value->getId()) {
                        $quantity = $value->getQuantity() + 1;
                        $value->setQuantity($quantity);
                        break;
                    }
                    break;
                
                case 'decrease':
                    if ($itemId == $value->id) {
                        $quantity = $value->getQuantity() + 1;
                        $value->setQuantity($quantity);
                        break;
                    }
                    break;
            }
        }
    }

    public function getItems()
    {
        return $this->items;
    }
}

class Item
{
    protected $id;
    protected $name;
    protected $price;
    protected $quantity;
    protected $location;

    public function __construct($id, $name, $price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->quantity = 'N/A';
        $this->location = 'on display';
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setLocation($location)
    {
        $this->location = $location;
    }
}

$item2 = new Item(1, 'Chair', 50);
$user2 = new RegularUser(1, 'test', '12345', 'John', 'male', 20, 'I am a human', 'N/A', 'active');
// echo '<p>Newly created regular user</p>';
// var_dump($user2);

$user2->addToCart($item2);
// echo '<p>Adding items to cart</p>';
// var_dump($user2);
// echo '<p>Showing cart</p>';
// var_dump($user2->getCart());

$user2->addToCart($item2);
// echo '<p>Increasing quantity</p>';
// var_dump($user2->getCart());

class Administrator extends User
{
    protected $accessLevel;

    public function __construct($id, $login, $passwordHash, $username, $gender, $age, $about, $role, $status, $accessLevel)
    {
        parent::__construct($id, $login, $passwordHash, $username, $gender, $age, $about, $role, $status);
        $this->role = 'administrator';
        $this->accessLevel = $accessLevel;
    }

    public function blockUser($user)
    {
        if ($this->accessLevel == 'medium' OR $this->accessLevel == 'high') {
            $user->blockSelf();
        } else {
            echo 'Your access level is to low <br>';
        }
    }

    public function increaseAccessLevel()
    {
        if ($this->accessLevel == 'low') {
            $this->accessLevel = 'medium';
        } elseif ($this->accessLevel == 'medium') {
            $this->accessLevel = 'high';
        } else {
            echo 'Your access level is already at maximum <br>';
        }
    }
}

$user3 = new Administrator(1, 'test', '12345', 'John', 'male', 20, 'I am a human', 'N/A', 'active', 'low');
// var_dump($user3);

// $user3->blockUser($user2);
$user3->increaseAccessLevel();
$user3->increaseAccessLevel();
// $user3->increaseAccessLevel();
$user3->blockUser($user2);
// var_dump($user2);

// Задание 5

/*
class A
{
    public function foo()
    {
        static $x = 0;
        echo ++$x;
    }
}

$a1 = new A(); // Создаст экземпляр класса A
$a2 = new A(); // Создаст экземпляр класса A
$a1->foo(); // Выведет '1'
$a2->foo(); // Выведет '1'
$a1->foo(); // Выведет '2'
$a2->foo(); // Выведет '2'
*/

// Вывел 1, 2, 3, 4. static внутри функции приводит к тому, что функция "запоминает переменную между вызовами (чем-то похоже на замыкания в JS)
// Однако static внутри метода видимо записывается в сам класс, а не в конкретный экземпляр объекта.
/* When a static variable is defined inside a class method they will always refer to the class on which the method was called.
In doing this they act almost like properties referenced through static, though there are subtle differences.
http://joshduck.com/blog/2010/03/19/exploring-phps-static-scoping/ */

// Задание 6

/*
class A
{
    public function foo()
    {
        static $x = 0;
        echo ++$x;
    }
}

class B extends A
{
}

$a1 = new A(); // Создаст экземпляр класса A
$b1 = new B(); // Создаст экземпляр класса B
$a1->foo(); // Выведет 1
$b1->foo(); // Выведет 1
$a1->foo(); // Выведет 2
$b1->foo(); // Выведет 2
*/

// Так и вывел. Так как static относится к классу, а классы у $a1 и $b1 разные
/* Static variables can’t preserve the calling class scope.
This can be potentially problematic if you have an inherited method containing a static variable that is called from both inside and outside its class.
http://joshduck.com/blog/2010/03/19/exploring-phps-static-scoping/ */

// Задание 7

class A
{
    public function foo()
    {
        static $x = 0;
        echo ++$x;
    }
}

class B extends A
{
}

$a1 = new A;
$b1 = new B;
$a1->foo(); 
$b1->foo(); 
$a1->foo(); 
$b1->foo();
// Код почти полностью повторяет код из 6 задания, за исключением скобок после new A и new B.
// Выводит также 1, 1, 2, 2. То есть наличие скобок не влияет на поведение static.