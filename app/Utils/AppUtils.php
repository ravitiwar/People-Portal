<?php


namespace App\Utils;


class AppUtils
{
    public static function getCapabilies()
    {
        return array_column(self::getMapingForendpoints(),'capability');
    }

    public static function getMapingForendpoints()
    {
        return [
            [
                'endpoint' => '/employee',
                'method' => 'get',
                'controller_path' => 'Api\EmployeeController@index',
                'capability' => 'employee_read',
            ],
            [
                'endpoint' => '/employee',
                'controller_path' => 'Api\EmployeeController@store',
                'capability' => 'employee_create',
                'method' => 'post',
            ],

            [
                'endpoint' => '/employee/{id}',
                'method' => 'put',
                'controller_path' => 'Api\EmployeeController@update',
                'capability' => 'employee_edit',
            ],

            [
                'endpoint' => '/employee/{id}',
                'method' => 'delete',
                'controller_path' => 'Api\EmployeeController@destroy',
                'capability' => 'employee_delete',
            ],
            [
                'endpoint' => '/conference-room',
                'method' => 'get',
                'controller_path' => 'Api\ConferenceRoomController@index',
                'capability' => 'conf_room_read',
            ],
            [
                'endpoint' => '/conference-room',
                'controller_path' => 'Api\ConferenceRoomController@store',
                'capability' => 'conf_room_create',
                'method' => 'post',
            ],

            [
                'endpoint' => '/conference-room/{id}',
                'method' => 'put',
                'controller_path' => 'Api\ConferenceRoomController@update',
                'capability' => 'conf_room_edit',
            ],

            [
                'endpoint' => '/conference-room/{id}',
                'method' => 'delete',
                'controller_path' => 'Api\ConferenceRoomController@destroy',
                'capability' => 'conf_room_delete',
            ],
            [
                'endpoint' => '/role',
                'method' => 'get',
                'controller_path' => 'Api\RoleController@index',
                'capability' => 'conf_room_read',
            ],
            [
                'endpoint' => '/role',
                'controller_path' => 'Api\RoleController@store',
                'capability' => 'conf_room_create',
                'method' => 'post',
            ],

            [
                'endpoint' => '/role/{id}',
                'method' => 'put',
                'controller_path' => 'Api\RoleController@update',
                'capability' => 'conf_room_edit',
            ],

            [
                'endpoint' => '/role/{id}',
                'method' => 'delete',
                'controller_path' => 'Api\RoleController@destroy',
                'capability' => 'conf_room_delete',
            ],
        ];
    }

    public static function getRoomStatuses()
    {
        return [
            'booked',
            'available'
        ];
    }
}
