<?php

class SolutionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testExceptionUsingAnnotation()
    {
        throw new \InvalidArgumentException('Some Message)';
    }
    
    public function testExceptionUsingTry()
    {
        try {
            throw new \InvalidArgumentException('Some Message');
            $this->fail('excepted exception');
        } catch (\InvalidArgumentException $e) {            
        }
    }
}

/**
 * ACL (access control list) это механизм проверки доступа определенных ролей к действиям над определенными ресурсами.
 * 
 * Включает понятия:
 * 
 * Роль - кто выполняет действие.
 * Ресурс - над чем выполняется действие.
 * Привилегия - какое выполняется действие.
 * Например, администратор может редактировать карточку пользователя. 
 * Здесь роль - администратор, пользователь - ресурс, редактировать - привилегия.
 * 
 * Принцип работы системы ACL из этого упражнения:
 * 
 * $data = [
 *     'articles' => [
 *         'show' => ['editor', 'manager'],
 *         'edit' => ['editor']
 *     ],
 *     'money' => [
 *         'create' => ['editor'],
 *         'show' => ['editor', 'manager'],
 *         'edit' => ['manager'],
 *         'remove' => ['manager']
 *     ]
 * ];
 * 
 * $acl = new Acl($data);
 * 
 * $acl->check('articles', 'show', 'manager')
 * 
 * Напишите тесты на функцию check объекта $acl. 
 * Функция принимает на вход ресурс, привилегию и роль. 
 * 
 * Принцип работы этой функции:
 * 
 * Если не найден ресурс - бросаем исключение Acl\ResourceUndefined.
 * Если не найдена привилегия - бросаем исключение Acl\PrivilegeUndefined.
 * Если доступ запрещен - Acl\AccessDenied.
 */

require_once 'implementations/Acl/AccessDenied.php';
require_once 'implementations/Acl/ResourceUndefined.php';
require_once 'implementations/Acl/PrivilegeUndefined.php';

class TestSolution extends \PHPUnit_Framework_TestCase
{
    private static $data = [
        'articles' => [
            'show' => ['editor', 'manager'],
            'edit' => ['editor']
        ],
        'money' => [
            'create' => ['editor'],
            'show' => ['editor', 'manager'],
            'edit' => ['manager'],
            'remove' => ['manager']
        ]
    ];

    public function testAccessDenied()
    {
        $acl = new Acl(static::$data);

        // BEGIN (write your solution here)
        try {
            $acl->check('articles', 'edit', 'manager');
            $acl->check('money', 'create', 'manager');
            $this->fail('expected exception');
        } catch (Acl\AccessDenied $e) {
        }
        // END
    }

    // BEGIN (write your solution here)
    public function testResourceUndefined()
    {
        $acl = new Acl(static::$data);
        
        try {
            $acl->check('new_resource', 'edit', 'manager');
            $this->fail('expected exception');
        } catch (Acl\ResourceUndefined $e) {
        }
    }
    
    public function testPrivilegeUndefined()
    {
        $acl = new Acl(static::$data);
        
        try {
            $acl->check('articles', 'create', 'manager');
            $this->fail('expected exception');
        } catch (Acl\PrivilegeUndefined $e) {
        }
    }
    // END
}


