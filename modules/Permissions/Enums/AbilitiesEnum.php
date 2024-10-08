<?php

namespace Permissions\Enums;

enum AbilitiesEnum: string
{
    // Restrict abilities
    case RESET_PASSWORD = 'reset_password';

    // General abilities
    case USERS = 'users';
    case PERMISSIONS = 'permissions';
    case REGISTER_STRATEGIES = 'register_strategies';
    case VIEW_STRATEGIES = 'view_strategies';
    case CALC_STRATEGIES = 'calc_strategies';
    case STRATEGY_INFERENCE = 'strategy_inference';

    public static function availableAbilities(): array
    {
        return [
            self::USERS,
            self::PERMISSIONS,
            self::REGISTER_STRATEGIES,
            self::VIEW_STRATEGIES,
            self::CALC_STRATEGIES,
            self::STRATEGY_INFERENCE,
        ];
    }

    public static function requireAllAbilities(array $abilities): string
    {
        $abilities = array_map(fn (self $ability) => $ability->value, $abilities);

        return 'abilities:' . implode(',', $abilities);
    }

    public static function requireAnyAbility(array $abilities): string
    {
        return 'ability:' . implode(',', $abilities);
    }
}
