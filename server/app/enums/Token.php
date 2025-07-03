<?php



enum TokenType: string
{
    case STUDENT = 'MODEL/STUDENT';
    case TEACHER = 'MODEL/TEACHER';
    case ADMIN = 'MODEL/ADMIN';
}

enum TokenAbility: string
{
    case CREATE = 'create';
    case READ = 'read';
    case UPDATE = 'update';
    case DELETE = 'delete';
    case ALL = '*';
}
