<?php

namespace App\Models\Traits;

trait FilamentTrait
{
    /*
     * Returns whether the user is allowed to access Filament
     */
    public function canAccessFilament(): bool
    {
        return $this->isAdmin();
    }

    public function getFilamentAvatarUrl(): ?string
    {
        return $this->profile_image_path
            ? asset("storage/{$this->profile_image_path}")
            : 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($this->email))) . '?s=200&d=mp';
    }
}
