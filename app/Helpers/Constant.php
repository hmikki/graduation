<?php


namespace App\Helpers;


class Constant
{
    const NOTIFICATION_TYPE = [
        'General'=>1,
    ];
    const VERIFICATION_TYPE = [
        'Email'=>1,
        'Mobile'=>2
    ];
    const VERIFICATION_TYPE_RULES = '1,2';
    const FORGET_TYPE = [
        'Email'=>1,
        'Mobile'=>2
    ];
    const FORGET_TYPE_RULES = '1,2';
    const MEDIA_TYPE = [
        'Product'=>1,
    ];
    const TICKETS_STATUS = [
        'Open'=>1,
        'Closed'=>2
    ];
    const SETTING_TYPE = [
        'Page'=>1,
        'Notification'=>2,
        'Values'=>3,
    ];
    const USER_TYPE=[
        'Admin'=>2,
        'Doctor'=>1,
        'Supervisor' => 0,
    ];
    const USER_TYPE_RULES = '2,1,0';
    const ORDER_STATUSES = [
        'New' => 1,
        'Accepted' => 2,
        'Rejected' => 3,
        'Finished' => 4,
    ];
    const ORDER_STATUSES_RULES = '1,2,3,4';

    const PAYMENT_METHOD = [
        'BankTransfer'=>1,
        'Cash'=>2,
    ];
    const PAYMENT_METHOD_RULES = '1,2';
    const TRANSACTION_STATUS = [
        'Pending'=>1,
        'Paid'=>2,
    ];
    const TRANSACTION_TYPES = [
        'Deposit'=>1,
        'Withdraw'=>2,
        'Holding'=>3,
    ];
    const QUALITY = [
        'HIGH' => 2,
        'MID' => 1,
        'LOW' => 0,
    ];
    const QUALITY_RULES = '0,1,2';

    const SENDER_TYPE = [
        'User'=>1,
        'Admin'=>2,
    ];
    const NATIONALITY_TYPE=[
        1=> 'Palestinian',
        2=> 'Saudi Arabian',
        3=> 'Egyptian',
        4=> 'Britain',
        5=> 'Libyan',
        6=> 'Malagasy',
        7=> 'Moroccan',
        8=> 'Omani',
        9=> 'Pakistani',
        10=> 'Romanian',
        11=> 'Swedish',
        12=> 'Turkish',
        13=> 'Emirati',
        14=> 'American',
    ];
    const NATIONALITY_TYPE_RULES = ' 1 ,2 ,3 ,4 ,5 ,6 ,7 ,8 ,9 ,10 ,11 ,12 ,13 ,14';
    const GENDER_TYPE=[
        1=> 'Male',
        2=> 'Female',
    ];
    const GENDER_TYPE_RULES = ' 1 ,2 ';
    const MARITAL_STATUS_TYPE=[
        1=> 'Single',
        2=> 'Married',
        3=>'Divorced'
    ];
    const MARITAL_STATUS_TYPE_RULES = ' 1 ,2 , 3';
    const HIGH_SCHOOL_TYPE=[
        1=> 'Art/Science',
        2=> 'courses',
    ];
    const HIGH_SCHOOL_TYPE_RULES = ' 1 ,2';
}
