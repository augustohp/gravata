<?php

namespace Gravata\Service\Gravatar;

class EmailHashCalculatortest extends \PHPUnit_Framework_TestCase
{
    public function testCalculateEmailHash()
    {
        $rawEmail = 'augusto.hp@gmail.com';
        $expectedHash = '89de242e444d231e9928320af0417571';
        $calculator = new EmailHashCalculator;

        $this->assertEquals($expectedHash, $calculator->calculate($rawEmail));
    }

    public function testCalculateEmailHashWithUpperCaseEmail()
    {
        $rawEmail = 'AUGUSTO.HP@GMAIL.COM';
        $expectedHash = '89de242e444d231e9928320af0417571';
        $calculator = new EmailHashCalculator;

        $this->assertEquals($expectedHash, $calculator->calculate($rawEmail));
    }

    public function testCalculateEmailHashWithTrailingSpaces()
    {
        $rawEmail = 'augusto.hp@gmail.com ';
        $expectedHash = '89de242e444d231e9928320af0417571';
        $calculator = new EmailHashCalculator;

        $this->assertEquals($expectedHash, $calculator->calculate($rawEmail));
    }

}
