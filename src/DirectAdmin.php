<?php

    namespace Lizzy\DirectadminLaravel;

    use Lizzy\DirectadminLaravel\DirectAdminCLI;


class DirectAdmin{

    public static function testConnection()
    {
        return config('Directadmin');
    }

    /**
     * The function `AddPointer` adds a pointer domain to a DirectAdmin domain.
     *
     * @param pointer The parameter "pointer" is the domain name or URL that you want to add as a
     * pointer to the main domain.
     *
     * @return the result of the query made to the DirectAdmin API.
     */
    public static function AddPointer($pointer){
        $DA_Domain = env('DIRECTADMIN_DOMAIN');
        $DA_Pointer = $pointer;
        $da = new DirectAdminCLI(env('DIRECTADMIN_HOST',null), env('DIRECTADMIN_USERNAME',null), env('DIRECTADMIN_PASSWORD',null));
        $result = $da->query("CMD_API_DOMAIN_POINTER?domain=".$DA_Domain,
            array("domain" => $DA_Domain,"action" => "add","from" => $DA_Pointer,"alias" => "yes"), "POST");
        return $result;
    }

    /**
     * The function DeletePointer deletes a pointer for a specified domain in DirectAdmin.
     *
     * @param pointer The "pointer" parameter is the domain pointer that you want to delete. It is the
     * alias domain that is associated with the main domain.
     *
     * @return the result of the query made to the DirectAdmin API.
     */
    public static function DeletePointer($pointer){
		$DA_Domain = env('DIRECTADMIN_DOMAIN');
        $da = new DirectAdminCLI(env('DIRECTADMIN_HOST',null), env('DIRECTADMIN_USERNAME',null), env('DIRECTADMIN_PASSWORD',null));
        $result = $da->query("CMD_API_DOMAIN_POINTER?domain=".$DA_Domain,
            array("domain" => $DA_Domain,"action" => "delete","select0" => $pointer,"alias" => "yes"), "POST");
        return $result;
    }
}
