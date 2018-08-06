<?php

namespace Afedchuk\AssistantManager\Contracts;

/**
 * Class MasterAssistantInterface
 * @package App\Business\UserAssistant\Contracts
 */
interface MasterAssistantInterface
{
    /**
     * Many-to-Many relations with the user model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function assistants();

    /**
     * Returns if the user owns a assistant
     *
     * @return bool
     */
    public function isOwner();

    /**
     * Alias to eloquent many-to-many relation's attach() method.
     *
     * @param mixed $assistant
     * @param array $pivotData
     */
    public function attachAssistant($assistant, $pivotData = []);

    /**
     * Alias to eloquent many-to-many relation's detach() method.
     *
     * @param mixed $assistant
     */
    public function detachAssistant($assistant);

    /**
     * Attach multiple assistants to a user
     *
     * @param mixed $assistants
     */
    public function attachAssistants($assistants);

    /**
     * Detach multiple assistants from a user
     *
     * @param mixed $assistants
     */
    public function detachAssistants($assistants);
}
