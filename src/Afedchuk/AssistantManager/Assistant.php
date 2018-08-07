<?php
namespace Afedchuk\AssistantManager;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class UserAssistant
 * @package App
 */
class Assistant extends Model
{
    use SoftDeletes;

    public function __construct(array $attributes = [])
    {
        $this->table = \Config::get( 'assistant-manager.users_table' );
        parent::__construct($attributes);
    }
}
