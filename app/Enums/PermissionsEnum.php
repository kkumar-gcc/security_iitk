<?php

namespace App\Enums;

enum PermissionsEnum: string {
    case ADMIN_ACCESS = "admin access";
    case ACCESS_USERS = "access users";
    case CREATE_USERS = "create users";
    case EDIT_USERS = "edit users";
    case DELETE_USERS = "delete users";
    case ACCESS_ALL_REPORTS = "access all reports";
    case ACCESS_OWN_REPORTS = "access own reports";
    case CREATE_REPORTS = "create reports";
    case EDIT_ALL_REPORTS = "edit all reports";
    case EDIT_OWN_REPORTS = "edit own reports";
    case DELETE_ALL_REPORTS = "delete all reports";
    case DELETE_OWN_REPORTS = "delete own reports";
    case ACCESS_ROLES = "access roles";
    case CREATE_ROLES = "create roles";
    case EDIT_ROLES = "edit roles";
    case DELETE_ROLES = "delete roles";
    case ASSIGN_ROLES = "assign roles";
    case ACCESS_PERMISSIONS = "access permissions";
    case ASSIGN_PERMISSIONS = "assign permissions";

    public static function toArray(): array
    {
        return [
            self::ADMIN_ACCESS,
            self::ACCESS_USERS,
            self::CREATE_USERS,
            self::EDIT_USERS,
            self::DELETE_USERS,
            self::ACCESS_ALL_REPORTS,
            self::ACCESS_OWN_REPORTS,
            self::CREATE_REPORTS,
            self::EDIT_ALL_REPORTS,
            self::EDIT_OWN_REPORTS,
            self::DELETE_ALL_REPORTS,
            self::DELETE_OWN_REPORTS,
            self::ACCESS_ROLES,
            self::CREATE_ROLES,
            self::EDIT_ROLES,
            self::DELETE_ROLES,
            self::ASSIGN_ROLES,
            self::ACCESS_PERMISSIONS,
            self::ASSIGN_PERMISSIONS,
        ];
    }
}
