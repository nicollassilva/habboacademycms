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
        return asset("storage/{$this->profile_image_path}");
    }
}