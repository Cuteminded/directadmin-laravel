<?php

namespace Lizzy\DirectadminLaravel;

use Lizzy\DirectadminLaravel\DirectAdminCLI;


class DirectAdmin
{
    /**
     * domain information using the provided credentials, and returns the result as a JSON object.
     *
     * @return the result of the query made to the DirectAdmin CLI. The result is being decoded from
     * JSON format and returned as an object.
     */
    public static function testConnection()
    {
        $cli = new DirectAdminCLI(config('Directadmin.default.host'), config('Directadmin.default.username'), config('Directadmin.default.password'));
        $result = json_decode((string)$cli->query("CMD_SHOW_DOMAIN?json=yes&domain=".config('Directadmin.default.domain')));
        return $result;
    }

    /**
     * returns statistics for a user from a DirectAdmin control panel.
     */
    public static function getStatistics()
    {
        $cli = new DirectAdminCLI(config('Directadmin.default.host'), config('Directadmin.default.username'), config('Directadmin.default.password'));
        $result = json_decode((string)$cli->query("CMD_USER_STATS?json=yes&domain=".config('Directadmin.default.domain')));
        return $result;
    }

    /**
     * Adds a pointer domain to a DirectAdmin account.
     *
     * @param pointer The pointer parameter is the domain pointer that you want to add. It is the
     * domain that is being pointed to another domain.
     * @param alias The "alias" parameter is a boolean value that determines whether the pointer being
     * added as an alias or not. If the value is true, it means the pointer is an alias, and if the
     * value is false, it means the pointer is not an alias.
     * 
     * @return the result of the query made to the DirectAdmin CLI.
     */
    public static function addPointer($pointer, $alias = true)
    {
        $cli = new DirectAdminCLI(config('Directadmin.default.host'), config('Directadmin.default.username'), config('Directadmin.default.password'));
        $result = $cli->query(
            "CMD_API_DOMAIN_POINTER?domain=" . config('Directadmin.default.domain'),
            array(
                "domain" => config('Directadmin.default.domain'),
                "action" => "add",
                "from" => $pointer,
                "alias" => ($alias) ? 'yes' : 'no'
            ),
            "POST"
        );
        return $result;
    }


    /**
     * Removes a pointer domain from a DirectAdmin account.
     * 
     * @param pointer The pointer parameter is the domain pointer that you want to delete. It is the
     * domain that is being pointed to another domain.
     * @param alias The "alias" parameter is a boolean value that determines whether the pointer being
     * deleted is an alias or not. If the value is true, it means the pointer is an alias, and if the
     * value is false, it means the pointer is not an alias.
     * 
     * @return the result of the query made to the DirectAdmin CLI.
     */
    public static function deletePointer($pointer, $alias = true)
    {
        $cli = new DirectAdminCLI(config('Directadmin.default.host'), config('Directadmin.default.username'), config('Directadmin.default.password'));
        $result = $cli->query(
            "CMD_API_DOMAIN_POINTER?domain=" . config('Directadmin.default.domain'),
            array(
                "domain" => config('Directadmin.default.domain'),
                "action" => "delete",
                "select0" => $pointer,
                "alias" => ($alias) ? 'yes' : 'no'
            ),
            "POST"
        );
        return $result;
    }
}
