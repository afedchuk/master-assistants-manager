<?php
/**
 * This file is part of Teamwork
 *
 * @license MIT
 * @package Teamwork
 */
return [
    /*
    |--------------------------------------------------------------------------
    | Auth Model
    |--------------------------------------------------------------------------
    |
    | This is the Auth model used by Assistant manager.
    |
    */
    'user_model' => config('auth.providers.users.model', App\User::class),
    /*
    |--------------------------------------------------------------------------
    | Users Table
    |--------------------------------------------------------------------------
    |
    | This is the users table name used by Assistant manager.
    |
    */
    'users_table' => 'users',
    /*
    |--------------------------------------------------------------------------
    | Assistant Model
    |--------------------------------------------------------------------------
    |
    | This is the Assistant model used by Assistant manager to create correct relations.
    |
    */
    'user_assistant_model' => Afedchuk\AssistantManager\Assistant::class,
    /*
    |--------------------------------------------------------------------------
    | User assistants Table
    |--------------------------------------------------------------------------
    |
    | This is the assistants table name used by user to save assistants to the database.
    |
    */
    'user_assistants_table' => 'user_assistants',
];