<?php

namespace Afedchuk\AssistantManager\Events;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\SerializesModels;

/**
 * Class UserJoinedAssistantGroup
 * @package App\Business\UserAssistant\Events
 */
class UserJoinedAssistantGroup
{
    use SerializesModels;
    /**
     * @type Model
     */
    protected $user;

    /**
     * @type int
     */
    protected $group_id;

    public function __construct($user, $group_id)
    {
        $this->user     = $user;
        $this->group_id = $group_id;
    }

    /**
     * @return Model
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return int
     */
    public function getGroupId()
    {
        return $this->group_id;
    }
}
