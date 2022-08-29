<?php


namespace App\Domains\Interfaces;


interface Rulable
{
    public function run(): bool;
    public function getMessage():string;
}