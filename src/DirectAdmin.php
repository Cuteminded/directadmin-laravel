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
     * @param pointer The "pointer" parameter is the domain or subdomain that you want to add as a
     * pointer to the main domain. It can be a string representing the domain name or subdomain name.
     * @param alias The "alias" parameter is an optional parameter that specifies whether the pointer
     * should be added as an alias or not. If the value of "alias" is set to "yes", the pointer will be
     * added as an alias. If the value is set to "no" or not provided, the pointer
     *
     * @return the result of the query made to the DirectAdmin CLI.
     */
    public static function addPointer($pointer, $alias = 'yes')
    {
        $cli = new DirectAdminCLI(config('Directadmin.default.host'), config('Directadmin.default.username'), config('Directadmin.default.password'));
        $result = $cli->query(
            "CMD_API_DOMAIN_POINTER?domain=" . config('Directadmin.default.domain'),
            array(
                "domain" => config('Directadmin.default.domain'),
                "action" => "add",
                "from" => $pointer,
                "alias" => $alias
            ),
            "POST"
        );
        return $result;
    }

    /**
     * Removes a pointer domain to a DirectAdmin account.
     *
     * @param pointer The "pointer" parameter is the domain pointer that you want to delete. It is the
     * domain that is pointing to another domain or website.
     * @param alias The "alias" parameter is an optional parameter that specifies whether the pointer
     * being deleted is an alias or not. By default, it is set to 'yes', which means that the pointer
     * being deleted is an alias. If you want to delete a non-alias pointer, you can set the "alias
     *
     * @return the result of the query made to the DirectAdmin CLI.
     */
    public static function deletePointer($pointer, $alias = 'yes')
    {
        $cli = new DirectAdminCLI(config('Directadmin.default.host'), config('Directadmin.default.username'), config('Directadmin.default.password'));
        $result = $cli->query(
            "CMD_API_DOMAIN_POINTER?domain=" . config('Directadmin.default.domain'),
            array(
                "domain" => config('Directadmin.default.domain'),
                "action" => "delete",
                "select0" => $pointer,
                "alias" => $alias
            ),
            "POST"
        );
        return $result;
    }
}
