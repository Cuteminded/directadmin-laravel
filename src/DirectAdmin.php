<?php

namespace cuteminded\DirectadminLaravel;

use cuteminded\DirectadminLaravel\DirectAdminCLI;


class DirectAdmin
{

    /**
     * Tests the connection to a DirectAdmin server.
     *
     * @return bool Returns true if the connection is successful, false otherwise.
     */
    public static function checkConnection()
    {
        $cli = new DirectAdminCLI(config('Directadmin.default.host'), config('Directadmin.default.username'), config('Directadmin.default.password'));
        $result = json_decode((string)$cli->query("CMD_USER_STATS?json=yes&domain=".config('Directadmin.default.domain')));
        return (($result != null) and (!isset($result->error)));
    }

    /**
     * Retrieves domain information from a DirectAdmin server.
     *
     * The information typically includes details such as domain name, status, associated accounts,
     * and other relevant data.
     *
     * @return object Returns an object containing domain information if successful, or null if there's an error.
     */
    public static function domainInformation()
    {
        $cli = new DirectAdminCLI(config('Directadmin.default.host'), config('Directadmin.default.username'), config('Directadmin.default.password'));
        $result = json_decode((string)$cli->query("CMD_ADDITIONAL_DOMAINS?json=yes&domain=".config('Directadmin.default.domain')));
        try {
            return reset($result);
        } catch (\Throwable $th) {
            return null;
        }
    }

    /**
     * Retrieves statistics information for a user from a DirectAdmin server.
     *
     * @return object Returns an object containing statistics information if successful, or null if there's an error.
     */
    public static function UserStatistics()
    {
        $cli = new DirectAdminCLI(config('Directadmin.default.host'), config('Directadmin.default.username'), config('Directadmin.default.password'));
        $result = json_decode((string)$cli->query("CMD_USER_STATS?json=yes&domain=".config('Directadmin.default.domain')));
        return $result;
    }

    /**
     * Retrieves email information from a DirectAdmin server.
     *
     * @return object Returns an object containing email information if successful, or null if there's an error.
     */
    public static function emailInformation()
    {
        $cli = new DirectAdminCLI(config('Directadmin.default.host'), config('Directadmin.default.username'), config('Directadmin.default.password'));
        $result = json_decode((string)$cli->query("CMD_EMAIL_POP?json=yes&domain=".config('Directadmin.default.domain')));
        return $result;
    }

    /**
     * Retrieves system information from a DirectAdmin server.
     *
     * The information typically includes details such as server specifications, software versions,
     * resource usage, etc.
     *
     * @return object Returns an object containing system information if successful, or null if there's an error.
     */
    public static function systemInformation()
    {
        $cli = new DirectAdminCLI(config('Directadmin.default.host'), config('Directadmin.default.username'), config('Directadmin.default.password'));
        $result = json_decode((string)$cli->query("CMD_SYSTEM_INFO?json=yes&domain=".config('Directadmin.default.domain')));
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
    public static function createDomainPointer($pointer, $alias = true)
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
    public static function removeDomainPointer($pointer, $alias = true)
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
