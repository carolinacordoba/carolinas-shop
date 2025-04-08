<?php

class Employee
{
    public $id;
    public $name;
    public $email;
    public $hourySalary;
    function __construct($id, $name)
    {
        $this->name = $name;
        $this->id = $id;
    }
    // I KLASS = metod, utanför klass = funktion
    function calculateSalary($hours)
    {
        $bonus = 0;
        if ($hours > 40) {
            $bonus = 100;
        }
        return ($this->hourySalary * $hours) + $bonus;
    }

}

$stefan = new Employee(1, "Stefan");
$stefan->email = "a@a.com";
$stefan->hourySalary = 100;
$oliver = new Employee(2, "Oliver");
$oliver->email = "n@n.com";
$oliver->hourySalary = 200;
$salary = $stefan->calculateSalary(50);
//$salary = calculateSalary($stefan, 50);
$salary2 = $oliver->calculateSalary(80);
?>