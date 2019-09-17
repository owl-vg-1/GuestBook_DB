<?php

namespace App\Core;


trait DispatcherTrait
{
    public $dispatcher = [

        'feedback' => 'FeedBack/ShowForm',
        'login' => 'Auth/LoginForm',
        'logout' => 'Auth/Logout',
        'dashboard' => 'FeedBackAdmin/Show',
        'del{id}' => 'FeedbackAdmin/DelRow',
        'thanks' => 'Feedback/thanks',


        // '' => 'Error/',
        // '' => ''

        // 'one/page{page}' => 'TableOne/ShowTable',
        // 'one' => 'TableOne/ShowTable',
        // 'one/add_form' => 'TableOne/ShowAddForm',
        // 'one/add' => 'TableOne/AddRow',
        // 'one/edit_form{id}' => 'TableOne/ShowEditForm',
        // 'one/edit_{id}' => 'TableOne/EditRow',
        // 'one/del_{id}' => 'TableOne/DelRow',
        // 'two/page{page}' => 'TableTwo/ShowTable',
        // 'two' => 'TableTwo/ShowTable',
        // 'two/add_form' => 'TableTwo/ShowAddForm',
        // 'two/add' => 'TableTwo/AddRow',
        // 'two/edit_form{id}' => 'TableTwo/ShowEditForm',
        // 'two/edit{id}' => 'TableTwo/EditRow',
        // 'two/del{id}' => 'TableTwo/DelRow',
        // 'group/page{page}' => 'UserGroup/ShowTable',
        // 'group' => 'UserGroup/ShowTable',
        // 'group/add_form' => 'UserGroup/ShowAddForm',
        // 'group/add' => 'UserGroup/AddRow',
        // 'group/edit_form{id}' => 'UserGroup/ShowEditForm',
        // 'group/edit{id}' => 'UserGroup/EditRow',
        // 'group/del{id}' => 'UserGroup/DelRow',
        // 'user/page{page}' => 'Users/ShowTable',
        // 'user' => 'Users/ShowTable',
        // 'user/add_form' => 'Users/ShowAddForm',
        // 'user/add' => 'Users/AddRow',
        // 'user/edit_form{id}' => 'Users/ShowEditForm',
        // 'user/edit{id}' => 'Users/EditRow',
        // 'user/del{id}' => 'Users/DelRow',
        // '' => 'Site/Home',
    ];
}