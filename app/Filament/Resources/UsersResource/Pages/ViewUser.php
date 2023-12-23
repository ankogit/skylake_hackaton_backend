<?php

namespace App\Filament\Resources\UsersResource\Pages;

use App\Filament\Resources\UserResource;
use App\Filament\Resources\UsersResource;
use Filament\Actions;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;

class ViewUser extends ViewRecord
{
    protected static string $resource = UsersResource::class;

    protected static string $view = 'filament.resources.users.pages.view-user';

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
