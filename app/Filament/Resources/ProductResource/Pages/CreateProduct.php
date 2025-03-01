<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;
    protected array $temporaryImages = [];

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $images = $data['productImages'] ?? [];
        unset($data['productImages']);

        // Store images temporarily for use in afterSave
        $this->temporaryImages = $images;

        return $data;
    }

    protected function afterSave(): void
    {
        $images = $this->temporaryImages ?? [];

        // Remove old images and replace with new ones
        $this->record->productImages()->delete();

        foreach ($images as $index => $image) {
            $this->record->productImages()->create([
                'image_path' => $image['image'],
                'order_number' => $index + 1
            ]);
        }
    }

}
