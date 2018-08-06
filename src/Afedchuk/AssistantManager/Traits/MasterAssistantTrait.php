<?php

namespace Afedchuk\AssistantManager\Traits;

use Afedchuk\AssistantManager\Events\UserJoinedAssistantGroup;
use Afedchuk\AssistantManager\Events\UserLeftAssistantGroup;
use Afedchuk\AssistantManager\Assistant;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserAssistantTrait
 * @package App\Business\UserAssistant\Traits
 */
trait MasterAssistantTrait
{
    /**
     * Boot the user model
     * Attach event listener to remove the many-to-many records when trying to delete
     * Will NOT delete any records if the user model uses soft deletes.
     *
     * @return void|bool
     */
    public static function bootUserHasAssistants()
    {
        static::deleting(function (Model $user) {
            if (!method_exists(\Config::get( 'assistant-manager.user_model' ), 'bootSoftDeletes')) {
                $user->assistants()->sync([]);
            }
            return true;
        });
    }

    /**
     * Many-to-Many relations with the user model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function assistants()
    {
        return $this->belongsToMany(Assistant::class, \Config::get( 'assistant-manager.user_assistants_table' ))
            ->withTimestamps();
    }

    /**
     * Returns if the user owns a assistant
     * @param int $id
     *
     * @return bool
     */
    public function isOwner($id)
    {
        return ($this->assistants()->where("assistant_id", "=", $id)->first()) ? true : false;
    }

    /**
     * @return mixed
     */
    public function ownedAssistants()
    {
        return $this->assistants()->where("user_id", "=", $this->getKey());
    }

    /**
     * Alias to eloquent many-to-many relation's attach() method.
     *
     * @param mixed $assistant
     * @param array $pivotData
     * @return $this
     */
    public function attachAssistant($assistant, $pivotData = [])
    {
        $this->load('assistants');
        if (!$this->assistants->contains($assistant)) {
            $this->assistants()->attach($assistant);

            event(new UserJoinedAssistantGroup($this, $assistant));

            if ($this->relationLoaded('assistants')) {
                $this->load('assistants');
            }
        }

        return $this;
    }

    /**
     * Alias to eloquent many-to-many relation's detach() method.
     *
     * @param mixed $assistant
     * @return $this
     */
    public function detachAssistant($assistant)
    {
        $this->assistants()->detach($assistant);
        event(new UserLeftAssistantGroup($this, $assistant));
        if ($this->relationLoaded('assistants')) {
            $this->load('assistants');
        }

        return $this;
    }

    /**
     * Attach multiple assistants to a user
     *
     * @param mixed $assistants
     * @return $this
     */
    public function attachAssistants($assistants)
    {
        foreach ($assistants as $assistant) {
            $this->attachAssistant($assistant);
        }

        return $this;
    }

    /**
     * Detach multiple assistants from a user
     *
     * @param mixed $assistants
     * @return $this
     */
    public function detachAssistants($assistants)
    {
        foreach ($assistants as $assistant) {
            $this->detachAssistant($assistant);
        }

        return $this;
    }
}
