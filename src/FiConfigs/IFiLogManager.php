<?php

/**
 * Bunla ilgili bir implemantasyon yapılmadı henüz
 */
interface IFiLogManager
{
    // 
    public function debug(string $message): void;

    public function error(string $message): void;

    //public function logMessage(string $message, Type $refType): void;

}