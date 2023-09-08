<?php
require_once 'functions.php';

const HOST = "localhost";
const USER = "root";
const PASSWORD = "";
const DB = "shopping";
const CHARSET = "utf8mb4";

$pdoOptions = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false
];

$dsn = "mysql:host=" . HOST  . ";dbname=" . DB . ";charset=". CHARSET;

$pdo = connectDatabase($dsn, $pdoOptions);

const SITE = "http://localhost/nemanja_kosanovic/";

$messages = [
    0 => 'No direct access!',
    1 => 'Unknown user!',
    2 => 'User already exists, try another one!',
    3 => 'Check your email to active your account!',
    4 => 'Fill all the fields!',
    5 => 'You are logged out!!',
    6 => 'Account has been successfully activated!',
    7 => 'Passwords are not matching!',
    8 => 'Email format is not valid!',
    9 => 'Password must be minimum 8 characters long!',
    10 => 'Password is not strong enough!' . '<br/>' . '(min 8 characters, at least 1 lowercase character, 1 uppercase character, 1 number, and 1 special character',
    11 => 'Something went wrong with email server. Email will be sent later!',
    12 => 'Account already activated!',
    14 => 'If you have account on our site, email with instructions for reset password is sent to you.',
    15 => 'Password has been updated. Try logging in now.',
    16 => 'Token or other data are invalid!',
    18 => 'Check your credentials and try again',
    21 => 'Your response is saved.',
    22 => 'Your response is updated.',
    23 => 'Account is banned! Contact our support for more information.',
    25 => 'User has been successfully banned.',
    26 => 'Something went wrong, please try again.',
    36 => 'Check params down below, then submit update form again.',
    41 => 'Name must me at least 3 characters long and it can not be numeric.',
    42 => 'Please set your new name',
    43 => 'Fill update password form!',
    44 => 'Passwords do not match!',
    45 => 'Password updated!',
    46 => 'Password is not valid',
    47 => 'Your list has been successfully created!',
    48 => 'Name cannot be empty!',
    49 => 'Description cannot be empty',
    50 => 'Name must be at least 3 character long and cannot be longer then 30!',
    51 => 'Description must be at least 5 character long and cannot be longer then 50!',
    52 => 'Wrong date!',
    53 => 'It must be future date!',
    54 => 'Undefined list',
    55 => 'The list has been successfully updated!'
];

$emailMessages = [
    'register' => [
        'subject' => 'Register on web site',
        'altBody' => 'This is the body in plain text for non-HTML mail clients'
    ],
    'forget' => [
        'subject' => 'Forgotten password - create new password',
        'altBody' => 'This is the body in plain text for non-HTML mail clients'
    ],
];
