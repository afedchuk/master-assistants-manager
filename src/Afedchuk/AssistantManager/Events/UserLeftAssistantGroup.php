<?php

namespace Afedchuk\AssistantManager\Events;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\SerializesModels;

/**
 * Class UserLeftAssistantGroup
 * @package App\Business\UserAssistant\Events
 */
class UserLeftAssistantGroup
{
    use SerializesModels;
    /**
     * @type Model
     */
    protected $user;

    /**
     * @type int
     */
    protected $assistant;

    public function __construct($user, $assistant)
    {
        $this->user     = $user;
        $this->assistant = $assistant;
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
    public function getAssistant()
    {
        return $this->assistant;
    }
}
