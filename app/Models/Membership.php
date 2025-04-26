<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\CarbonImmutable;
use Laravel\Jetstream\Membership as JetstreamMembership;

/**
 * @property int $id
 * @property int $team_id
 * @property int $user_id
 * @property string|null $role
 * @property CarbonImmutable|null $created_at
 * @property CarbonImmutable|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Membership newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Membership newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Membership query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Membership whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Membership whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Membership whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Membership whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Membership whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Membership whereUserId($value)
 *
 * @mixin \Eloquent
 */
final class Membership extends JetstreamMembership
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;
}
