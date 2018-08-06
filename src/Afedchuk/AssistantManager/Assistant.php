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

    /**
     * Set the table associated with the model.
     *
     * @param  string  $table
     * @return $this
     */
    public function setTable($table)
    {
        $this->table = \Config::get( 'assistant-manager.users_table' );

        return $this;
    }
}
