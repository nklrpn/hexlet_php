<?php
/*
DSL (Domain Specific Language) - это декларативный "язык", созданный под конкретную область. Например, регулярные выражения - это DSL. Html, а так же SQL - это тоже DSL.

Часто бывает удобно создавать DSL для библиотек для упрощения использования и понимания кода. Пример с dsl для генерации html в php:

$tree = h('div', [],
    h('img', ['src' => 'link/to/path']),
    h('div', ['class' => 'row'],
        'body',
        h('p', [], 'paragraph1'),
        h('p', [], 'paragraph2')
    )
);

$tree->toString();

// <div><img src="link/to/path"><div class="row">body<p>paragraph1</p><p>paragraph2</p></div></div>
Как видно, это обычный php код, в котором используется всего лишь одна функция. Эта функция принимает на вход два обязательных параметра, а так же переменное число необязательных. Первым параметром функция принимает название тега, вторым - список атрибутов. Все остальные аргументы рассматриваются как дочерние теги, помещенные внуть данного тега.

Внутри функции h строится дерево из узлов, переданных снаружи. Без dsl тот же код выглядит так:

$img = new Img(['src' => 'link/to/path']);
$div = new Div(['class' => 'row'], [
  'body',
  new Paragraph('paragraph1'),
  new Paragraph('paragraph1')
]);

$tree = new Div($img, [$div]);
Это то, что происходит за кулисами.

Реализуйте метод toString, чтобы он возвращал строковое представление html.
*/

class Tag
{
    protected $attributes = [];

    public function getAttributes()
    {
        return $this->attributes;
    }
}

interface TagInterface
{
    public function getAttributes();
    public function toString();
}

class SingleTag extends Tag implements TagInterface
{
    public function __construct($attributes = [])
    {
        $this->attributes = $attributes;
    }

    // BEGIN (write your solution here)
    public function toString()
    {
        $attributes = [];
        
        foreach ($this->getAttributes() as $key => $value) {
            $attributes[] = $key . '=' . '"' . $value . '"';
        }

        return '<' . $this->getName() . ' ' . implode(' ', $attributes) . '>';
    }   
    // END
}

class PairedTag extends Tag implements TagInterface
{
    protected $children = [];

    public function __construct($attributes = [], $children = [])
    {
        $this->attributes = $attributes;
        $this->children = $children;
    }

    // BEGIN (write your solution here)
    public function toString()
    {
        $attributes = [];
        
        foreach ($this->getAttributes() as $key => $value) {
            $attributes[] = $key . '=' . '"' . $value . '"';
        }

        $attributeString = empty($attributes) ? '' : ' ' . implode(' ', $attributes);

        $tagData = [];
        $tagData[] = '<' . $this->getName() . $attributeString . '>';
        
        $tagData[] = implode('', array_map(function ($child) {
            return is_string($child) ? $child : $child->toString();
        }, $this->children));
        
        $tagData[] = '</' . $this->getName() . '>';

        return implode('', $tagData);
    }
    // END
}

class Div extends PairedTag
{
    public function getName()
    {
        return 'div';
    }
}

class Img extends SingleTag
{
    public function getName()
    {
        return 'img';
    }
}

class Paragraph extends PairedTag
{
    public function getName()
    {
        return 'p';
    }
}

function h($tagName, array $attributes, ...$children)
{
    switch ($tagName) {
        case 'div':
            return new \tree\tags\Div($attributes, $children);
        case 'p':
            return new \tree\tags\Paragraph($attributes, $children);
        case 'img':
            return new \tree\tags\Img($attributes);
        default:
            throw new \Exception("'{$tagName}' is undefined");
    }
}