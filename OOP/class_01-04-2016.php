<?php
/**
 * Created by PhpStorm.
 * User: litter
 * Date: 01.04.16
 * Time: 19:23
 */

interface iHeavyCar
{
    function createTank();
    function createBmp();
}

abstract class AbstractCar implements iHeavyCar
{
    abstract function createCityCar();
}

class Car extends AbstractCar
{

    public function createCityCar()
    {
        return 'Car created<br>';
    }

    public function createTank()
    {
        return 'Tank created<br>';
    }
    public function createBmp()
    {
        return 'BMP created<br>';
    }
}

$myCat = new Car;
echo $myCat->createCityCar();
echo $myCat->createBmp();
echo $myCat->createTank();